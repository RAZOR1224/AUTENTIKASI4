<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        // Middleware 'guest' ensures that authenticated users cannot access login route
       $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        // Validating user input
      $input = $request->validate([
          'email' => 'required|email',
          'password' => 'required',
      ]);

        // Attempting authentication
          if (Auth::attempt($input)) {
          // Debugging: Check if user is authenticate
            // Redirecting based on user type
            switch (auth()->user()->type) {
                case 'admin':
                    return redirect()->route('admin.home');
                case 'manager':
                    return redirect()->route('manager.home');
                case 'superadmin':
                    return redirect()->route('superadmin.home');
                case 'dosen':
                    return redirect()->route('dosen.home');
                case 'mahasiswa':
                    return redirect()->route('mahasiswa.home');
                case 'tendik':
                    return redirect()->route('tendik.home');
                case 'adminakademik':
                    return redirect()->route('adminakademik.home');
                case 'adminkeuangan':
                    return redirect()->route('adminkeuangan.home');
                case 'direktur':
                    return redirect()->route('direktur.home');
                case 'wakildirektur1':
                    return redirect()->route('wakildirektur1.home');
                case 'wakildirektur2':
                    return redirect()->route('wakildirektur2.home');
                case 'wakildirektur3':
                    return redirect()->route('wakildirektur3.home');
                case 'adminlppm':
                    return redirect()->route('adminlppm.home');
                case 'adminsdm':
                    return redirect()->route('adminsdm.home');
                default:
                    return redirect()->route('home');
            }
        } else {
            // Redirecting back to login with error message
            return redirect()->route('login')->with('error', 'Email-Address and Password Are Wrong.');
        }

        
      }

    }
