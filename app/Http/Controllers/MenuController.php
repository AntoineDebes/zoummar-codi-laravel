<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $result= Menu::with('foods')->get();
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
    public function create_menu(Request $req)
    {
        $menu= new Menu;

        $menu->name=$req->input('name');
        $menu->img_path=$req->file('img_path')->store('public');
        $menu->save();
        return $menu;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_menu($id)
    {
        $result= Menu::where('id', $id)->with('foods')->first();
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
    public function update_menu(Request $req, $id)
    {
        $menu= Menu::find($id);
        $menu->name=$req->input('name');
        $menu->img_path=$req->file('img_path')->store('public');
        $menu->save();
        return $menu;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_menu($id)
    {
        $result= Menu::where('id', $id)->delete();
        if($result){
            return ["result" => "Menu Category has been deleted!"];
        }
            return ["result" => "Operation faild"];
    }
}
