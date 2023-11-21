<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admins = User::where('name', 'LIKE', '%' . $request->val . '%')
                ->paginate(5);
            if ($admins->count() > 0) {
                return view('admin.pagination.paginate_admin', compact('admins'))->render();
            } else {
                return response()->json(
                    '
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td colspan="6">Data tidak ditemukan</td>
                            </tr>
                        </tbody>
                    </table>

                    '
                );
            }
        }


        $admins = User::where('role', 'admin')->paginate(5);
        return view('admin.dataAdmin', ['admins' => $admins]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:users|email:dns',
            'username' => 'required|unique:users|max:255',
            'password' => 'required|min:5'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'admin';

        User::create($validatedData);
        $users = User::latest()->paginate(5);

        return view('admin.pagination.paginate_admin', compact('users'))->render();
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
