<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RegisterController extends Controller{

    public function register(Request $request){
        $username = $request -> input('username');
        $email = $request -> input('email');
        // $phone = $request -> input('phone');
        // $cin = $request -> input('cin');
        // $age = $request -> input('age');
        // $genre = $request -> input('genre');
        $password = $request -> input('password');
        $password_confirmation = $request -> input('password_confirmation');
        if($password !== $password_confirmation){
            return redirect() -> back() -> withInput() -> with('error','Password and Password Confirmation do not match');
        }

        DB::table('users')->insert([
        'username'=> $username,
        'email' => $email,
        // 'phone' => $phone,
        // 'cin' => $cin,
        // 'age' => $age,
        // 'genre' => $genre,
        'password' => bcrypt($password),
        ]);
        return redirect() ->route('login')-> with('success','Resgistration succesful! please log in');
    }
}
