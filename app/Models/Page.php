<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['page_name', 'page_desc', 'meta_desc', 'meta_keywords', 'permission'];
}
