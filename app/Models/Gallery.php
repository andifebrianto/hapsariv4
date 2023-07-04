<?php

namespace App\Models;

use App\Models\GalleryFolder;
use App\Models\GalleryThumbnail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['thumbnails', 'folders'];

    public function thumbnails()
    {
        return $this->belongsTo(GalleryThumbnail::class, 'thumbnail_id');
    }

    public function folders()
    {
        return $this->belongsTo(GalleryFolder::class, 'folder_id');
    }

    public function scopeFilter($query, array $filters)
    {
        // Versi arrow function
        $query->when($filters['folderId'] ?? false, fn($query, $folderId) =>
            // $query->whereHas('categories', fn($query) =>
                $query->where('folder_id', $folderId)
            )
        ;
    }
}
