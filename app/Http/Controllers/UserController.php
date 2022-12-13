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
    public function AddUser(Request $rq){
        $user = $rq->txtusername;
        $pass = $rq->txtpasswd;

        $data=array('username'=>$user, 'password'=>$pass);
        DB::table('tbluser')->insert($data);
        echo "Succesful Added";
    }

    //delete
    public function DelUser(Request $rq){
        $user = $rq->userid;
        DB::table('tbluser')->where('userid', $user)->delete();
        echo "Record has been delete";
    }

    //up
    public function UpdateUser(Request $rq){

        $de = $rq->txtdepid;
        $ti = $rq->txttitle;
        $less = $rq->txtless;
        
        DB::table('tbluser')->where('userid', $de)->update(['username' => $ti,'password' => $less]);
        echo "Record has been Update";
        //echo $dep;
    }
}
