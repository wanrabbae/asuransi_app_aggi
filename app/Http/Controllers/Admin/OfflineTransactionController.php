<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Carbon\Carbon;
use App\Models\Email;
use App\Models\Landing;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\OnlineProduct;
use Illuminate\Http\Response;
use App\Models\OnlineTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use App\Mail\PaymentFirstInsuranceSuccess;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OfflineTransactionController extends Controller
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

    public function alltrx()
    {
        $data = OnlineTransaction::with('user', 'product')
        ->whereIn('status_offline', ['1', '2', '3', '4', '5', '6'])
        ->get();

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.offlinetransaction.alltrx', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.offlinetransaction.alltrx', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.offlinetransaction.alltrx', compact('data'));
        } else {
            return back();
        }
    }

    public function alltrxFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->whereIn('status_offline', ['1', '2', '3', '4', '5', '6'])
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return view('admin.pages.offlinetransaction.alltrx', compact('data'));
    }

    public function alltrxExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->whereIn('status_offline', ['1', '2', '3', '4', '5', '6'])
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->whereIn('status_offline', ['1', '2', '3', '4', '5', '6'])
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set table headers
        $headers = [
            'No',
            'Tanggal Tansaksi',
            'ID Transaksi',
            'Nama Produk',
            'Nama Nasabah',
            'Email',
            'Phone',
            'Status',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($dataTransaksi as $transaction) {
            if ($transaction->status_offline == 1) {
                $statusLabel = 'Request';
            } elseif ($transaction->status_offline == 2) {
                $statusLabel = 'Followup';
            } elseif ($transaction->status_offline == 3) {
                $statusLabel = 'Pending';
            } elseif ($transaction->status_offline == 4) {
                $statusLabel = 'Paid';
            } elseif ($transaction->status_offline == 5) {
                $statusLabel = 'Process';
            } elseif ($transaction->status_offline == 6) {
                $statusLabel = 'Completed';
            }

            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $transaction->created_at);
            $sheet->setCellValue('C' . $row, $transaction->transaction_id);
            $sheet->setCellValue('D' . $row, $transaction->product->name ?? "");
            $sheet->setCellValue('E' . $row, $transaction->user->name ?? "");
            $sheet->setCellValue('F' . $row, $transaction->user->email ?? "");
            $sheet->setCellValue('G' . $row, $transaction->user->phone ?? "");
            $sheet->setCellValue('H' . $row, $statusLabel ?? "");

            $row++;
        }

        // Create a temporary file to save the spreadsheet
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');

        // Save the spreadsheet to the temporary file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Set the response headers for file download
        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Data Transaksi Nasabah Offline' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }
    
    public function index()
    {
        $data = OnlineTransaction::with('user', 'product')
        ->where('status_offline', '1')
        ->orderBy('id', 'asc')
        ->get();
        return view('admin.pages.offlinetransaction.index', compact('data'));
    }

    public function requestFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '1')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return view('admin.pages.offlinetransaction.index', compact('data'));
    }

    public function requestExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '1')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->where('status_offline', '1')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set table headers
        $headers = [
            'No',
            'ID Transaksi',
            'Nama Produk',
            'Nama',
            'Email',
            'Telp',
            'Alamat',
            'Kota',
            'Province',
            'Perkiraan Pertanggungan',
            'Keterangan',

        ];

        $titleRow = ['Data Permintaan Asuransi'];
        $sheet->fromArray($titleRow, null, 'A1');
        $styleTitle = $sheet->getStyle('A1:K1');
        $styleTitle->getFont()->setBold(true); // Make the title bold
        $styleTitle->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_NONE); // Remove borders

        // Increment $row to add an empty row after the title
        $row = 2;

        // Add an empty row after the title
        $sheet->fromArray([], null, 'A' . $row);

        // Add headers after the empty row
        $sheet->fromArray($headers, null, 'A' . ++$row);

        // Add border at the top of the header row
        $styleHeaders = $sheet->getStyle('A' . $row . ':K' . $row);
        $styleHeaders->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Set data rows
        $row++;
        $i = 1;
        foreach ($dataTransaksi as $transaction) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $transaction->transaction_id);
            $sheet->setCellValue('C' . $row, $transaction->product->name ?? "");
            $sheet->setCellValue('D' . $row, $transaction->user->name ?? "");
            $sheet->setCellValue('E' . $row, $transaction->user->email ?? "");
            $sheet->setCellValue('F' . $row, $transaction->user->phone ?? "");
            $sheet->setCellValue('G' . $row, $transaction->user->address ?? "");
            $sheet->setCellValue('H' . $row, $transaction->nasabah_city ?? "");
            $sheet->setCellValue('I' . $row, $transaction->nasabah_province ?? "");
            $sheet->setCellValue('J' . $row, $transaction->nilai_pertanggungan ?? "");
            $sheet->setCellValue('K' . $row, $transaction->keterangan ?? "");

            $style = $sheet->getStyle('A' . $row . ':K' . $row);
            $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

            $row++;
        }

        // Create a temporary file to save the spreadsheet
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');

        // Save the spreadsheet to the temporary file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Set the response headers for file download
        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Permintaan Asuransi' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    // process
    public function process()
    {
        $data = OnlineTransaction::with('user', 'product')
        ->where('status_offline', '2')
        ->orderBy('id', 'asc')
        ->get();
        return view('admin.pages.offlinetransaction.process', compact('data'));
    }

    public function processFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '2')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.process', compact('data'));
    }

    public function processExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '2')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->where('status_offline', '2')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set table headers
        $headers = [
            'No',
            'ID Transaksi',
            'Product Name',
            'Name',
            'Email',
            'City',
            'Province',
            'Premi',
            'Admin Fee',
            'Total',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($dataTransaksi as $transaction) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $transaction->transaction_id);
            $sheet->setCellValue('C' . $row, $transaction->product->name ?? "");
            $sheet->setCellValue('D' . $row, $transaction->user->name ?? "");
            $sheet->setCellValue('E' . $row, $transaction->user->email ?? "");
            $sheet->setCellValue('F' . $row, $transaction->nasabah_city ?? "");
            $sheet->setCellValue('G' . $row, $transaction->nasabah_province ?? "");
            $sheet->setCellValue('H' . $row, format_uang($transaction->nilai_premi ?? 0) ?? "");
            $sheet->setCellValue('I' . $row, format_uang($transaction->biaya_admin ?? 0) ?? "");
            $sheet->setCellValue('J' . $row, format_uang($transaction->total_payment ?? 0) ?? "");

            $row++;
        }

        // Create a temporary file to save the spreadsheet
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');

        // Save the spreadsheet to the temporary file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Set the response headers for file download
        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Pending Transaksi' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    // payment
    public function payment()
    {
        $data = OnlineTransaction::with('user', 'product')
        ->where('status_offline', '3')
        ->orderBy('id', 'desc')
        ->get();
        return view('admin.pages.offlinetransaction.payment', compact('data'));
    }

    public function paymentFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '3')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.payment', compact('data'));
    }

    public function paymentExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '3')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->where('status_offline', '3')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set table headers
        $headers = [
            'No',
            'ID Transaksi',
            'Product Name',
            'Name',
            'Email',
            'City',
            'Province',
            'Premi',
            'Admin Fee',
            'Total',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($dataTransaksi as $transaction) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $transaction->transaction_id);
            $sheet->setCellValue('C' . $row, $transaction->product->name ?? "");
            $sheet->setCellValue('D' . $row, $transaction->user->name ?? "");
            $sheet->setCellValue('E' . $row, $transaction->user->email ?? "");
            $sheet->setCellValue('F' . $row, $transaction->nasabah_city ?? "");
            $sheet->setCellValue('G' . $row, $transaction->nasabah_province ?? "");
            $sheet->setCellValue('H' . $row, format_uang($transaction->nilai_premi ?? 0) ?? "");
            $sheet->setCellValue('I' . $row, format_uang($transaction->biaya_admin ?? 0) ?? "");
            $sheet->setCellValue('J' . $row, format_uang($transaction->total_payment ?? 0) ?? "");

            $row++;
        }

        // Create a temporary file to save the spreadsheet
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');

        // Save the spreadsheet to the temporary file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Set the response headers for file download
        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Pending Transaksi' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    // paid
    public function paid()
    {
        $data = OnlineTransaction::with('user', 'product')
        ->where('status_offline', '4')
        ->orderBy('id', 'asc')
        ->get();
        return view('admin.pages.offlinetransaction.paid', compact('data'));
    }

    public function paidFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '4')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.paid', compact('data'));
    }

    public function processPaid(Request $request)
    {
        $ids = explode(',', $request->checkbox_child_value);
        if ($ids[0] != '') {
            foreach ($ids as $id) {
                $data = OnlineTransaction::find($id);
                sendNotification($data->user_id, $data->id, 'process_polis', 'Polis asuransi anda sedang diproses oleh admin');
                $data->status_offline = 5;
                $data->save();
            }

            return redirect()->route('dashboard.offlinetransaction.polisprocess')->with('success', 'Transaksi Polis berhasil diproses');
        } else {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih');
        }
    }

    public function paidExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '4')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->where('status_offline', '4')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set table headers
        $headers = [
            'No',
            'ID Transaksi',
            'Product Name',
            'Name',
            'Email',
            'City',
            'Province',
            'Premi',
            'Admin Fee',
            'Total',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($dataTransaksi as $transaction) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $transaction->transaction_id);
            $sheet->setCellValue('C' . $row, $transaction->product->name ?? "");
            $sheet->setCellValue('D' . $row, $transaction->user->name ?? "");
            $sheet->setCellValue('E' . $row, $transaction->user->email ?? "");
            $sheet->setCellValue('F' . $row, $transaction->nasabah_city ?? "");
            $sheet->setCellValue('G' . $row, $transaction->nasabah_province ?? "");
            $sheet->setCellValue('H' . $row, format_uang($transaction->nilai_premi ?? 0) ?? "");
            $sheet->setCellValue('I' . $row, format_uang($transaction->biaya_admin ?? 0) ?? "");
            $sheet->setCellValue('J' . $row, format_uang($transaction->total_payment ?? 0) ?? "");

            $row++;
        }

        // Create a temporary file to save the spreadsheet
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');

        // Save the spreadsheet to the temporary file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Set the response headers for file download
        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Pending Transaksi' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    // polisprocess
    public function polisprocess()
    {
        $data = OnlineTransaction::with('user', 'product')
        ->where('status_offline', '5')
        ->orderBy('id', 'asc')
        ->get();
        return view('admin.pages.offlinetransaction.polisprocess', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'no_polis' => ['required', 'string', 'max:255'],
            'polis' => ['nullable', 'mimes:pdf', 'max:10000'],
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        if (request()->hasFile('polis')) {
            $polis           = $request->file('polis');
            $polis_ekstensi  = $polis->extension();
            $polis_nama      = date('ymdhis') . "." . $polis_ekstensi;
            $polis->move(public_path('img/pdf'), $polis_nama);

            $data_polis      = OnlineTransaction::where('id', $id)->first();
            File::delete(public_path('img/pdf') . '/' . $data_polis->polis);

            $data = [
                'polis' => $polis_nama
            ];
        }

        $data['no_polis'] = $request->no_polis;
        $data['upload_polis_date'] = Carbon::now();
        $data['status_offline'] = '6';

        OnlineTransaction::whereId($id)->update($data);
        return redirect()->route('dashboard.offlinetransaction.completed');
    }

    public function polisprocessFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '5')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.polisprocess', compact('data'));
    }

    public function polisprocessExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '5')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->where('status_offline', '5')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set table headers
        $headers = [
            'No',
            'ID Transaksi',
            'Product Name',
            'Name',
            'Email',
            'City',
            'Province',
            'Premi',
            'Admin Fee',
            'Total',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($dataTransaksi as $transaction) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $transaction->transaction_id);
            $sheet->setCellValue('C' . $row, $transaction->product->name ?? "");
            $sheet->setCellValue('D' . $row, $transaction->user->name ?? "");
            $sheet->setCellValue('E' . $row, $transaction->user->email ?? "");
            $sheet->setCellValue('F' . $row, $transaction->nasabah_city ?? "");
            $sheet->setCellValue('G' . $row, $transaction->nasabah_province ?? "");
            $sheet->setCellValue('H' . $row, format_uang($transaction->nilai_premi ?? 0) ?? "");
            $sheet->setCellValue('I' . $row, format_uang($transaction->biaya_admin ?? 0) ?? "");
            $sheet->setCellValue('J' . $row, format_uang($transaction->total_payment ?? 0) ?? "");

            $row++;
        }

        // Create a temporary file to save the spreadsheet
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');

        // Save the spreadsheet to the temporary file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Set the response headers for file download
        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Pending Transaksi' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    // complated
    public function complated()
    {
        $data = OnlineTransaction::with('user', 'product')
        ->where('status_offline', '6')
        ->orderBy('id', 'desc')
        ->get();
        return view('admin.pages.offlinetransaction.complated', compact('data'));
    }

    public function complatedFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '6')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.complated', compact('data'));
    }

    public function complatedExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '6')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->where('status_offline', '6')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set table headers
        $headers = [
            'No',
            'ID Transaksi',
            'Product Name',
            'Name',
            'Email',
            'City',
            'Province',
            'Premi',
            'Admin Fee',
            'Total',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($dataTransaksi as $transaction) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $transaction->transaction_id);
            $sheet->setCellValue('C' . $row, $transaction->product->name ?? "");
            $sheet->setCellValue('D' . $row, $transaction->user->name ?? "");
            $sheet->setCellValue('E' . $row, $transaction->user->email ?? "");
            $sheet->setCellValue('F' . $row, $transaction->nasabah_city ?? "");
            $sheet->setCellValue('G' . $row, $transaction->nasabah_province ?? "");
            $sheet->setCellValue('H' . $row, format_uang($transaction->nilai_premi ?? 0) ?? "");
            $sheet->setCellValue('I' . $row, format_uang($transaction->biaya_admin ?? 0) ?? "");
            $sheet->setCellValue('J' . $row, format_uang($transaction->total_payment ?? 0) ?? "");

            $row++;
        }

        // Create a temporary file to save the spreadsheet
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');

        // Save the spreadsheet to the temporary file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Set the response headers for file download
        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Pending Transaksi' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function expired()
    {
        $now = Carbon::today();
        $data = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '6')
            ->where('jatuh_tempo',  '<', $now)
            ->orderBy('jatuh_tempo', 'desc')
            ->get();
        return view('admin.pages.offlinetransaction.expired', compact('data'));
    }

    public function expiredFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '6')
            ->whereBetween('jatuh_tempo', [$start_date, $end_date])
            ->get();

        return view('admin.pages.offlinetransaction.expired', compact('data'));
    }    

    public function followup()
    {
        $start_date = Carbon::today();
        $end_date = Carbon::today()->addDays(7);

        $data = OnlineTransaction::with('user', 'product')
            ->whereBetween('jatuh_tempo', [$start_date, $end_date])
            ->where(function ($query) {
                $query->where('status_offline', '6');
            })
            ->orderBy('jatuh_tempo', 'asc')
            ->get();
        return view('admin.pages.offlinetransaction.followup', compact('data'));
    }

    public function followFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status_offline', '6')
            ->whereBetween('jatuh_tempo', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.followup', compact('data'));
    }

    public function premi()
    {
        $data = OnlineTransaction::with('user', 'product')->where('status_offline', '4')->orWhere('status_offline', '5')->orWhere('status_offline', '6')->latest('id')->get();
        $countData = $data->sum('nilai_premi');
        $countDataFilter = 0;
        return view('admin.pages.offlinetransaction.premi', compact('data', 'countData', 'countDataFilter'));
    }

    public function premiFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->where(function ($query) {
                $query->where('status_offline', '4')
                    ->orWhere('status_offline', '5')
                    ->orWhere('status_offline', '6');
            })
            ->get();

        $countData = OnlineTransaction::where('status_offline', '4')
            ->orWhere('status_offline', '5')
            ->orWhere('status_offline', '6')
            ->sum('nilai_premi');

        $countDataFilter = OnlineTransaction::whereBetween('created_at', [$start_date, $end_date])
            ->where(function ($query) {
                $query->where('status_offline', '4')
                    ->orWhere('status_offline', '5')
                    ->orWhere('status_offline', '6');
            })
            ->sum('nilai_premi');

        return view('admin.pages.offlinetransaction.premi', compact('data', 'countData', 'countDataFilter'));
    }

    public function premiExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $data = OnlineTransaction::with('user', 'product')->where('status_offline', '4')->orWhere('status_offline', '5')->orWhere('status_offline', '6')->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $data = OnlineTransaction::with('user', 'product')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->where(function ($query) {
                    $query->where('status_offline', '4')
                        ->orWhere('status_offline', '5')
                        ->orWhere('status_offline', '6');
                })
                ->get();
        }

        $statusLabel = '';


        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set table headers
        $headers = [
            'No',
            'Transaction ID',
            'Produk',
            'Premi',
            'Materai',
            'Biaya Admin',
            'Total',
            'Tanggal Bayar',
            'Payment ID',
            'Status',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($data as $item) {
            if ($item->status_offline == 1) {
                $statusLabel = 'Request';
            } elseif ($item->status_offline == 2) {
                $statusLabel = 'Followup';
            } elseif ($item->status_offline == 3) {
                $statusLabel = 'Pending';
            } elseif ($item->status_offline == 4) {
                $statusLabel = 'Paid';
            } elseif ($item->status_offline == 5) {
                $statusLabel = 'Process';
            } elseif ($item->status_offline == 6) {
                $statusLabel = 'Completed';
            }

            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $item->transaction_id ?? "");
            $sheet->setCellValue('C' . $row, $item->product->name);
            $sheet->setCellValue('D' . $row, $item->nilai_premi ?? "");
            $sheet->setCellValue('E' . $row, $item->biaya_materai ?? "");
            $sheet->setCellValue('F' . $row, $item->biaya_admin ?? "");
            $sheet->setCellValue('G' . $row, $item->total_payment ?? "");
            $sheet->setCellValue('H' . $row, Carbon::parse($item->payment->updated_at)->format('d F Y') ?? "");
            $sheet->setCellValue('I' . $row, $item->payment->ipaymu_trx_id);
            $sheet->setCellValue('J' . $row, $statusLabel ?? "");

            $row++;
        }

        // Create a temporary file to save the spreadsheet
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');

        // Save the spreadsheet to the temporary file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Set the response headers for file download
        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Offline Incomes' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function printTransaction($id)
    {
        $dataServe = OnlineTransaction::with('user', 'product', 'payment')->find($id);
        $pdf = PDF::loadView('pdf.detail_offtransaction', ['data' => $dataServe])->setPaper('A4', 'portrait');

        $pdf->setOptions([
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'defaultFont' => 'Arial'
        ]);

        $pdfContent = $pdf->output();

        // Set the response headers
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $dataServe->transaction_id . '.pdf"',
        ];

        // Return the response with the modified PDF content
        return new Response($pdfContent, 200, $headers);
    }

    public function downloadFileFromPublic($id)
    {
        $data = OnlineTransaction::find($id);
        $file = public_path('img/pdf') . '/' . $data->polis;
        return response()->download($file);
    }

    public function show(Request $request, $id)
    {
        $data = OnlineTransaction::with('user', 'product', 'payment')->find($id);
        return view('admin.pages.offlinetransaction.show', compact('data'));
    }

    public function showfinance(Request $request, $id)
    {
        $data = OnlineTransaction::with('user', 'product', 'payment')->find($id);
        return view('admin.pages.offlinetransaction.showfinance', compact('data'));
    }

    public function requestProcess(Request $request, $id)
    {
        $data = OnlineTransaction::find($id);
        $data->status_offline = '2';
        $data->save();
        sendNotification($data->user_id, $data->id, 'process_polis', 'Polis asuransi anda sedang diproses oleh admin');
        return redirect()->route('dashboard.offlinetransaction.process')->with('success', 'Berhasil Memproses Transaksi');
    }
    
    public function processPayment(Request $request, $id)
    {
        $findTrx = OnlineTransaction::with('user')->find($id);
        $findLanding = Landing::first();
        $updateData['nilai_premi'] = str_replace('.', '', $request->nilai_premi);
        $updateData['biaya_admin'] = $findLanding->admin_fee;
        $updateData['biaya_materai'] = $findLanding->materai_fee;
        $updateData['total_payment'] = (int) $updateData['nilai_premi'] + (int) $findLanding->admin_fee + (int) $findLanding->materai_fee;
        $updateData['status_offline'] = '3';
        $updateData['created_at'] = Carbon::now();

        $data = [
            'product' => array('Asuransi Kebakaran'),
            'qty' => array('1'),
            'price' => array('' . $updateData['total_payment'] . ''),
            'returnUrl' => env('APP_URL'),
            'cancelUrl' => "https://webhook.site/e63a316e-9520-4a80-862b-1e4e7a97d0e0",
            'notifyUrl' => env('IPAYMU_CALLBACK_URL'),
            'referenceId' => '' . $findTrx['transaction_id'] . '',
            'expired' => '24',
            'feeDirection' => 'MERCHANT',
            'buyerName' => $findTrx->nasabah_name,
            'buyerEmail' => $findTrx->nasabah_email,
            'buyerPhone' => $findTrx->nasabah_phone
        ];

        $ipaymu = $this->sendPayment($data);

        if ($ipaymu['Status'] == 200) {
            sendNotification($findTrx->user_id, $findTrx->id, 'payment_polis', 'Silakan melakukan pembayaran polis asuransi anda');
            Payment::create([
                'transaction_id' => $findTrx->id,
                'user_id' => $findTrx->user->id,
                'url_payment' => $ipaymu['Data']['Url'],
                'payment_method' => "ipaymu",
                'transaction_no' => $ipaymu['Data']['SessionID'],
                'status' => '3',
                'created_at' => date('Y-m-d H:i:s'),
                'expired' => Carbon::now()->addDay()
            ]);

            $landing   = DB::table('landings')->first();
            $product = OnlineProduct::find($findTrx->product_id);
            $data = array(
                'landing' => $landing,
                'product' => $product,
                'nilai_premi' => $updateData['nilai_premi'],
                'user' => $findTrx->user,
                'payment_url' => $ipaymu['Data']['Url'],
                'invoice_date' => date('d F Y'),
                'invoice_expired' => date('d F Y', strtotime('+1 day')),
                'invoice_no' => $findTrx->transaction_id,
                'isRegistered' => true
            );

            Mail::to($findTrx->nasabah_email)->send(new PaymentFirstInsuranceSuccess($data));

            Email::create([
                'transaction_id' => $findTrx->id,
                'email' => $findTrx->nasabah_email,
            ]);

            $findTrx->update([
                'user_id' => $findTrx->user->id,
                'status_offline' => '3',
            ]);
        }

        OnlineTransaction::whereId($id)->update($updateData);

        return redirect()->route('dashboard.offlinetransaction.payment')->with('success', 'Berhasil Mengirim Link Pembayaran Transaksi');
    }
}
