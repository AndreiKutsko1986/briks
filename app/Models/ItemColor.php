<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemColor extends Model
{
    public $timestamps = false;

    protected $fillable = ['item_id', 'color_id', 'image_path'];
}
