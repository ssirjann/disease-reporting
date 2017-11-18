<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Accessor for description (pseudo attribute)
     */
    public function getDescriptionAttribute()
    {
        return $this->getOriginal('description') ?: 'na';
    }
}
