<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanType;

class PlanTypeController extends Controller
{
    public function create_plan_type(Request $req){

        $plan_type = new PlanType;

        $plan_type->name=$req->input('name');
        $plan_type->save();
        return $plan_type;
    }

    public function list_plans(){
        $result= PlanType::with('activities')->get();
        if ($result){
            return $result;
        }
        else{
            return ["result"=> "Operation failed"];
        }
    }

    public function show_plan($id){
        $result= PlanType::where('id', $id)->with('activities')->first();
        if ($result){
            return $result;
        }
        else{
            return ["result"=> "Operation failed"];
        }
    }

    public function update_plan(Request $req, $id){
        $plan_type= PlanType::find($id);
        $plan_type->name=$req->input('name');
        $plan_type->save();
        return $plan_type;
    }
    
    public function destroy_plan($id){
        $result= PlanType::where('id', $id)->delete();
        if($result){
            return ["result" => "Plan type has been deleted!"];
        }
        else{
            return ["result" => "Operation faild"];
        }
    }
}
