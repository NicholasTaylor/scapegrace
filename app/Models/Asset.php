<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'article_id',
        'name',
        'media_type',
        'path'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
