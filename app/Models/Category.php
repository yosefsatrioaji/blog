<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Posts;

class Category extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    protected $table = 'categories';
    protected $fillable = ['nama','slug'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }

    public function posts()
    {
        return $this->hasMany(Posts::class,'category_id');
    }
}
