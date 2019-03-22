<?php

namespace App\Http\Controllers\Auth;

use App\Info;
use App\Member;
use App\Notifications\Rh\CreateUserNotification;
use App\Premium;
use App\Rules\PasswordRule;
use App\Rules\PhoneRule;
use App\Rules\SexRule;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
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
    protected $redirectTo = '/';


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
            'face'          => 'nullable|mimes:jpg,png,jpeg,gif',
            'name'          => 'bail|required|string|min:3|max:20|unique:users,login',
            'token'         => 'bail|required|exists:tokens,token',
            'email'         => 'bail|required|string|email|unique:users,email',
            'tel'           => ['bail','required','min:10','max:10', new PhoneRule()],
            'password'      => ['bail', 'required', 'min:6', 'max:16', 'confirmed', new PasswordRule()],
            'last_name'     => ['bail', 'required', 'string', 'min:3', 'max:255'],
            'first_name'    => ['bail', 'required', 'string', 'min:3', 'max:255'],
            'sex'           => ['bail', 'required', 'string', 'min:5', 'max:5', new SexRule()],
            'birth'         => ['bail', 'required', 'date', 'before:' . date('d-m-Y',strtotime("-18 years"))],
            'address'       => 'bail|required|min:10,max:255',
            'city'          => 'bail|required|int|exists:cities,id',
            'cin'           => 'nullable|string|min:6'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $member = new Member();
        return $member->onCreate(new User(),new Info(),new Premium(),$data);
    }

    protected function registered(Request $request,User $user)
    {
        Notification::send($user->colleagues(), new CreateUserNotification($user));
        return redirect()->route('member.show',['member' => $user->member]);
    }


}
