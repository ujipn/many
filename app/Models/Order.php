<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'group_name', 'order_purpose', 'start_date','end_date', 'order_number', 'order_budget', 'order_area', 'order_content','accommodation_status', 'activity_status','content_status'];

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Post::class);
    }
}
