<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Expense;
use Carbon\Carbon;
use App\Models\User;
use App\Models\RedeemPoin;
use App\Models\OnlineTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = OnlineTransaction::where('status', '3')->orWhere('status', '4')->orWhere('status', '5')->get(['nilai_premi']);
        $dataoff = OnlineTransaction::where('status_offline', '4')->orWhere('status_offline', '5')->orWhere('status_offline', '6')->get(['nilai_premi']);
        $countData = $data->sum('nilai_premi');
        $countDataOff = $dataoff->sum('nilai_premi');
        $totalOmzet = $countData + $countDataOff;
        $totalCom = ($totalOmzet * 15) / 100;

        $feeAdmin = OnlineTransaction::where('status', '3')->orWhere('status', '4')->orWhere('status', '5')->get(['biaya_admin']);
        $feeAdminOff = OnlineTransaction::where('status_offline', '4')->orWhere('status_offline', '5')->orWhere('status_offline', '6')->get(['biaya_admin']);
        $countFeeAdmin = $feeAdmin->sum('biaya_admin');
        $countFeeAdminOff = $feeAdminOff->sum('biaya_admin');
        $totalFeeAdmin = $countFeeAdmin + $countFeeAdminOff;

        $feeMaterai = OnlineTransaction::where('status', '3')->orWhere('status', '4')->orWhere('status', '5')->get(['biaya_materai']);
        $feeMateraiOff = OnlineTransaction::where('status_offline', '4')->orWhere('status_offline', '5')->orWhere('status_offline', '6')->get(['biaya_materai']);
        $countFeeMaterai = $feeMaterai->sum('biaya_materai');
        $countFeeMateraiOff = $feeMateraiOff->sum('biaya_materai');
        $totalFeeMaterai = $countFeeMaterai + $countFeeMateraiOff;

        $otherExpense = Expense::get(['amount']);
        $counOtherExpense = $otherExpense->sum('amount');

        $dataRedeemAmountR = RedeemPoin::where('redeem_status', '1')->get(['redeem_amount']);
        $dataRedeemAmountP = RedeemPoin::where('redeem_status', '2')->get(['redeem_amount']);
        $dataRedeemAmount = RedeemPoin::where('redeem_status', '3')->get(['redeem_amount']);
        $countRedeemAmountR = $dataRedeemAmountR->sum('redeem_amount');
        $countRedeemAmountP = $dataRedeemAmountP->sum('redeem_amount');
        $countRedeemAmount = $dataRedeemAmount->sum('redeem_amount');
        $sisaRedeemAmount =  $totalCom - $countRedeemAmount;

        $countUser = User::where('roles', '1')->count();
        $countAgen = User::where('roles', '0')->count();
        $countAgenR = User::where('roles', '3')->count();
        $countPartner = User::where('roles', '2')->count();
        $totalUser = $countAgen + $countPartner + $countUser + $countAgenR;

        $totalPolisPaid = OnlineTransaction::where('status', '=', '3')->count();
        $totalPolisProcess = OnlineTransaction::where('status', '=', '4')->count();
        $totalPolis = OnlineTransaction::where('status', '=', '5')->count();
        $now = Carbon::today();
        $totalPolisExpired = OnlineTransaction::where('status', '5')
            ->where('jatuh_tempo',  '<', $now)
            ->count();
        $totalPolisComplate = OnlineTransaction::where('status', '5')
            ->where('jatuh_tempo',  '>=', $now)
            ->count();

        $totalPolisPaidOff = OnlineTransaction::where('status_offline', '=', '4')->count();
        $totalPolisProcessOff = OnlineTransaction::where('status_offline', '=', '5')->count();
        $totalPolisOff = OnlineTransaction::where('status_offline', '=', '6')->count();
        $now = Carbon::today();
        $totalPolisExpiredOff = OnlineTransaction::where('status_offline', '6')
            ->where('jatuh_tempo',  '<', $now)
            ->count();
        $totalPolisComplateOff = OnlineTransaction::where('status_offline', '6')
            ->where('jatuh_tempo',  '>=', $now)
            ->count();

        $sisaBalance = (($totalOmzet + $totalFeeAdmin + $totalFeeMaterai) - ($countRedeemAmount + $counOtherExpense));

        return view('admin.pages.home', compact(
            'totalPolisPaidOff',
            'totalPolisProcessOff',
            'totalPolisOff',
            'totalPolisExpiredOff',
            'totalPolisComplateOff',
            'sisaRedeemAmount',
            'countAgenR',
            'totalUser',
            'totalPolis',
            'totalPolisPaid',
            'totalPolisProcess',
            'totalPolisExpired',
            'totalPolisComplate',
            'countData',
            'countDataOff',
            'totalOmzet',
            'totalCom',
            'countRedeemAmountR',
            'countRedeemAmountP',
            'countRedeemAmount',
            'countUser',
            'countAgen',
            'countPartner',
            'countAgenR',
            'totalFeeAdmin',
            'totalFeeMaterai',
            'sisaBalance',
            'counOtherExpense'
        ));
    }

    public function profile()
    {
        return view('admin.pages.profile');
    }

    public function updateprofile(Request $request)
    {
        $admin = Admin::find(Auth::user()->id);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->password) {
            $admin->password = bcrypt($request->password);
        }

        $admin->save();

        return redirect()->back()->with('success', 'Profil berhasil diupdate');
    }

    public function underwriting()
    {
        $totalPolisPaid = OnlineTransaction::where('status', '=', '3')->count();
        $totalPolisProcess = OnlineTransaction::where('status', '=', '4')->count();
        $totalPolis = OnlineTransaction::where('status', '=', '5')->count();
        $now = Carbon::today();
        $end_date = Carbon::today()->addDays(7);
        $totalPolisExpired = OnlineTransaction::where('status', '5')
            ->where('jatuh_tempo',  '<', $now)
            ->count();
        $totalPolisComplate = OnlineTransaction::where('status', '5')
            ->where('jatuh_tempo',  '>=', $now)
            ->count();
        $totalPolisFollowup = OnlineTransaction::with('user', 'product')
            ->whereBetween('jatuh_tempo', [$now, $end_date])
            ->where(function ($query) {
                $query->where('status', '5');
            })
            ->count();

        $totalPolisReqOff = OnlineTransaction::where('status_offline', '=', '1')->count();
        $totalPolisFollOff = OnlineTransaction::where('status_offline', '=', '2')->count();
        $totalPolisPayOff = OnlineTransaction::where('status_offline', '=', '3')->count();
        $totalPolisPaidOff = OnlineTransaction::where('status_offline', '=', '4')->count();
        $totalPolisProcessOff = OnlineTransaction::where('status_offline', '=', '5')->count();
        $totalPolisOff = OnlineTransaction::where('status_offline', '=', '6')->count();
        $now = Carbon::today();
        $end_date = Carbon::today()->addDays(7);
        $totalPolisExpiredOff = OnlineTransaction::where('status_offline', '6')
            ->where('jatuh_tempo',  '<', $now)
            ->count();
        $totalPolisComplateOff = OnlineTransaction::where('status_offline', '6')
            ->where('jatuh_tempo',  '>=', $now)
            ->count();
        $totalPolisFollowupOff = OnlineTransaction::with('user', 'product')
            ->whereBetween('jatuh_tempo', [$now, $end_date])
            ->where(function ($query) {
                $query->where('status_offline', '5');
            })
            ->count();

        $countAgenR = User::where('roles', '3')->count();

        return view('admin.pages.underwriting', compact(
            'totalPolisPaid',
            'totalPolisProcess',
            'totalPolisComplate',
            'totalPolisExpired',
            'totalPolisFollowup',
            'totalPolisReqOff',
            'totalPolisFollOff',
            'totalPolisPayOff',
            'totalPolisPaidOff',
            'totalPolisProcessOff',
            'totalPolisComplateOff',
            'totalPolisExpiredOff',
            'totalPolisFollowupOff',
            'countAgenR'
        ));
    }

    public function staff()
    {
        return view('admin.pages.staff');
    }

    public function finance()
    {
        $data = OnlineTransaction::where('status', '3')->orWhere('status', '4')->orWhere('status', '5')->get(['nilai_premi']);
        $dataoff = OnlineTransaction::where('status_offline', '4')->orWhere('status_offline', '5')->orWhere('status_offline', '6')->get(['nilai_premi']);
        $countOnPaid = $data->sum('nilai_premi');
        $countOffPaid = $dataoff->sum('nilai_premi');
        $totalOmzet = $countOnPaid + $countOffPaid;
        $totalCom = ($totalOmzet * 15) / 100;

        $feeAdmin = OnlineTransaction::where('status', '3')->orWhere('status', '4')->orWhere('status', '5')->get(['biaya_admin']);
        $feeAdminOff = OnlineTransaction::where('status_offline', '4')->orWhere('status_offline', '5')->orWhere('status_offline', '6')->get(['biaya_admin']);
        $countFeeAdmin = $feeAdmin->sum('biaya_admin');
        $countFeeAdminOff = $feeAdminOff->sum('biaya_admin');
        $totalFeeAdmin = $countFeeAdmin + $countFeeAdminOff;

        $feeMaterai = OnlineTransaction::where('status', '3')->orWhere('status', '4')->orWhere('status', '5')->get(['biaya_materai']);
        $feeMateraiOff = OnlineTransaction::where('status_offline', '4')->orWhere('status_offline', '5')->orWhere('status_offline', '6')->get(['biaya_materai']);
        $countFeeMaterai = $feeMaterai->sum('biaya_materai');
        $countFeeMateraiOff = $feeMateraiOff->sum('biaya_materai');
        $totalFeeMaterai = $countFeeMaterai + $countFeeMateraiOff;

        $otherExpense = Expense::get(['amount']);
        $counOtherExpense = $otherExpense->sum('amount');

        $dataRedeemRequest = RedeemPoin::where('redeem_status', '1')->get(['redeem_amount']);
        $countRedeemRequest = $dataRedeemRequest->sum('redeem_amount');

        $dataRedeemAmountP = RedeemPoin::where('redeem_status', '2')->get(['redeem_amount']);
        $countRedeemAmountP = $dataRedeemAmountP->sum('redeem_amount');

        $dataRedeemAmount = RedeemPoin::where('redeem_status', '3')->get(['redeem_amount']);
        $countRedeemAmount = $dataRedeemAmount->sum('redeem_amount');
        $sisaRedeemAmount =  $totalCom - $countRedeemAmount;

        $sisaBalance = (($totalOmzet + $totalFeeAdmin + $totalFeeMaterai) - ($countRedeemAmount + $counOtherExpense));

        $countUser = User::count();

        return view('admin.pages.finance', compact(
            'countRedeemAmountP',
            'sisaRedeemAmount',
            'totalCom',
            'totalOmzet',
            'countOnPaid',
            'countOffPaid',
            'countRedeemAmount',
            'countRedeemRequest',
            'totalFeeAdmin',
            'totalFeeMaterai',
            'counOtherExpense',
            'sisaBalance'
        ));
    }

    public function chartGraphIncome()
    {
        $dataChartTotalPayment = OnlineTransaction::where('status', '3')
            ->orWhere('status', '4')
            ->orWhere('status', '5')
            ->select(DB::raw('SUM(nilai_premi) as total_payment_sum'), DB::raw('MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $dataChartTotalPaymentoFF = OnlineTransaction::where('status_offline', '4')
            ->orWhere('status_offline', '5')
            ->orWhere('status_offline', '6')
            ->select(DB::raw('SUM(nilai_premi) as total_payment_sum_off'), DB::raw('MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        return response()->json([$dataChartTotalPayment, $dataChartTotalPaymentoFF]);
    }

    public function chartGraphPolis()
    {
        $dataChartTotalPolis = OnlineTransaction::whereIn('status', ['3', '4', '5'])
            ->select(DB::raw('COUNT(user_id) as polis_sum'), DB::raw('MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $dataChartTotalPolisoFF = OnlineTransaction::whereIn('status_offline', ['4', '5', '6'])
            ->select(DB::raw('COUNT(user_id) as polis_sum_off'), DB::raw('MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        return response()->json([$dataChartTotalPolis, $dataChartTotalPolisoFF]);
    }

    public function chartGraphFinance()
    {
        $dataChartTotalPayment = OnlineTransaction::where('status', '3')
            ->orWhere('status', '4')
            ->orWhere('status', '5')
            ->select(DB::raw('SUM(nilai_premi) as total_payment_sum'), DB::raw('MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $dataChartTotalPaymentoFF = OnlineTransaction::where('status_offline', '4')
            ->orWhere('status_offline', '5')
            ->orWhere('status_offline', '6')
            ->select(DB::raw('SUM(nilai_premi) as total_payment_sum_off'), DB::raw('MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $redeemPoinData = RedeemPoin::where('redeem_status', '3')
            ->select(DB::raw('SUM(redeem_amount) as redeem_amount_sum'), DB::raw('MONTH(redeem_approve_date) as month'))
            ->groupBy(DB::raw('MONTH(redeem_approve_date)'))
            ->get();

        return response()->json([$dataChartTotalPayment, $redeemPoinData, $dataChartTotalPaymentoFF]);
    }
}
