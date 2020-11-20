<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;



class UserController extends Controller
{
    use PasswordValidationRules;

    public function index()
    {
        return view('admin.users.index', ['users' => User::all()]);
    }


    public function create()
    {
        return view('admin.users.create', ['roles' => Role::all()]);
    }


    public function store(Request $request)
    {
        $input = $request->except('_token');
        Validator::make($input, [
            'login' => ['required', 'string', 'max:25'],
            'name' => ['required', 'string', 'max:25'],
            'second_name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();


        DB::transaction(function () use ($input) {
            User::create([
                'login' => $input['login'],
                'name' => $input['name'],
                'second_name' => $input['second_name'],
                'email' => $input['email'],
                'birthday' => $input['birthday'],
                'password' => Hash::make($input['password']),
            ]);
        });

        return redirect('/admin/users')->with('status', 'The User was created');
    }


    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user, 'roles' => Role::all()]);
    }


    public function update(Request $request, User $user)
    {
        $input = $request->except('_token');

        if (!$input['password'] && !$input['password_confirmation']){
             $input['password'] = $user->password;
        } else {
            Validator::make($input, [
                'password' => $this->passwordRules(),
            ])->validate();
        }
        Validator::make($input, [
            'login' => ['required', 'string', 'max:25'],
            'name' => ['required', 'string', 'max:25'],
            'second_name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ])->validate();

        $user->fill($input);

        if ($user->update()) {
            return redirect('/admin/users')->with('status', 'The User was updated');
        } else {
            return redirect('/admin/users/edit/'.$user)->withErrors('The User wasn\'t updated');
        }
    }


    public function destroy(User $user)
    {
        if (auth()->user()->role_id == User::ADMIN) {
            if($user){
                if($user->delete()){
                    return redirect('/admin/users')->with('status', 'The User was deleted');
                }
                return redirect('/admin/users')->withErrors('The User wasn\'t deleted');
            }
            return redirect('/admin/users')->withErrors('The User isn\'t exist');
        }
        return redirect('/admin/users')->withErrors('You can\'t delete users');
    }
}
