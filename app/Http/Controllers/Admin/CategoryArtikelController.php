<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoryArtikel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryArtikelController extends Controller
{
    public function index()
    {
        $data = CategoryArtikel::get();

        return view('admin.pages.categoryartikel.index',compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        
        CategoryArtikel::create($data);

        return redirect()->route('dashboard.categoryartikeldata.index');
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);

        CategoryArtikel::whereId($id)->update($data);
        return redirect()->route('dashboard.categoryartikeldata.index');
    }

    public function destroy(string $id)
    {
        $data = CategoryArtikel::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->route('dashboard.categoryartikeldata.index');
    }
}
