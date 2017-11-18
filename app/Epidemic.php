<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Epidemic extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'disease_id',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    /**
     * Returns reports in this epidemic
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
