<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeptController extends Controller
{
    //
    public function viewDept(){
        $dept = DB::table("tbldepartment")->get();
        return view("admin.dept",["userdata"=>$dept]);
    }

    //insert data
    public function adddep(Request $rq){
        //echo "add data";
        //$de = $rq->txtdept;
        $ti = $rq->txttitle;
        $les = $rq->txtless;

        $data=array('title'=>$ti, 'lesson'=>$les);
        DB::table('tbldepartment')->insert($data);
        echo "Succesful Added";

        //DB::insert('INSERT INTO tbldepartment(depid,title) VALUSE(?,?)[$de,$ti]');
        //echo $de."".$ti;
        
    }

    //delete department
    public function deldep(Request $rq){
        $dep = $rq->deid;
        DB::table('tbldepartment')->where('depid', $dep)->delete();
        echo "Record has been delete";
        //echo $dep;
    }

    //update
    public function updatedep(Request $rq){

        $de = $rq->txtdepid;
        $ti = $rq->txttitle;
        $less = $rq->txtless;
        
        DB::table('tbldepartment')->where('depid', $de)->update(['title' => $ti,'lesson' => $less]);
        echo "Record has been Update";
        //echo $dep;
    }
}
