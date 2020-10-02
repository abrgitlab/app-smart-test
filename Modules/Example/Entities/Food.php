<?php

namespace Modules\Example\Entities;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'id', 'name', 'image', 'categories'
    ];
    protected $table = 'food';
    protected $primaryKey = 'id';
}
