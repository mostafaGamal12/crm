<?php

namespace App\Traits;

use App\Models\Image;

trait hasImages
{
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getImageUrlAttribute()
    {
        return $this->image->full_url;
    }

    public function firstImage()
    {
        return $this->images()->first();
    }

    public function getImage($type)
    {
        return $this->images()->where('type',$type)->first();
    }

    public function getLatestImage($type)
    {
        return $this->images()->where('type',$type)->latest()->first();
    }

    public function getImages($type)
    {
        return $this->images()->where('type',$type)->get();
    }
}
