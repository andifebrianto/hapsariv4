<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ActivityThumbnail;

class Activity extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['thumbnails'];

    public function thumbnails()
    {
        return $this->belongsTo(ActivityThumbnail::class, 'thumbnail_id');
    }

    public function scopeFilter($query, array $filters)
    {
        // Versi arrow function
        $query->when($filters['kategori'] ?? false, fn($query, $kategori) =>
            // $query->whereHas('categories', fn($query) =>
                $query->where('kategori', $kategori)
            )
        ;
    }
}
