<?php

namespace App\Http\Controllers;

use App\Models\MainDashboard;
use App\exportResult;
use Illuminate\Http\Request;
use App\Models\projects;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use  Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Models\result; 
use Illuminate\Database\Eloquent\Casts\Attribute;

// use Maatwebsite\Excel\Facades\Excel;

class MainDashboardController extends Controller{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        $collections;
        $uuid= $request->query('code');
        session(['uuid' =>  $uuid]);

      $mainDashboardCollection = MainDashboard::all(); // or however you are retrieving it
$mainDashboard = $mainDashboardCollection->first(); // Get the first instance

// Access the images
$images = $mainDashboard->images;
$message = $images['MainTrial']['message'];
 $cells = $message['cells'];

     
    $result = Result::where('demoPart', 'Main Trial')->where('testcode',$request->query('code'))
                ->groupBy('cellid') 
                ->selectRaw('`cellid`, SUM(rt) as total_rt') 
                ->get();

$avgresult = Result::where('demoPart', 'Main Trial')->where('testcode',$request->query('code'))
                    ->groupBy('cellid') 
                    ->selectRaw('`cellid`, SUM(rt) as total_rt') 
                   ->get();


$rt_values = [
    'highest' => $avgresult->max('total_rt'),
    'lowest' => $avgresult->min('total_rt'),
    'median' => $avgresult->median('total_rt'),
];

// dd($result);

// foreach ($cells as $cell) {
//     // Access the `cellid` within each cell
//     foreach($result as $results){
//         if($cell['cellid']==$result['cellid']){
//  $collections[] = $cell['cellid'].":".$result['cellid'];
//         }
//     }
//     //$cellid = $cell['cellid'];
// }
//dd($collections);

        return Inertia::render("MainDashboardPage/Index",[
             'data'=>MainDashboard::where('code',$request->query('code'))->first(),
             'rt_values'=>$rt_values,
             'test_result'=>$result,
             'mainData'=>MainDashboard::where('code',$request->query('code'))->get()
        ]);


    }

    public function PreviewSettings(Request $request, MainDashboard $mainDashboard){
      $testid = $request->query('testid');
        session(['testid'=>$testid]);
        if($testid!=null){
        return Inertia::render("PreviewSettings/index",[
        'data'=>MainDashboard::where('code',$request->query('code'))->first(),
        ]);
        }
        else{
             return response()->json($request->data, 201);
        }
       
    }



public function RecieveJsonData(Request $request, MainDashboard $mainDashboard){

    if(session('testid')!=null){
    foreach ($request->data as $key => $value) {
      
        $model = new result();
        $model->cellid = $value['cellid'];
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
    return response()->json($request->data, 201);

}
else{
  return response()->json("Test id not found", 201);  
}

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
    public function store(Request $request){

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
    public function update(Request $request, MainDashboard $mainDashboard){
        $mainDashboard = MainDashboard::find($request->id);
        $mainDashboard->headers=$request->header;
        $mainDashboard->footers=$request->footer;
        $mainDashboard->warnings=$request->warning;
        $mainDashboard->images=$request->images;
        $mainDashboard->instructions=$request->instructions;
        $mainDashboard->save();
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
    public function destroy(MainDashboard $mainDashboard){
        //
    }

    public function test(){

        // Retrieve all results from the database
        $results = Result::all();
        $allData = MainDashboard::all();
      
        // Check if there are results to export
        if ($results->isEmpty()) {
            return response()->json("No data available to export", 404);
        }

        // Create a CSV file in memory
        $output = fopen('php://output', 'w');

        // Set the headers to download the file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="results.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Output the CSV header
        fputcsv($output, ['cellid', 'testcode', 'testid', 'demoPart', 'devices', 'browser', 'OS', 'index', 'rt', 'MobileOS']);

        // Output each result as a CSV row
        foreach ($results as $result) {
            fputcsv($output, [
                $result->cellid,
                $result->testcode,
                $result->testid,
                $result->demoPart,
                $result->devices,
                $result->browser,
                $result->OS,
                $result->index,
                $result->rt,
                $result->MobileOS
            ]);
        }

        // Close the output stream
        //dd($output);
        fclose($output);
        exit; // Terminate the script to prevent further output
    }
    
    

public function testresult(){

$result = Result::where('demoPart', 'Main Trial')
                ->groupBy('index')
                ->selectRaw('`index`, sum(rt) as total_rt')
                ->get();

                $avgresult = Result::where('demoPart', 'Main Trial')
                ->select('rt')
                ->get();

// $highest = $result->max('rt');
// $lowest = $result->min('rt');
// $median = $result->median('rt');

$rt_values = ([
    'highest'=>$avgresult->max('rt'),
    'lowest'=>$avgresult->min('rt'),
    'median'=>$avgresult->median('rt'),
]);

return response()->json($result);

}
  

}
