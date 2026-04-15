<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    protected $table = 'danh_muc';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'ten_danh_muc',
    ];

    // Quan hệ ngược với SanPham
    public function sanPhams()
    {
        return $this->belongsToMany(
            SanPham::class,
            'sanpham_danhmuc',
            'id_danh_muc',      // foreign key của danh_muc
            'id_san_pham'       // foreign key của san_pham
        );
    }
}