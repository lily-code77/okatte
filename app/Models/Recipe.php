<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'tags', 'intro', 'ing', 'comment', 'memo'];

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function mindmaps()
    {
        return $this->hasMany(Mindmap::class);
    }
    // 親データ（Recipe）が削除されたら、子データ（Step）も削除される
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($recipe) {
            $recipe->steps()->delete();
        });
    }
}
