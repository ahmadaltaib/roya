<?php

namespace App\Http\Controllers\Auth;

use App\Models\User,
    App\Http\Controllers\Controller,
    Illuminate\Support\Facades\Hash,
    Illuminate\Support\Facades\Validator,
    Illuminate\Foundation\Auth\RegistersUsers,
    Illuminate\Support\Facades\Input;

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
    protected $redirectTo = '/';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'avatar' => 'image|mimes:jpg,png',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data){

        $sAvatar = 'avatar.jpg';
        if (Input::file('avatar')->isValid()) {
            $sDestinationPath = public_path('uploads/avatars');
            $sExtension = Input::file('avatar')->getClientOriginalExtension();
            $sAvatar = uniqid().'.'.$sExtension;

            Input::file('avatar')->move($sDestinationPath, $sAvatar);
        }

        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'type'     => User::DEFAULT_TYPE,
            'avatar'   => $sAvatar
        ]);
    }
}
