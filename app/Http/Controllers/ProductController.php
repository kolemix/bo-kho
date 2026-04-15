<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Câu 3: Hiển thị chi tiết cây cảnh
    public function show($id) {
        $sanPham = DB::table('san_pham')->where('id', $id)->first();
        // Gọi đúng file chitiet.blade.php
        return view('sanpham.chitiet', compact('sanPham'));
    }

    // Câu 5: Tìm kiếm cây cảnh
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        
        $ketQua = DB::table('san_pham')
                    ->where('ten_san_pham', 'like', '%' . $keyword . '%')
                    ->get();

        // Gọi đúng file timkiem.blade.php
        return view('sanpham.timkiem', compact('ketQua', 'keyword'));
    }   
}