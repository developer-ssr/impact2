<?php

namespace App\Http\Controllers;

use App\Models\records;
use Illuminate\Http\Request;
use App\Models\MainDashboard;
use App\exportResult;

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
use Illuminate\Support\Collection;
class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request){
$code = $request->query('code');
         

$avgresult1 = Result::where('demoPart', '>', 3) 
->groupBy('cellid') 
                ->where('methods', 1)
                    ->groupBy('cellid')

              ->selectRaw(' SUM(rt) as total_rt') 
                ->get();



$rt_values1 = ([
    'highest'=>$avgresult1->max('total_rt'),
    'lowest'=>$avgresult1->min('total_rt'),
    'median'=>$avgresult1->median('total_rt'),
]);

$avgresult2 = Result::where('demoPart', '>', 3) 

                ->where('methods', 2)
                  ->groupBy('cellid') 
                 ->selectRaw('`cellid`, SUM(rt) as total_rt') 
               
                ->get();

$rt_values2 = ([
    'highest'=>$avgresult2->max('total_rt'),
    'lowest'=>$avgresult2->min('total_rt'),
    'median'=>$avgresult2->median('total_rt'),
]);


$main = MainDashboard::where('code', $code)->first();

$castImages = $main->images['MainTrial'];
$castcontent = $castImages['message'];

$Cell_collection = [];


$cells1 = collect($castcontent['cells'])->map(function ($cell) use (&$Cell_collection) {
  
    $results1 = Result::where('cellid', $cell['cellid'])
        ->where('methods', '=', 1)
        ->get();

   
    $Cell_collection[] = $cell;

 
    if ($results1->contains(function ($result) {
        return $result->demoPart <= 2;
    })) {
        $cell['results'] = null; 
    } else {
        $cell['results'] = $results1;
    }

    return $cell; 
});

$cells1 = $cells1->groupBy('cellid')->map(function ($group) {
   
    $rt_sum = $group->sum(function ($cell) {
        return $cell['results'] ? $cell['results']->sum('rt') : 0;
    });
    
    
    return array_merge($group->first(), ['rt_sum' => $rt_sum]);
});


$rt_sums = $cells1->pluck('rt_sum');
//print_r($rt_sums); 


$rt_sums = $rt_sums->filter(function ($value) {
    return $value !== 0;
});


$rt_values1 = [
    'highest' => $rt_sums->max(),
    'lowest' => $rt_sums->min(),
    'median' => $rt_sums->median(),
];



$cells2 = collect($castcontent['cells'])->map(function ($cell) use (&$Cell_collection) {

    $results2 = Result::where('cellid', $cell['cellid'])
        ->where('methods', '=', 2)
        ->get();

   
    $Cell_collection[] = $cell;

  
    if ($results2->contains(function ($result) {
        return $result->demoPart <= 2;
    })) {
        $cell['results'] = null; 
    } else {
        $cell['results'] = $results2;
    }

    return $cell; 
});

$cells2 = $cells2->groupBy('cellid')->map(function ($group) {

    $rt_sum = $group->sum(function ($cell) {
        return $cell['results'] ? $cell['results']->sum('rt') : 0;
    });
    
   
    return array_merge($group->first(), ['rt_sum' => $rt_sum]);
});


$rt_sums = $cells2->pluck('rt_sum');

$rt_sums = $rt_sums->filter(function ($value) {
    return $value !== 0;
});


$rt_values2 = [
    'highest' => $rt_sums->max(),
    'lowest' => $rt_sums->min(),
    'median' => $rt_sums->median(),
];




 return Inertia::render('ViewResult/index',[
        'implicit_data'=>$cells1,
        'rt_values_implicit'=>$rt_values1,
        'explicit_data'=>$cells2,
        'rt_values_explicit'=>$rt_values2,
        'rows'=>$castcontent['rows'],
        'imagesrc'=>$castcontent['imagesrc'],
        'image_ratio'=>$castcontent['image_ratio']
    ]);

   
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
    public function show(records $records)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(records $records)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, records $records)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(records $records)
    {
        //
    }
}
