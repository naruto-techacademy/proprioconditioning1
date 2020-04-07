<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Auth;   // 追加
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Session_item;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $admin = \Auth::user();
        $users = User::orderBy('id', 'desc')->where('team_id',$admin->team_id)->paginate(10);
        foreach($users as $user)
            $session_items = $user->session_items()->orderBy('session_date', 'desc')->paginate(28);
            $latest_item = optional($user->session_items()->orderBy('session_date' , 'desc')->first());
        return view('admin.home', [
            'users' => $users,
            'latest_item' => $latest_item,
            'session_items' => $session_items,
        ]);
        
    }
    
    public function show($id)
    {   
        $admin = \Auth::user();
        $user = User::find($id);
        $users = User::orderBy('id', 'desc')->where('team_id',$admin->team_id)->paginate(10);
        $session_items = $user->session_items()->orderBy('session_date', 'desc')->paginate(28);
        
        $data = [
            'user' => $user,
           
            'session_items' => $session_items,
        ];
        
        $data += $this->counts($user);

        return view('admin.show', $data);
    }
    
    public function users($id)
    {   
        $admin = \Auth::user();
        $user = User::find($id);
        $users = User::orderBy('id', 'desc')->where('team_id',$admin->team_id)->paginate(10);
        $session_items = $user->session_items()->orderBy('session_date', 'desc')->paginate(28);
        
        $data = [
            'user' => $user,
            'users' => $users,
            'session_items' => $session_items,
        ];
        
        $data += $this->counts($user);

        return view('admin.users', $data);
    }
}
