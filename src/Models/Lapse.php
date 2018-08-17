<?php

namespace Pyaesone17\Lapse\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Exception;

class Lapse extends Model
{
    protected $fillable = [
        'class', 'title', 'user_id', 'content', 
        'url', 'payload', 'method'
    ];
    //

    public function scopeSearch($query, $request)
    {
        if($request->filled('q')){
            $query->orWhere("class","like",
                sprintf("%s%s%s","%",$request->q,"%")
            )->orWhere("title","like",
                sprintf("%s%s%s","%",$request->q,"%")
            )->orWhere("method","like",
                sprintf("%s%s%s","%",$request->q,"%")
            )->orWhere("url","like",
                sprintf("%s%s%s","%",$request->q,"%")
            )->orWhere("content","like",
                sprintf("%s%s%s","%",$request->q,"%")
            );
        } 

        if($request->filled('from') && $request->filled('to')){
            try {
                $from = Carbon::parse($request->from)->toDateString();
                $to = Carbon::parse($request->to)->toDateString();

                $query->whereDate("created_at",">=",$from)
                    ->whereDate("created_at","<=",$to);

            } catch (Exception $e){
                return $query;
            }
        }

        return $query;
    }
}
