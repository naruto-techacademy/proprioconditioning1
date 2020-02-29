<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;// 追加
use App\Session_item; // export追加
use DB; // export追加

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
        $user = Auth::user();
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
            'session_work' => $request->session_minutes* $request->session_rpe,
            'team_id' => Auth::user()->team_id,
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
    
    public function export( Request $request ) //ここより下エクスポートのため追加
    {
        $response = new StreamedResponse (function() use ($request){
 
            // キーワードで検索
            $team_id = $request->team_id;
            $stream = fopen('php://output', 'w');
 
            //　文字化け回避
          stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');
 
            // タイトルを追加
          fputcsv($stream, ['name','session_date','session_work','session_rpe','session_minutes','session_category']);
 
          Session_item::where('team_id', Auth::user()->team_id)->chunk( 1000, function($results) use ($stream) {
              foreach ($results as $result) {
                  fputcsv($stream, [$result->user->name,$result->session_date,$result->session_work,$result->session_rpe,$result->session_minutes,$result->session_category]);
              }
          });
          fclose($stream);
      });
      $response->headers->set('Content-Type', 'application/octet-stream');
      $response->headers->set('Content-Disposition', 'attachment; filename="Session_item.csv"');

      return $response;
  }
}
