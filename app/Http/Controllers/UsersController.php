<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Micropost;

class UsersController extends Controller
{
    public function index()
    {   
        $users = User::paginate(10);
        
        return view('users.index', [
            'users' => $users,
        ]);
    }
    public function show($id)
    {
        //$micropost = Micropost::find($id);
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];
        
        $data += $this->counts($user);
        //$microposts_count = count(Micropost::all()); 
        
        return view('users.show', $data);
    }
    
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);
        
        $data = [
            'user' => $user,
            'users' => $followings,
        ];
        
        $data += $this->counts($user);
        
        return view('users.followings', $data);
    }
    
    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);
        
        $data = [
            'user' => $user,
            'users' => $followers,
        ];
        
        $data += $this->counts($user);
        
        return view('users.followers', $data);
    }
    public function favors($id)
    {   $user = User::find($id);
        //$micropost = Micropost::find($id);
        $favors = $user->favors()->paginate(10);
        //dd($favors);
        $data = [
            'user' => $user,
            'microposts' => $favors,
        ];
        
        $data += $this->counts($user);
        
        //$microposts = Micropost::all();
        //$micropost_count = count(Micropost::all());
        //$favorite_count = \Auth::user()->favors;
        
        return view('users.favors', $data);
    }
    
    public function favoreds($id)
    {
        $micropost = Micropost::find($id);
        $favoreds = $micropost->favoreds()->paginate(10);
        
        $data = [
            //'user' => $user,
            'microposts' => $favoreds,
        ];
        
        $data += $this->counts($micropost);
        
        return view('users.favoreds', $data);
    }
}