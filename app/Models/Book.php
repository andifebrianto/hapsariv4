<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['cari'] ?? false, function($query, $cari) {
            return $query->where(function($query) use ($cari) {
                 $query->where('judul', 'like', '%' . $cari . '%')
                             ->orWhere('penulis', 'like', '%' . $cari . '%');
             });
         });

        // Versi arrow function
        $query->when($filters['kategori'] ?? false, fn($query, $kategori) =>
            // $query->whereHas('categories', fn($query) =>
                $query->where('kategori', $kategori)
            )
        ;
    }
}
