<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    // Formdan gelen verilerde name ve parent_id'nin kaydedilmesine izin veriyoruz
    protected $fillable = ['name', 'parent_id'];

    protected static function boot()
{
    parent::boot();

    static::deleting(function ($category) {
        foreach ($category->children as $child) {
            $child->delete(); // recursive silme
        }
    });
}


    // Bu kategoriye ait yazılar
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Bu kategorinin ebeveyni
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Bu kategorinin alt kategorileri
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function allChildrenIds()
{
    $ids = [];

    foreach ($this->children as $child) {
        $ids[] = $child->id;
        $ids = array_merge($ids, $child->allChildrenIds()); // recursive çağrı
    }

    return $ids;
}


}
