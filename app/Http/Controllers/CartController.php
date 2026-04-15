<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Request $request) {
        $id = $request->input('id_san_pham');
        $so_luong = $request->input('so_luong');
        
        // Lấy thông tin cây cảnh từ database
        $sanPham = DB::table('san_pham')->where('id', $id)->first();

        // Lấy giỏ hàng hiện tại từ session
        $cart = session()->get('cart', []);

        // Nếu đã có trong giỏ thì cộng dồn số lượng
        if(isset($cart[$id])) {
            $cart[$id]['so_luong'] += $so_luong;
        } else {
            // Nếu chưa có thì thêm mới
            $cart[$id] = [
                "ten_san_pham" => $sanPham->ten_san_pham,
                "so_luong" => $so_luong,
                "gia_ban" => $sanPham->gia_ban,
                "hinh_anh" => $sanPham->hinh_anh
            ];
        }
        
        // Lưu lại vào session
        session()->put('cart', $cart);
        
        // Quay lại trang trước đó
        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }
}