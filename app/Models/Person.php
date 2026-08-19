<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';

    protected $fillable = ['name', 'position', 'photo'];

    public function documentations()
    {
        return $this->belongsToMany(Documentation::class, 'documentation_pics')->withTimestamps();
    }
}
