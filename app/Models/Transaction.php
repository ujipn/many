<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'calendar_id',
        'asset_id',
        'status',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
