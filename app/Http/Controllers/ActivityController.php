<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function create_activity(Request $req){

        $activity = new Activity;

        $activity->name=$req->input('name');
        $activity->description=$req->input('description');
        $activity->plan_types_id=$req->input('plan_types_id');
        $activity->save();
        return $activity;
    }

    public function list_activities(){
        $result= Activity::with('plan_type')->get();
        if ($result){
            return $result;
        }
        else{
            return ["result"=> "Operation failed"];
        }
    }

    public function show_activity($id){
        $result= Activity::where('id', $id)->with('plan_type')->first();
        if ($result){
            return $result;
        }
        else{
            return ["result"=> "Operation failed"];
        }
    }

    public function update_activity(Request $req, $id){
        $activity= Activity::find($id);
        $activity->name=$req->input('name');
        $activity->description=$req->input('description');
        $activity->plan_types_id=$req->input('plan_types_id');
        $activity->save();
        return $activity;
    }
    
    public function destroy_activity($id){
        $result= Activity::where('id', $id)->delete();
        if($result){
            return ["result" => "Activity has been deleted!"];
        }
        else{
            return ["result" => "Operation faild"];
        }
    }
}
