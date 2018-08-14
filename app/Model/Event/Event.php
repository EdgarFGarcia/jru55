<?php

namespace App\Model\Event;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = 'events';

    protected $fillable = [
    	'title', 'body', 'category',
    ];
}
