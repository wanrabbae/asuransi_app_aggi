<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Popup;
use App\Models\commission;
use App\Models\RedeemPoin;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\OnlineProduct;
use App\Models\OnlineTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function show(Request $request, $id)
    {
        $data = OnlineTransaction::with('user', 'product', 'payment', 'ahliwaris')->find($id);
        return view('auth.pages.polis.show', compact('data'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalReferal = OnlineTransaction::where('referal_code', Auth::user()->referal_code)->count();
        $totalPolisReferal = OnlineTransaction::where('referal_code', Auth::user()->referal_code)
            ->whereIn('status', ['3', '4', '5'])
            ->whereIn('status_offline', ['4', '5', '6'])
            ->count();
        $totalPolisReferalAktif = OnlineTransaction::where('referal_code', Auth::user()->referal_code)
            ->where('status', '5')
            ->where('status_offline', '6')
            ->where('jatuh_tempo', '>=', date('Y-m-d'))
            ->count();
        $totalPolisReferalTidakAktif = OnlineTransaction::where('referal_code', Auth::user()->referal_code)
            ->where('status', '5')
            ->where('status_offline', '6')
            ->where('jatuh_tempo', '<', date('Y-m-d'))
            ->count();
        $totalPolisDalamProses = OnlineTransaction::where('referal_code', Auth::user()->referal_code)
            ->whereIn('status', ['3', '4'])
            ->whereIn('status_offline', ['4', '5'])
            ->count();

        $start_date = Carbon::today();
        $end_date = Carbon::today()->addDays(30);

        $totalPolis = OnlineTransaction::where('user_id', Auth::user()->id)->whereIn('status', ['1', '2', '3', '4', '5'])->count();
        $totalPolisTidakAktif = OnlineTransaction::where('user_id', Auth::user()->id)->where('status', '5')->where('jatuh_tempo', '<', date('Y-m-d'))->count();
        $totalPolisJatuhTempo = OnlineTransaction::where('user_id', Auth::user()->id)->where('status', '5')->whereBetween('jatuh_tempo', [$start_date, $end_date])->count();
        $totalPolisAktif = OnlineTransaction::where('user_id', Auth::user()->id)->whereIn('status', ['3', '4', '5'])->where('jatuh_tempo', '>=', date('Y-m-d'))->count();
        $totalPolisDalamProsesUser = OnlineTransaction::where('user_id', Auth::user()->id)->where('status', '=', '4')->count();
        $totalPolisPaid = OnlineTransaction::where('user_id', Auth::user()->id)->where('status', '=', '3')->count();
        $totalPolisPending = OnlineTransaction::where('user_id', Auth::user()->id)->where('status', '=', '2')->count();
        $totalPolisRequest = OnlineTransaction::where('user_id', Auth::user()->id)->where('status', '=', '1')->count();

        $totalPolisOff = OnlineTransaction::where('user_id', Auth::user()->id)->whereIn('status_offline', ['1', '2', '3', '4', '5', '6'])->count();
        $totalPolisTidakAktifOff = OnlineTransaction::where('user_id', Auth::user()->id)->where('status_offline', '6')->where('jatuh_tempo', '<', date('Y-m-d'))->count();
        $totalPolisAktifOff = OnlineTransaction::where('user_id', Auth::user()->id)->where('status_offline', ['4', '5', '6'])->where('jatuh_tempo', '>', date('Y-m-d'))->count();
        $totalPolisDalamProsesUserOff = OnlineTransaction::where('user_id', Auth::user()->id)->where('status_offline', '=', '5')->count();
        $totalPolisPaidOff = OnlineTransaction::where('user_id', Auth::user()->id)->where('status_offline', '=', '4')->count();
        $totalPolisPendingOff = OnlineTransaction::where('user_id', Auth::user()->id)->where('status_offline', '=', '3')->count();
        $totalPolisProgressOff = OnlineTransaction::where('user_id', Auth::user()->id)->where('status_offline', '=', '2')->count();
        $totalPolisRequestOff = OnlineTransaction::where('user_id', Auth::user()->id)->where('status_offline', '=', '1')->count();

        // POINT AKTIF
        $sumAllCommission = commission::where('upline_id', Auth::user()->id)->sum('commissions');
        $sumAllRedeemPoin = RedeemPoin::where('user_id', Auth::user()->id)->sum('redeem_amount');
        $poinAktif = abs($sumAllCommission - $sumAllRedeemPoin);

        $popup02            = Popup::where('id', '2')->get();
        $popup03            = Popup::where('id', '3')->get();
        $popup04            = Popup::where('id', '4')->get();

        return view('auth/pages/home', compact(
            'popup02',
            'popup03',
            'popup04',
            'totalPolis',
            'totalPolisAktif',
            'totalPolisTidakAktif',
            'totalPolisJatuhTempo',
            'totalPolisDalamProsesUser',
            'totalPolisPaid',
            'totalPolisPending',
            'totalPolisRequest',
            'totalPolisOff',
            'totalPolisAktifOff',
            'totalPolisTidakAktifOff',
            'totalPolisDalamProsesUserOff',
            'totalPolisPaidOff',
            'totalPolisPendingOff',
            'totalPolisProgressOff',
            'totalPolisRequestOff',
            'totalReferal',
            'totalPolisReferal',
            'poinAktif',
            'sumAllCommission',
            'sumAllRedeemPoin',
            'totalPolisReferalAktif',
            'totalPolisReferalTidakAktif',
            'totalPolisDalamProses'
        ));
    }

    public function link(Request $request)
    {
        $link = OnlineProduct::where('status_product', '1')->where('type_product', '0')->get();
        return view('auth.pages.link', compact('link'));
    }

    public function linkagen(Request $request)
    {
        $link = OnlineProduct::where('status_product', '1')->get();
        return view('auth.pages.linkagen', compact('link'));
    }

    public function nasabahagen()
    {
        $getJumlahAllNasabahByAgentReferalCode = User::where('referal_code_upline', auth()->user()->referal_code)->count();

        $transactionByNasabahAgent = OnlineTransaction::with(['product', 'user'])
            ->whereHas('user', function ($query) {
                $query->where('referal_code_upline', auth()->user()->referal_code);
            })
            ->get();
        $sumTransactionByNasabahAgentOnline = OnlineTransaction::with(['product', 'user'])
            ->whereHas('user', function ($query) {
                $query->where('referal_code_upline', auth()->user()->referal_code);
            })
            ->where('status',  '3')
            ->orWhere('status',  '4')
            ->orWhere('status',  '5')
            ->sum('nilai_premi');
        $sumTransactionByNasabahAgentOffline = OnlineTransaction::with(['product', 'user'])
            ->whereHas('user', function ($query) {
                $query->where('referal_code_upline', auth()->user()->referal_code);
            })
            ->where('status_offline',  '4')
            ->orWhere('status_offline',  '5')
            ->orWhere('status_offline',  '6')
            ->sum('nilai_premi');

        return view('auth.pages.nasabahagen', compact('getJumlahAllNasabahByAgentReferalCode', 'transactionByNasabahAgent', 'sumTransactionByNasabahAgentOnline', 'sumTransactionByNasabahAgentOffline', 'transactionByNasabahAgent'));
    }

    public function profile(Request $request)
    {
        Auth::user()->id;
        return view('auth.pages.profile');
    }

    public function upgradeAffiliator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npwp' => ['required', 'string', 'max:100'],
            'bank' => ['required', 'string', 'max:100'],
            'account_name' => ['required', 'string', 'max:100'],
            'account_number' => ['required', 'string', 'max:100'],
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['npwp'] = $request->npwp;
        $data['bank'] = $request->bank;
        $data['account_name'] = $request->account_name;
        $data['account_number'] = $request->account_number;
        $data['roles'] = 2;
        $data['target_id'] = 1;

        User::where('id', '=', Auth::user()->id)->update($data);
        return redirect()->route('dashboard.profile')->with('success', 'Anda telah berhasil bergabung program affiliasi');;
    }

    public function upgradeToAgent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npwp_img' => ['required', 'image', 'mimes:png,jpg,svg', 'max:2048'],
            'ktp_img' => ['required', 'image', 'mimes:png,jpg,svg', 'max:2048'],
            'kk_img' => ['required', 'image', 'mimes:png,jpg,svg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = [];

        foreach (['npwp_img', 'ktp_img', 'kk_img'] as $imageField) {
            $imageFile = $request->file($imageField);
            $imageExtension = $imageFile->extension();
            $imageName = date('ymdhis') . "_" . $imageField . "." . $imageExtension;
            $imageFile->move(public_path('img/mitra'), $imageName);
            $data[$imageField] = $imageName;
        }

        $data['roles'] = 3; // Set the 'roles' field to 3

        // Update the user's record with image file names and roles
        User::where('id', auth()->user()->id)->update($data);

        return redirect()->route('dashboard.profile')->with('success', 'Permintaan menjadi Mitra telah dikirim, silahkan menunggu konfirmasi');
    }

    public function updateprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'ktp' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'poscode' => ['string', 'max:255'],
            'dob' => ['required', 'string', 'max:10'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        // dd($request->all());

        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['ktp'] = $request->ktp;
        $data['address'] = $request->address;
        $data['poscode'] = $request->poscode;
        $data['dob'] = $request->dob;
        $data['npwp'] = $request->npwp;
        $data['bank'] = $request->bank;
        $data['account_name'] = $request->account_name;
        $data['account_number'] = $request->account_number;


        if ($request->has('province') && $request->province != null) {
            $provinceParts = explode('-', $request->province);
            $data['province'] = isset($provinceParts[1]) ? $provinceParts[1] : null;
        }

        if ($request->has('city') && $request->city != null) {
            $cityParts = explode('-', $request->city);
            $data['city'] = isset($cityParts[1]) ? $cityParts[1] : null;
        }

        if ($request->has('district') && $request->district != null) {
            $districtParts = explode('-', $request->district);
            $data['district'] = isset($districtParts[1]) ? $districtParts[1] : null;
        }

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', '=', Auth::user()->id)->update($data);
        return redirect()->route('dashboard.profile')->with('success', 'Data berhasil diubah');;
    }

    public function commission(Request $request)
    {
        $id = Auth::user()->id;
        $poinData = commission::with('user')->where('upline_id', $id)->get();
        $redeemPoins = RedeemPoin::where('user_id', $id)->get();
        return view('auth.pages.commision.index', compact('poinData', 'redeemPoins'));
    }

    // polis online
    public function followup()
    {
        $start_date = Carbon::today();
        $end_date = Carbon::today()->addDays(30);

        $polises = OnlineTransaction::with('product')
            ->whereBetween('jatuh_tempo', [$start_date, $end_date])
            ->where(function ($query) {
                $query->where('status', '5');
            })
            ->get();

        return view('auth.pages.polis.followup', compact('polises'));
    }

    public function expired(Request $request)
    {
        $id = Auth::user()->id;
        $currentDate = now(); // Get the current date and time

        $polises = OnlineTransaction::with('product')
            ->where('user_id', $id)
            ->where('status', '5')
            ->whereDate('jatuh_tempo', '<', $currentDate)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('auth.pages.polis.expired', compact('polises'));
    }

    public function active(Request $request)
    {
        $id = Auth::user()->id;
        $currentDate = now(); // Get the current date and time

        $polises = OnlineTransaction::with('product')
            ->where('user_id', $id)
            ->whereIn('status', ['3', '4', '5'])
            ->whereDate('jatuh_tempo', '>=', $currentDate)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('auth.pages.polis.active', compact('polises'));
    }

    public function polis(Request $request)
    {
        $id = Auth::user()->id;
        $polises = OnlineTransaction::with('product')->where('user_id', $id)->whereIn('status', ['1', '2', '3', '4', '5'])->orderBy('created_at', 'DESC')->get();
        return view('auth.pages.polis.index', compact('polises'));
    }

    public function process(Request $request)
    {
        $id = Auth::user()->id;
        $polises = OnlineTransaction::with('product')->where('user_id', $id)->where('status', '4')->orderBy('created_at', 'DESC')->get();
        return view('auth.pages.polis.process', compact('polises'));
    }

    public function paid(Request $request)
    {
        $id = Auth::user()->id;
        $polises = OnlineTransaction::with('product', 'payment')->where('user_id', $id)->where('status', '3')->orderBy('created_at', 'DESC')->get();
        return view('auth.pages.polis.paid', compact('polises'));
    }

    public function unpaid(Request $request)
    {
        $id = Auth::user()->id;
        $polises = OnlineTransaction::with('product', 'payment')->where('user_id', $id)->where('status', '2')->orderBy('created_at', 'DESC')->get();
        return view('auth.pages.polis.unpaid', compact('polises'));
    }

    public function request(Request $request)
    {
        $id = Auth::user()->id;
        $polises = OnlineTransaction::with('product', 'payment')->where('user_id', $id)->where('status', '1')->get();
        return view('auth.pages.polis.request', compact('polises'));
    }

    public function requestRedeem(Request $request)
    {
        $id = Auth::user()->id;
        $sumAllCommission = commission::where('upline_id', Auth::user()->id)->sum('commissions');
        $sumAllRedeemPoin = RedeemPoin::where('user_id', Auth::user()->id)->sum('redeem_amount');
        $poinAktif = abs($sumAllCommission - $sumAllRedeemPoin);

        if ((int)$request->jumlah > $poinAktif) return redirect()->back()->with('error', 'Jumlah yang anda masukkan melebihi poin aktif anda');

        if ((int)$request->jumlah <= 0) return redirect()->back()->with('error', 'Jumlah yang anda masukkan tidak sesuai dengan ketentuan');

        $findRedeem = RedeemPoin::where('user_id', $id)->where('redeem_status', '1')->first();
        if ($findRedeem) return redirect()->back()->with('error', 'Anda masih memiliki permintaan redeem poin yang belum dikonfirmasi');

        $data['user_id'] = $id;
        $data['redeem_amount'] = $request->jumlah;
        $data['redeem_status'] = '1';
        $data['redeem_code'] = rand(100000, 999999);
        $data['redeem_request_date'] = date('Y-m-d');
        $data['redeem_approve_date'] = date('Y-m-d');
        $data['created_at'] = date('Y-m-d H:i:s');

        RedeemPoin::create($data);

        return redirect()->back()->with('success', 'Permintaan redeem poin anda telah dikirim, silahkan menunggu konfirmasi dari admin');
    }

    // polis offline
    public function offpolis(Request $request)
    {
        $id = Auth::user()->id;
        $polises = OnlineTransaction::with('product')->where('user_id', $id)->whereIn('status_offline', ['1', '2', '3', '4', '5', '6'])->get();
        return view('auth.pages.offpolis.index', compact('polises'));
    }

    public function offexpired(Request $request)
    {
        $id = Auth::user()->id;
        $currentDate = now(); // Get the current date and time

        $polises = OnlineTransaction::with('product')
            ->where('user_id', $id)
            ->where('status_offline', '6')
            ->whereDate('jatuh_tempo', '<', $currentDate) // Add this line for expiration check
            ->get();

        return view('auth.pages.offpolis.expired', compact('polises'));
    }

    public function offactive(Request $request)
    {
        $id = Auth::user()->id;
        $currentDate = now(); // Get the current date and time

        $polises = OnlineTransaction::with('product')
            ->where('user_id', $id)
            ->whereIn('status_offline', ['4', '5', '6'])
            ->whereDate('jatuh_tempo', '>=', $currentDate) // Add this line for expiration check
            ->get();

        return view('auth.pages.offpolis.active', compact('polises'));
    }

    public function offpolisprocess(Request $request)
    {
        $id = Auth::user()->id;
        $polises = OnlineTransaction::with('product')->where('user_id', $id)->where('status_offline', '5')->get();
        return view('auth.pages.offpolis.polisprocess', compact('polises'));
    }

    public function offpaid(Request $request)
    {
        $id = Auth::user()->id;
        $polises = OnlineTransaction::with('product', 'payment')->where('user_id', $id)->where('status_offline', '4')->get();
        return view('auth.pages.offpolis.paid', compact('polises'));
    }

    public function offunpaid(Request $request)
    {
        $id = Auth::user()->id;
        $polises = OnlineTransaction::with('product', 'payment')->where('user_id', $id)->where('status_offline', '3')->get();
        return view('auth.pages.offpolis.unpaid', compact('polises'));
    }

    public function offprocess(Request $request)
    {
        $id = Auth::user()->id;
        $polises = OnlineTransaction::with('product', 'payment')->where('user_id', $id)->where('status_offline', '2')->get();
        return view('auth.pages.offpolis.process', compact('polises'));
    }

    public function offrequest(Request $request)
    {
        $id = Auth::user()->id;
        $polises = OnlineTransaction::with('product', 'payment')->where('user_id', $id)->where('status_offline', '1')->get();
        return view('auth.pages.offpolis.request', compact('polises'));
    }

    public function offshow(Request $request, $id)
    {
        $data = OnlineTransaction::with('user', 'product', 'payment', 'ahliwaris')->find($id);
        return view('auth.pages.offpolis.show', compact('data'));
    }

    // agen sale
    public function belibaru(Request $request)
    {
        $landing   = DB::table('landings')->first();
        $onlineproduct = OnlineProduct::where('type_product', '0')->where('status_product', '1')->get();
        $referal_code = $request->query('referalCode') ?? null;
        $offlineproduct     = OnlineProduct::where('type_product', '1')->where('status_product', '1')->get();
        $data = array(
            'landing'           => $landing,
            'onlineproduct'     => $onlineproduct,
            'referal_code'      => $referal_code,
            'offlineproduct'    => $offlineproduct,
        );

        return view('auth.pages.belibaru', $data);
    }

    public function belibaruDetailForm(Request $request, $slug)
    {
        $landing   = DB::table('landings')->first();
        $onlineproduct = OnlineProduct::where('slug', $slug)->firstOrFail();
        $referal_code = $request->query('referalCode') ?? null;
        $data = array(
            'landing'           => $landing,
            'onlineproduct'     => $onlineproduct,
            'referal_code'      => $referal_code,
        );

        return view('auth.pages.belibaru_details', $data);
    }

    public function belibaruOffline(Request $request)
    {
        $landing   = DB::table('landings')->first();
        $referal_code = $request->query('referalCode') ?? null;
        $offlineproduct     = OnlineProduct::where('type_product', '1')->where('status_product', '1')->get();
        $data = array(
            'landing'           => $landing,
            'referal_code'      => $referal_code,
            'offlineproduct'    => $offlineproduct,
        );

        return view('auth.pages.belibaru_offline', $data);
    }

    public function belibaruOfflineDetailForm(Request $request, $slug)
    {
        $landing        = DB::table('landings')->first();
        $offlineproduct = OnlineProduct::where('slug', $slug)->firstOrFail();
        $referal_code   = $request->query('referalCode') ?? null;
        $products = OnlineProduct::where('type_product', '1')->where('status_product', '1')->get(['id', 'name']);
        $data = array(
            'landing'           => $landing,
            'offlineproduct'    => $offlineproduct,
            'referal_code'      => $referal_code,
            'products'          => $products,
        );

        return view('auth.pages.belibaru_offline_details', $data);
    }

    // notifikasi
    public function notifikasi()
    {

        $id = Auth::user()->id;
        $notifications = Notification::with([
            'notif_detail',
            'transaction' => function ($query) {
                $query->select('id', 'transaction_id');
            }
        ])
            ->where('user_id', $id)
            ->orderBy('id', 'desc')
            ->take(20)
            ->get();

        return view('auth.pages.notifikasi.index', compact('notifications'));
    }
}
