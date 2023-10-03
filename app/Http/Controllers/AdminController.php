<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('admin.dataAdmin', ['users' => $users]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required||email:dns',
            'username' => 'required|max:255',
            'password' => 'required|min:5'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'admin';

        User::find($request->id)->update($validatedData);
        $users = User::latest()->paginate(5);

        return view('admin.pagination.paginate_admin', compact('users'))->render();
        // return $request->password;
    }

    public function destroy(string $id)
    {
        User::find($id)->delete();
        $users = User::latest()->paginate(5);

        return view('admin.pagination.paginate_admin', compact('users'))->render();
        // return $id;
    }
}
