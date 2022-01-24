<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todos;
use Illuminate\Support\Facades\Auth;


class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Todos::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                'title' => 'required',
                'description' => 'required',
        ]);
        if (Auth::user()){
            return Auth::user()->todo()->create([
                'title' => $request->title,
                'description' => $request->description,
                'confirmed' => FALSE
            ]);
        }
        return "Your are not authorised to this";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Todos::find($id)->get();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'confirmed' => 'required'
       ]);

       if($todo_item->user_id === Auth::user()->id  || Auth::user()->can('edit todo') || Auth::user()->hasrole('admin')){
           $todo_item->update($request->all());
           return $todo_item;   
       }
       return "Your are not Authorised";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo_item = Todos::find($id)->first();
        if($todo_item->user_id === Auth::user()->id  || Auth::user()->can('delete todo') || Auth::user()->hasrole('admin')){
            Todos::destroy($id);
            return 'Already deleted';
        }
        return "Your are not Authorised";
    }
}
