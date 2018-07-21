<?php

namespace Pyaesone17\Lapse\Models;

use Illuminate\Database\Eloquent\Model;

class Lapse extends Model
{
    protected $fillable = [
        'class', 'title', 'user_id', 'content', 
        'url', 'payload', 'method'
    ];
    //
}
