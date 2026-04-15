<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = DB::table('san_pham');

        // 👉 lọc theo danh mục (QUAN TRỌNG)
        if ($request->category_id) {
            $query->join('sanpham_danhmuc', 'san_pham.id', '=', 'sanpham_danhmuc.id_san_pham')
                ->where('sanpham_danhmuc.id_danh_muc', $request->category_id);
        }

        // 👉 lọc dễ chăm
        if ($request->care == 'de') {
            $query->where('do_kho', 'LIKE', '%dễ%');
        }


        // 👉 lọc bóng râm
        if ($request->light == 'bong_ram') {
            $query->where(function($q) {
                $q->where('yeu_cau_anh_sang', 'LIKE', '%râm%')
                ->orWhere('yeu_cau_anh_sang', 'LIKE', '%bóng%')
                ->orWhere('yeu_cau_anh_sang', 'LIKE', '%thiếu sáng%');
            });
        }


        // 👉 sort giá
        if ($request->sort == 'asc') {
            $query->orderBy('gia_ban', 'asc');
        } elseif ($request->sort == 'desc') {
            $query->orderBy('gia_ban', 'desc');
        }

        // 👉 mặc định 20 sản phẩm
        if (!$request->hasAny(['category_id','care','light','sort'])) {
            $products = $query->limit(20)->get();
        } else {
            $products = $query->get();
        }

        return view("caycanh.index", compact('products'));
    }


}
