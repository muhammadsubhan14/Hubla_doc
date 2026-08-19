<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['documentation_id', 'image_path', 'caption', 'sort_order'];

    public function documentation()
    {
        return $this->belongsTo(Documentation::class);
    }
}
