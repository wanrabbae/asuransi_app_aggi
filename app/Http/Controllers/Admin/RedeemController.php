<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RedeemPoin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class RedeemController extends Controller
{
    public function index()
    {
        $data = RedeemPoin::with('user')->get();
        $countData = RedeemPoin::count();
        $countDataFilter = 0;

        return view('admin.pages.redeems.index', compact('data', 'countData', 'countDataFilter'));
    }

    public function request()
    {
        $data = RedeemPoin::with('user')->where('redeem_status', '1')->get();
        $countData = RedeemPoin::with('user')->where('redeem_status', '1')->count();
        return view('admin.pages.redeems.request', compact('data', 'countData'));
    }

    public function process()
    {
        $data = RedeemPoin::with('user')->where('redeem_status', '2')->get();
        $countData = RedeemPoin::with('user')->where('redeem_status', '2')->count();
        return view('admin.pages.redeems.process', compact('data', 'countData'));
    }

    public function success()
    {
        $data = RedeemPoin::with('user')->where('redeem_status', '3')->get();
        $countData = RedeemPoin::where('redeem_status', '3')->count();
        $countDataFilter = 0;
        return view('admin.pages.redeems.success', compact('data', 'countData', 'countDataFilter'));
    }

    public function indexFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = RedeemPoin::with('user')->whereBetween('created_at', [$start_date, $end_date])->get();
        $countData = RedeemPoin::count();
        $countDataFilter = RedeemPoin::whereBetween('created_at', [$start_date, $end_date])->count();


        return view('admin.pages.redeems.index', compact('data', 'countData', 'countDataFilter'));
    }

    public function requestFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = RedeemPoin::with('user')->where('redeem_status', '1')->whereBetween('created_at', [$start_date, $end_date])->get();
        $countData = RedeemPoin::with('user')->where('redeem_status', '1')->whereBetween('created_at', [$start_date, $end_date])->count();

        return view('admin.pages.redeems.request', compact('data', 'countData'));
    }

    public function requestSubmit(Request $request)
    {
        $ids = explode(',', $request->checkbox_child_value);
        if ($ids[0] != '') {
            foreach ($ids as $id) {
                $data = RedeemPoin::find($id);
                $data->redeem_status = 2;
                $data->redeem_request_date = Carbon::now();
                $data->save();
            }
            return back()->with('success', 'Berhasil Mengubah Status');
        } else {
            return back()->with('error', 'Tidak ada data yang dipilih');
        }
    }

    public function processFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = RedeemPoin::with('user')->where('redeem_status', '2')->whereBetween('created_at', [$start_date, $end_date])->get();
        $countData = RedeemPoin::with('user')->where('redeem_status', '2')->whereBetween('created_at', [$start_date, $end_date])->count();

        return view('admin.pages.redeems.process', compact('data', 'countData'));
    }

    public function processSubmit(Request $request)
    {
        $ids = explode(',', $request->checkbox_child_value);
        if ($ids[0] != '') {
            foreach ($ids as $id) {
                $data = RedeemPoin::find($id);
                $data->redeem_status = 3;
                $data->save();
            }
            return back()->with('success', 'Berhasil Mengubah Status');
        } else {
            return back()->with('error', 'Tidak ada data yang dipilih');
        }
    }

    public function successFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = RedeemPoin::with('user')->where('redeem_status', '3')->whereBetween('created_at', [$start_date, $end_date])->get();
        $countData = RedeemPoin::where('redeem_status', '3')->count();
        $countDataFilter = RedeemPoin::where('redeem_status', '3')->whereBetween('created_at', [$start_date, $end_date])->count();

        return view('admin.pages.redeems.success', compact('data', 'countData', 'countDataFilter'));
    }

    public function indexExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataRedeem = RedeemPoin::with('user')
            ->where('redeem_status', '1')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataRedeem = RedeemPoin::with('user')
                ->where('redeem_status', '1')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
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
            'Kode Redeem',
            'Jumlah',
            'Tanggal',
            'Status',
        ];
    
        $titleRow = ['Data Redeem'];
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
        foreach ($dataRedeem as $redeem) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $redeem->user->name);
            $sheet->setCellValue('C' . $row, $redeem->user->npwp);
            $sheet->setCellValue('D' . $row, $redeem->user->bank);
            $sheet->setCellValue('E' . $row, $redeem->user->account_name);
            $sheet->setCellValue('F' . $row, $redeem->user->account_number);
            $sheet->setCellValue('G' . $row, $redeem->redeem_code ?? "");
            $sheet->setCellValue('H' . $row, $redeem->redeem_amount ?? "");
            $sheet->setCellValue('I' . $row, tanggal_local($redeem->redeem_request_date) ?? "");

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
            'Redeem Data' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function requestExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataRedeem = RedeemPoin::with('user')
            ->where('redeem_status', '1')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataRedeem = RedeemPoin::with('user')
                ->where('redeem_status', '1')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
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
            'Kode Redeem',
            'Jumlah',
            'Tanggal',
            'Status',
        ];
    
        $titleRow = ['Data Permintaan Redeem'];
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
        foreach ($dataRedeem as $redeem) {

            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $redeem->user->name);
            $sheet->setCellValue('C' . $row, $redeem->user->npwp);
            $sheet->setCellValue('D' . $row, $redeem->user->bank);
            $sheet->setCellValue('E' . $row, $redeem->user->account_name);
            $sheet->setCellValue('F' . $row, $redeem->user->account_number);
            $sheet->setCellValue('G' . $row, $redeem->redeem_code ?? "");
            $sheet->setCellValue('H' . $row, $redeem->redeem_amount ?? "");
            $sheet->setCellValue('I' . $row, tanggal_local($redeem->redeem_request_date) ?? "");

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
            'Redeem Request' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function processExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataRedeem = RedeemPoin::with('user')
            ->where('redeem_status', '2')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataRedeem = RedeemPoin::with('user')
                ->where('redeem_status', '2')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'No',
            'Nama Mitra',
            'No NPWP',
            'Bank',
            'Nama Di Rekening',
            'No Rekening',
            'Kode Redeem',
            'Jumlah',
            'Tanggal',
            'Status',
        ];
    
        $titleRow = ['Data Proses Redeem'];
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
        foreach ($dataRedeem as $redeem) {

            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $redeem->user->name);
            $sheet->setCellValue('C' . $row, $redeem->user->npwp);
            $sheet->setCellValue('D' . $row, $redeem->user->bank);
            $sheet->setCellValue('E' . $row, $redeem->user->account_name);
            $sheet->setCellValue('F' . $row, $redeem->user->account_number);
            $sheet->setCellValue('G' . $row, $redeem->redeem_code ?? "");
            $sheet->setCellValue('H' . $row, $redeem->redeem_amount ?? "");
            $sheet->setCellValue('I' . $row, tanggal_local($redeem->redeem_request_date) ?? "");

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
            'Data Redeem Proses' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function successExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataRedeem = RedeemPoin::with('user')
            ->where('redeem_status', '3')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataRedeem = RedeemPoin::with('user')
                ->where('redeem_status', '3')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'No',
            'Nama Mitra',
            'No NPWP',
            'Bank',
            'Nama Di Rekening',
            'No Rekening',
            'Kode Redeem',
            'Jumlah',
            'Tanggal',
            'Status',
        ];
    
        $titleRow = ['Data Redeem Sukses'];
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
        foreach ($dataRedeem as $redeem) {

            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $redeem->user->name);
            $sheet->setCellValue('C' . $row, $redeem->user->npwp);
            $sheet->setCellValue('D' . $row, $redeem->user->bank);
            $sheet->setCellValue('E' . $row, $redeem->user->account_name);
            $sheet->setCellValue('F' . $row, $redeem->user->account_number);
            $sheet->setCellValue('G' . $row, $redeem->redeem_code ?? "");
            $sheet->setCellValue('H' . $row, $redeem->redeem_amount ?? "");
            $sheet->setCellValue('I' . $row, tanggal_local($redeem->redeem_request_date) ?? "");

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
            'Data Redeem Sukses' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }
}
