<?php

namespace App\Http\Controllers;

use App\Models\MainDashboard;
use Illuminate\Http\Request;
use App\Models\projects;
use App\Models\User;

use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use  Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Models\result; 

class MainDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $uuid= $request->query('code');
     
      
        session(['uuid' =>  $uuid]);

     
      
        return Inertia::render("MainDashboardPage/Index",[
             'data'=>MainDashboard::where('code',$request->query('code'))->first(),
        ]);

    }

    public function PreviewSettings(Request $request, MainDashboard $mainDashboard){
      $testid = $request->query('testid');
        session(['testid'=>$testid]);
        return Inertia::render("PreviewSettings/index",[
        'data'=>MainDashboard::where('code',$request->query('code'))->first(),
        ]);
    }



public function RecieveJsonData(Request $request, MainDashboard $mainDashboard)
{
    $data = $request->all();
    $demopart = null;
   
    foreach ($data as $key => $value) {
      $demopart  = $value['demoPart'];
        $model = new result();

        $model->testcode = session('uuid');
        $model->testid = session('testid');
        $model->demoPart = $value['demoPart'];
        $model->devices = $value['devices'];
        $model->browser = $value['browser'];
        $model->OS = $value['OS'];
        $model->index = $value['index'];
        $model->rt = $value['rt'];
        $model->MobileOS = $value['MobileOS'];
        $model->save();
    }

    // Return a response indicating success
    return response()->json($demopart, 201);
}
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->query();
var_dump($data); 



$jsonString = json_encode($data);


$decodedObject = json_decode($jsonString);


if (json_last_error() !== JSON_ERROR_NONE) {
    echo "JSON decode error: " . json_last_error_msg();
}
        dd($decodedObject);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
         MainDashboard::create([
            'test_name'=>$request->folder_name,
            'uuid'=> session('uuid'),
            'user_id'=>auth()->user()->id,
            'status'=>1,
            'code'=>Str::upper(Str::random(10)),
            'headers'=>$request->Header_Settings,
            'warnings'=>$request->Warning_Settings,
            'images'=>$request->Image_Settings,
            'instructions'=>$request->Instructions,
              'footers'=>$request->Footer_Settings,
            
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(MainDashboard $mainDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MainDashboard $mainDashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MainDashboard $mainDashboard)
    {
      
         $mainDashboard = MainDashboard::find($request->id);
        $mainDashboard->headers=$request->header;
         $mainDashboard->footers=$request->footer;
          $mainDashboard->warnings=$request->warning;
            $mainDashboard->images=$request->images;
            $mainDashboard->instructions=$request->instructions;
        $mainDashboard->save();
       // return $mainDashboard;
    }
    public function uploadImage(Request $request, MainDashboard $mainDashboard){
       
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
     * Remove the specified resource from storage.
     */
    public function destroy(MainDashboard $mainDashboard)
    {
        //
    }
}
