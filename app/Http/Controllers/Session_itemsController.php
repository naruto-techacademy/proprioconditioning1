<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Session_itemsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $session_items = $user->session_items()->orderBy('session_date', 'desc')->paginate(28);
            
            $data = [
                'user' => $user,
                'session_items' => $session_items,
            ];
        }
        
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'session_date' => 'required',
            'session_category' => 'required|max:191',
            'session_minutes' => 'required',
            'session_rpe' => 'required', 
            'remarks'=>'required',
        ]);

        $request->user()->session_items()->create([
            'content' => $request->content,
            'session_date' => $request->session_date,
            'session_category' => $request->session_category,
            'session_minutes' => $request->session_minutes,
            'session_rpe' => $request->session_rpe,
            'remarks' => $request->remarks,
            'session_work' => $request->session_minutes* $request->session_rpe
        ]);

        return back();
    }
    
    public function destroy($id)
    {
        $session_item = \App\Session_item::find($id);

        if (\Auth::id() === $session_item->user_id) {
            $session_item->delete();
        }

        return back();
    }
}
