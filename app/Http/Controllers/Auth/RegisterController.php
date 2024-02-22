<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'ktp' => $data['ktp'],
            'npwp' => $data['npwp'],         
            'bank' => $data['bank'],         
            'account_name' => $data['account_name'],         
            'account_number' => $data['account_number'],
            'phone' => $data['phone'],         
            'address' => $data['address'],    
            'province' => $data['province'] != null ? explode('-', $data['province'])[1] : null,
            'city' => $data['city'] != null ? explode('-', $data['city'])[1] : null,
            'district' => $data['district'] != null ? explode('-', $data['district'])[1] : null,
            'poscode' => $data['poscode'],
            'dob' => $data['dob'],         
            'password' => Hash::make($data['password']),
            'referal_code' => rand(100000, 999999),
            'referal_code_upline' => null,
            'target_id' => 1,
            'roles' => 2
        ]);
        
    }
}
