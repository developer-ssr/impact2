<?php

namespace App\Http\Controllers;

use App\Models\preview;
use Illuminate\Http\Request;
use App\Models\Tests;
use Illuminate\Support\Str;
use Inertia\Inertia;


class PreviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(tests $tests, request $request)
    {

    return Inertia::render("Preview/index",[
        'previewData'=>tests::where('code', $request->query('code'))->first(),
        'demoPart'=>$request->query('demo')
    ]);

    }

    public function PracticeView(){
         return Inertia::render("practice/index");
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(preview $preview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(preview $preview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, preview $preview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(preview $preview)
    {
        //
    }
}
