<?php

namespace App\Http\Controllers;

use App\Models\districts;
use App\Models\poscode;
use App\Models\province;
use App\Models\regencies;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function provinces()
    {
        $provinces = province::orderBy('name_province', 'DESC')->get();
        return response()->json($provinces);
    }
    public function regencies($province_id)
    {
        $regencies = regencies::where('id_province', $province_id)->orderBy('name_regencies', 'DESC')->get();
        return response()->json($regencies);
    }
    public function districts($regency_id)
    {
        $districts = districts::where('id_regencies', $regency_id)->orderBy('name_districts', 'DESC')->get();
        return response()->json($districts);
    }
    public function postcode($kota)
    {
        $postcode = poscode::where('name_districts', $kota)->orderBy('poscode', 'DESC')->get();
        return response()->json($postcode);
    }
}
