<?php

namespace App\Http\Controllers;

use App\Mail\PaymentFirstInsuranceSuccess;
use App\Models\Artikel;
use App\Models\Faq;
use App\Models\Landing;
use Illuminate\Http\Request;
use App\Models\OnlineProduct;
use App\Models\Popup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $landing            = DB::table('landings')->first();
        $onlineproduct      = OnlineProduct::where('type_product', '0')->where('status_product', '1')->get();
        $offlineproduct     = OnlineProduct::where('type_product', '1')->where('status_product', '1')->get();
        $faq                = Faq::get();
        $artikel            = Artikel::get();
        $popup01            = Popup::where('id', '1')->get();

        $data = array(
            'landing'           => $landing,
            'onlineproduct'     => $onlineproduct,
            'offlineproduct'    => $offlineproduct,
            'faq'               => $faq,
            'artikel'           => $artikel,
            'popup01'           => $popup01,

        );

        return view('landing.home', $data);
    }

    public function onlinedetails(Request $request, $slug)
    {
        $landing   = DB::table('landings')->first();
        $onlineproduct = OnlineProduct::where('slug', $slug)->firstOrFail();
        $referal_code = $request->query('referalCode') ?? null;
        $data = array(
            'landing'           => $landing,
            'onlineproduct'     => $onlineproduct,
            'referal_code'      => $referal_code,
        );

        return view('landing.onlinedetails', $data);
    }

    public function offlinedetails(Request $request, $slug)
    {
        $landing        = DB::table('landings')->first();
        $offlineproduct = OnlineProduct::where('slug', $slug)->firstOrFail();
        $referal_code   = $request->query('referalCode') ?? null;
        $products = OnlineProduct::where('type_product', '1')->where('status_product', '1')->get(['id', 'name']);
        $data = array(
            'landing'           => $landing,
            'offlineproduct'    => $offlineproduct,
            'referal_code'      => $referal_code,
            'products'          => $products,
        );

        return view('landing.offlinedetails', $data);
    }

    public function pageerror()
    {
        return view('landing.error');
    }

    public function kawanaggi()
    {
        $landing   = DB::table('landings')->first();

        $data = array(
            'landing'           => $landing,
        );

        return view('landing.kawanaggi', $data);
    }

    public function aturanpengguna()
    {
        $landing   = DB::table('landings')->first();

        $data = array(
            'landing'           => $landing,
        );

        return view('landing.aturanpengguna', $data);
    }

    public function kebijakanprivasi()
    {
        $landing   = DB::table('landings')->first();

        $data = array(
            'landing'           => $landing,
        );

        return view('landing.kebijakanprivasi', $data);
    }

    public function faqs()
    {
        $landing   = DB::table('landings')->first();
        $faqs = Faq::get();

        $data = array(
            'landing'        => $landing,
            'faqs'           => $faqs,
        );

        return view('landing.faq', $data);
    }

    public function klaim()
    {
        $landing   = DB::table('landings')->first();
        $products = OnlineProduct::where('status_product', '1')->get(['id', 'name']);

        $data = array(
            'landing'        => $landing,
            'products'        => $products,
        );

        return view('landing.klaim', $data);
    }

    public function Artikel()
    {
        $landing   = DB::table('landings')->first();
        $artikel   = Artikel::orderBy('created_at', 'DESC')->get();

        $data = array(
            'landing'        => $landing,
            'artikel'        => $artikel,
        );

        return view('landing.artikel', $data);
    }

    public function Read(Request $request, $slug)
    {
        $landing        = DB::table('landings')->first();
        $artikel        = Artikel::where('slug', $slug)->firstOrFail();
        $readartikel   = Artikel::get();
        $data = array(
            'landing'           => $landing,
            'artikel'           => $artikel,
            'readartikel'       => $readartikel,
        );

        return view('landing.read', $data);
    }

    public function claimDownload(Request $request)
    {
        $product = OnlineProduct::where('status_product', '1')->findOrFail($request->id);

        if ($product->claim_file != null) {
            return response()->download(public_path('/img/pdf/' . $product->claim_file));
        } else {
            return redirect()->back()->with('error', 'Form claim belum tersedia');
        }
    }
}
