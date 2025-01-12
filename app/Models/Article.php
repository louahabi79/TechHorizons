<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_title',
        'article_content',
        'article_thumbnail',
        'author_id',
        'theme_id',
    ];
    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id', 'theme_id');
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'user_id');
    }
}
