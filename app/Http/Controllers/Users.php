<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
class Users extends Controller
{
   
    public function index( Request $request)
    {
        $id = auth()->user()->id;
        $user_id = User::where('id',$id);
        $token = $user_id->pluck('remember_token');
        
         if($token!=csrf_token()){
                $this->update();
                return redirect('projects/index');
        }
        else{
          $search =  DB::table('users')->where('role', 'like', 'Admin')->get();
              if($search->isEmpty()){
                $search = "Not Found";
                 }

            return $token;
        }
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        echo "create";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
        'name' => 'Jann vega',
        'uuid' => (String) Str::uuid(),
        'remember_token'=>csrf_token(),
        'email'=>'newemail@gmail.com',
        'email_verified_at'=>'',
        'password'=>Hash::make(Str::uuid()),
        'two_factor_secret'=>'',
        'two_factor_recovery_codes'=>'',
        'two_factor_confirmed_at'=>'',
        'role'=>'Admin',
        'config'=>'',
        'current_team_id'=>'',
        'profile_photo_path'=>'',
        ]);
        
        return $this->edit($user->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $User)
    {
        echo "Show";
    }

    public function bin(User $user){
       $restoreBin = $user->trashed();
        dd($restoreBin);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    $user = User::find($id);
     $user->uuid = Str::uuid();
     $user->remember_token =csrf_token();
     $user->role = 'Admin';
     $user->save();
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
     $user = User::find(auth()->user()->id);
     $user->uuid = Str::uuid();
     $user->remember_token =csrf_token();
     $user->role = 'Admin';
     $user->save();
    return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $User)
    {
        User::destroy(3);
    }
}
