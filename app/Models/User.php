<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function favorites() {
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

    /**
     * Get the articles that the user has bookmarked.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bookmarkedArticles()
    {
        return $this->belongsToMany(Article::class, 'bookmarks');
    }

    public function bookmarkedRecipes()
    {
        return $this->belongsToMany(Recipe::class, 'bookmarks');
    }
}
