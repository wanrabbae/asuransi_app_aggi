<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\OnlineTransaction;
use App\Models\User;
use App\Models\Target;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class TransactionController extends Controller
{
    public function alltrx()
    {
        $data = OnlineTransaction::with('user', 'product')
        ->whereIn('status', ['1', '2', '3', '4', '5'])
        ->orderBy('id', 'desc')
        ->get();

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.onlinetransaction.alltrx', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.onlinetransaction.alltrx', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.onlinetransaction.alltrx', compact('data'));
        } else {
            return back();
        }
    }
    
    public function index()
    {
        $data = OnlineTransaction::with('user', 'product')
        ->where('status', '1')
        ->orderBy('id', 'desc')
        ->get();

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.onlinetransaction.index', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.onlinetransaction.index', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.onlinetransaction.index', compact('data'));
        } else {
            return back();
        }
    }

    public function pending()
    {
        $data = OnlineTransaction::with('user', 'product')
        ->where('status', '2')
        ->orderBy('id', 'desc')
        ->get();

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.onlinetransaction.pending', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.onlinetransaction.pending', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.onlinetransaction.pending', compact('data'));
        } else {
            return back();
        }
    }

    public function paid()
    {
        $data = OnlineTransaction::with('user', 'product')
        ->where('status', '3')
        ->orderBy('id', 'asc')
        ->get();

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.onlinetransaction.paid', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.onlinetransaction.paid', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.onlinetransaction.paid', compact('data'));
        } else {
            return back();
        }
    }

    public function process()
    {
        $data = OnlineTransaction::with('user', 'product')
        ->where('status', '4')
        ->orderBy('id', 'asc')
        ->get();

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.onlinetransaction.process', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.onlinetransaction.process', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.onlinetransaction.process', compact('data'));
        } else {
            return back();
        }
    }

    public function complated()
    {
        $now = Carbon::today();
        $data = OnlineTransaction::with('user', 'product')
            ->where('status', '5')
            ->where('jatuh_tempo',  '>=', $now)
            ->orderBy('id', 'desc')
            ->get();

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.onlinetransaction.complated', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.onlinetransaction.complated', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 2) {
            return view('admin.pages.onlinetransaction.complated', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.onlinetransaction.complated', compact('data'));
        } else {
            return back();
        }
    }

    public function followup()
    {
        $start_date = Carbon::today();
        $end_date = Carbon::today()->addDays(7);

        $data = OnlineTransaction::with('user', 'product')
            ->whereBetween('jatuh_tempo', [$start_date, $end_date])
            ->where(function ($query) {
                $query->where('status', '5');
            })
            ->orderBy('jatuh_tempo', 'asc')
            ->get();
        
        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.onlinetransaction.followup', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.onlinetransaction.followup', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.onlinetransaction.followup', compact('data'));
        } else {
            return back();
        }
    }

    public function expired()
    {
        $now = Carbon::today();
        $data = OnlineTransaction::with('user', 'product')
            ->where('status', '5')
            ->where('jatuh_tempo',  '<', $now)
            ->orderBy('jatuh_tempo', 'desc')
            ->get();

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.onlinetransaction.expired', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.onlinetransaction.expired', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.onlinetransaction.expired', compact('data'));
        } else {
            return back();
        }
    }
    

    public function adminfee()
    {
        $data = OnlineTransaction::with('user', 'product')->where('status', '3')->orWhere('status', '4')->orWhere('status', '5')->latest('id')->get();
        $countData = $data->sum('biaya_admin');
        $countDataFilter = 0;
        return view('admin.pages.onlinetransaction.adminfee', compact('data', 'countData', 'countDataFilter'));
    }

    public function adminfeeFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->where(function ($query) {
                $query->where('status', '3')
                    ->orWhere('status', '4')
                    ->orWhere('status', '5');
            })
            ->get();

        $countData = OnlineTransaction::where('status', '3')
            ->orWhere('status', '4')
            ->orWhere('status', '5')
            ->sum('biaya_admin');

        $countDataFilter = OnlineTransaction::whereBetween('created_at', [$start_date, $end_date])
            ->where(function ($query) {
                $query->where('status', '3')
                    ->orWhere('status', '4')
                    ->orWhere('status', '5');
            })
            ->sum('biaya_admin');

        return view('admin.pages.onlinetransaction.adminfee', compact('data', 'countData', 'countDataFilter'));
    }

    public function materai()
    {
        $data = OnlineTransaction::with('user', 'product')->where('status', '3')->orWhere('status', '4')->orWhere('status', '5')->latest('id')->get();
        $countData = $data->sum('biaya_materai');
        $countDataFilter = 0;
        return view('admin.pages.onlinetransaction.materai', compact('data', 'countData', 'countDataFilter'));
    }

    public function materaiFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->where(function ($query) {
                $query->where('status', '3')
                    ->orWhere('status', '4')
                    ->orWhere('status', '5');
            })
            ->get();

        $countData = OnlineTransaction::where('status', '3')
            ->orWhere('status', '4')
            ->orWhere('status', '5')
            ->sum('biaya_materai');

        $countDataFilter = OnlineTransaction::whereBetween('created_at', [$start_date, $end_date])
            ->where(function ($query) {
                $query->where('status', '3')
                    ->orWhere('status', '4')
                    ->orWhere('status', '5');
            })
            ->sum('biaya_materai');

        return view('admin.pages.onlinetransaction.materai', compact('data', 'countData', 'countDataFilter'));
    }

    public function alldata()
    {
        $data = OnlineTransaction::with('user', 'product')
        ->where('status', '3')
        ->orWhere('status', '4')
        ->orWhere('status', '5')
        ->orWhere('status_offline', '4')
        ->orWhere('status_offline', '5')
        ->orWhere('status_offline', '6')
        ->latest('id')
        ->get();
        $countData = $data->sum('total_payment');
        $countDataFilter = 0;
        return view('admin.pages.onlinetransaction.alldata', compact('data', 'countData', 'countDataFilter'));
    }

    public function alldataFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->where(function ($query) {
                $query->where('status', '3')
                    ->orWhere('status', '4')
                    ->orWhere('status', '5')
                    ->orWhere('status_offline', '4')
                    ->orWhere('status_offline', '5')
                    ->orWhere('status_offline', '6');
            })
            ->get();

        $countData = OnlineTransaction::where('status', '3')
            ->orWhere('status', '4')
            ->orWhere('status', '5')
            ->orWhere('status_offline', '4')
            ->orWhere('status_offline', '5')
            ->orWhere('status_offline', '6')
            ->sum('total_payment');

        $countDataFilter = OnlineTransaction::whereBetween('created_at', [$start_date, $end_date])
            ->where(function ($query) {
                $query->where('status', '3')
                    ->orWhere('status', '4')
                    ->orWhere('status', '5')
                    ->orWhere('status_offline', '4')
                    ->orWhere('status_offline', '5')
                    ->orWhere('status_offline', '6');
            })
            ->sum('total_payment');

        return view('admin.pages.onlinetransaction.alldata', compact('data', 'countData', 'countDataFilter'));
    }
    
    public function premi()
    {
        $data = OnlineTransaction::with('user', 'product')->where('status', '3')->orWhere('status', '4')->orWhere('status', '5')->latest('id')->get();
        $countData = $data->sum('nilai_premi');
        $countDataFilter = 0;
        return view('admin.pages.onlinetransaction.premi', compact('data', 'countData', 'countDataFilter'));
    }

    public function premiFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->where(function ($query) {
                $query->where('status', '3')
                    ->orWhere('status', '4')
                    ->orWhere('status', '5');
            })
            ->get();

        $countData = OnlineTransaction::where('status', '3')
            ->orWhere('status', '4')
            ->orWhere('status', '5')
            ->sum('nilai_premi');

        $countDataFilter = OnlineTransaction::whereBetween('created_at', [$start_date, $end_date])
            ->where(function ($query) {
                $query->where('status', '3')
                    ->orWhere('status', '4')
                    ->orWhere('status', '5');
            })
            ->sum('nilai_premi');

        return view('admin.pages.onlinetransaction.premi', compact('data', 'countData', 'countDataFilter'));
    }

    public function alltrxFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->whereIn('status', ['1', '2', '3', '4', '5'])
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.alltrx', compact('data'));
    }

    public function requestFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status', '1')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.index', compact('data'));
    }

    public function pendingFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status', '2')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.pending', compact('data'));
    }

    public function paidFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status', '3')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.paid', compact('data'));
    }

    public function processFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status', '4')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.process', compact('data'));
    }

    public function complateFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status', '5')
            ->whereBetween('jatuh_tempo', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.complated', compact('data'));
    }

    public function followFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status', '5')
            ->whereBetween('jatuh_tempo', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.followup', compact('data'));
    }

    public function expiredFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = OnlineTransaction::with('user', 'product')
            ->where('status', '5')
            ->whereBetween('jatuh_tempo', [$start_date, $end_date])
            ->get();

        return view('admin.pages.onlinetransaction.followup', compact('data'));
    }

    public function processPaid(Request $request)
    {
        $ids = explode(',', $request->checkbox_child_value);
        if ($ids[0] != '') {
            foreach ($ids as $id) {
                $data = OnlineTransaction::find($id);
                sendNotification($data->user_id, $data->id, 'process_polis', 'Polis asuransi anda sedang diproses oleh admin');
                $data->status = 4;
                $data->save();
            }

            return redirect()->route('dashboard.onlinetransaction.process')->with('success', 'Transaksi Polis berhasil diproses');
        } else {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih');
        }
    }

    public function show(Request $request, $id)
    {
        $data = OnlineTransaction::with('user', 'product', 'payment')->find($id);
        return view('admin.pages.onlinetransaction.show', compact('data'));
    }

    public function showfinance(Request $request, $id)
    {
        $data = OnlineTransaction::with('user', 'product', 'payment')->find($id);
        return view('admin.pages.onlinetransaction.showfinance', compact('data'));
    }

    public function showall(Request $request, $id)
    {
        $data = OnlineTransaction::with('user', 'product', 'payment')->find($id);
        return view('admin.pages.onlinetransaction.showall', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'no_polis' => ['required', 'string', 'max:255'],
            'polis' => ['nullable', 'mimes:pdf', 'max:10000'],
            'nota_premi' => ['nullable', 'mimes:pdf', 'max:10000'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = [
            'no_polis' => $request->no_polis,
            'upload_polis_date' => Carbon::now(),
            'status' => '5',
        ];

        if ($request->hasFile('polis')) {
            $polis_file = $request->file('polis');
            $polis_ekstensi = $polis_file->extension();
            $polis_nama = date('ymdhis') . "_polis." . $polis_ekstensi;
            $polis_file->move(public_path('img/pdf/polis'), $polis_nama);

            $data['polis'] = $polis_nama;
        }

        if ($request->hasFile('nota_komisi')) {
            $nota_komisi_file = $request->file('nota_komisi');
            $nota_komisi_ekstensi = $nota_komisi_file->extension();
            $nota_komisi_nama = date('ymdhis') . "_nota_komisi." . $nota_komisi_ekstensi;
            $nota_komisi_file->move(public_path('img/pdf/nota_komisi'), $nota_komisi_nama);

            $data['nota_komisi'] = $nota_komisi_nama;
        }

        if ($request->hasFile('nota_premi')) {
            $nota_premi_file = $request->file('nota_premi');
            $nota_premi_ekstensi = $nota_premi_file->extension();
            $nota_premi_nama = date('ymdhis') . "_nota_premi." . $nota_premi_ekstensi;
            $nota_premi_file->move(public_path('img/pdf/nota_premi'), $nota_premi_nama);

            $data['nota_premi'] = $nota_premi_nama;
        }

        OnlineTransaction::whereId($id)->update($data);
        return redirect()->route('dashboard.onlinetransaction.completed');
    }

    public function revisipolis(Request $request, string $id)
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

        OnlineTransaction::whereId($id)->update($data);
        return redirect()->route('dashboard.onlinetransaction.completed');
    }

    public function alltrxExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->whereIn('status', ['1', '2', '3', '4', '5'])
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->whereIn('status', ['1', '2', '3', '4', '5'])
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
            if ($transaction->status == 1) {
                $statusLabel = 'Request';
            } elseif ($transaction->status == 2) {
                $statusLabel = 'Pending';
            } elseif ($transaction->status == 3) {
                $statusLabel = 'Paid';
            } elseif ($transaction->status == 4) {
                $statusLabel = 'Process';
            } elseif ($transaction->status == 5) {
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
            'Data Transaksi Nasabah' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function requestExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->where('status', '1')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->where('status', '1')
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
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $transaction->created_at);
            $sheet->setCellValue('C' . $row, $transaction->transaction_id);
            $sheet->setCellValue('D' . $row, $transaction->product->name ?? "");
            $sheet->setCellValue('E' . $row, $transaction->user->name ?? "");
            $sheet->setCellValue('F' . $row, $transaction->user->email ?? "");
            $sheet->setCellValue('G' . $row, $transaction->user->phone ?? "");
            $sheet->setCellValue('H' . $row, $transaction->status ?? "");

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
            'Request Transaksi' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function pendingExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->where('status', '2')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->where('status', '2')
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
            'Payment URL',
            'Premi',
            'Biaya Admin',
            'Biaya Materai',
            'Total',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($dataTransaksi as $transaction) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $transaction->created_at);
            $sheet->setCellValue('C' . $row, $transaction->transaction_id);
            $sheet->setCellValue('D' . $row, $transaction->product->name ?? "");
            $sheet->setCellValue('E' . $row, $transaction->user->name ?? "");
            $sheet->setCellValue('F' . $row, $transaction->user->email ?? "");
            $sheet->setCellValue('G' . $row, $transaction->user->phone ?? "");
            $sheet->setCellValue('H' . $row, $transaction->status ?? "");
            $sheet->setCellValue('I' . $row, $transaction->payment->url_payment ?? "");
            $sheet->setCellValue('J' . $row, format_uang($transaction->nilai_premi ?? 0) ?? "");
            $sheet->setCellValue('K' . $row, format_uang($transaction->biaya_admin ?? 0) ?? "");
            $sheet->setCellValue('L' . $row, format_uang($transaction->biaya_materai ?? 0) ?? "");
            $sheet->setCellValue('M' . $row, format_uang($transaction->total_payment ?? 0) ?? "");

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

    public function paidExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->where('status', '3')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->where('status', '3')
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
            'Tanggal bayar',
            'Nilai Premi',
        ];

        
        // Add a title row before the headers
        $titleRow = ['Data Permintaan Cetak Polis'];
        $sheet->fromArray($titleRow, null, 'A1');
        $styleTitle = $sheet->getStyle('A1:G1');
        $styleTitle->getFont()->setBold(true); // Make the title bold
        $styleTitle->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_NONE); // Remove borders

        // Increment $row to add an empty row after the title
        $row = 2;

        // Add an empty row after the title
        $sheet->fromArray([], null, 'A' . $row);

        // Add headers after the empty row
        $sheet->fromArray($headers, null, 'A' . ++$row);

        // Add border at the top of the header row
        $styleHeaders = $sheet->getStyle('A' . $row . ':G' . $row);
        $styleHeaders->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Set data rows
        $row++;
        $i = 1;
        foreach ($dataTransaksi as $transaction) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y'));
            $sheet->setCellValue('C' . $row, $transaction->transaction_id);
            $sheet->setCellValue('D' . $row, $transaction->product->name ?? "");
            $sheet->setCellValue('E' . $row, $transaction->user->name ?? "");
            $sheet->setCellValue('F' . $row, \Carbon\Carbon::parse($transaction->payment->updated_at)->format('d/m/Y') ?? "");
            $sheet->setCellValue('G' . $row, $transaction->nilai_premi ?? "");

            $style = $sheet->getStyle('A' . $row . ':G' . $row);
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
            'Cetak Polis' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function processExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->where('status', '4')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->where('status', '3')
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
            'Tanggal Proses',
            'Premi',
            'Biaya Admin',
            'Biaya Materai',
            'Total',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($dataTransaksi as $transaction) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $transaction->created_at);
            $sheet->setCellValue('C' . $row, $transaction->transaction_id);
            $sheet->setCellValue('D' . $row, $transaction->product->name ?? "");
            $sheet->setCellValue('E' . $row, $transaction->user->name ?? "");
            $sheet->setCellValue('F' . $row, $transaction->user->email ?? "");
            $sheet->setCellValue('G' . $row, $transaction->user->phone ?? "");
            $sheet->setCellValue('H' . $row, $transaction->status ?? "");
            $sheet->setCellValue('I' . $row, $transaction->updated_at ?? "");
            $sheet->setCellValue('J' . $row, format_uang($transaction->nilai_premi ?? 0) ?? "");
            $sheet->setCellValue('K' . $row, format_uang($transaction->biaya_admin ?? 0) ?? "");
            $sheet->setCellValue('L' . $row, format_uang($transaction->biaya_materai ?? 0) ?? "");
            $sheet->setCellValue('M' . $row, format_uang($transaction->total_payment ?? 0) ?? "");

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
            'Process Transaksi' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function complateExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->where('status', '5')
            ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->where('status', '3')
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
            'Tanggal Polis',
            'No Polis',
            'Tanggal Jatuh Tempo',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($dataTransaksi as $transaction) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $transaction->created_at);
            $sheet->setCellValue('C' . $row, $transaction->transaction_id);
            $sheet->setCellValue('D' . $row, $transaction->product->name ?? "");
            $sheet->setCellValue('E' . $row, $transaction->user->name ?? "");
            $sheet->setCellValue('F' . $row, $transaction->user->email ?? "");
            $sheet->setCellValue('G' . $row, $transaction->user->phone ?? "");
            $sheet->setCellValue('H' . $row, $transaction->status ?? "");
            $sheet->setCellValue('I' . $row, $transaction->updated_at ?? "");
            $sheet->setCellValue('I' . $row, $transaction->no_polis ?? "");
            $sheet->setCellValue('I' . $row, $transaction->jatuh_tempo ?? "");

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
            'Complated Transaksi' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function premiExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $data = OnlineTransaction::with('user', 'product')->where('status', '3')->orWhere('status', '4')->orWhere('status', '5')->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $data = OnlineTransaction::with('user', 'product')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->where(function ($query) {
                    $query->where('status', '3')
                        ->orWhere('status', '4')
                        ->orWhere('status', '5');
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
            if ($item->status == 1) {
                $statusLabel = 'Request';
            } elseif ($item->status == 2) {
                $statusLabel = 'Pending';
            } elseif ($item->status == 3) {
                $statusLabel = 'Paid';
            } elseif ($item->status == 4) {
                $statusLabel = 'Process';
            } elseif ($item->status == 5) {
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
            'Online Incomes' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function adminfeeExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $data = OnlineTransaction::with('user', 'product')->where('status', '3')->orWhere('status', '4')->orWhere('status', '5')->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $data = OnlineTransaction::with('user', 'product')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->where(function ($query) {
                    $query->where('status', '3')
                        ->orWhere('status', '4')
                        ->orWhere('status', '5');
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
            'Biaya Admin',
            'Tanggal Bayar',
            'Payment ID',
            'Status',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($data as $item) {
            if ($item->status == 1) {
                $statusLabel = 'Request';
            } elseif ($item->status == 2) {
                $statusLabel = 'Pending';
            } elseif ($item->status == 3) {
                $statusLabel = 'Paid';
            } elseif ($item->status == 4) {
                $statusLabel = 'Process';
            } elseif ($item->status == 5) {
                $statusLabel = 'Completed';
            }

            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $item->transaction_id ?? "");
            $sheet->setCellValue('C' . $row, $item->product->name);
            $sheet->setCellValue('D' . $row, $item->biaya_admin ?? "");
            $sheet->setCellValue('E' . $row, Carbon::parse($item->payment->updated_at)->format('d F Y') ?? "");
            $sheet->setCellValue('F' . $row, $item->payment->ipaymu_trx_id);
            $sheet->setCellValue('G' . $row, $statusLabel ?? "");

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
            'Admin Fee Data' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function materaiExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $data = OnlineTransaction::with('user', 'product')->where('status', '3')->orWhere('status', '4')->orWhere('status', '5')->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $data = OnlineTransaction::with('user', 'product')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->where(function ($query) {
                    $query->where('status', '3')
                        ->orWhere('status', '4')
                        ->orWhere('status', '5');
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
            'Biaya Materai',
            'Tanggal Bayar',
            'Payment ID',
            'Status',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($data as $item) {
            if ($item->status == 1) {
                $statusLabel = 'Request';
            } elseif ($item->status == 2) {
                $statusLabel = 'Pending';
            } elseif ($item->status == 3) {
                $statusLabel = 'Paid';
            } elseif ($item->status == 4) {
                $statusLabel = 'Process';
            } elseif ($item->status == 5) {
                $statusLabel = 'Completed';
            }

            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $item->transaction_id ?? "");
            $sheet->setCellValue('C' . $row, $item->product->name);
            $sheet->setCellValue('D' . $row, $item->biaya_materai ?? "");
            $sheet->setCellValue('E' . $row, Carbon::parse($item->payment->updated_at)->format('d F Y') ?? "");
            $sheet->setCellValue('F' . $row, $item->payment->ipaymu_trx_id);
            $sheet->setCellValue('G' . $row, $statusLabel ?? "");

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
            'Materai Data' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function alldataExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $data = OnlineTransaction::with('user', 'product')
        ->where('status', '3')
        ->orWhere('status', '4')
        ->orWhere('status', '5')
        ->orWhere('status_offline', '4')
        ->orWhere('status_offline', '5')
        ->orWhere('status_offline', '6')
        ->get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $data = OnlineTransaction::with('user', 'product')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->where(function ($query) {
                    $query->where('status', '3')
                        ->orWhere('status', '4')
                        ->orWhere('status', '5')
                        ->orWhere('status_offline', '4')
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
            if ($item->status == 1) {
                $statusLabel = 'Request';
            } elseif ($item->status == 2) {
                $statusLabel = 'Pending';
            } elseif ($item->status == 3) {
                $statusLabel = 'Paid';
            } elseif ($item->status == 4) {
                $statusLabel = 'Process';
            } elseif ($item->status == 5) {
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
            'Total All Incomes' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function printTransaction($id)
    {
        // Retrieve OnlineTransaction data with relationships
        $onlineTransactionData = OnlineTransaction::with('user', 'product', 'payment')->find($id);

        // Retrieve User data based on referal_code_upline
        $referalCodeUplineData = user::where('referal_code', $onlineTransactionData->referal_code_upline)->first();

        // Retrieve Target comission data based on referal code upline and assign it for nilai komisi
        $nilaiKomisi = 0;
        if($referalCodeUplineData && $referalCodeUplineData->target_id != null) {
            $targetData = Target::find($referalCodeUplineData->target_id);
            $nilaiKomisi = ($onlineTransactionData->nilai_premi * ($onlineTransactionData->product->komisi / 100)) * ($targetData->percentage_1 / 100);
        }

        // Add the user data to the $dataServe variable
        $dataServe = $onlineTransactionData;
        $dataServe->referalCodeUplineData = $referalCodeUplineData;
        $dataServe->nilaiKomisi = $nilaiKomisi;

        // Generate PDF
        $pdf = PDF::loadView('pdf.detail_transaction', ['data' => $dataServe])->setPaper('A4', 'portrait');

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
        $file = public_path('img/pdf/polis') . '/' . $data->polis;
        return response()->download($file);
    }

    public function downloadFilePremiFromPublic($id)
    {
        $data = OnlineTransaction::find($id);
        $file = public_path('img/pdf/nota_premi') . '/' . $data->nota_premi;
        return response()->download($file);
    }

    public function downloadFileKomisiFromPublic($id)
    {
        $data = OnlineTransaction::find($id);
        $file = public_path('img/pdf/nota_komisi') . '/' . $data->nota_komisi;
        return response()->download($file);
    }

    
}
