<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OnlineProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DataOnlineProductController extends Controller
{
    public function index()
    {
        $data = OnlineProduct::where('type_product', '0')->get();

        return view('admin.pages.onlineproduct.index',compact('data'));
    }

    public function create()
    {
        return view('admin.pages.onlineproduct.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'unique:online_products,name', 'string', 'max:255'],
            'icon' => ['required', 'image', 'mimes:png,jpg,svg', 'max:2048'],
            'price_show' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'string'],
            'min_price' => ['required', 'integer'],
            'max_price' => ['required', 'integer'],
            'description' => ['required'],
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $icon           = $request->file('icon');
        $icon_ekstensi  = $icon->extension();
        $icon_nama      = date('ymdhis') ."." .$icon_ekstensi;
        $icon->move(public_path('img/landing'), $icon_nama);

        $data['name'] = $request->name;
        $data['type_product'] = 0;
        $data['status_product'] = 2;
        $data['icon'] = $request->icon;
        $data['price_show'] = $request->price_show;
        $data['rate'] = $request->rate;
        $data['min_price'] = $request->min_price;
        $data['max_price'] = $request->max_price;
        $data['description'] = $request->description;
        $data['slug'] = Str::slug($request->name);
        
        OnlineProduct::create($data);

        return redirect()->route('dashboard.onlineproductdata.index');
    }

    public function edit(string $id)
    {
        $data = OnlineProduct::find($id);
        return view('admin.pages.onlineproduct.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'status_product' => ['required', 'integer'],
            'icon' => ['nullable','mimes:png,jpg,jpeg,svg', 'max:2048'],
            'price_show' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'string'],
            'komisi' => ['required', 'string'],
            'min_price' => ['required', 'integer'],
            'max_price' => ['required', 'integer'],
            'description' => ['required'],
            'claim_file' => ['nullable', 'mimes:pdf', 'max:10000'],
            'images_landing' => ['nullable','mimes:png,jpg,jpeg,svg', 'max:2048'],
            'title_landing' => ['required', 'string', 'max:255'],
            'desc_landing' => ['required'],
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        if (request()->hasFile('claim_file')) {
            $claim_file           = $request->file('claim_file');
            $claim_file_ekstensi  = $claim_file->extension();
            $claim_file_nama      = date('ymdhis') . "." . $claim_file_ekstensi;
            $claim_file->move(public_path('img/pdf'), $claim_file_nama);

            $data_claim_file      = OnlineProduct::where('id', $id)->first();
            File::delete(public_path('img/pdf') . '/' . $data_claim_file->claim_file);

            $data = [
                'claim_file' => $claim_file_nama
            ];
        }

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

        if (request()->hasFile('images_landing')){
            $images_landing           = $request->file('images_landing');
            $images_landing_ekstensi  = $images_landing->extension();
            $images_landing_nama      = date('ymdhis') ."." .$images_landing_ekstensi;
            $images_landing->move(public_path('img/landing'), $images_landing_nama);
            
            $data_images_landing      = OnlineProduct::where('id', $id)->first(); 
            File::delete(public_path('img/landing'). '/' . $data_images_landing->images_landing);

            $data = [
                'images_landing' => $images_landing_nama
            ];
        }

        $data['name'] = $request->name;
        $data['status_product'] = $request->status_product;
        $data['price_show'] = $request->price_show;
        $data['rate'] = $request->rate;
        $data['komisi'] = $request->komisi;
        $data['min_price'] = $request->min_price;
        $data['max_price'] = $request->max_price;
        $data['description'] = $request->description;
        $data['slug'] = Str::slug($request->name);
        $data['title_landing'] = $request->title_landing;
        $data['desc_landing'] = $request->desc_landing;

        OnlineProduct::whereId($id)->update($data);

        return redirect()->route('dashboard.onlineproductdata.index');
    }
}
