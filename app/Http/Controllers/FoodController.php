<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $result= Food::with('Menus')->get();
        if ($result){
            return $result;
        }
        return ['result'=> "Operation failed"];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_food(Request $req)
    {
        $food= new Food;

        $food->title=$req->input('title');
        $food->description=$req->input('description');
        $food->price=$req->input('price');
        $food->menu_id=$req->input('menu_id');
        $food->img_path=$req->file('img_path')->store('public');
        $food->save();
        return $food;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_food($id)
    {
        $result= Food::where('id', $id)->with('menus')->first();
        if ($result){
            return $result;
        }

        return ["result"=> "Operation failed"];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_food(Request $req, $id)
    {
        $food= Food::find($id);
        $food->title=$req->input('title');
        $food->description=$req->input('description');
        $food->price=$req->input('price');
        $food->menu_id=$req->input('menu_id');
        $food->img_path=$req->file('img_path')->store('public');
        $food->save();
        return $food;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_food($id)
    {
        $result= Food::where('id', $id)->delete();
        if($result){
            return ["result" => "Food item has been deleted!"];
        }
            return ["result" => "Operation faild"];
    }
}
