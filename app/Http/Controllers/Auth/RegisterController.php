<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\OrganizerProfile;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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
    protected function redirectTo()
    {
        if (auth()->user()->role == 'organisateur') {
            return '/organizer/dashboard';
        }
        
        return '/participant/dashboard';
    }

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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'string', 'in:participant,organisateur'],
        ];
        
        if (isset($data['role']) && $data['role'] == 'organisateur') {
            $rules['organization_name'] = ['required', 'string', 'max:255'];
            $rules['organization_type'] = ['required', 'string', 'max:255'];
            $rules['organization_description'] = ['nullable', 'string'];
        }
        
        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
        
        if ($data['role'] == 'organisateur') {
            OrganizerProfile::create([
                'user_id' => $user->id,
                'organization_name' => $data['organization_name'],
                'organization_type' => $data['organization_type'],
                'organization_description' => $data['organization_description'] ?? null,
            ]);
        }
        
        return $user;
    }
    
    /**
     * Override the registration method to handle custom fields
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        
        event(new Registered($user = $this->create($request->all())));
        
        $this->guard()->login($user);
        
        return $this->registered($request, $user)
                        ?: redirect($this->redirectTo());
    }
}
