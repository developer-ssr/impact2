<?php

namespace App\Http\Controllers;

use App\Models\Tests;
use Illuminate\Http\Request;
use App\Models\trials;
use App\Models\quadrants;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use Illuminate\Support\Facades\Storage;
 


 
class TestsController extends Controller
{

     
    
    /**
     * Display a listing of the resource.
     */


    public function index(tests $tests, Request $request)
    {
            $uuid= $request->query('uuid');
            session(['uuid' =>  $uuid]);
            $menu = [
           'folder'=>'Projects',
           'folderlink'=>'projects_index',
           'title'=> 'Tests',
           'add'=>'Add Test',
           'link'=>'project_index/',
           'placeholder'=>'Test Name',
           'save'=>'tests_store'
        ];
        
        return Inertia::render("Tests/index",[
            'menu'=>$menu,
            'data'=>tests::where('uuid',$request->query('uuid'))->paginate(12),
            'Project_title'=>tests::where('uuid',$request->query('uuid'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function trials(Request $request, trials $trials ){
      $code= $request->query('code');

    session(['code' =>  $code]);

        return Inertia::render('Editor/index',[
        'code'=>$request->query('code'),
         'test'=> tests::where('code',$request->query('code'))->first(),
        ]);
    }



    public function make_quadrants(){
        quadrants::create([
            'grid_name'=>'Keypress M',
            'key'=>'M',
            'rows'=>1
        ]);
    }
    public function create(){
        tests::create([
            'uuid'=> Str::uuid(),
            'name'=>'sample1',
            'user_id'=>auth()->user()->id,
            'status'=>1,
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(tests $tests, Request $request){
           tests::create([
            'test_name'=>$request->folder_name,
            'uuid'=> session('uuid'),
            'user_id'=>auth()->user()->id,
            'status'=>1,
            'code'=>Str::upper(Str::random(10)),
            'quadrants'=>$request->quadrants,
            'settings'=>$request->settings
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(tests $tests,Request $request)
    {
        
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tests $tests)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tests $tests){
        $tests = tests::find($request->id);
        $tests->test_name = $request->test_name;
        $tests->save();
    }

    public function updateTest(Request $request, tests $tests){
        $tests = tests::find($request->id);
        $tests->settings=$request->settings;
        $tests->save();
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tests $tests, Request $request){
        tests::destroy($request->id);
    }

    public function grid1(tests $tests, Request $request){
        
      
        return Inertia::render('Editor/index',[
            'test'=> tests::all()
        ]
    );
    }

    public function updateRow(Request $request){
    $quadrants = quadrants::find($request->id);
        $quadrants->rows = $request->rows;
        $quadrants->save();
    }

    public function deleteCollection(Request $request){
           trials::destroy($request->col);
    }
}