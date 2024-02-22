<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IpaymuSettingController extends Controller
{
    public function setEnvironmentValues($envKey, $envValue, $envKey2, $envValue2, $envKey3, $envValue3, $envKey4, $envValue4)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $str .= "\n"; // In case the searched variable is in the last line without \n
        $keyPosition = strpos($str, "{$envKey}=");
        $keyPosition2 = strpos($str, "{$envKey2}=");
        $keyPosition3 = strpos($str, "{$envKey3}=");
        $keyPosition4 = strpos($str, "{$envKey4}=");
        $endOfLinePosition = strpos($str, PHP_EOL, $keyPosition);
        $endOfLinePosition2 = strpos($str, PHP_EOL, $keyPosition2);
        $endOfLinePosition3 = strpos($str, PHP_EOL, $keyPosition3);
        $endOfLinePosition4 = strpos($str, PHP_EOL, $keyPosition4);
        $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
        $oldLine2 = substr($str, $keyPosition2, $endOfLinePosition2 - $keyPosition2);
        $oldLine3 = substr($str, $keyPosition3, $endOfLinePosition3 - $keyPosition3);
        $oldLine4 = substr($str, $keyPosition4, $endOfLinePosition4 - $keyPosition4);
        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
        $str = str_replace($oldLine2, "{$envKey2}={$envValue2}", $str);
        $str = str_replace($oldLine3, "{$envKey3}={$envValue3}", $str);
        $str = str_replace($oldLine4, "{$envKey4}={$envValue4}", $str);
        $str = substr($str, 0, -1);

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'ipaymu_key' => env('IPAYMU_KEY'),
            'ipaymu_va' => env('IPAYMU_VA'),
            'ipaymu_url' => env('IPAYMU_URL'),
            'ipaymu_callback' => env('IPAYMU_CALLBACK_URL'),
        ];

        return view('admin.pages.ipaymu.index', compact('data'));
    }

    public function store(Request $request)
    {
        $this->setEnvironmentValues('IPAYMU_KEY', $request->apikey, 'IPAYMU_VA', $request->vaNumber, 'IPAYMU_URL', $request->ipaymu_url, 'IPAYMU_CALLBACK_URL', $request->ipaymu_callback_url);
        return redirect()->back()->with('success', 'Berhasil menyimpan pengaturan iPaymu');
    }
    
}
