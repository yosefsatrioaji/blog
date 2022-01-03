<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\User;
use App\Models\Category;

class Posts extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $table = 'posts';
    protected $fillable = ['user_id', 'category_id', 'slug', 'published', 'judul', 'cover', 'ringkasan', 'isi', 'keywords'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }
}
