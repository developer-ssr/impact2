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
use Illuminate\Http\RedirectResponse;
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

// // Access the images
// $images = $mainDashboard->images;
// $message = $images['MainTrial']['message'];
//  $cells = $message['cells'];

     
$result = Result::where('testcode', $request->query('code'))
                ->where('demoPart', 3)
                ->whereNotNull('cellid')
                ->whereNotNull('index')
                ->groupBy('cellid', 'index')
                ->selectRaw('cellid, `index`, SUM(rt) as total_rt, COUNT(*) as total_records')
                ->orderBy('index') // Add this line to sort by index
                ->get();

$avgresult = Result::where('demoPart', 3)->where('testcode',$request->query('code'))
                    ->groupBy('cellid') 
                    ->selectRaw('`cellid`, SUM(rt) as total_rt') 
                   ->get();

$rt_values = [
    'highest' => $avgresult->max('total_rt'),
    'lowest' => $avgresult->min('total_rt'),
    'median' => $avgresult->median('total_rt'),
];


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

   
   DB::beginTransaction();
try {
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
        $model->methods = $value['methods'];
        $model->save();
       
    }
    
    DB::commit();
} catch (\Exception $e) {
    DB::rollback();
    // Log the exception
    Log::error($e->getMessage());
}
       
    // Return a response indicating success
//    dd($request->data);
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
        // dd($decodedObject);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        // dd($request);

         MainDashboard::create([
            'test_name'=>$request->test_name,
            'uuid'=> session('uuid'),
            'user_id'=>auth()->user()->id,
            'status'=>1,
            'code'=>Str::upper(Str::random(10)),
            // 'headers'=>$request->Header_Settings,
            // 'warnings'=>$request->Warning_Settings,
            'images'=>$request->Image_Settings,
            'instructions'=>$request->Instructions,
            // 'footers'=>$request->Footer_Settings,
        ]);
    }

public function searchTest(Request $request)
{
 
   $result = MainDashboard::whereNull('deleted_at')
    ->where('uuid', session('uuid'))
    ->where('test_name', 'LIKE', '%' . $request->testName . '%')
    ->paginate(12);
  
    return Inertia::render("Tests/index", [
        'data' => $result,
       
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
        $mainDashboard->test_name = $request->test_name;
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


public function practice(){

return Inertia::render('practice/index',[ 'data'=>MainDashboard::where('code',session('uuid'))->first(),]);
}
  

public function export() {
    $results = Result::where('testcode', session('uuid'))->get();
$resultdata = Result::where('demoPart', '>', 3) 
                ->where('methods', 1)
                ->groupBy('index')
                ->selectRaw('`index`, sum(rt) as total_rt')
                ->get();


$avgresult = Result::where('demoPart', '>', 3) 
                ->where('methods', 1)
                ->select('rt')
                ->get();



$rt_values = ([
    'highest'=>$avgresult->max('rt'),
    'lowest'=>$avgresult->min('rt'),
    'median'=>$avgresult->median('rt'),
]);
// dd($rt_values);

    $main = MainDashboard::where('code', session('uuid'))->first();

    $castImages = $main->images['MainTrial'];
    $castcontent = $castImages['message'];
    $cells = $castcontent['cells']; 

  
    $groupedResults = [];
    
    foreach ($results as $result) {
        if ($result->demoPart > 2) {
          
            if (!isset($groupedResults[$result->cellid])) {
                $groupedResults[$result->cellid] = [
                    'sum_rt' => 0,
                    'count' => 0
                ];
            }
          
            $groupedResults[$result->cellid]['sum_rt'] += $result->rt;
            $groupedResults[$result->cellid]['count']++;
        }
    }

    
    foreach ($cells as &$cellItem) {
        $matchingResult = $results->firstWhere('cellid', $cellItem['cellid']);
        
        if ($matchingResult) {
        
            $cellItem['result_data'] = [
                'id' => $matchingResult->id,
                'data' => [
                    'cellid' => $matchingResult->cellid,
                    'rt' => $matchingResult->rt,
                    'index' => $matchingResult->index,
                    'demoPart' => $matchingResult->demoPart,
                  
                    'sum_rt' => isset($groupedResults[$matchingResult->cellid]) ? 
                                $groupedResults[$matchingResult->cellid]['sum_rt'] : 0
                ],
            ];
        }
    }

    return response()->json($cells); 
}


public function Results_Data() {
    $results = Result::where('testcode', session('uuid'))->get();
    $resultdata = Result::where('demoPart', '>', 3) 
                ->where('methods', 1)
                ->groupBy('index')
                ->selectRaw('`index`, sum(rt) as total_rt')
                ->get();


$avgresult = Result::where('demoPart', '>', 3) 
                ->where('methods', 1)
                ->select('rt')
                ->get();



$rt_values = ([
    'highest'=>$avgresult->max('rt'),
    'lowest'=>$avgresult->min('rt'),
    'median'=>$avgresult->median('rt'),
]);
dd($rt_values);

    $main = MainDashboard::where('code', session('uuid'))->first();

    $castImages = $main->images['MainTrial'];
    $castcontent = $castImages['message'];
    $cells = $castcontent['cells']; 

  
    $groupedResults = [];
    
    foreach ($results as $result) {
        if ($result->demoPart > 2) {
          
            if (!isset($groupedResults[$result->cellid])) {
                $groupedResults[$result->cellid] = [
                    'sum_rt' => 0,
                    'count' => 0
                ];
            }
          
            $groupedResults[$result->cellid]['sum_rt'] += $result->rt;
            $groupedResults[$result->cellid]['count']++;
        }
    }

    
    foreach ($cells as &$cellItem) {
        $matchingResult = $results->firstWhere('cellid', $cellItem['cellid']);
        
        if ($matchingResult) {
        
            $cellItem['result_data'] = [
                'id' => $matchingResult->id,
                'data' => [
                    'cellid' => $matchingResult->cellid,
                    'rt' => $matchingResult->rt,
                    'index' => $matchingResult->index,
                    'demoPart' => $matchingResult->demoPart,
                  
                    'sum_rt' => isset($groupedResults[$matchingResult->cellid]) ? 
                                $groupedResults[$matchingResult->cellid]['sum_rt'] : 0
                ],
            ];
        }
    }

    return response()->json($cells); 
}
}
