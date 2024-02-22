<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\DataUser;
use Illuminate\Http\Request;
use App\Models\OnlineTransaction;
use App\Http\Controllers\Controller;
use App\Models\Target;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DataUserController extends Controller
{
    public function index()
    {
        $data = User::where('roles', '1')->get();

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.user.index', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.user.index', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.user.index', compact('data'));
        } else {
            return back();
        }
    }

    public function show(Request $request, $id)
    {
        $data = User::find($id);

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.user.show', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.user.show', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.user.show', compact('data'));
        } else {
            return back();
        }
    }

    public function create()
    {
        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.user.create');
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.user.create');
        } else {
            return back();
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:4', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Z a-z \d]+$/'],
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('dashboard.userdata.index');
    }

    public function edit(Request $request, $id)
    {
        $data = User::find($id);

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.user.edit', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.user.edit', compact('data'));
        } else {
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'roles' => ['required'],
            'referal_code_upline' => ['required'],
            'is_active' => ['required'],
            'password' => ['nullable', 'string', 'confirmed', 'min:4', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Z a-z \d]+$/'],
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['referal_code_upline'] = $request->referal_code_upline;
        $data['roles'] = $request->roles;
        $data['is_active'] = $request->is_active;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($data);
        return redirect()->route('dashboard.userdata.index');
    }

    public function destroy(Request $request, $id)
    {
        $data = User::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->route('dashboard.userdata.index');
    }

    // affliator
    public function affliator()
    {
        $data = User::where('roles', '2')->get();

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.affliator.index', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.affliator.index', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.affliator.index', compact('data'));
        } else {
            return back();
        }
    }

    public function editaffliator(Request $request, $id)
    {
        $data = User::find($id);

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.affliator.edit', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.affliator.edit', compact('data'));
        } else {
            return back();
        }
    }

    public function updateaffliator(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'roles' => ['required'],
            'referal_code_upline' => ['required'],
            'is_active' => ['required'],
            'password' => ['nullable', 'string', 'confirmed', 'min:4', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Z a-z \d]+$/'],
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['referal_code_upline'] = $request->referal_code_upline;
        $data['roles'] = $request->roles;
        $data['is_active'] = $request->is_active;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($data);
        return redirect()->route('dashboard.userdata.affliator');
    }

    public function datanasabahaff(Request $request, $id)
    {
        $referalCodeUpline = User::where('id', $id)->first(['referal_code']);
        $data = User::whereIn('roles', ['1', '2', '3'])->where('referal_code_upline', $referalCodeUpline->referal_code)->get();
        $getJumlahAllNasabahByAgentReferalCode = User::whereIn('roles', ['1', '2', '3'])->where('referal_code_upline', $referalCodeUpline->referal_code)->count();

        if ($request->query('start_date') && $request->query('start_date') != 'null' && $request->query('end_date') && $request->query('end_date') != 'null') {
            $start_date = Carbon::parse($request->query('start_date'))->subDay();
            $end_date = Carbon::parse($request->query('end_date'))->addDay();

            $getJumlahAllNasabahByAgentReferalCode = User::whereIn('roles', ['1', '2', '3'])->where('referal_code_upline', $referalCodeUpline->referal_code)->whereBetween('created_at', [$start_date, $end_date])->count();

            $data = User::whereIn('roles', ['1', '2', '3'])
                ->where('referal_code_upline', $referalCodeUpline->referal_code)
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }

        return view('admin.pages.affliator.datanasabah', compact('data', 'getJumlahAllNasabahByAgentReferalCode'));
    }

    // public function datanasabahaffExcel(Request $request)
    // {
    //     $start_date = $request->query('start_date');
    //     $end_date = $request->query('end_date');

    //     $data = User::whereIn('roles', ['1', '2', '3'])
    //         ->get();

    //     if ($start_date != "null" && $end_date != "null") {
    //         $start_date = Carbon::parse($request->start_date)->subDay();
    //         $end_date = Carbon::parse($request->end_date)->addDay();

    //         $data = User::whereIn('roles', ['1', '2', '3'])
    //             ->whereBetween('created_at', [$start_date, $end_date])
    //             ->get();
    //     }

    //     $statusLabel = '';

    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     $headers = [
    //         'No',
    //         'Tanggal Register',
    //         'Nama',
    //         'Email',
    //         'Phone',
    //         'Level',
    //     ];

    //     $sheet->fromArray($headers, null, 'A1');

    //     $row = 2;
    //     $i = 1;
    //     foreach ($data as $d) {
    //         if ($d->roles == 0) {
    //             $statusLabel = 'Agent';
    //         } elseif ($d->roles == 1) {
    //             $statusLabel = 'Nasabah';
    //         } elseif ($d->roles == 2) {
    //             $statusLabel = 'Affiliator';
    //         } elseif ($d->roles == 3) {
    //             $statusLabel = 'Affiliator';
    //         }

    //         $sheet->setCellValue('A' . $row, $i++);
    //         $sheet->setCellValue('B' . $row, Carbon::parse($d->created_at)->format('d F Y') ?? "");
    //         $sheet->setCellValue('C' . $row, $d->name);
    //         $sheet->setCellValue('D' . $row, $d->email);
    //         $sheet->setCellValue('E' . $row, $d->phone);
    //         $sheet->setCellValue('F' . $row, $statusLabel ?? "");

    //         $row++;
    //     }

    //     $tempFile = tempnam(sys_get_temp_dir(), 'excel');

    //     $writer = new Xlsx($spreadsheet);
    //     $writer->save($tempFile);

    //     $response = new BinaryFileResponse($tempFile);
    //     $response->setContentDisposition(
    //         ResponseHeaderBag::DISPOSITION_ATTACHMENT,
    //         'Nasabah Affiliator Data' . '.xlsx'
    //     );

    //     $response->deleteFileAfterSend(true);

    //     return $response;
    // }

    public function nasabahaff(Request $request, $id)
    {
        $referalCodeUpline = User::where('id', $id)->first(['referal_code']);
        $getJumlahAllNasabahByAgentReferalCode = User::where('referal_code_upline', $referalCodeUpline->referal_code)->count();
        // dd($getJumlahAllNasabahByAgentReferalCode);
        $transactionByNasabahAgent = OnlineTransaction::with(['product', 'user'])
            ->where('referal_code_upline', $referalCodeUpline->referal_code)
            ->whereHas('user', function ($query) {
                $query->whereIn('roles', ['1', '2', '3']);
            })
            ->get();
        $sumTransactionByNasabahAgentOnline = OnlineTransaction::with(['product', 'user'])
            ->whereHas('user', function ($query) {
                $query->whereIn('roles', ['1', '2', '3']);
            })
            ->whereIn('status', ['3', '4', '5'])
            ->where('referal_code_upline', $referalCodeUpline->referal_code)
            ->sum('nilai_premi');
        $sumTransactionByNasabahAgentOffline = OnlineTransaction::with(['product', 'user'])
            ->whereHas('user', function ($query) {
                $query->whereIn('roles', ['1', '2', '3']);
            })
            ->whereIn('status_offline', ['4', '5', '6'])
            ->where('referal_code_upline', $referalCodeUpline->referal_code)
            ->sum('nilai_premi');

        if ($request->query('start_date') && $request->query('start_date') != 'null' && $request->query('end_date') && $request->query('end_date') != 'null') {
            $start_date = Carbon::parse($request->query('start_date'))->subDay();
            $end_date = Carbon::parse($request->query('end_date'))->addDay();

            $getJumlahAllNasabahByAgentReferalCode = User::whereIn('roles', ['1', '2', '3'])->where('referal_code_upline', $referalCodeUpline->referal_code)->whereBetween('created_at', [$start_date, $end_date])->count();

            $transactionByNasabahAgent = OnlineTransaction::with(['product', 'user'])
                ->where('referal_code_upline', $referalCodeUpline->referal_code)
                ->whereHas('user', function ($query) {
                    $query->whereIn('roles', ['1', '2', '3']);
                })
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
            $sumTransactionByNasabahAgentOnline = OnlineTransaction::with(['product', 'user'])
                ->where('referal_code_upline', $referalCodeUpline->referal_code)
                ->whereHas('user', function ($query) {
                    $query->whereIn('roles', ['1', '2', '3']);
                })
                ->whereIn('status', ['3', '4', '5'])
                ->whereBetween('created_at', [$start_date, $end_date])
                ->sum('nilai_premi');
            $sumTransactionByNasabahAgentOffline = OnlineTransaction::with(['product', 'user'])
                ->where('referal_code_upline', $referalCodeUpline->referal_code)
                ->whereHas('user', function ($query) {
                    $query->whereIn('roles', ['1', '2', '3']);
                })
                ->whereIn('status_offline', ['4', '5', '6'])
                ->whereBetween('created_at', [$start_date, $end_date])
                ->sum('nilai_premi');
        }

        return view('admin.pages.affliator.nasabah', compact('getJumlahAllNasabahByAgentReferalCode', 'sumTransactionByNasabahAgentOffline', 'sumTransactionByNasabahAgentOnline', 'transactionByNasabahAgent'));
    }

    // public function nasabahaffExcel(Request $request)
    // {
    //     $start_date = $request->query('start_date');
    //     $end_date = $request->query('end_date');

    //     $dataTransaksi = OnlineTransaction::with('user', 'product')
    //         ->whereHas('user', function ($query) {
    //             $query->whereIn('roles', ['1', '2', '3']);
    //         })
    //         ->get();

    //     if ($start_date != "null" && $end_date != "null") {
    //         $start_date = Carbon::parse($request->start_date)->subDay();
    //         $end_date = Carbon::parse($request->end_date)->addDay();

    //         $dataTransaksi = OnlineTransaction::with('user', 'product')
    //             ->whereHas('user', function ($query) {
    //                 $query->whereIn('roles', ['1', '2', '3']);
    //             })
    //             ->whereBetween('created_at', [$start_date, $end_date])
    //             ->get();
    //     }

    //     $statusLabel = '';

    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     $headers = [
    //         'No',
    //         'Tanggal Tansaksi',
    //         'ID Transaksi',
    //         'Nama Produk',
    //         'Nama Nasabah',
    //         'Nilai Premi',
    //         'Status',
    //         'Tanggal Polis',
    //         'No Polis',
    //         'Tanggal Jatuh Tempo',
    //     ];

    //     $sheet->fromArray($headers, null, 'A1');

    //     $row = 2;
    //     $i = 1;
    //     foreach ($dataTransaksi as $transaction) {
    //         if ($transaction->status == 1) {
    //             $statusLabel = 'Request';
    //         } elseif ($transaction->status == 2) {
    //             $statusLabel = 'Pending';
    //         } elseif ($transaction->status == 3) {
    //             $statusLabel = 'Paid';
    //         } elseif ($transaction->status == 4) {
    //             $statusLabel = 'Process';
    //         } elseif ($transaction->status == 5) {
    //             $statusLabel = 'Completed';
    //         } elseif ($transaction->status_offline == 1) {
    //             $statusLabel = 'Request';
    //         } elseif ($transaction->status_offline == 2) {
    //             $statusLabel = 'Proses';
    //         } elseif ($transaction->status_offline == 3) {
    //             $statusLabel = 'Payment Send';
    //         } elseif ($transaction->status_offline == 4) {
    //             $statusLabel = 'Paid';
    //         } elseif ($transaction->status_offline == 5) {
    //             $statusLabel = 'Polis Proses';
    //         } elseif ($transaction->status_offline == 6) {
    //             $statusLabel = 'Completed';
    //         }

    //         $sheet->setCellValue('A' . $row, $i++);
    //         $sheet->setCellValue('B' . $row, Carbon::parse($transaction->created_at)->format('d F Y') ?? "");
    //         $sheet->setCellValue('C' . $row, $transaction->transaction_id);
    //         $sheet->setCellValue('D' . $row, $transaction->product->name ?? "");
    //         $sheet->setCellValue('E' . $row, $transaction->user->name ?? "");
    //         $sheet->setCellValue('F' . $row, $transaction->nilai_premi ?? "");
    //         $sheet->setCellValue('G' . $row, $statusLabel ?? "");
    //         $sheet->setCellValue('H' . $row, Carbon::parse($transaction->updated_at)->format('d F Y') ?? "");
    //         $sheet->setCellValue('I' . $row, $transaction->no_polis ?? "");
    //         $sheet->setCellValue('J' . $row, Carbon::parse($transaction->jatuh_tempo)->format('d F Y') ?? "");

    //         $row++;
    //     }

    //     $tempFile = tempnam(sys_get_temp_dir(), 'excel');

    //     $writer = new Xlsx($spreadsheet);
    //     $writer->save($tempFile);

    //     $response = new BinaryFileResponse($tempFile);
    //     $response->setContentDisposition(
    //         ResponseHeaderBag::DISPOSITION_ATTACHMENT,
    //         'Transaksi Nasabah Affiliator Data' . '.xlsx'
    //     );

    //     $response->deleteFileAfterSend(true);

    //     return $response;
    // }

    public function affsales(Request $request)
    {
        $query = DB::table('users as u')
            ->leftJoin('online_transactions as ot', 'u.referal_code', '=', 'ot.referal_code_upline')
            ->select(
                'u.id as agent_id',
                'u.agent_code as agent_code',
                'u.name as agent_name'
            )
            ->selectRaw('SUM(CASE WHEN ot.status IN (3, 4, 5) THEN ot.nilai_premi ELSE 0 END) as total_sales_online')
            ->selectRaw('SUM(CASE WHEN ot.status_offline IN (4, 5, 6) THEN ot.nilai_premi ELSE 0 END) as total_sales_offline')
            ->where('u.roles', 2)
            ->orWhere('u.roles', 3)
            ->groupBy('u.id', 'u.name');

        if ($request->start_date && $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $query->selectRaw('SUM(CASE WHEN ot.status IN (3, 4, 5) AND ot.created_at BETWEEN ? AND ? THEN ot.nilai_premi ELSE 0 END) as total_sales_online', [$start_date, $end_date])
                ->selectRaw('SUM(CASE WHEN ot.status_offline IN (4, 5, 6) AND ot.created_at BETWEEN ? AND ? THEN ot.nilai_premi ELSE 0 END) as total_sales_offline', [$start_date, $end_date]);
        }

        $totalSales = $query->orderByRaw('(SUM(CASE WHEN ot.status IN (3, 4, 5) THEN ot.nilai_premi ELSE 0 END) + SUM(CASE WHEN ot.status_offline IN (4, 5, 6) THEN ot.nilai_premi ELSE 0 END)) DESC')
            ->get();

        return view('admin.pages.affliator.sales', compact('totalSales'));
    }

    public function affsalesExcel(Request $request)
    {
        $totalSales = DB::table('users as u')
            ->leftJoin('online_transactions as ot', 'u.referal_code', '=', 'ot.referal_code_upline')
            ->select(
                'u.id as agent_id',
                'u.agent_code as agent_code',
                'u.name as agent_name'
            )
            ->selectRaw('SUM(CASE WHEN ot.status IN (3, 4, 5) THEN ot.nilai_premi ELSE 0 END) as total_sales_online')
            ->selectRaw('SUM(CASE WHEN ot.status_offline IN (4, 5, 6) THEN ot.nilai_premi ELSE 0 END) as total_sales_offline')
            ->where('u.roles', 2)
            ->orWhere('u.roles', 3)
            ->groupBy('u.id', 'u.name');

        if ($request->query('start_date') != 'null' && $request->query('end_date') != 'null') {
            $start_date = Carbon::parse($request->query('start_date'))->subDay();
            $end_date = Carbon::parse($request->query('end_date'))->addDay();

            $totalSales->selectRaw('SUM(CASE WHEN ot.status IN (3, 4, 5) AND ot.created_at BETWEEN ? AND ? THEN ot.nilai_premi ELSE 0 END) as total_sales_online', [$start_date, $end_date])
                ->selectRaw('SUM(CASE WHEN ot.status_offline IN (4, 5, 6) AND ot.created_at BETWEEN ? AND ? THEN ot.nilai_premi ELSE 0 END) as total_sales_offline', [$start_date, $end_date]);
        }
        $dataTopSales = $totalSales->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'No',
            'Nama Agen',
            'Total Transaksi',
        ];

        $sheet->fromArray($headers, null, 'A1');

        $row = 2;
        $i = 1;
        foreach ($dataTopSales as $transaction) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $transaction->agent_name ?? "");
            $sheet->setCellValue('C' . $row, format_uang($transaction->total_sales_online + $transaction->total_sales_offline));

            $row++;
        }

        $tempFile = tempnam(sys_get_temp_dir(), 'excel');

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Affiliator Sales Data' . '.xlsx'
        );

        $response->deleteFileAfterSend(true);

        return $response;
    }

    // agent request
    public function agentRequest()
    {
        $data = User::where('roles', '3')->get();

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.agent.agent_request', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.agent.agent_request', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.agent.agent_request', compact('data'));
        } else {
            return back();
        }
    }

    public function approveAgentRequest($id)
    {
        $data = User::find($id);

        $data->roles = 0;
        $data->save();

        return redirect()->back();
    }

    public function rejectAgentRequest($id)
    {
        $data = User::find($id);

        $data->roles = 2;
        $data->save();

        return redirect()->back();
    }

    public function editagentrequest(Request $request, $id)
    {
        $data = User::find($id);
        return view('admin.pages.agent.agen_request_edit', compact('data'));
    }

    public function updateagentrequest(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'agent_code' => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['roles'] = 0;
        $data['referal_code_upline'] = 0;
        $data['agent_code'] = $request->agent_code;

        User::whereId($id)->update($data);
        return redirect()->route('dashboard.userdata.agent');
    }

    // agent
    public function agent()
    {
        $data = User::where('roles', '0')->get();

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.agent.index', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.agent.index', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.agent.index', compact('data'));
        } else {
            return back();
        }
    }

    public function createagent()
    {
        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.agent.create');
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.agent.create');
        } else {
            return back();
        }
    }

    public function storeagent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string', 'min:6'],
            'phone' => ['required', 'string', 'max:20'],
            'ktp' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'poscode' => ['string', 'max:255'],
            'dob' => ['required', 'string', 'max:10'],
            'agent_code' => ['required', 'string', 'max:255'],
            'npwp' => ['required', 'string', 'max:100'],
            'bank' => ['required', 'string', 'max:100'],
            'account_name' => ['required', 'string', 'max:100'],
            'account_number' => ['required', 'string', 'max:100'],
            'npwp_img' => ['required', 'image', 'mimes:png,jpg,svg', 'max:2048'],
            'ktp_img' => ['required', 'image', 'mimes:png,jpg,svg', 'max:2048'],
            'kk_img' => ['required', 'image', 'mimes:png,jpg,svg', 'max:2048'],
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        // dd($request->all());

        $data = [];

        foreach (['npwp_img', 'ktp_img', 'kk_img'] as $imageField) {
            $imageFile = $request->file($imageField);
            $imageExtension = $imageFile->extension();
            $imageName = date('ymdhis') . "_" . $imageField . "." . $imageExtension;
            $imageFile->move(public_path('img/mitra'), $imageName);
            $data[$imageField] = $imageName;
        }

        $data['agent_code'] = $request->agent_code;
        $data['name'] = $request->name;
        $data['ktp'] = $request->ktp;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['province'] = $request->province != null ? explode('-', $request->province)[1] : null;
        $data['city'] = $request->city != null ? explode('-', $request->city)[1] : null;
        $data['district'] = $request->district != null ? explode('-', $request->district)[1] : null;
        $data['poscode'] = $request->poscode;
        $data['dob'] = $request->dob;
        $data['npwp'] = $request->npwp;
        $data['bank'] = $request->bank;
        $data['account_name'] = $request->account_name;
        $data['account_number'] = $request->account_number;
        $data['target_id'] = 2;
        $data['roles'] = 0;
        $data['password'] = Hash::make($request->password);
        $data['is_active'] = '1';
        $data['referal_code'] = rand(100000, 999999);

        User::create($data);

        return redirect()->route('dashboard.userdata.agent');
    }

    public function datanasabahagent(Request $request, $id)
    {
        $referalCodeUpline = User::where('id', $id)->first(['referal_code']);
        $data = User::whereIn('roles', ['1', '2', '3'])->where('referal_code_upline', $referalCodeUpline->referal_code)->get();
        $getJumlahAllNasabahByAgentReferalCode = User::whereIn('roles', ['1', '2', '3'])->where('referal_code_upline', $referalCodeUpline->referal_code)->count();

        if ($request->query('start_date') && $request->query('start_date') != 'null' && $request->query('end_date') && $request->query('end_date') != 'null') {
            $start_date = Carbon::parse($request->query('start_date'))->subDay();
            $end_date = Carbon::parse($request->query('end_date'))->addDay();

            $getJumlahAllNasabahByAgentReferalCode = User::whereIn('roles', ['1', '2', '3'])->where('referal_code_upline', $referalCodeUpline->referal_code)->whereBetween('created_at', [$start_date, $end_date])->count();

            $data = User::whereIn('roles', ['1', '2', '3'])
                ->where('referal_code_upline', $referalCodeUpline->referal_code)
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }
        return view('admin.pages.agent.datanasabah', compact('data', 'getJumlahAllNasabahByAgentReferalCode', 'referalCodeUpline'));
    }

    public function datanasabahExcel(Request $request)
    {
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');
        $referalCodeUpline = $request->query('referalCodeUpline');

        $data = User::whereIn('roles', ['1', '2', '3'])
            ->where('referal_code_upline', $referalCodeUpline)
            ->get();

        if ($start_date && $start_date != "null" && $end_date && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $data = User::whereIn('roles', ['1', '2', '3'])
                ->where('referal_code_upline', $referalCodeUpline)
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }

        $statusLabel = '';

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'No',
            'Tanggal Register',
            'Nama',
            'Email',
            'Phone',
            'Level',
        ];

        $sheet->fromArray($headers, null, 'A1');

        $row = 2;
        $i = 1;
        foreach ($data as $d) {
            if ($d->roles == 0) {
                $statusLabel = 'Agent';
            } elseif ($d->roles == 1) {
                $statusLabel = 'Nasabah';
            } elseif ($d->roles == 2) {
                $statusLabel = 'Affiliator';
            } elseif ($d->roles == 3) {
                $statusLabel = 'Affiliator';
            }

            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, Carbon::parse($d->created_at)->format('d F Y') ?? "");
            $sheet->setCellValue('C' . $row, $d->name);
            $sheet->setCellValue('D' . $row, $d->email);
            $sheet->setCellValue('E' . $row, $d->phone);
            $sheet->setCellValue('F' . $row, $statusLabel ?? "");

            $row++;
        }

        $tempFile = tempnam(sys_get_temp_dir(), 'excel');

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Nasabah Data' . '.xlsx'
        );

        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function nasabahagent(Request $request, $id)
    {
        $referalCodeUpline = User::where('id', $id)->first(['referal_code']);
        $getJumlahAllNasabahByAgentReferalCode = User::whereIn('roles', ['1', '2', '3'])->where('referal_code_upline', $referalCodeUpline->referal_code)->count();

        $transactionByNasabahAgent = OnlineTransaction::with(['product', 'user'])
            ->where('referal_code_upline', $referalCodeUpline->referal_code)
            ->whereHas('user', function ($query) {
                $query->whereIn('roles', ['1', '2', '3']);
            })
            ->get();
        $sumTransactionByNasabahAgentOnline = OnlineTransaction::with(['product', 'user'])
            ->whereHas('user', function ($query) {
                $query->whereIn('roles', ['1', '2', '3']);
            })
            ->whereIn('status', ['3', '4', '5'])
            ->where('referal_code_upline', $referalCodeUpline->referal_code)
            ->sum('nilai_premi');
        $sumTransactionByNasabahAgentOffline = OnlineTransaction::with(['product', 'user'])
            ->whereHas('user', function ($query) {
                $query->whereIn('roles', ['1', '2', '3']);
            })
            ->whereIn('status_offline', ['4', '5', '6'])
            ->where('referal_code_upline', $referalCodeUpline->referal_code)
            ->sum('nilai_premi');

        if ($request->query('start_date') && $request->query('start_date') != 'null' && $request->query('end_date') && $request->query('end_date') != 'null') {
            $start_date = Carbon::parse($request->query('start_date'))->subDay();
            $end_date = Carbon::parse($request->query('end_date'))->addDay();

            $getJumlahAllNasabahByAgentReferalCode = User::whereIn('roles', ['1', '2', '3'])
                ->where('referal_code_upline', $referalCodeUpline->referal_code)
                ->whereBetween('created_at', [$start_date, $end_date])
                ->count();

            $transactionByNasabahAgent = OnlineTransaction::with(['product', 'user'])
                ->where('referal_code_upline', $referalCodeUpline->referal_code)
                ->whereHas('user', function ($query) {
                    $query->whereIn('roles', ['1', '2', '3']);
                })
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
            $sumTransactionByNasabahAgentOnline = OnlineTransaction::with(['product', 'user'])
                ->where('referal_code_upline', $referalCodeUpline->referal_code)
                ->whereHas('user', function ($query) {
                    $query->whereIn('roles', ['1', '2', '3']);
                })
                ->whereIn('status', ['3', '4', '5'])
                ->whereBetween('created_at', [$start_date, $end_date])
                ->sum('nilai_premi');
            $sumTransactionByNasabahAgentOffline = OnlineTransaction::with(['product', 'user'])
                ->where('referal_code_upline', $referalCodeUpline->referal_code)
                ->whereHas('user', function ($query) {
                    $query->whereIn('roles', ['1', '2', '3']);
                })
                ->whereIn('status_offline', ['4', '5', '6'])
                ->whereBetween('created_at', [$start_date, $end_date])
                ->sum('nilai_premi');
        }
        return view('admin.pages.agent.nasabah', compact('getJumlahAllNasabahByAgentReferalCode', 'sumTransactionByNasabahAgentOffline', 'sumTransactionByNasabahAgentOnline', 'transactionByNasabahAgent', 'referalCodeUpline'));
    }

    public function nasabahExcel(Request $request)
    {
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');
        $referalCodeUpline = $request->query('referalCodeUpline');

        $dataTransaksi = OnlineTransaction::with('user', 'product')
            ->where('referal_code_upline', $referalCodeUpline)
            ->whereHas('user', function ($query) {
                $query->whereIn('roles', ['1', '2', '3']);
            })
            ->get();

        if ($start_date && $start_date != "null" && $end_date && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $dataTransaksi = OnlineTransaction::with('user', 'product')
                ->where('referal_code_upline', $referalCodeUpline)
                ->whereHas('user', function ($query) {
                    $query->whereIn('roles', ['1', '2', '3']);
                })
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }

        $statusLabel = '';

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'No',
            'Tanggal Tansaksi',
            'ID Transaksi',
            'Nama Produk',
            'Nama Nasabah',
            'Nilai Premi',
            'Status',
            'Tanggal Polis',
            'No Polis',
            'Tanggal Jatuh Tempo',
        ];

        $sheet->fromArray($headers, null, 'A1');

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
            } elseif ($transaction->status_offline == 1) {
                $statusLabel = 'Request';
            } elseif ($transaction->status_offline == 2) {
                $statusLabel = 'Proses';
            } elseif ($transaction->status_offline == 3) {
                $statusLabel = 'Payment Send';
            } elseif ($transaction->status_offline == 4) {
                $statusLabel = 'Paid';
            } elseif ($transaction->status_offline == 5) {
                $statusLabel = 'Polis Proses';
            } elseif ($transaction->status_offline == 6) {
                $statusLabel = 'Completed';
            }

            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, Carbon::parse($transaction->created_at)->format('d F Y') ?? "");
            $sheet->setCellValue('C' . $row, $transaction->transaction_id);
            $sheet->setCellValue('D' . $row, $transaction->product->name ?? "");
            $sheet->setCellValue('E' . $row, $transaction->user->name ?? "");
            $sheet->setCellValue('F' . $row, $transaction->nilai_premi ?? "");
            $sheet->setCellValue('G' . $row, $statusLabel ?? "");
            $sheet->setCellValue('H' . $row, Carbon::parse($transaction->updated_at)->format('d F Y') ?? "");
            $sheet->setCellValue('I' . $row, $transaction->no_polis ?? "");
            $sheet->setCellValue('J' . $row, Carbon::parse($transaction->jatuh_tempo)->format('d F Y') ?? "");

            $row++;
        }

        $tempFile = tempnam(sys_get_temp_dir(), 'excel');

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Transaksi Nasabah Data' . '.xlsx'
        );

        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function agentsales(Request $request)
    {
        $query = DB::table('users as u')
            ->leftJoin('online_transactions as ot', 'u.referal_code', '=', 'ot.referal_code_upline')
            ->select(
                'u.id as agent_id',
                'u.agent_code as agent_code',
                'u.name as agent_name'
            )
            ->selectRaw('SUM(CASE WHEN ot.status IN (3, 4, 5) THEN ot.nilai_premi ELSE 0 END) as total_sales_online')
            ->selectRaw('SUM(CASE WHEN ot.status_offline IN (4, 5, 6) THEN ot.nilai_premi ELSE 0 END) as total_sales_offline')
            ->where('u.roles', 0)
            ->groupBy('u.id', 'u.name');

        if ($request->start_date && $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $query->selectRaw('SUM(CASE WHEN ot.status IN (3, 4, 5) AND ot.created_at BETWEEN ? AND ? THEN ot.nilai_premi ELSE 0 END) as total_sales_online', [$start_date, $end_date])
                ->selectRaw('SUM(CASE WHEN ot.status_offline IN (4, 5, 6) AND ot.created_at BETWEEN ? AND ? THEN ot.nilai_premi ELSE 0 END) as total_sales_offline', [$start_date, $end_date]);
        }

        $totalSales = $query->orderByRaw('(SUM(CASE WHEN ot.status IN (3, 4, 5) THEN ot.nilai_premi ELSE 0 END) + SUM(CASE WHEN ot.status_offline IN (4, 5, 6) THEN ot.nilai_premi ELSE 0 END)) DESC')
            ->get();

        return view('admin.pages.agent.sales', compact('totalSales'));
    }

    public function agentsalesExcel(Request $request)
    {
        $totalSales = DB::table('users as u')
            ->leftJoin('online_transactions as ot', 'u.referal_code', '=', 'ot.referal_code_upline')
            ->select(
                'u.id as agent_id',
                'u.agent_code as agent_code',
                'u.name as agent_name'
            )
            ->selectRaw('SUM(CASE WHEN ot.status IN (3, 4, 5) THEN ot.nilai_premi ELSE 0 END) as total_sales_online')
            ->selectRaw('SUM(CASE WHEN ot.status_offline IN (4, 5, 6) THEN ot.nilai_premi ELSE 0 END) as total_sales_offline')
            ->where('u.roles', 0)
            ->groupBy('u.id', 'u.name');

        if ($request->query('start_date') != 'null' && $request->query('end_date') != 'null') {
            $start_date = Carbon::parse($request->query('start_date'))->subDay();
            $end_date = Carbon::parse($request->query('end_date'))->addDay();

            $totalSales->selectRaw('SUM(CASE WHEN ot.status IN (3, 4, 5) AND ot.created_at BETWEEN ? AND ? THEN ot.nilai_premi ELSE 0 END) as total_sales_online', [$start_date, $end_date])
                ->selectRaw('SUM(CASE WHEN ot.status_offline IN (4, 5, 6) AND ot.created_at BETWEEN ? AND ? THEN ot.nilai_premi ELSE 0 END) as total_sales_offline', [$start_date, $end_date]);
        }
        $dataTopSales = $totalSales->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'No',
            'Kode Agen',
            'Nama Agen',
            'Total Transaksi',
        ];

        $sheet->fromArray($headers, null, 'A1');

        $row = 2;
        $i = 1;
        foreach ($dataTopSales as $transaction) {
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $transaction->agent_code ?? "");
            $sheet->setCellValue('C' . $row, $transaction->agent_name ?? "");
            $sheet->setCellValue('D' . $row, format_uang($transaction->total_sales_online + $transaction->total_sales_offline));

            $row++;
        }

        $tempFile = tempnam(sys_get_temp_dir(), 'excel');

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        $response = new BinaryFileResponse($tempFile);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Agent Sales Data' . '.xlsx'
        );

        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function editagent(Request $request, $id)
    {
        $tag = Target::all();
        $data = User::find($id);

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.agent.edit', compact('data', 'tag'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.agent.edit', compact('data', 'tag'));
        } else {
            return back();
        }
    }

    public function updateagent(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'agent_code' => ['required'],
            'is_active' => ['required'],
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['agent_code'] = $request->agent_code;
        $data['is_active'] = $request->is_active;

        User::whereId($id)->update($data);
        return redirect()->route('dashboard.userdata.agent');
    }

    public function destroyagent(Request $request, $id)
    {
        $data = User::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->route('dashboard.userdata.agent');
    }

    // Admin function
    public function admin()
    {
        $data = Admin::where('roles', '!=', '0')->get();

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.admin.index', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.admin.staff', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 2) {
            return view('admin.pages.admin.finance', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 3) {
            return view('admin.pages.admin.underwriting', compact('data'));
        } else {
            return back();
        }
    }

    public function createadmin()
    {
        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.admin.create');
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.admin.create');
        } else {
            return back();
        }
    }

    public function storeadmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'confirmed', 'min:4', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Z a-z \d]+$/'],
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);


        $DataUser = new DataUser();

        $DataUser['name'] = $request->input('name');
        $DataUser['email'] = $request->input('email');
        $DataUser['roles'] = '1';
        $DataUser['password'] = Hash::make($request->input('password'));

        $DataUser->save();

        return redirect()->route('dashboard.userdata.admin');
    }

    public function editadmin(Request $request, $id)
    {
        $data = Admin::find($id);

        if (Auth::guard('admin')->user()->roles == 0) {
            return view('admin.pages.admin.edit', compact('data'));
        } elseif (Auth::guard('admin')->user()->roles == 1) {
            return view('admin.pages.admin.edit', compact('data'));
        } else {
            return back();
        }
    }

    public function updateadmin(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'roles' => ['required', 'string', 'max:100'],
            'password' => ['nullable', 'string', 'min:4', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Z a-z \d]+$/'],
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['roles'] = $request->roles;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        Admin::whereId($id)->update($data);
        return redirect()->route('dashboard.userdata.admin');
    }
}
