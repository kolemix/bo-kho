<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMuc;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = SanPham::where('status', 1);
        
        // Lọc theo danh mục
        if ($request->has('category_id') && $request->category_id) {
            $query->whereHas('danhMucs', function($q) use ($request) {
                $q->where('id_danh_muc', $request->category_id);
            });
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

        // Mặc định 20 sản phẩm
        if (!$request->hasAny(['category_id', 'care', 'light', 'sort'])) {
            $products = $query->limit(20)->get();
        } else {
            $products = $query->get();
        }

        $categories = DanhMuc::all();
        
        return view("caycanh.index", compact('products', 'categories'));
    }

    public function filterByCategory($id)
    {
        return redirect()->route('home', ['category_id' => $id]);
    }
}