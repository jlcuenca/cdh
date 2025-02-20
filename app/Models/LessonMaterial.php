<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LessonMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'filename',
        'location'
    ];

    protected $appends = [
        'download_link'
    ];

    public function getDownloadLinkAttribute()
    {
        return Storage::url($this->location);
    }
}
