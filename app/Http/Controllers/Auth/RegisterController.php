<?php

namespace App\Http\Controllers\Auth;

use App\Http\Middleware\Role;
use App\Models\Admin\Country\Country;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Auth Controller
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
    protected $redirectTo = 'home_page';

    /*public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }*/
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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'first_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'last_name' => ['string', 'max:255','nullable'],
          // 'country_id' => ['required'],
            'phone_number' => ['max:255'],
           // 'gender' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //$role = \App\Models\User\Role::where('name', 'Role_User')->first();
        $user = User::create([
            // 'name' => $data['name'],
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'user_name' => $data['user_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'country_id' => $data['country_id'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
        ]);
        $user->role_id = 8;
        $user->save();
        return $user;

    }


}
