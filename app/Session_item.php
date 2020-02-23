<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Session_item extends Model
{
    protected $fillable = ['session_date','session_category','session_rpe','session_minutes', 'user_id', 'remarks', 'session_work','team_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function rpe($days){
       $to = $this->session_date;
       $from = Carbon::parse($to);
       $from->subDays($days); 
       $rpe = Session_item::where('user_id', $this->user_id)
       ->whereBetween('session_date', [$from, $to])
       ->sum('session_work');
       return $rpe;
   }
   
   public function acratio()
   {
        if($rpe===0){
        return $session_item->rpe(7)*4;
    }
    return "存在なし" ;

    }
}
