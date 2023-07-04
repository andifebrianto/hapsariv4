<?php

namespace App\Models;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryThumbnail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function galleries()
    {
        return $this->hasOne(Gallery::class);
    }
}
