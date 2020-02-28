<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User; // 追加


class UsersController extends Controller
{
    public function index()
    {   
        $user = Auth::user();
        $users = User::orderBy('id', 'desc')->where('team_id',$user->team_id)->paginate(10);
        $latest_item = optional($user->session_items()->orderBy('session_date' , 'desc')->first());
        

        return view('users.index', [
            'users' => $users,
            'latest_item' => $latest_item,
        ]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $session_items = $user->session_items()->orderBy('session_date', 'desc')->paginate(28);
        
        $data = [
            'user' => $user,
            'session_items' => $session_items,
        ];
        
        $data += $this->counts($user);

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

    //public function followings($id)
    //{
    //    $follow_user_ids = $this->followings()->pluck('users.id')->toArray();
    //    $follow_user_ids[] = $this->id;
	//	return User::whereIn('team_id', $follow_user_ids);
    //}
    
    
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
    
    //public function same_team($id)
    //{   
    //    $teamMate = $this->team_id == $id->team_id;
    //    
    //    if($teamMate){
    //        return view('users_follow.follow_button', $teamMate);
    //        return true;
    //    } else {
    //        return false;
    //    }
    //}
}
