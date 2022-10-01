<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginValidation;
use App\Http\Requests\RegisterValidation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    /**
     * форма авторизации
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function login()
    {
        return view('users.login');
    }

    /**
     * получение данных с формы авторизации через post
     * @param loginValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function loginPost(loginValidation $request)
    {
        if(Auth::attempt($request->validated())){
            $request->session()->regenerate();
            return back()->with(['success'=>'true']);
        }
        return back()->withErrors(['auth'=>'Логин или пароль не верный']);
    }

    /**
     * форма регистрации
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function register()
    {
        return view('users.register');
    }

    /**
     * получение данных с формы регистрации через post
     * @param RegisterValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function registerPost(RegisterValidation $request)
    {
        $requests=$request->validated();
        $requests['password']=Hash::make($requests['password']);
        User::create($requests);
        return redirect()->route('login')->with(['register'=>true]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('login');
    }
}
