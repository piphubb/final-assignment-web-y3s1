<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function viewUser(){
        $user = DB::table("tbluser")->get();
        return view("admin.user-manage",['userdata'=>$user]);
    }
    
    public function UserLogout(Request $rq)
    {
        $rq->session()->flush();
        return redirect("/");   
            
    }

    public function CheckLogin(Request $rq){
        $user = $rq->txtuser;
        $pass = $rq->txtpass;
        // check user in database 

       
        $users = DB::table('tbluser')
                ->where('username', '=', $user)
                ->where('password', '=', md5($pass))
                ->limit(1)
                ->get();
        
        $userid = 0;
        foreach($users as $obj)
        {
            $userid = $obj->userid;
            $username = $obj->username;
        }
        if($userid > 0)
        {
            $rq->session()->put('userid', $userid);
            $rq->session()->put('username', $username);

            echo $userid;
            //redirect("admin/dashboard");
           
           

            //session(['key' => 'value','key2'=>'value2']);
           
           
        }else{
            echo "Invalid user or password. Try again";
        }
        
        //echo $userid;
        
        

        
        
        //echo $user." ".$pass;
    }
    
    //insert

}
