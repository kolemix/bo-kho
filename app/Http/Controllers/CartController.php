<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        $categories = Category::all();

        return view('cart.index', compact('cart', 'categories'));
    }

    // Thêm vào giỏ hàng
    public function add(Request $request)
    {
        $id = $request->input('id_san_pham');
        $so_luong = $request->input('so_luong', 1);
        
        // Lấy thông tin cây cảnh từ database
        $sanPham = DB::table('san_pham')->where('id', $id)->first();
        
        if (!$sanPham) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
        }

        // Lấy giỏ hàng hiện tại từ session
        $cart = session()->get('cart', []);

        // Nếu đã có trong giỏ thì cộng dồn số lượng
        if (isset($cart[$id])) {
            $cart[$id]['so_luong'] += $so_luong;
        } else {
            // Nếu chưa có thì thêm mới
            $cart[$id] = [
                "id" => $sanPham->id,
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

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

    // Đặt hàng
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        // Nếu cần thì xử lý logic lưu đơn hàng vào DB ở đây

        // Xóa giỏ hàng khỏi session
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Đặt hàng thành công!');
    }
}