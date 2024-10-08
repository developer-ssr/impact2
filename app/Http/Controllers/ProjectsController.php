<?php
 
namespace App\Http\Controllers;

use App\Models\projects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;


class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index($result = null)
{

        return Inertia::render("Projects/index", [
            'data' => projects::paginate(12),
        ]);
   
    
}

public function searchProject(Request $request)
{
    
    $request->validate([
        'projectName' => 'required|string|max:255',
    ]);

   
    $result = DB::table('projects')
        ->where('deleted_at', null)
        ->where('project_name', 'LIKE', '%' . $request->projectName . '%')
        ->paginate(12);

         return Inertia::render("Projects/index", [
            'data' =>  $result,
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


        $projects = projects::create([
            'project_name'=>$request->project_name,
            'uuid' => (String) Str::uuid(),
            'user_id'=>auth()->user()->id,
            'settings'=>$request->settings 
        ]);
      
        //return  $projects;
     
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
