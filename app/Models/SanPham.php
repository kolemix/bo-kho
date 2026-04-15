<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'san_pham';
    public $timestamps = false;

    protected $fillable = [
        'code', 'ten_san_pham', 'gia_ban', 'hinh_anh', 'mo_ta',
        'ten_khoa_hoc', 'ten_thong_thuong', 'quy_cach_san_pham',
        'do_kho', 'yeu_cau_anh_sang', 'nhu_cau_nuoc', 'status',
    ];

    // Pivot table tên là sanpham_danhmuc, khóa id_san_pham / id_danh_muc
    public function danhMucs()
    {
        return $this->belongsToMany(
            DanhMuc::class,
            'sanpham_danhmuc',  // tên bảng pivot đúng với DB
            'id_san_pham',      // foreign key của san_pham
            'id_danh_muc'       // foreign key của danh_muc
        );
    }
}