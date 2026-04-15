<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Khai báo đúng tên bảng trong DB
    protected $table = 'danh_muc';

    // Các cột cho phép gán (tùy DB của bạn)
    protected $fillable = ['ten_danh_muc'];
}
