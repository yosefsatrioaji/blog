<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class UserProfiles extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'user_profiles';
    protected $fillable = [
        'user_id',
        'instagram',
        'twitter',
        'facebook',
        'github',
        'website'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
