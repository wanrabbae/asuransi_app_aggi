<?php

namespace App\Http\Controllers\Admin;

use App\Models\Target;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TargetSetting extends Controller
{
    public function index()
    {
        $data = Target::get();
        return view('admin.pages.target.index',compact('data'));
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'target_1' => ['required', 'string', 'max:255'],
            'percentage_1' => ['required', 'string', 'max:255'],
            'target_2' => ['required', 'string', 'max:255'],
            'percentage_2' => ['required', 'string', 'max:255'],
            'target_3' => ['required', 'string', 'max:255'],
            'percentage_3' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['name'] = $request->name;
        $data['target_1'] = $request->target_1;
        $data['percentage_1'] = $request->percentage_1;
        $data['target_2'] = $request->target_2;
        $data['percentage_2'] = $request->percentage_2;
        $data['target_3'] = $request->target_3;
        $data['percentage_3'] = $request->percentage_3;

        Target::create($data);
        return redirect()->route('dashboard.targetdata.index');
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'target_1' => ['required', 'string', 'max:255'],
            'percentage_1' => ['required', 'string', 'max:255'],
            'target_2' => ['required', 'string', 'max:255'],
            'percentage_2' => ['required', 'string', 'max:255'],
            'target_3' => ['required', 'string', 'max:255'],
            'percentage_3' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        
        $data['name'] = $request->name;
        $data['target_1'] = $request->target_1;
        $data['percentage_1'] = $request->percentage_1;
        $data['target_2'] = $request->target_2;
        $data['percentage_2'] = $request->percentage_2;
        $data['target_3'] = $request->target_3;
        $data['percentage_3'] = $request->percentage_3;

        Target::whereId($id)->update($data);
        return redirect()->route('dashboard.targetdata.index');
    }
}
