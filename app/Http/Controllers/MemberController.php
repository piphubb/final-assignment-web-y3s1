<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function viewMember(){
        $member = DB::table("tblmember")->get();
        return view("admin.member",["member"=>$member]);
    }
}
