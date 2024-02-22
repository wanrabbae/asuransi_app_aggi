<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExpenseController extends Controller
{
    public function index()
    {
        $data = Expense::get();
        $countData = $data->sum('amount');
        $countDataFilter = 0;
        return view('admin.pages.expense.index',compact('data', 'countData', 'countDataFilter'));
    }

    public function expenseFilter(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->subDay();
        $end_date = Carbon::parse($request->end_date)->addDay();

        $data = Expense::whereBetween('created_at', [$start_date, $end_date])->get();

        $countData = Expense::sum('amount');

        $countDataFilter = Expense::whereBetween('created_at', [$start_date, $end_date])
            ->sum('amount');

        return view('admin.pages.expense.index', compact('data', 'countData', 'countDataFilter'));
    }

    public function create()
    {
        return view('admin.pages.expense.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nota_number' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'string'],
            'description' => ['required', 'string'],
            'pic' => ['required', 'string', 'max:255'],
            'img' => ['required', 'image', 'mimes:png,jpg,svg', 'max:2048'],
            'date' => ['required', 'date'],
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);        

        $img           = $request->file('img');
        $img_ekstensi  = $img->extension();
        $img_nama      = date('ymdhis') ."." .$img_ekstensi;
        $img->move(public_path('img/landing'), $img_nama);

        $data['nota_number'] = $request->nota_number;
        $data['name'] = $request->name;
        $data['amount'] = $request->amount;
        $data['description'] = $request->description;
        $data['pic'] = $request->pic;
        $data['img'] = $request->img;
        $data['date'] = $request->date;
        
        Expense::create($data);

        return redirect()->route('dashboard.expensedata.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = Expense::find($id);
        return view('admin.pages.expense.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'nota_number' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'string'],
            'description' => ['required', 'string'],
            'pic' => ['required', 'string', 'max:255'],
            // 'img' => ['required', 'image', 'mimes:png,jpg,svg', 'max:2048'],
            'date' => ['required', 'date'],
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        // dd($request->all());

        if (request()->hasFile('img')){
            $foto_file      = $request->file('img');
            $foto_ekstensi  = $foto_file->extension();
            $foto_nama      = date('ymdhis') ."." .$foto_ekstensi;
            $foto_file->move(public_path('img/landing'), $foto_nama);
            
            $data_foto      = Expense::where('id', $id)->first(); 
            File::delete(public_path('img/landing'). '/' . $data_foto->img);

            $data = [
                'img' => $foto_nama
            ];
        }

        $data['nota_number'] = $request->nota_number;
        $data['name'] = $request->name;
        $data['amount'] = $request->amount;
        $data['description'] = $request->description;
        $data['pic'] = $request->pic;
        $data['date'] = $request->date;

        Expense::whereId($id)->update($data);

        return redirect()->route('dashboard.expensedata.index');
    }

    public function expenseExcel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $data = Expense::get();

        if ($start_date != "null" && $end_date != "null") {
            $start_date = Carbon::parse($request->start_date)->subDay();
            $end_date = Carbon::parse($request->end_date)->addDay();

            $data = Expense::whereBetween('created_at', [$start_date, $end_date])->get();
        }


        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set table headers
        $headers = [
            'No',
            'No Nota',
            'Name',
            'Jumlah',
            'PIC',
            'Tanggal Nota',
            'Penjelasan',
        ];

        $sheet->fromArray($headers, null, 'A1');

        // Set data rows
        $row = 2;
        $i = 1;
        foreach ($data as $item) {

            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $item->nota_number	 ?? "");
            $sheet->setCellValue('C' . $row, $item->name);
            $sheet->setCellValue('D' . $row, $item->amount ?? "");
            $sheet->setCellValue('E' . $row, $item->pic);
            $sheet->setCellValue('F' . $row, Carbon::parse($item->date)->format('d F Y') ?? "");
            $sheet->setCellValue('G' . $row, $item->description);

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
            'Other Expense Data' . '.xlsx'
        );

        // Delete the temporary file after the response is sent
        $response->deleteFileAfterSend(true);

        return $response;
    }

   
    public function destroy(string $id)
    {
        //
    }
}
