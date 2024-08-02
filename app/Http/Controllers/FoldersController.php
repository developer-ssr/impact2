<?php
 
namespace App\Http\Controllers;

use App\Models\folders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class FoldersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(folders $folders)
    {
    $menu = [
           'title'=> 'Folders',
           'add'=>'Add Folders',
           'link'=>'index/',
           'placeholder'=>'Folder Name',
           'save'=>'/folder_store'
        ];
        
    
        return Inertia::render("Folders/index",[
            
            'menu'=>$menu,
            'data'=>folders::paginate(10),
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
    public function store(folders $folders , Request $request)
    {
    //    dd($request->folder_name);
        $folders = folders::create([
            'folder_name'=>$request->folder_name,
            'uuid' => (String) Str::uuid(),
            'user_id'=>auth()->user()->id,
            'code'=>Str::upper(Str::random(10)),
        ]);

     
    }

    /**
     * Display the specified resource.
     */
    public function show(folders $folders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(folders $folders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, folders $folders)
    {
    
        $fol = folders::find($request->id);
        $fol->folder_name = $request->folder_name;
        $fol->save();
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(folders $folders,Request $request)
    {
        // dd($request);
          folders::destroy($request->id);
    }
}
