<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'disease_id',
        'location',
        'district',
        'no_of_victims',
        'priority',
        'epidemic_id',
    ];
}
