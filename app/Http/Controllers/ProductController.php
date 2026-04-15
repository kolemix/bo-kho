<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DanhMuc;
use App\Models\SanPham;

class ProductController extends Controller
{
    // Câu 3: Hiển thị chi tiết cây cảnh
    public function show($id)
    {
        // Dùng Eloquent Model để có quan hệ danhMucs
        $sanPham = SanPham::with('danhMucs')->find($id);
        
        if (!$sanPham || $sanPham->status != 1) {
            abort(404);
        }
        
        return view('sanpham.chitiet', compact('sanPham'));
    }

    // Câu 5: Tìm kiếm cây cảnh
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        
        $query = SanPham::where('status', 1);
        
        // Tìm trong tên sản phẩm
        if ($keyword) {
            $query->where('ten_san_pham', 'LIKE', "%{$keyword}%");
        }
        
        // Lọc dễ chăm sóc
        if ($request->has('care') && $request->care == 'de') {
            $query->where('do_kho', 'LIKE', '%Dễ%');
        }
        
        // Lọc chịu bóng râm
        if ($request->has('light') && $request->light == 'bong_ram') {
            $query->where(function($q) {
                $q->where('yeu_cau_anh_sang', 'LIKE', '%râm%')
                  ->orWhere('yeu_cau_anh_sang', 'LIKE', '%bóng%')
                  ->orWhere('yeu_cau_anh_sang', 'LIKE', '%Chịu được bóng râm%');
            });
        }
        
        // Sắp xếp theo giá
        if ($request->has('sort')) {
            if ($request->sort == 'asc') {
                $query->orderBy('gia_ban', 'asc');
            } elseif ($request->sort == 'desc') {
                $query->orderBy('gia_ban', 'desc');
            }
        }
        
        $ketQua = $query->get();
        $categories = DanhMuc::all();
        
        return view('sanpham.timkiem', compact('ketQua', 'keyword', 'categories'));
    }   
}