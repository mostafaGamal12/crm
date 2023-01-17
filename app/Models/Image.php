<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $guarded = ['id'];

    protected $appends = ['full_url'];

	public function imageable()
	{
		return $this->morphTo();
	}

	public function getFullUrlAttribute()
	{
		return url(Storage::url($this->url));
	}

	public function getAltAttribute()
	{
		return $this->{'alt_'.app()->getLocale()};
	}
}
