<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $fillable = ['title', 'description', 'event_date', 'location', 'cover_image_id', 'created_by'];

    protected function casts(): array
    {
        return ['event_date' => 'date'];
    }

    public function images()
    {
        return $this->hasMany(Image::class)->orderBy('sort_order');
    }

    public function coverImage()
    {
        return $this->belongsTo(Image::class, 'cover_image_id');
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'documentation_pics')->withTimestamps();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
