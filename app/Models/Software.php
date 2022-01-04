<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Software extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['category_id', 'name', 'version', 'date_time', 'content'];

    protected $appends = ['icon', 'file'];

    public function getIconAttribute()
    {
        return $this->getFirstMediaUrl('icon');
    }

    public function getFileAttribute()
    {
        return $this->getFirstMediaUrl('file');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
