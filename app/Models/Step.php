<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $guarded = [];

    public function todo()
    {
    	return $this->belongsTo(Todo::class);
    }
}
