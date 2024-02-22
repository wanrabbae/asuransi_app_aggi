<?php

namespace App\Http\Controllers;

use App\Mail\PaymentFirstInsuranceSuccess;
use App\Models\AhliWaris;
use App\Models\commission;
use App\Models\Email;
use App\Models\OnlineProduct;
use App\Models\Logger;
use App\Models\OnlineTransaction;
use App\Models\Payment;
use App\Models\Target;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    public function sendPayment($data)
    {
        $va = env('IPAYMU_VA');
        $apiKey = env('IPAYMU_KEY');
        $timestamp = Date('YmdHis');
        $ch = curl_init(env('IPAYMU_URL') . "/payment");

        // signature generate
        $jsonBody     = json_encode($data, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper("POST") . ':' . $va . ':' . $requestBody . ':' . $apiKey;
        $signature    = hash_hmac('sha256', $stringToSign, $apiKey);

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, count($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);

        if ($err) {
            return $err;
        }

        return json_decode($ret, true);
    }

    public function storeBangunan(Request $request)
    {
        if (auth()->check()) {
            $request->merge([
                'total_payment' => (int) $request->biaya_materai + (int) $request->biaya_admin,
                'province_bangunan' => explode('-', $request->province_bangunan)[1],
                'kota_bangunan' => explode('-', $request->kota_bangunan)[1],
                'district_bangunan' => explode('-', $request->district_bangunan)[1],
                'nasabah_province' => auth::user()->province,
                'nasabah_city' => auth::user()->city,
                'nasabah_district' => auth::user()->district,
                'nasabah_poscode' => auth::user()->poscode,
                'referal_code_upline' => $request->referal_code_upline ?? '',
                'jatuh_tempo' => date('Y-m-d', strtotime('+1 year')),
                'status' => '1',
            ]);
        } else {
            $request->merge([
                'total_payment' => (int) $request->biaya_materai + (int) $request->biaya_admin,
                'province_bangunan' => explode('-', $request->province_bangunan)[1],
                'kota_bangunan' => explode('-', $request->kota_bangunan)[1],
                'district_bangunan' => explode('-', $request->district_bangunan)[1],
                'nasabah_province' => explode('-', $request->nasabah_province)[1],
                'nasabah_city' => explode('-', $request->nasabah_city)[1],
                'nasabah_district' => explode('-', $request->nasabah_district)[1],
                'referal_code_upline' => $request->referal_code_upline ?? '',
                'jatuh_tempo' => date('Y-m-d', strtotime('+1 year')),
                'status' => '1',
            ]);
        }

        if ($request->nilai_bangunan) {
            $request->merge([
                'nilai_bangunan' => str_replace('.', '', $request->nilai_bangunan),
            ]);
        }

        if ($request->nilai_lainnya) {
            $request->merge([
                'nilai_lainnya' => str_replace('.', '', $request->nilai_lainnya),
            ]);
        }
        $product = OnlineProduct::find($request->product_id);
        $request->merge([
            'total_payment' => (((int) $request->nilai_bangunan + (int) $request->nilai_lainnya) * floatval($request->rate) / 1000) + $request->total_payment,
            'nilai_premi' => (((int) $request->nilai_bangunan + (int) $request->nilai_lainnya) * floatval($request->rate) / 1000),
            'transaction_id' => 'AGGIKU' . $product->code . '-' . date('dmy') . rand(100, 999),
        ]);

        unset($request['rate']);
        $saveTransaction = OnlineTransaction::create(
            $request->except('_token')
        );

        if ($saveTransaction) {
            $findUser = User::where('email', $request->nasabah_email)->first();

            // check if logged in
            if (auth()->check()) {
                sendNotification(auth()->user()->id, $saveTransaction->id, "1", "Request asuransi telah berhasil");
                $data = [
                    'product' => array('Asuransi Kebakaran Online'),
                    'qty' => array('1'),
                    'price' => array('' . $request->total_payment . ''),
                    'returnUrl' => env('APP_URL'),
                    'cancelUrl' => "https://webhook.site/e63a316e-9520-4a80-862b-1e4e7a97d0e0",
                    'notifyUrl' => env('IPAYMU_CALLBACK_URL'),
                    'referenceId' => '' . $saveTransaction->transaction_id . '',
                    'expired' => '24',
                    'feeDirection' => 'MERCHANT',
                    'buyerName' => $request->nasabah_name,
                    'buyerEmail' => $request->nasabah_email,
                    'buyerPhone' => $request->nasabah_phone
                ];

                $ipaymu = $this->sendPayment($data);

                if ($ipaymu['Status'] == 200) {
                    sendNotification(auth()->user()->id, $saveTransaction->id, "2", "Silakan lakukan pembayaran");
                    Payment::create([
                        'transaction_id' => $saveTransaction->id,
                        'user_id' => $saveTransaction->user_id,
                        'url_payment' => $ipaymu['Data']['Url'],
                        'payment_method' => "ipaymu",
                        'transaction_no' => $ipaymu['Data']['SessionID'],
                        'status' => '3',
                        'created_at' => date('Y-m-d H:i:s'),
                        'expired' => Carbon::now()->addDay()
                    ]);
                }

                $landing   = DB::table('landings')->first();
                $product = OnlineProduct::find($saveTransaction->product_id);
                $user = User::find($saveTransaction->user_id);
                $data = array(
                    'landing' => $landing,
                    'product' => $product,
                    'nilai_premi' => $request->nilai_premi,
                    'user' => $user,
                    'payment_url' => $ipaymu['Data']['Url'],
                    'invoice_date' => date('d F Y'),
                    'invoice_expired' => date('d F Y', strtotime('+1 day')),
                    'invoice_no' => $saveTransaction->transaction_id,
                    'isRegistered' => false
                );

                Mail::to($request->nasabah_email)->send(new PaymentFirstInsuranceSuccess($data));

                Email::create([
                    'transaction_id' => $saveTransaction->id,
                    'email' => $request->nasabah_email,
                ]);

                $saveTransaction->update([
                    'user_id' => auth()->user()->id,
                    'status' => '2',
                ]);

                return "
                <script>
                    window.location.href = '/dashboard/user';
                    window.open('" . $ipaymu['Data']['Url'] . "', '_blank')
                </script>
                ";
            } else if ($findUser) {
                OnlineTransaction::find($saveTransaction->id)->update([
                    'nasabah_email' => $findUser->email,
                    'nasabah_name' => $findUser->name,
                    'nasabah_id' => $findUser->ktp,
                    'nasabah_phone' => $findUser->phone,
                    'nasabah_address' => $findUser->address,
                    'nasabah_city' => $findUser->city,
                    'nasabah_province' => $findUser->province,
                    'nasabah_district' => $findUser->district,
                    'nasabah_poscode' => $findUser->poscode,
                    'nasabah_dob' => $findUser->dob
                ]);

                sendNotification($findUser->id, $saveTransaction->id, "1", "Request asuransi telah berhasil");
                $data = [
                    'product' => array('Asuransi Kebakaran Online'),
                    'qty' => array('1'),
                    'price' => array('' . $request->total_payment . ''),
                    'returnUrl' => env('APP_URL'),
                    'cancelUrl' => "https://webhook.site/e63a316e-9520-4a80-862b-1e4e7a97d0e0",
                    'notifyUrl' => env('IPAYMU_CALLBACK_URL'),
                    'referenceId' => '' . $saveTransaction->transaction_id . '',
                    'expired' => '24',
                    'feeDirection' => 'MERCHANT',
                    'buyerName' => $request->nasabah_name,
                    'buyerEmail' => $request->nasabah_email,
                    'buyerPhone' => $request->nasabah_phone
                ];

                $ipaymu = $this->sendPayment($data);

                if ($ipaymu['Status'] == 200) {
                    sendNotification($findUser->id, $saveTransaction->id, "2", "Silahkan lakukan pembayaran");
                    Payment::create([
                        'transaction_id' => $saveTransaction->id,
                        'user_id' => $findUser->id,
                        'url_payment' => $ipaymu['Data']['Url'],
                        'payment_method' => "ipaymu",
                        'transaction_no' => $ipaymu['Data']['SessionID'],
                        'status' => '3',
                        'created_at' => date('Y-m-d H:i:s'),
                        'expired' => Carbon::now()->addDay()
                    ]);

                    $landing   = DB::table('landings')->first();
                    $product = OnlineProduct::find($saveTransaction->product_id);
                    $data = array(
                        'landing' => $landing,
                        'product' => $product,
                        'nilai_premi' => $request->nilai_premi,
                        'user' => $findUser,
                        'payment_url' => $ipaymu['Data']['Url'],
                        'invoice_date' => date('d F Y'),
                        'invoice_expired' => date('d F Y', strtotime('+1 day')),
                        'invoice_no' => $saveTransaction->transaction_id,
                        'isRegistered' => false
                    );

                    Mail::to($request->nasabah_email)->send(new PaymentFirstInsuranceSuccess($data));

                    Email::create([
                        'transaction_id' => $saveTransaction->id,
                        'email' => $request->nasabah_email,
                    ]);

                    $saveTransaction->update([
                        'user_id' => $findUser->id,
                        'status' => '2',
                    ]);
                }
                $paymentLink = $ipaymu['Data']['Url'];
                return "
                <script>
                    localStorage.setItem('payment_link', '" . $paymentLink . "')
                    window.location.href='/login-user'
                </script>
                ";
            } else {
                // create user
                $createUser = User::create([
                    'name' => $request->nasabah_name,
                    'ktp' => $request->nasabah_id,
                    'email' => $request->nasabah_email,
                    'phone' => $request->nasabah_phone,
                    'address' => $request->nasabah_address,
                    'province' => $request->nasabah_province,
                    'city' => $request->nasabah_city,
                    'district' => $request->nasabah_district,
                    'poscode' => $request->nasabah_poscode,
                    'dob' => $request->nasabah_dob,
                    'password' => bcrypt('12345'),
                    'referal_code' => rand(100000, 999999),
                    'referal_code_upline' => $request->referal_code_upline ?? null,
                    'target_id' => null,
                    'email_verified_at' => now(),
                ]);

                if ($createUser) {
                    sendNotification($createUser->id, $saveTransaction->id, "1", "Request asuransi telah berhasil");
                    $data = [
                        'product' => array('Asuransi Kebakaran Online'),
                        'qty' => array('1'),
                        'price' => array('' . $request->total_payment . ''),
                        'returnUrl' => env('APP_URL'),
                        'cancelUrl' => "https://webhook.site/e63a316e-9520-4a80-862b-1e4e7a97d0e0",
                        'notifyUrl' => env('IPAYMU_CALLBACK_URL'),
                        'referenceId' => '' . $saveTransaction->transaction_id . '',
                        'expired' => '24',
                        'feeDirection' => 'MERCHANT',
                        'buyerName' => $request->nasabah_name,
                        'buyerEmail' => $request->nasabah_email,
                        'buyerPhone' => $request->nasabah_phone
                    ];

                    $ipaymu = $this->sendPayment($data);

                    if ($ipaymu['Status'] == 200) {
                        sendNotification($createUser->id, $saveTransaction->id, "2", "Silahkan lakukan pembayaran");
                        Payment::create([
                            'transaction_id' => $saveTransaction->id,
                            'user_id' => $createUser->id,
                            'url_payment' => $ipaymu['Data']['Url'],
                            'payment_method' => "ipaymu",
                            'transaction_no' => $ipaymu['Data']['SessionID'],
                            'status' => '3',
                            'created_at' => date('Y-m-d H:i:s'),
                            'expired' => Carbon::now()->addDay()
                        ]);

                        $landing   = DB::table('landings')->first();
                        $product = OnlineProduct::find($saveTransaction->product_id);
                        $data = array(
                            'landing' => $landing,
                            'product' => $product,
                            'nilai_premi' => $request->nilai_premi,
                            'user' => $createUser,
                            'payment_url' => $ipaymu['Data']['Url'],
                            'invoice_date' => date('d F Y'),
                            'invoice_expired' => date('d F Y', strtotime('+1 day')),
                            'invoice_no' => $saveTransaction->transaction_id,
                            'isRegistered' => true
                        );

                        Mail::to($request->nasabah_email)->send(new PaymentFirstInsuranceSuccess($data));

                        Email::create([
                            'transaction_id' => $saveTransaction->id,
                            'email' => $request->nasabah_email,
                        ]);

                        $saveTransaction->update([
                            'user_id' => $createUser->id,
                            'status' => '2',
                        ]);

                        Auth::attempt(['email' => $request->nasabah_email, 'password' => '12345']);
                        $request->session()->regenerate();
                    }

                    return "
                    <script>
                        window.location.href = '/dashboard/user';
                        window.open('" . $ipaymu['Data']['Url'] . "', '_blank')
                    </script>
                    ";

                }
            }
        } else {
            return "
                <script>
                    alert('Pembayaran gagal, silahkan coba lagi');
                </script>
            ";
        }
    }

    public function storeKecelakaan(Request $request)
    {
        $product = OnlineProduct::find($request->product_id);

        if (auth()->check()) {
            $request->merge([
                'total_payment' => ((int) $request->biaya_materai + (int) $request->biaya_admin) + ((int) $request->nilai_premi * floatval($request->rate)),
                'nasabah_province' => auth::user()->province,
                'nasabah_city' => auth::user()->city,
                'nasabah_district' => auth::user()->district,
                'nasabah_poscode' => auth::user()->poscode,
                'referal_code_upline' => $request->referal_code_upline ?? '',
                'jatuh_tempo' => date('Y-m-d', strtotime('+1 year')),
                'status' => '1',
                'nilai_premi' => $request->nilai_premi * floatval($request->rate),
                'transaction_id' => 'AGGI' . $product->code . '-' . date('dmy') . rand(100, 999),
            ]);
        } else {
            $request->merge([
                'total_payment' => ((int) $request->biaya_materai + (int) $request->biaya_admin) + ((int) $request->nilai_premi * floatval($request->rate)),
                'nasabah_province' => explode('-', $request->nasabah_province)[1],
                'nasabah_city' => explode('-', $request->nasabah_city)[1],
                'nasabah_district' => explode('-', $request->nasabah_district)[1],
                'referal_code_upline' => $request->referal_code_upline ?? '',
                'jatuh_tempo' => date('Y-m-d', strtotime('+1 year')),
                'status' => '1',
                'nilai_premi' => $request->nilai_premi * floatval($request->rate),
                'transaction_id' => 'AGGI' . $product->code . '-' . date('dmy') . rand(100, 999),
            ]);
        }

        unset($request['rate']);

        // save data transaction
        $saveTransaction = OnlineTransaction::create(
            $request->except(
                'namaAhliWaris',
                'emailAhliWaris',
                'ttlAhliWaris',
                'tglAhliWaris',
                'nomorIdentitasAhliWaris',
                'hubunganStatusAhliWaris',
                '_token',
                'paymentMethod'
            )
        );
        if ($saveTransaction && $request->namaAhliWaris != [] && $request->emailAhliWaris != [] && $request->ttlAhliWaris != [] && $request->tglAhliWaris != [] && $request->nomorIdentitasAhliWaris != [] && $request->hubunganStatusAhliWaris != []) {

            // then save ahli waris
            for ($i = 0; $i < count($request->namaAhliWaris); $i++) {
                AhliWaris::create([
                    'transaction_id' => $saveTransaction->id,
                    'name' => $request->namaAhliWaris[$i],
                    'email' => $request->emailAhliWaris[$i],
                    'pob' => $request->ttlAhliWaris[$i],
                    'dob' => $request->tglAhliWaris[$i],
                    'no_id' => $request->nomorIdentitasAhliWaris[$i],
                    'relationship' => $request->hubunganStatusAhliWaris[$i],
                ]);
            }

            $findUser = User::where('email', $request->nasabah_email)->first();

            if (auth()->check()) {
                sendNotification(auth()->user()->id, $saveTransaction->id, "1", "Permintaan asuransi telah berhasil");
                $data = [
                    'product' => array('Asuransi Kecelakaan Online'),
                    'qty' => array('1'),
                    'price' => array('' . $request->total_payment . ''),
                    'returnUrl' => env('APP_URL'),
                    'cancelUrl' => "https://webhook.site/e63a316e-9520-4a80-862b-1e4e7a97d0e0",
                    'notifyUrl' => env('IPAYMU_CALLBACK_URL'),
                    'referenceId' => '' . $saveTransaction->transaction_id . '',
                    'expired' => '24',
                    'feeDirection' => 'MERCHANT',
                    'buyerName' => $request->nasabah_name,
                    'buyerEmail' => $request->nasabah_email,
                    'buyerPhone' => $request->nasabah_phone
                ];

                $ipaymu = $this->sendPayment($data);

                if ($ipaymu['Status'] == 200) {
                    sendNotification(auth()->user()->id, $saveTransaction->id, "2", "Silahkan lakukan pembayaran");
                    Payment::create([
                        'transaction_id' => $saveTransaction->id,
                        'user_id' => $saveTransaction->user_id,
                        'url_payment' => $ipaymu['Data']['Url'],
                        'payment_method' => "ipaymu",
                        'transaction_no' => $ipaymu['Data']['SessionID'],
                        'status' => '3',
                        'created_at' => date('Y-m-d H:i:s'),
                        'expired' => Carbon::now()->addDay()
                    ]);
                }

                $landing   = DB::table('landings')->first();
                $product = OnlineProduct::find($saveTransaction->product_id);
                $user = User::find($saveTransaction->user_id);
                $data = array(
                    'landing' => $landing,
                    'product' => $product,
                    'nilai_premi' => $request->nilai_premi,
                    'user' => $user,
                    'payment_url' => $ipaymu['Data']['Url'],
                    'invoice_date' => date('d F Y'),
                    'invoice_expired' => date('d F Y', strtotime('+1 day')),
                    'invoice_no' => $saveTransaction->transaction_id,
                    'isRegistered' => false
                );

                Mail::to($request->nasabah_email)->send(new PaymentFirstInsuranceSuccess($data));

                Email::create([
                    'transaction_id' => $saveTransaction->id,
                    'email' => $request->nasabah_email,
                ]);

                $saveTransaction->update([
                    'user_id' => auth()->user()->id,
                    'status' => '2',
                ]);

                return "
                <script>
                    window.location.href = '/dashboard/user';
                    window.open('" . $ipaymu['Data']['Url'] . "', '_blank')
                </script>
                ";                
            } else if ($findUser) {
                OnlineTransaction::find($saveTransaction->id)->update([
                    'nasabah_email' => $findUser->email,
                    'nasabah_name' => $findUser->name,
                    'nasabah_id' => $findUser->ktp,
                    'nasabah_phone' => $findUser->phone,
                    'nasabah_address' => $findUser->address,
                    'nasabah_city' => $findUser->city,
                    'nasabah_province' => $findUser->province,
                    'nasabah_district' => $findUser->district,
                    'nasabah_poscode' => $findUser->poscode,
                    'nasabah_dob' => $findUser->dob
                ]);
                sendNotification($findUser->id, $saveTransaction->id, "1", "Permintaan asuransi telah berhasil");
                $data = [
                    'product' => array('Asuransi Kecelakaan Online'),
                    'qty' => array('1'),
                    'price' => array('' . $request->total_payment . ''),
                    'returnUrl' => env('APP_URL'),
                    'cancelUrl' => "https://webhook.site/e63a316e-9520-4a80-862b-1e4e7a97d0e0",
                    'notifyUrl' => env('IPAYMU_CALLBACK_URL'),
                    'referenceId' => '' . $saveTransaction->transaction_id . '',
                    'expired' => '24',
                    'feeDirection' => 'MERCHANT',
                    'buyerName' => $request->nasabah_name,
                    'buyerEmail' => $request->nasabah_email,
                    'buyerPhone' => $request->nasabah_phone
                ];

                $ipaymu = $this->sendPayment($data);

                if ($ipaymu['Status'] == 200) {
                    sendNotification($findUser->id, $saveTransaction->id, "2", "Silahkan lakukan pembayaran");
                    Payment::create([
                        'transaction_id' => $saveTransaction->id,
                        'user_id' => $findUser->id,
                        'url_payment' => $ipaymu['Data']['Url'],
                        'payment_method' => "ipaymu",
                        'transaction_no' => $ipaymu['Data']['SessionID'],
                        'status' => '3',
                        'created_at' => date('Y-m-d H:i:s'),
                        'expired' => Carbon::now()->addDay()
                    ]);

                    $landing   = DB::table('landings')->first();
                    $product = OnlineProduct::find($saveTransaction->product_id);
                    $data = array(
                        'landing' => $landing,
                        'product' => $product,
                        'nilai_premi' => $request->nilai_premi,
                        'user' => $findUser,
                        'payment_url' => $ipaymu['Data']['Url'],
                        'invoice_date' => date('d F Y'),
                        'invoice_expired' => date('d F Y', strtotime('+1 day')),
                        'invoice_no' => $saveTransaction->transaction_id,
                        'isRegistered' => false
                    );

                    Mail::to($request->nasabah_email)->send(new PaymentFirstInsuranceSuccess($data));

                    Email::create([
                        'transaction_id' => $saveTransaction->id,
                        'email' => $request->nasabah_email,
                    ]);

                    $saveTransaction->update([
                        'user_id' => $findUser->id,
                        'status' => '2',
                    ]);
                }

                $paymentLink = $ipaymu['Data']['Url'];
                return "
                <script>
                    localStorage.setItem('payment_link', '" . $paymentLink . "')
                    window.location.href='/login-user'
                </script>
                ";
            } else {
                // create user
                $createUser = User::create([
                    'name' => $request->nasabah_name,
                    'ktp' => $request->nasabah_id,
                    'email' => $request->nasabah_email,
                    'phone' => $request->nasabah_phone,
                    'address' => $request->nasabah_address,
                    'province' => $request->nasabah_province,
                    'city' => $request->nasabah_city,
                    'district' => $request->nasabah_district,
                    'poscode' => $request->nasabah_poscode,
                    'dob' => $request->nasabah_dob,
                    'password' => bcrypt('12345'),
                    'referal_code' => rand(100000, 999999),
                    'referal_code_upline' => $request->referal_code_upline ?? null,
                    'email_verified_at' => now(),
                ]);

                if ($createUser) {
                    sendNotification($createUser->id, $saveTransaction->id, "1", "Permintaan asuransi telah berhasil");
                    $data = [
                        'product' => array('Asuransi Kecelakaan Online'),
                        'qty' => array('1'),
                        'price' => array('' . $request->total_payment . ''),
                        'returnUrl' => env('APP_URL'),
                        'cancelUrl' => "https://webhook.site/e63a316e-9520-4a80-862b-1e4e7a97d0e0",
                        'notifyUrl' => env('IPAYMU_CALLBACK_URL'),
                        'referenceId' => '' . $saveTransaction->transaction_id . '',
                        'expired' => '24',
                        'feeDirection' => 'MERCHANT',
                        'buyerName' => $request->nasabah_name,
                        'buyerEmail' => $request->nasabah_email,
                        'buyerPhone' => $request->nasabah_phone
                    ];

                    $ipaymu = $this->sendPayment($data);

                    if ($ipaymu['Status'] == 200) {
                        sendNotification($createUser->id, $saveTransaction->id, "2", "Silahkan lakukan pembayaran");
                        Payment::create([
                            'transaction_id' => $saveTransaction->id,
                            'user_id' => $createUser->id,
                            'url_payment' => $ipaymu['Data']['Url'],
                            'payment_method' => "ipaymu",
                            'transaction_no' => $ipaymu['Data']['SessionID'],
                            'status' => '3',
                            'created_at' => date('Y-m-d H:i:s'),
                            'expired' => Carbon::now()->addDay()
                        ]);

                        $landing   = DB::table('landings')->first();
                        $product = OnlineProduct::find($saveTransaction->product_id);
                        $data = array(
                            'landing' => $landing,
                            'product' => $product,
                            'nilai_premi' => $request->nilai_premi,
                            'user' => $createUser,
                            'payment_url' => $ipaymu['Data']['Url'],
                            'invoice_date' => date('d F Y'),
                            'invoice_expired' => date('d F Y', strtotime('+1 day')),
                            'invoice_no' => $saveTransaction->transaction_id,
                            'isRegistered' => true
                        );

                        Mail::to($request->nasabah_email)->send(new PaymentFirstInsuranceSuccess($data));

                        Email::create([
                            'transaction_id' => $saveTransaction->id,
                            'email' => $request->nasabah_email,
                        ]);

                        $saveTransaction->update([
                            'user_id' => $createUser->id,
                            'status' => '2',
                        ]);

                        Auth::attempt(['email' => $request->nasabah_email, 'password' => '12345']);
                        $request->session()->regenerate();
                    }

                    return "
                    <script>
                        window.location.href = '/dashboard/user';
                        window.open('" . $ipaymu['Data']['Url'] . "', '_blank')
                    </script>
                    ";
                    
                }
            }
        } else {
            return "
                <script>
                    alert('Pembayaran gagal, silahkan coba lagi');
                </script>
            ";
        }
    }

    public function storeOffline(Request $request)
    {
        $product = OnlineProduct::find($request->product_id);
        if (auth()->check()) {
            $request->merge([
                'nasabah_province' => auth::user()->province,
                'nasabah_city' => auth::user()->city,
                'nasabah_district' => auth::user()->district,
                'nasabah_poscode' => auth::user()->poscode,
                'referal_code_upline' => $request->referal_code_upline ?? '',
                 'referal_code' => $request->referal_code_upline ?? '',        
                'transaction_id' => 'AGGIKU' . $product->code . '-' . date('dmy') . rand(100, 999),
                'status_offline' => '1',
                'nilai_pertanggungan' => str_replace('.', '', $request->nilai_pertanggungan),
            ]);
        } else {
            $request->merge([
                'nasabah_province' => explode('-', $request->nasabah_province)[1],
                'nasabah_city' => explode('-', $request->nasabah_city)[1],
                'nasabah_district' => explode('-', $request->nasabah_district)[1],
                'referal_code_upline' => $request->referal_code_upline ?? '',
                'transaction_id' => 'AGGIKU' . $product->code . '-' . date('dmy') . rand(100, 999),
                'status_offline' => '1',
                'nilai_pertanggungan' => str_replace('.', '', $request->nilai_pertanggungan),
            ]);
        }

        unset($request['rate']);
        // save data transaction

        $saveTransaction = OnlineTransaction::create(
            $request->except('_token')
        );

        if ($saveTransaction) {
            $findUser = User::where('email', $request->nasabah_email)->first();

            // check if logged in
            if (auth()->check()) {
                sendNotification(auth()->user()->id, $saveTransaction->id, "1", "Permintaan produk asuransi telah berhasil");

                $saveTransaction->update([
                    'user_id' => auth()->user()->id,
                ]);

                return redirect()->route('dashboard.user');
            } else if ($findUser) {
                OnlineTransaction::find($saveTransaction->id)->update([
                    'user_id' => $findUser->id,
                    'nasabah_email' => $findUser->email,
                    'nasabah_name' => $findUser->name,
                    'nasabah_id' => $findUser->ktp,
                    'nasabah_phone' => $findUser->phone,
                    'nasabah_address' => $findUser->address,
                    'nasabah_city' => $findUser->city,
                    'nasabah_province' => $findUser->province,
                    'nasabah_district' => $findUser->district,
                    'nasabah_poscode' => $findUser->poscode,
                    'nasabah_dob' => $findUser->dob
                ]);
                sendNotification($findUser->id, $saveTransaction->id, "1", "Permintaan produk asuransi telah berhasil");

                return redirect()->route('login-user-view');
            } else {
                // create user
                $createUser = User::create([
                    'name' => $request->nasabah_name,
                    'ktp' => $request->nasabah_id,
                    'email' => $request->nasabah_email,
                    'phone' => $request->nasabah_phone,
                    'address' => $request->nasabah_address,
                    'province' => $request->nasabah_province,
                    'city' => $request->nasabah_city,
                    'district' => $request->nasabah_district,
                    'poscode' => $request->nasabah_poscode,
                    'dob' => $request->nasabah_dob,
                    'password' => bcrypt('12345'),
                    'referal_code' => rand(100000, 999999),
                    'referal_code_upline' => $request->referal_code_upline ?? null,
                    'target_id' => null,
                    'email_verified_at' => now(),
                ]);

                if ($createUser) {
                    sendNotification($createUser->id, $saveTransaction->id, "1", "Permintaan produk asuransi telah berhasil");

                    $saveTransaction->update(['user_id' => $createUser->id]);
                    if (auth()->attempt(['email' => $createUser->email, 'password' => $createUser->password])) {
                        $request->session()->regenerate();
                        return redirect()->route('dashboard.user');
                    } else {
                        return redirect()->route('landinghome');
                    }
                }
            }
        } else {
            return "
                <script>
                    alert('Pembelian gagal, silahkan coba lagi');
                </script>
            ";
        }
    }

    public function storeBangunanAgent(Request $request)
    {
        $request->merge([
            'total_payment' => (int) $request->biaya_materai + (int) $request->biaya_admin,
            'province_bangunan' => explode('-', $request->province_bangunan)[1],
            'kota_bangunan' => explode('-', $request->kota_bangunan)[1],
            'district_bangunan' => explode('-', $request->district_bangunan)[1],
            'nasabah_province' => explode('-', $request->nasabah_province)[1],
            'nasabah_city' => explode('-', $request->nasabah_city)[1],
            'nasabah_district' => explode('-', $request->nasabah_district)[1],
            'referal_code_upline' => $request->referal_code_upline ?? '',
            'jatuh_tempo' => date('Y-m-d', strtotime('+1 year')),
            'status' => '1',
        ]);

        if ($request->nilai_bangunan) {
            $request->merge([
                'nilai_bangunan' => str_replace('.', '', $request->nilai_bangunan),
            ]);
        }

        if ($request->nilai_lainnya) {
            $request->merge([
                'nilai_lainnya' => str_replace('.', '', $request->nilai_lainnya),
            ]);
        }
        $product = OnlineProduct::find($request->product_id);
        $request->merge([
            'total_payment' => (((int) $request->nilai_bangunan + (int) $request->nilai_lainnya) * floatval($request->rate) / 1000) + $request->total_payment,
            'nilai_premi' => (((int) $request->nilai_bangunan + (int) $request->nilai_lainnya) * floatval($request->rate) / 1000),
            'transaction_id' => 'AGGI' . $product->code . '-' . date('dmy') . rand(100, 999),
        ]);

        unset($request['rate']);

        // save data transaction
        $saveTransaction = OnlineTransaction::create(
            $request->except('_token', 'paymentMethod')
        );

        if ($saveTransaction) {
            $findUser = User::where('email', $request->nasabah_email)->first();

            // check if logged in
            if (auth()->check()) {
                sendNotification(auth()->user()->id, $saveTransaction->id, "1", "Request asuransi telah berhasil");
                $data = [
                    'product' => array('Asuransi Kebakaran'),
                    'qty' => array('1'),
                    'price' => array('' . $request->total_payment . ''),
                    'returnUrl' => env('APP_URL'),
                    'cancelUrl' => "https://webhook.site/e63a316e-9520-4a80-862b-1e4e7a97d0e0",
                    'notifyUrl' => env('IPAYMU_CALLBACK_URL'),
                    'referenceId' => '' . $saveTransaction->transaction_id . '',
                    'expired' => '24',
                    'feeDirection' => 'MERCHANT',
                    'buyerName' => $request->nasabah_name,
                    'buyerEmail' => $request->nasabah_email,
                    'buyerPhone' => $request->nasabah_phone
                ];

                $ipaymu = $this->sendPayment($data);

                if ($ipaymu['Status'] == 200) {
                    sendNotification(auth()->user()->id, $saveTransaction->id, "2", "Silahkan lakukan pembayaran");
                    Payment::create([
                        'transaction_id' => $saveTransaction->id,
                        'user_id' => $saveTransaction->user_id,
                        'url_payment' => $ipaymu['Data']['Url'],
                        'payment_method' => "ipaymu",
                        'transaction_no' => $ipaymu['Data']['SessionID'],
                        'status' => '3',
                        'created_at' => date('Y-m-d H:i:s'),
                        'expired' => Carbon::now()->addDay()
                    ]);
                }

                $landing   = DB::table('landings')->first();
                $product = OnlineProduct::find($saveTransaction->product_id);
                $user = User::find($saveTransaction->user_id);
                $data = array(
                    'landing' => $landing,
                    'product' => $product,
                    'nilai_premi' => $request->nilai_premi,
                    'user' => $user,
                    'payment_url' => $ipaymu['Data']['Url'],
                    'invoice_date' => date('d F Y'),
                    'invoice_expired' => date('d F Y', strtotime('+1 day')),
                    'invoice_no' => $saveTransaction->transaction_id,
                    'isRegistered' => false
                );

                Mail::to($request->nasabah_email)->send(new PaymentFirstInsuranceSuccess($data));

                Email::create([
                    'transaction_id' => $saveTransaction->id,
                    'email' => $request->nasabah_email,
                ]);

                $saveTransaction->update([
                    'user_id' => auth()->user()->id,
                    'status' => '2',
                ]);

                return redirect()->to($ipaymu['Data']['Url']);
            } else if ($findUser) {
                OnlineTransaction::find($saveTransaction->id)->update([
                    'nasabah_email' => $findUser->email,
                    'nasabah_name' => $findUser->name,
                    'nasabah_id' => $findUser->ktp,
                    'nasabah_phone' => $findUser->phone,
                    'nasabah_address' => $findUser->address,
                    'nasabah_city' => $findUser->city,
                    'nasabah_province' => $findUser->province,
                    'nasabah_district' => $findUser->district,
                    'nasabah_poscode' => $findUser->poscode,
                    'nasabah_dob' => $findUser->dob
                ]);

                sendNotification($findUser->id, $saveTransaction->id, "1", "Request asuransi telah berhasil");
                $data = [
                    'product' => array('Asuransi Kebakaran'),
                    'qty' => array('1'),
                    'price' => array('' . $request->total_payment . ''),
                    'returnUrl' => env('APP_URL'),
                    'cancelUrl' => "https://webhook.site/e63a316e-9520-4a80-862b-1e4e7a97d0e0",
                    'notifyUrl' => env('IPAYMU_CALLBACK_URL'),
                    'referenceId' => '' . $saveTransaction->transaction_id . '',
                    'expired' => '24',
                    'feeDirection' => 'MERCHANT',
                    'buyerName' => $request->nasabah_name,
                    'buyerEmail' => $request->nasabah_email,
                    'buyerPhone' => $request->nasabah_phone
                ];

                $ipaymu = $this->sendPayment($data);

                if ($ipaymu['Status'] == 200) {
                    sendNotification($findUser->id, $saveTransaction->id, "2", "Silahkan lakukan pembayaran");
                    Payment::create([
                        'transaction_id' => $saveTransaction->id,
                        'user_id' => $findUser->id,
                        'url_payment' => $ipaymu['Data']['Url'],
                        'payment_method' => "ipaymu",
                        'transaction_no' => $ipaymu['Data']['SessionID'],
                        'status' => '3',
                        'created_at' => date('Y-m-d H:i:s'),
                        'expired' => Carbon::now()->addDay()
                    ]);

                    $landing   = DB::table('landings')->first();
                    $product = OnlineProduct::find($saveTransaction->product_id);
                    $data = array(
                        'landing' => $landing,
                        'product' => $product,
                        'nilai_premi' => $request->nilai_premi,
                        'user' => $findUser,
                        'payment_url' => $ipaymu['Data']['Url'],
                        'invoice_date' => date('d F Y'),
                        'invoice_expired' => date('d F Y', strtotime('+1 day')),
                        'invoice_no' => $saveTransaction->transaction_id,
                        'isRegistered' => false
                    );

                    Mail::to($request->nasabah_email)->send(new PaymentFirstInsuranceSuccess($data));

                    Email::create([
                        'transaction_id' => $saveTransaction->id,
                        'email' => $request->nasabah_email,
                    ]);

                    $saveTransaction->update([
                        'user_id' => $findUser->id,
                        'status' => '2',
                    ]);
                }
                $paymentLink = $ipaymu['Data']['Url'];
                return "
                <script>
                    localStorage.setItem('payment_link', '" . $paymentLink . "')
                    window.location.href='/login-user'
                </script>
                ";
            } else {
                // create user
                $createUser = User::create([
                    'name' => $request->nasabah_name,
                    'ktp' => $request->nasabah_id,
                    'email' => $request->nasabah_email,
                    'phone' => $request->nasabah_phone,
                    'address' => $request->nasabah_address,
                    'province' => $request->nasabah_province,
                    'city' => $request->nasabah_city,
                    'district' => $request->nasabah_district,
                    'poscode' => $request->nasabah_poscode,
                    'dob' => $request->nasabah_dob,
                    'password' => bcrypt('12345'),
                    'referal_code' => rand(100000, 999999),
                    'referal_code_upline' => $request->referal_code_upline ?? null,
                    'target_id' => 1,
                    'email_verified_at' => now(),
                ]);

                if ($createUser) {
                    sendNotification($createUser->id, $saveTransaction->id, "1", "Request asuransi telah berhasil");
                    $data = [
                        'product' => array('Asuransi Kebakaran'),
                        'qty' => array('1'),
                        'price' => array('' . $request->total_payment . ''),
                        'returnUrl' => env('APP_URL'),
                        'cancelUrl' => "https://webhook.site/e63a316e-9520-4a80-862b-1e4e7a97d0e0",
                        'notifyUrl' => env('IPAYMU_CALLBACK_URL'),
                        'referenceId' => '' . $saveTransaction->transaction_id . '',
                        'expired' => '24',
                        'feeDirection' => 'MERCHANT',
                        'buyerName' => $request->nasabah_name,
                        'buyerEmail' => $request->nasabah_email,
                        'buyerPhone' => $request->nasabah_phone
                    ];

                    $ipaymu = $this->sendPayment($data);

                    if ($ipaymu['Status'] == 200) {
                        sendNotification($createUser->id, $saveTransaction->id, "2", "Silahkan lakukan pembayaran");
                        Payment::create([
                            'transaction_id' => $saveTransaction->id,
                            'user_id' => $createUser->id,
                            'url_payment' => $ipaymu['Data']['Url'],
                            'payment_method' => "ipaymu",
                            'transaction_no' => $ipaymu['Data']['SessionID'],
                            'status' => '3',
                            'created_at' => date('Y-m-d H:i:s'),
                            'expired' => Carbon::now()->addDay()
                        ]);

                        $landing   = DB::table('landings')->first();
                        $product = OnlineProduct::find($saveTransaction->product_id);
                        $data = array(
                            'landing' => $landing,
                            'product' => $product,
                            'nilai_premi' => $request->nilai_premi,
                            'user' => $createUser,
                            'payment_url' => $ipaymu['Data']['Url'],
                            'invoice_date' => date('d F Y'),
                            'invoice_expired' => date('d F Y', strtotime('+1 day')),
                            'invoice_no' => $saveTransaction->transaction_id,
                            'isRegistered' => true
                        );

                        Mail::to($request->nasabah_email)->send(new PaymentFirstInsuranceSuccess($data));

                        Email::create([
                            'transaction_id' => $saveTransaction->id,
                            'email' => $request->nasabah_email,
                        ]);

                        $saveTransaction->update([
                            'user_id' => $createUser->id,
                            'status' => '2',
                        ]);

                        Auth::attempt(['email' => $request->nasabah_email, 'password' => '12345']);
                        $request->session()->regenerate();
                    }

                    return redirect()->to($ipaymu['Data']['Url']);
                }
            }
        } else {
            return "
                <script>
                    alert('Pembayaran gagal, silahkan coba lagi');
                </script>
            ";
        }
    }

    public function storeKecelakaanAgent(Request $request)
    {
        $product = OnlineProduct::find($request->product_id);
        $request->merge([
            'total_payment' => ((int) $request->biaya_materai + (int) $request->biaya_admin) + ((int) $request->nilai_premi * floatval($request->rate)),
            'tertanggung_province' => explode('-', $request->tertanggung_province)[1],
            'tertanggung_city' => explode('-', $request->tertanggung_city)[1],
            'tertanggung_district' => explode('-', $request->tertanggung_district)[1],
            'nasabah_province' => explode('-', $request->nasabah_province)[1],
            'nasabah_city' => explode('-', $request->nasabah_city)[1],
            'nasabah_district' => explode('-', $request->nasabah_district)[1],
            'referal_code_upline' => $request->referal_code_upline ?? '',
            'jatuh_tempo' => date('Y-m-d', strtotime('+1 year')),
            'nilai_premi' => $request->nilai_premi * floatval($request->rate),
            'transaction_id' => 'AGGI' . $product->code . '-' . date('dmy') . rand(100, 999),
            'status' => '1',
        ]);
        unset($request['rate']);
        // save data transaction
        $saveTransaction = OnlineTransaction::create(
            $request->except('namaAhliWaris', 'emailAhliWaris', 'ttlAhliWaris', 'tglAhliWaris', 'nomorIdentitasAhliWaris', 'hubunganStatusAhliWaris', '_token', 'paymentMethod')
        );
        if ($saveTransaction && $request->namaAhliWaris != [] && $request->emailAhliWaris != [] && $request->ttlAhliWaris != [] && $request->tglAhliWaris != [] && $request->nomorIdentitasAhliWaris != [] && $request->hubunganStatusAhliWaris != []) {

            // then save ahli waris
            for ($i = 0; $i < count($request->namaAhliWaris); $i++) {
                AhliWaris::create([
                    'transaction_id' => $saveTransaction->id,
                    'name' => $request->namaAhliWaris[$i],
                    'email' => $request->emailAhliWaris[$i],
                    'pob' => $request->ttlAhliWaris[$i],
                    'dob' => $request->tglAhliWaris[$i],
                    'no_id' => $request->nomorIdentitasAhliWaris[$i],
                    'relationship' => $request->hubunganStatusAhliWaris[$i],
                ]);
            }

            $findUser = User::where('email', $request->nasabah_email)->first();

            if (auth()->check()) {
                sendNotification(auth()->user()->id, $saveTransaction->id, "1", "Request asuransi telah berhasil");
                $data = [
                    'product' => array('Asuransi Kecelakaan'),
                    'qty' => array('1'),
                    'price' => array('' . $request->total_payment . ''),
                    'returnUrl' => env('APP_URL'),
                    'cancelUrl' => "https://webhook.site/e63a316e-9520-4a80-862b-1e4e7a97d0e0",
                    'notifyUrl' => env('IPAYMU_CALLBACK_URL'),
                    'referenceId' => '' . $saveTransaction->transaction_id . '',
                    'expired' => '24',
                    'feeDirection' => 'MERCHANT',
                    'buyerName' => $request->nasabah_name,
                    'buyerEmail' => $request->nasabah_email,
                    'buyerPhone' => $request->nasabah_phone
                ];

                $ipaymu = $this->sendPayment($data);

                if ($ipaymu['Status'] == 200) {
                    sendNotification(auth()->user()->id, $saveTransaction->id, "2", "Silahkan lakukan pembayaran");
                    Payment::create([
                        'transaction_id' => $saveTransaction->id,
                        'user_id' => $saveTransaction->user_id,
                        'url_payment' => $ipaymu['Data']['Url'],
                        'payment_method' => "ipaymu",
                        'transaction_no' => $ipaymu['Data']['SessionID'],
                        'status' => '3',
                        'created_at' => date('Y-m-d H:i:s'),
                        'expired' => Carbon::now()->addDay()
                    ]);
                }

                $landing   = DB::table('landings')->first();
                $product = OnlineProduct::find($saveTransaction->product_id);
                $user = User::find($saveTransaction->user_id);
                $data = array(
                    'landing' => $landing,
                    'product' => $product,
                    'nilai_premi' => $request->nilai_premi,
                    'user' => $user,
                    'payment_url' => $ipaymu['Data']['Url'],
                    'invoice_date' => date('d F Y'),
                    'invoice_expired' => date('d F Y', strtotime('+1 day')),
                    'invoice_no' => $saveTransaction->transaction_id,
                    'isRegistered' => false
                );

                Mail::to($request->nasabah_email)->send(new PaymentFirstInsuranceSuccess($data));

                Email::create([
                    'transaction_id' => $saveTransaction->id,
                    'email' => $request->nasabah_email,
                ]);

                $saveTransaction->update([
                    'user_id' => auth()->user()->id,
                    'status' => '2',
                ]);

                return redirect()->to($ipaymu['Data']['Url']);
            } else if ($findUser) {
                OnlineTransaction::find($saveTransaction->id)->update([
                    'nasabah_email' => $findUser->email,
                    'nasabah_name' => $findUser->name,
                    'nasabah_id' => $findUser->ktp,
                    'nasabah_phone' => $findUser->phone,
                    'nasabah_address' => $findUser->address,
                    'nasabah_city' => $findUser->city,
                    'nasabah_province' => $findUser->province,
                    'nasabah_district' => $findUser->district,
                    'nasabah_poscode' => $findUser->poscode,
                    'nasabah_dob' => $findUser->dob
                ]);
                sendNotification($findUser->id, $saveTransaction->id, "1", "Request asuransi telah berhasil");
                $data = [
                    'product' => array('Asuransi Kecelakaan'),
                    'qty' => array('1'),
                    'price' => array('' . $request->total_payment . ''),
                    'returnUrl' => env('APP_URL'),
                    'cancelUrl' => "https://webhook.site/e63a316e-9520-4a80-862b-1e4e7a97d0e0",
                    'notifyUrl' => env('IPAYMU_CALLBACK_URL'),
                    'referenceId' => '' . $saveTransaction->transaction_id . '',
                    'expired' => '24',
                    'feeDirection' => 'MERCHANT',
                    'buyerName' => $request->nasabah_name,
                    'buyerEmail' => $request->nasabah_email,
                    'buyerPhone' => $request->nasabah_phone
                ];

                $ipaymu = $this->sendPayment($data);

                if ($ipaymu['Status'] == 200) {
                    sendNotification($findUser->id, $saveTransaction->id, "2", "Silahkan lakukan pembayaran");
                    Payment::create([
                        'transaction_id' => $saveTransaction->id,
                        'user_id' => $findUser->id,
                        'url_payment' => $ipaymu['Data']['Url'],
                        'payment_method' => "ipaymu",
                        'transaction_no' => $ipaymu['Data']['SessionID'],
                        'status' => '3',
                        'created_at' => date('Y-m-d H:i:s'),
                        'expired' => Carbon::now()->addDay()
                    ]);

                    $landing   = DB::table('landings')->first();
                    $product = OnlineProduct::find($saveTransaction->product_id);
                    $data = array(
                        'landing' => $landing,
                        'product' => $product,
                        'nilai_premi' => $request->nilai_premi,
                        'user' => $findUser,
                        'payment_url' => $ipaymu['Data']['Url'],
                        'invoice_date' => date('d F Y'),
                        'invoice_expired' => date('d F Y', strtotime('+1 day')),
                        'invoice_no' => $saveTransaction->transaction_id,
                        'isRegistered' => false
                    );

                    Mail::to($request->nasabah_email)->send(new PaymentFirstInsuranceSuccess($data));

                    Email::create([
                        'transaction_id' => $saveTransaction->id,
                        'email' => $request->nasabah_email,
                    ]);

                    $saveTransaction->update([
                        'user_id' => $findUser->id,
                        'status' => '2',
                    ]);
                }

                $paymentLink = $ipaymu['Data']['Url'];
                return "
                <script>
                    localStorage.setItem('payment_link', '" . $paymentLink . "')
                    window.location.href='/login-user'
                </script>
                ";
            } else {
                // create user
                $createUser = User::create([
                    'name' => $request->nasabah_name,
                    'ktp' => $request->nasabah_id,
                    'email' => $request->nasabah_email,
                    'phone' => $request->nasabah_phone,
                    'address' => $request->nasabah_address,
                    'province' => $request->nasabah_province,
                    'city' => $request->nasabah_city,
                    'district' => $request->nasabah_district,
                    'poscode' => $request->nasabah_poscode,
                    'dob' => $request->nasabah_dob,
                    'password' => bcrypt('12345'),
                    'referal_code' => rand(100000, 999999),
                    'referal_code_upline' => $request->referal_code_upline ?? null,
                    'target_id' => 1,
                    'email_verified_at' => now(),
                ]);

                if ($createUser) {
                    sendNotification($createUser->id, $saveTransaction->id, "1", "Request asuransi telah berhasil");
                    $data = [
                        'product' => array('Asuransi Kecelakaan'),
                        'qty' => array('1'),
                        'price' => array('' . $request->total_payment . ''),
                        'returnUrl' => env('APP_URL'),
                        'cancelUrl' => "https://webhook.site/e63a316e-9520-4a80-862b-1e4e7a97d0e0",
                        'notifyUrl' => env('IPAYMU_CALLBACK_URL'),
                        'referenceId' => '' . $saveTransaction->transaction_id . '',
                        'expired' => '24',
                        'feeDirection' => 'MERCHANT',
                        'buyerName' => $request->nasabah_name,
                        'buyerEmail' => $request->nasabah_email,
                        'buyerPhone' => $request->nasabah_phone
                    ];

                    $ipaymu = $this->sendPayment($data);

                    if ($ipaymu['Status'] == 200) {
                        sendNotification($createUser->id, $saveTransaction->id, "2", "Silahkan lakukan pembayaran");
                        Payment::create([
                            'transaction_id' => $saveTransaction->id,
                            'user_id' => $createUser->id,
                            'url_payment' => $ipaymu['Data']['Url'],
                            'payment_method' => "ipaymu",
                            'transaction_no' => $ipaymu['Data']['SessionID'],
                            'status' => '3',
                            'created_at' => date('Y-m-d H:i:s'),
                            'expired' => Carbon::now()->addDay()
                        ]);

                        $landing   = DB::table('landings')->first();
                        $product = OnlineProduct::find($saveTransaction->product_id);
                        $data = array(
                            'landing' => $landing,
                            'product' => $product,
                            'nilai_premi' => $request->nilai_premi,
                            'user' => $createUser,
                            'payment_url' => $ipaymu['Data']['Url'],
                            'invoice_date' => date('d F Y'),
                            'invoice_expired' => date('d F Y', strtotime('+1 day')),
                            'invoice_no' => $saveTransaction->transaction_id,
                            'isRegistered' => true
                        );

                        Mail::to($request->nasabah_email)->send(new PaymentFirstInsuranceSuccess($data));

                        Email::create([
                            'transaction_id' => $saveTransaction->id,
                            'email' => $request->nasabah_email,
                        ]);

                        $saveTransaction->update([
                            'user_id' => $createUser->id,
                            'status' => '2',
                        ]);

                        Auth::attempt(['email' => $request->nasabah_email, 'password' => '12345']);
                        $request->session()->regenerate();
                    }

                    return redirect()->to($ipaymu['Data']['Url']);
                }
            }
        } else {
            return "
                <script>
                    alert('Pembayaran gagal, silahkan coba lagi');
                </script>
            ";
        }
    }

    public function callBackPayment(Request $request)
    {
         Logger::create([
            "event_type" => "call back payment",
            "log_value" => json_encode($request->all())
       ]);
        $data = $request->all();

        if ($data['status_code'] == '1') {
            $transaction = OnlineTransaction::where('transaction_id', $data['reference_id'])->first();

            if ($transaction) {
                if ($transaction->status_offline == '3') {
                    sendNotification($transaction->user_id, $transaction->id, "3", "Pembayaran berhasil");
                    $transaction->update([
                        'status_offline' => '4',
                    ]);
                } elseif ($transaction->status == '2') {
                    sendNotification($transaction->user_id, $transaction->id, "2", "Pembayaran berhasil");
                    $transaction->update([
                        'status' => '3',
                    ]);
                }

                Payment::where('transaction_id', $transaction->id)->update([
                    'status' => $data['status_code'],
                    'ipaymu_trx_id' => $data['trx_id'],
                    'payment_method' => $data['via'] . "" . '-' . $data['channel'],
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

                // COMMISSION CALCULATION
                if ($transaction->referal_code != null) {
                    $findUplineUser = User::where('referal_code', $transaction->referal_code)->first(['id', 'target_id', 'referal_code']);
                    $target = Target::find($findUplineUser->target_id);
                    if ($target) {
                        $user_id = $transaction->user_id;
                        $referal_code = $transaction->referal_code;
                        $findUplineUser = User::where('referal_code', $referal_code)->first(['id', 'target_id', 'referal_code']);

                        // sum all nilai_premi from transaction where status = 3 or status_offline = 4 
                        $commisionUser = $transaction->product_id;
                        $ComUser = OnlineProduct::where('product_id', $commisionUser)->first(['id', 'komisi', 'product_id']);

                        $sumTotalPayment = OnlineTransaction::where('user_id', $user_id)
                            ->where('status', '3')
                            ->orWhere('status_offline', '4')
                            ->sum('nilai_premi');
                        $sumTotalPayment = $sumTotalPayment *($ComUser->komisi / 100);
                        if ($sumTotalPayment >= $target->target_1 && $sumTotalPayment <= $target->target_2) {
                            $commission_amount = $sumTotalPayment * ($target->percentage_1 / 100);
                            commission::create([
                                'user_id' => $user_id,
                                'transaction_id' => $transaction->id,
                                'upline_id' => $findUplineUser->id,
                                'commissions' => $commission_amount,
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                        } else if ($sumTotalPayment >= $target->target_2 && $sumTotalPayment <= $target->target_3) {
                            $commission_amount = $sumTotalPayment * ($target->percentage_2 / 100);
                            commission::create([
                                'user_id' => $user_id,
                                'transaction_id' => $transaction->id,
                                'upline_id' => $findUplineUser->id,
                                'commissions' => $commission_amount,
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                        } else if ($sumTotalPayment >= $target->target_3) {
                            $commission_amount = $sumTotalPayment * ($target->percentage_3 / 100);
                            commission::create([
                                'user_id' => $user_id,
                                'transaction_id' => $transaction->id,
                                'upline_id' => $findUplineUser->id,
                                'commissions' => $commission_amount,
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                        }
                    }
                }
            }
            return response()->json(['status' => 'success', 'data' => $data]);
        } elseif ($data['status_code'] == '2') {
            $transaction = OnlineTransaction::where('transaction_id', $data['reference_id'])->first();

            if ($transaction) {
                if ($transaction->status_offline == '3') {
                    sendNotification($transaction->user_id, $transaction->id, "0", "Link Pembayaran Kadaluarsa");
                    $transaction->update([
                        'status_offline' => '0',
                    ]);
                } elseif ($transaction->status == '2') {
                    sendNotification($transaction->user_id, $transaction->id, "0", "Link Pembayaran Kadaluarsa");
                    $transaction->update([
                        'status' => '0',
                    ]);
                }

                Payment::where('transaction_id', $transaction->id)->update([
                    'status' => $data['status_code'],
                    'ipaymu_trx_id' => $data['trx_id'],
                    'payment_method' => $data['via'] . "" . '-' . $data['channel'],
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
            return response()->json(['status' => 'Expired', 'data' => $data]);
        } elseif ($data['status_code'] == '0') {
            $transaction = OnlineTransaction::where('transaction_id', $data['reference_id'])->first();

            if ($transaction) {
                if ($transaction->status_offline == '3') {
                    sendNotification($transaction->user_id, $transaction->id, "4", "Konfirmasi pembayaran tertunda");
                } elseif ($transaction->status == '2') {
                    sendNotification($transaction->user_id, $transaction->id, "4", "Konfirmasi pembayaran tertunda");
                }

                Payment::where('transaction_id', $transaction->id)->update([
                    'status' => $data['status_code'],
                    'ipaymu_trx_id' => $data['trx_id'],
                    'payment_method' => $data['via'] . "" . '-' . $data['channel'],
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
            return response()->json(['status' => 'Pending', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'data' => $data]);
        }
    }
}
