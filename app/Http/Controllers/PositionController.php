<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    //
    public function viewPosition(){
        $post = DB::table("tblposition")->get();
        return view("admin.position",["userdata"=>$post]);
    }

    //add
    public function addPosition(Request $rq){
        //echo "add data";
        //$de = $rq->txtdept;
        $ti = $rq->txttitle;
        $de = $rq->txtdepa;

        $data=array('position_title'=>$ti,'department_id'=>$de);
        DB::table('tblposition')->insert($data);
        echo "Succesful Added";

        //DB::insert('INSERT INTO tbldepartment(depid,title) VALUSE(?,?)[$de,$ti]');
        //echo $de."".$ti;
        
    }

    //delete Position
    public function delPosition(Request $rq){
        $dep = $rq->deid;
        DB::table('tblposition')->where('positionid', $dep)->delete();
        echo "Record has been delete";
        //echo $dep;
    }

    //update
    public function updatePosition(Request $rq){

        $de = $rq->txtPostionID;
        $ti = $rq->txttitle;
        $depa = $rq->txtdepa;
        
        DB::table('tblposition')->where('positionid', $de)->update(['position_title' => $ti,'department_id' => $depa]);
        echo "Record has been Update";
        //echo $dep;
    }
    
}
