<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // ✅ Sadece bir tane $fillable olacak
    protected $fillable = ['title', 'content', 'user_id', 'category_id', 'image_path'];
    // İlişki: Bu post bir kullanıcıya aittir
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // İlişki: Bu post bir kategoriye aittir
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
