<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $maxAttempts = 5; // Default is 5
    protected $decayMinutes = 1; // Default is 1

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return ['email' => $request->{$this->username()}, 'password' => $request->password, 'is_active' => '1'];
    }

    public function loginView()
    {
        return view('auth.login_user');
    }

    // for login in product detail
    public function loginUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (auth()->attempt($this->credentials($request))) {
            $request->session()->regenerate();
            if ($request->payment_link != null) {
                return redirect()->to($request->payment_link);
            } else {
                redirect()->route('dashboard.user');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->with('payment_link', $request->payment_link);
    }

    public function registerView(Request $request)
    {
        $referalCode = $request->query('referalCode') ?? null;
        // dd($referalCode);
        return view('auth.register', compact('referalCode'));
    }

    public function registerUser(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:4|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Z a-z \d]+$/',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['referal_code'] = rand(100000, 999999);
        $data['referal_code_upline'] = $request->referalCode ?? null;

        User::create($data);

        return redirect()->back()->with('success', 'Register Success');
    }

    public function registerFromPage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email',
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['ktp'] = $request->ktp;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['province'] = $request->province != null ? explode('-', $request->province)[1] : null;
        $data['city'] = $request->city != null ? explode('-', $request->city)[1] : null;
        $data['district'] = $request->district != null ? explode('-', $request->district)[1] : null;
        $data['poscode'] = $request->poscode;
        $data['dob'] = $request->dob;
        $data['password'] = bcrypt($request->password);
        $data['referal_code'] = rand(100000, 999999);
        $data['referal_code_upline'] = $request->referalCode ?? null;
        $data['target_id'] = 1;

        User::create($data);
        return redirect()->route('dashboard.user')->with('success', 'Register Success');
    }
}
