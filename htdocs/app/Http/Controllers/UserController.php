<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\DepartementUser;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function yourMethod()
{
    $user = User::find(auth()->id()); // Ou récupérez l'utilisateur connecté
    Session::put('username', $user->name); // Facultatif, si vous souhaitez aussi mettre à jour la session

    return view('layout', compact('user'));
}
    public function index()
    {
        $users = User::all();
        return view('user', ['users' => $users]);
    }
    public function adduser(){
        $departments = DepartementUser::all();

        // Pass the departments to the view
        return view('adduser', compact('departments'));
        // return view('adduser');

    }
    public function edituser($id){
        $user = User::find($id);
    if (!$user) {
        return redirect()->route('User')->with('error', 'User not found');
    }
        $departments = DepartementUser::all();
    return view('edituser', compact('user', 'departments'), ['id'=> $id]);
        // return view('edituser', ['id'=> $id]);
    }
    public function createuser(Request $request){
        $username = $request -> input('username');
        $email = $request -> input('email');
        $phone = $request -> input('phone');
        $cin = $request -> input('cin');
        $age = $request -> input('age');
        $genre = $request -> input('genre');
        $role = $request -> input('role');
        $password = $request -> input('password');
        $departement = $request -> input('departement');

    //DataBase
        DB::table('users')->insert([
        'username'=> $username,
        'email' => $email,
        'phone' => $phone,
        'cin' => $cin,
        'age' => $age,
        'genre' => $genre,
        'role'=> $role,
        'password'=> bcrypt($password),
        'departement'=> $departement,
        ]);
        return redirect() ->route('User')-> with('success',' succesful!');
    }

    //Delete
    public function destroy($id)
    {
        $user= User::findOrFail($id);
        $user->delete();
        return redirect('user')->with('success', 'user deleted successfully.');
    }
    //Update
    public function edit($id)
    {
    $user = User::find($id);
    if (!$user) {
        return redirect()->route('User')->with('error', 'User not found');
    }

     return view('edituser', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = DB::table('users')->where('id', $request->id)->first();

        if (!$user) {
            return redirect()->route('User')->with('error', 'User not found');
        }
        $username = $request->input('username');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $cin = $request->input('cin');
        $age = $request->input('age');
        $genre = $request->input('genre');
        $role = $request->input('role');
        $departement = $request -> input('departement');

        DB::table('users')->where('id', $request->id)->update([
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'cin' => $cin,
            'age' => $age,
            'genre' => $genre,
            'role'=> $role,
            'departement'=> $departement,
        ]);
        return redirect()->route('User')->with('success', 'User updated successfully!');
    }
}
