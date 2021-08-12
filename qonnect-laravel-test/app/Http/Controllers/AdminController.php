<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index(){
        $address = "123 BKK , THAILAND";
        $tel = "64-651-1446";
        $email = "test@email.com";
        // return view('member.index', ['address'=>$city,'tel'=>$tel]);
        // return view('member.index',compact('address','tel'));
        return view('member.index')
        ->with('address',$address)
        ->with('tel',$tel)
        ->with('email',$email)
        ->with('error','404 The Data Not Found')
        ->with('status','Successfully');
    }
}
