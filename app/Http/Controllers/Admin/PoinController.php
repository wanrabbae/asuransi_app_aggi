<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\commission;
use App\Models\RedeemPoin;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Illuminate\Http\Request;

class PoinController extends Controller
{
    public function index()
    {
        $data = Commission::selectRaw('upline_id, SUM(commissions) as total_commissions_peruser')
            ->groupBy('upline_id')
            ->with('user')
            ->get();

        $dataRedeemPoin = RedeemPoin::selectRaw('user_id, SUM(redeem_amount) as total_redeem_amount_peruser')
            ->where('redeem_status', '3')
            ->groupBy('user_id')
            ->get();

        $redeemAmounts = [];
        foreach ($dataRedeemPoin as $redeemPoin) {
            $redeemAmounts[$redeemPoin->user_id] = $redeemPoin->total_redeem_amount_peruser;
        }

        foreach ($data as $commissionData) {
            $uplineId = $commissionData->upline_id;
            $totalCommissions = $commissionData->total_commissions_peruser;
            $totalRedeemAmount = isset($redeemAmounts[$uplineId]) ? $redeemAmounts[$uplineId] : 0;

            $netCommissions = $totalCommissions - $totalRedeemAmount;

            $commissionData->net_commissions_peruser = $netCommissions;
            $commissionData->redeem_poins_peruser = $totalRedeemAmount;
        }

        $countDataFilter = 0;
        $countData = commission::sum('commissions') - RedeemPoin::where('redeem_status', '3')->sum('redeem_amount');

        return view('admin.pages.poin.index', compact('data', 'countDataFilter', 'countData'));
    }

    public function indexFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = commission::selectRaw('upline_id, SUM(commissions) as total_commissions_peruser')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->groupBy('upline_id')
            ->with('user')
            ->get();

        $dataRedeemPoin = RedeemPoin::selectRaw('user_id, SUM(redeem_amount) as total_redeem_amount_peruser')
            ->where('redeem_status', '3')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->groupBy('user_id')
            ->get();

        $redeemAmounts = [];

        foreach ($dataRedeemPoin as $redeemPoin) {
            $redeemAmounts[$redeemPoin->user_id] = $redeemPoin->total_redeem_amount_peruser;
        }

        foreach ($data as $commissionData) {
            $uplineId = $commissionData->upline_id;
            $totalCommissions = $commissionData->total_commissions_peruser;
            $totalRedeemAmount = isset($redeemAmounts[$uplineId]) ? $redeemAmounts[$uplineId] : 0;

            $netCommissions = $totalCommissions - $totalRedeemAmount;

            $commissionData->net_commissions_peruser = $netCommissions;
            $commissionData->redeem_poins_peruser = $totalRedeemAmount;
        }

        $countDataFilter = commission::whereBetween('created_at', [$start_date, $end_date])->sum('commissions') - RedeemPoin::where('redeem_status', '3')->whereBetween('created_at', [$start_date, $end_date])->sum('redeem_amount');
        $countData = commission::sum('commissions') - RedeemPoin::where('redeem_status', '3')->sum('redeem_amount');

        return view('admin.pages.poin.index', compact('data', 'countDataFilter', 'countData'));
    }

    public function indexExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataPoin = commission::selectRaw('upline_id, SUM(commissions) as total_commissions_peruser')
            ->groupBy('upline_id')
            ->with('user')
            ->get();

        $dataRedeemPoin = RedeemPoin::selectRaw('user_id, SUM(redeem_amount) as total_redeem_amount_peruser')
            ->where('redeem_status', '3')
            ->groupBy('user_id')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataPoin = commission::selectRaw('upline_id, SUM(commissions) as total_commissions_peruser')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->groupBy('upline_id')
                ->with('user')
                ->get();

            $dataRedeemPoin = RedeemPoin::selectRaw('user_id, SUM(redeem_amount) as total_redeem_amount_peruser')
                ->where('redeem_status', '3')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->groupBy('user_id')
                ->get();
        }

        $redeemAmounts = [];
        foreach ($dataRedeemPoin as $redeemPoin) {
            $redeemAmounts[$redeemPoin->user_id] = $redeemPoin->total_redeem_amount_peruser;
        }

        foreach ($dataPoin as $commissionData) {
            $uplineId = $commissionData->upline_id;
            $totalCommissions = $commissionData->total_commissions_peruser;
            $totalRedeemAmount = isset($redeemAmounts[$uplineId]) ? $redeemAmounts[$uplineId] : 0;

            $netCommissions = $totalCommissions - $totalRedeemAmount;

            $commissionData->net_commissions_peruser = $netCommissions;
            $commissionData->redeem_poins_peruser = $totalRedeemAmount;
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set table headers
        $headers = [
            'No',
            'Nama Mitra',
            'No NPWP',
            'Bank',
            'Nama Di Rekening',
            'No Rekening',
            'Total Poin',
            'Total Poin Redeem',
            'Sisa Poin',
        ];

        $titleRow = ['Data Poin Mitra'];
        $sheet->fromArray($titleRow, null, 'A1');
        $styleTitle = $sheet->getStyle('A1:I1');
        $styleTitle->getFont()->setBold(true); // Make the title bold
        $styleTitle->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_NONE); 

        $row = 2;

        $sheet->fromArray([], null, 'A' . $row);
        $sheet->fromArray($headers, null, 'A' . ++$row);
        $styleHeaders = $sheet->getStyle('A' . $row . ':I' . $row);
        $styleHeaders->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $row++;
        $i = 1;
        foreach ($dataPoin as $poin) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $poin->user->name);
            $sheet->setCellValue('C' . $row, $poin->user->npwp);
            $sheet->setCellValue('D' . $row, $poin->user->bank);
            $sheet->setCellValue('E' . $row, $poin->user->account_name);
            $sheet->setCellValue('F' . $row, $poin->user->account_number);
            $sheet->setCellValue('G' . $row, $poin->total_commissions_peruser ?? "");
            $sheet->setCellValue('H' . $row, $poin->redeem_poins_peruser ?? "");
            $sheet->setCellValue('I' . $row, $poin->net_commissions_peruser ?? "");

            $style = $sheet->getStyle('A' . $row . ':I' . $row);
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
            'Data Poin Mitra' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function index_poin()
    {
        $data = Commission::selectRaw('upline_id, SUM(commissions) as total_commissions_peruser')
            ->groupBy('upline_id')
            ->with('user')
            ->get();

        $dataRedeemPoin = RedeemPoin::selectRaw('user_id, SUM(redeem_amount) as total_redeem_amount_peruser')
            ->where('redeem_status', '3')
            ->groupBy('user_id')
            ->get();

        $redeemAmounts = [];
        foreach ($dataRedeemPoin as $redeemPoin) {
            $redeemAmounts[$redeemPoin->user_id] = $redeemPoin->total_redeem_amount_peruser;
        }

        foreach ($data as $commissionData) {
            $uplineId = $commissionData->upline_id;
            $totalCommissions = $commissionData->total_commissions_peruser;
            $totalRedeemAmount = isset($redeemAmounts[$uplineId]) ? $redeemAmounts[$uplineId] : 0;

            $netCommissions = $totalCommissions - $totalRedeemAmount;

            $commissionData->total_commissions_peruser = $netCommissions;
        }

        $countDataFilter = 0;
        $countData = commission::sum('commissions') - RedeemPoin::where('redeem_status', '3')->sum('redeem_amount');

        return view('admin.pages.poin.index_poin', compact('data', 'countDataFilter', 'countData'));
    }

    public function index_poin_filter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = commission::selectRaw('upline_id, SUM(commissions) as total_commissions_peruser')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->groupBy('upline_id')
            ->with('user')
            ->get();

        $dataRedeemPoin = RedeemPoin::selectRaw('user_id, SUM(redeem_amount) as total_redeem_amount_peruser')
            ->where('redeem_status', '3')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->groupBy('user_id')
            ->get();

        $redeemAmounts = [];

        foreach ($dataRedeemPoin as $redeemPoin) {
            $redeemAmounts[$redeemPoin->user_id] = $redeemPoin->total_redeem_amount_peruser;
        }

        foreach ($data as $commissionData) {
            $uplineId = $commissionData->upline_id;
            $totalCommissions = $commissionData->total_commissions_peruser;
            $totalRedeemAmount = isset($redeemAmounts[$uplineId]) ? $redeemAmounts[$uplineId] : 0;

            $netCommissions = $totalCommissions - $totalRedeemAmount;

            $commissionData->total_commissions_peruser = $netCommissions;
        }

        $countDataFilter = commission::whereBetween('created_at', [$start_date, $end_date])->sum('commissions') - RedeemPoin::where('redeem_status', '3')->whereBetween('created_at', [$start_date, $end_date])->sum('redeem_amount');
        $countData = commission::sum('commissions') - RedeemPoin::where('redeem_status', '3')->sum('redeem_amount');

        return view('admin.pages.poin.index_poin', compact('data', 'countDataFilter', 'countData'));
    }

    public function index_poin_excel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataPoin = commission::selectRaw('upline_id, SUM(commissions) as total_commissions_peruser')
            ->groupBy('upline_id')
            ->with('user')
            ->get();

        $dataRedeemPoin = RedeemPoin::selectRaw('user_id, SUM(redeem_amount) as total_redeem_amount_peruser')
            ->where('redeem_status', '3')
            ->groupBy('user_id')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataPoin = commission::selectRaw('upline_id, SUM(commissions) as total_commissions_peruser')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->groupBy('upline_id')
                ->with('user')
                ->get();

            $dataRedeemPoin = RedeemPoin::selectRaw('user_id, SUM(redeem_amount) as total_redeem_amount_peruser')
                ->where('redeem_status', '3')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->groupBy('user_id')
                ->get();
        }

        $redeemAmounts = [];
        foreach ($dataRedeemPoin as $redeemPoin) {
            $redeemAmounts[$redeemPoin->user_id] = $redeemPoin->total_redeem_amount_peruser;
        }

        foreach ($dataPoin as $commissionData) {
            $uplineId = $commissionData->upline_id;
            $totalCommissions = $commissionData->total_commissions_peruser;
            $totalRedeemAmount = isset($redeemAmounts[$uplineId]) ? $redeemAmounts[$uplineId] : 0;

            $netCommissions = $totalCommissions - $totalRedeemAmount;

            $commissionData->total_commissions_peruser = $netCommissions;
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set table headers
        $headers = [
            'No',
            'Nama',
            'Total Poin',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($dataPoin as $poin) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $poin->user->name);
            $sheet->setCellValue('C' . $row, $poin->total_commissions_peruser ?? "");

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
            'Data Poin' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }
}
