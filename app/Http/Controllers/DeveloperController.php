<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Developer;
use App\Http\Resources\Developer as DeveloperResource;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all list of developers
        $developers = Developer::orderBy('created_at','desc')->paginate(5);

        return DeveloperResource::collection($developers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $developer = $request->isMethod('put') ? Developer::findOrFail($request->developer_id) : new Developer;

        $developer->id  = $request->input('developer_id');
        $developer->first_name  = $request->input('first_name');
        $developer->last_name  = $request->input('last_name'); 
        $developer->email  = $request->input('email');
        $developer->phone  = $request->input('phone');
        $developer->position  = $request->input('position');
        $developer->role  = $request->input('role');

        if($developer->save()){
            return new DeveloperResource($developer);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get a record of single developer
        $developer = Developer::findOrFail($id);

        return new DeveloperResource($developer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $developer = Developer::findOrFail($id);

        if($developer->delete()){
        return new DeveloperResource($developer);
        }
    }
}
