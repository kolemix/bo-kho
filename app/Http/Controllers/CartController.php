<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // nhớ import model Category

class CartController extends Controller
{
    public function index()
    {
        // Lấy giỏ hàng thực tế từ session
        $cart = session()->get('cart', []);
        $categories = Category::all();

        return view('cart.index', compact('cart', 'categories'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $index => $item) {
            if ($item['id'] == $id) {
                unset($cart[$index]);
                break;
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

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
