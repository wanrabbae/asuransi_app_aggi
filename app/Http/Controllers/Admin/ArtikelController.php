<?php

namespace App\Http\Controllers\Admin;

use App\Models\Artikel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoryArtikel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ArtikelController extends Controller
{
    public function index()
    {
        $data = Artikel::get();
        return view('admin.pages.artikel.index',compact('data'));
    }

    public function create()
    {
        $cat = CategoryArtikel::all();

        return view('admin.pages.artikel.create', compact('cat'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => ['required', 'string', 'max:255'],
            'artikel_img' => ['required', 'image', 'mimes:png,jpg,svg', 'max:2048'],
            'category_id' => ['required', 'integer'],
            'description' => ['required', 'string'],
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $artikel_img           = $request->file('artikel_img');
        $artikel_img_ekstensi  = $artikel_img->extension();
        $artikel_img_nama      = date('ymdhis') ."." .$artikel_img_ekstensi;
        $artikel_img->move(public_path('img/artikel'), $artikel_img_nama);      
        
        $data = [
            'artikel_img' => $artikel_img_nama
        ];

        $data['title'] = $request->title;
        $data['slug'] = Str::slug($request->title);
        $data['category_id'] = $request->category_id;
        $data['description'] = $request->description;
        
        Artikel::create($data);

        return redirect()->route('dashboard.artikeldata.index');
    }

    public function edit(string $id)
    {
        $cat = CategoryArtikel::all();
        $data = Artikel::find($id);
        return view('admin.pages.artikel.edit', compact('data', 'cat'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => ['required', 'string', 'max:255'],
            'artikel_img' => ['nullable','mimes:png,jpg,jpeg,svg', 'max:2048'],
            'category_id' => ['required', 'integer'],
            'description' => ['required', 'string'],        
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        if (request()->hasFile('artikel_img')){
            $artikel_img           = $request->file('artikel_img');
            $artikel_img_ekstensi  = $artikel_img->extension();
            $artikel_img_nama      = date('ymdhis') ."." .$artikel_img_ekstensi;
            $artikel_img->move(public_path('img/artikel'), $artikel_img_nama);
            
            $data_artikel_img      = Artikel::where('id', $id)->first(); 
            File::delete(public_path('img/artikel'). '/' . $data_artikel_img->artikel_img);

            $data = [
                'artikel_img' => $artikel_img_nama
            ];
        }

        $data['title'] = $request->title;
        $data['slug'] = Str::slug($request->title);
        $data['category_id'] = $request->category_id;
        $data['description'] = $request->description;

        Artikel::whereId($id)->update($data);

        return redirect()->route('dashboard.artikeldata.index');
    }

    public function destroy(string $id)
    {
        $data = Artikel::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->route('dashboard.artikeldata.index');
    }
}
