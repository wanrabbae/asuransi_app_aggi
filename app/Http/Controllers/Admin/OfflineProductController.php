<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OnlineProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class OfflineProductController extends Controller
{
    public function index()
    {
        $data = OnlineProduct::where('type_product', '1')->get();

        return view('admin.pages.offlineproduct.index',compact('data'));
    }
    public function create()
    {
        return view('admin.pages.offlineproduct.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'image', 'mimes:png,jpg,svg', 'max:2048'],
            'description' => ['required'],
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $icon           = $request->file('icon');
        $icon_ekstensi  = $icon->extension();
        $icon_nama      = date('ymdhis') ."." .$icon_ekstensi;
        $icon->move(public_path('img/landing'), $icon_nama);

        $data = [
            'icon' => $icon_nama
        ];

        $data['name'] = $request->name;
        $data['type_product'] = 1;
        $data['status_product'] = 2;
        $data['description'] = $request->description;
        $data['slug'] = Str::slug($request->name);
        
        OnlineProduct::create($data);

        return redirect()->route('dashboard.offlineproductdata.index');
    }

    public function edit(string $id)
    {
        $data = OnlineProduct::find($id);
        return view('admin.pages.offlineproduct.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable','mimes:png,jpg,jpeg,svg', 'max:2048'],
            'komisi' => ['required', 'string'],
            'status_product' => ['required'],            
            'description' => ['required'],
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        if (request()->hasFile('icon')){
            $icon           = $request->file('icon');
            $icon_ekstensi  = $icon->extension();
            $icon_nama      = date('ymdhis') ."." .$icon_ekstensi;
            $icon->move(public_path('img/landing'), $icon_nama);
            
            $data_icon      = OnlineProduct::where('id', $id)->first(); 
            File::delete(public_path('img/landing'). '/' . $data_icon->icon);

            $data = [
                'icon' => $icon_nama
            ];
        }

        $data['name'] = $request->name;  
        $data['status_product'] = $request->status_product;
        $data['komisi'] = $request->komisi;
        $data['description'] = $request->description;
        $data['slug'] = Str::slug($request->name);

        OnlineProduct::whereId($id)->update($data);

        return redirect()->route('dashboard.offlineproductdata.index');
    }
}
