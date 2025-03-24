<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
class AdminAccountController extends Controller
{
    //
    public function index(){
        $admins = Admin::paginate(10);
        return view('admin.account_admin.index', compact('admins'));
    }

    public function create(){
        return view('admin.account_admin.create');
    }
    public function showInfo()
    {
        $admin = session('admin');
        return view('admin.account_admin.info', compact('admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.account_admin.index')->with('success', 'Admin created successfully!');
    }

    public function edit(Admin $admin){
        return view('admin.account_admin.create', compact('admin'));
    }

    public function destroy(Admin $admin){
        $admin->delete();
        return redirect()->route('admin.account_admin.index')->with('success', 'Đã xóa tài khoản!');
    }
}
