<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Posts extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';
    protected $fillable = ['user_id', 'slug', 'judul', 'cover', 'ringkasan', 'isi', 'keywords'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
