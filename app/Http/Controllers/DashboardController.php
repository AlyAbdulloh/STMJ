<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = User::where('role', 'admin')->count();
        $user = User::where('role', 'user')->count();
        return view('admin.dashboard', compact(['admin', 'user']));
    }
}
