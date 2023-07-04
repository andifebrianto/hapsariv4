<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;

class ActivityThumbnail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function activities()
    {
        return $this->hasOne(Activity::class);
    }
}
