<?php

namespace App\Http\Controllers;

use App\Models\targets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TargetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(targets $targets,Request $request)
    {
          if($request->hasFile("image")){
            $file = $request->file("image");
            $name = $file->hashName();
            $file->move(public_path() . '\targets_images', $name);
            return env('APP_URL').'\targets_images\\'.$name;
            //$file->move(storage_path() . '\app\targets_images', $name);
           // return  Storage::path('targets_images\\'.$name);
          } 
    }

    /**
     * Display the specified resource.
     */
    public function show(targets $targets,Request $request)
    {
       
 
       

        //dd($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(targets $targets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, targets $targets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(targets $targets)
    {
        //
    }
}
