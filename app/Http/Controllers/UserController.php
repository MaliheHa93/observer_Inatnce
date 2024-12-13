<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //نمایش فرم ایجاد کاربر
    public function create(){
        return view('users.create');
    }
    public function store(Request $request){
        //اعتبار سنجی
        $validateData = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:8',
        ]);
        //ایجاد کاربر جدید
        User::create([
            'name'=>$validateData['name'],
            'email'=>$validateData['email'],
            'password'=>bcrypt($validateData['password']),
        ]);
        return redirect()->back()->with('success', 'user created successfully!');
    }
}
