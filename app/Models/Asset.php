<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
//許可するデータを指定するために fillable プロパティを使用する
    protected $fillable = ['asset_name', 'asset_area', 'asset_number', 'asset_amount', 'published','image'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
