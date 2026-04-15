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
