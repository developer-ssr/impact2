<?php
 
namespace App\Http\Controllers;

use App\Models\projects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(projects $projects)
    {
    $menu = [
           'title'=> 'Projects',
           'add'=>'Add Projects',
           'link'=>'index/',
           'placeholder'=>'Project Name',
           'save'=>'/project_store'
        ];
        
    
        return Inertia::render("Projects/index",[
            
            'menu'=>$menu,
            'data'=>projects::paginate(12),
            // 'data'=>DB::table('users')->join('folders','folders.user_id','=','users.id')->select('users.*','folders.*')->paginate(10)
        ]);
    } 
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(projects $projects , Request $request)
    {
        dd(url(env('APP_URL')) . "/id");
    //    dd($request->folder_name);
        $projects = projects::create([
            'project_name'=>$request->folder_name,
            'uuid' => (String) Str::uuid(),
            'user_id'=>auth()->user()->id
          
        ]);

     
    }

    /**
     * Display the specified resource.
     */
    public function show(projects $projects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(projects $projects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, projects $projects)
    {
    
        $fol = projects::find($request->id);
        $fol->project_name = $request->project_name;
        $fol->save();
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(projects $projects,Request $request)
    {
     
          projects::destroy($request->id);
    }
}
