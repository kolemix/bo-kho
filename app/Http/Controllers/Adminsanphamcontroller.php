<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AdminSanPhamController extends Controller
{
    public function index()
    {
        $sanPhams = SanPham::where('status', 1)->get();
        return view('admin.san_pham.index', compact('sanPhams'));
    }

    public function show($id)
    {
        return redirect()->route('san-pham.show', $id);
    }

    public function destroy($id)
    {
        $sanPham = SanPham::findOrFail($id);
        $sanPham->update(['status' => 0]);
        return redirect()->route('admin.san-pham.index')->with('success', 'Xóa sản phẩm thành công!');
    }

    public function create()
    {
        $danhMucs = DanhMuc::all();
        return view('admin.san_pham.create', compact('danhMucs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => [
                'required',
                'max:50',
                'regex:/^[0-9]+$/',
                Rule::unique('san_pham', 'code')->where(function ($query) {
                    return $query->where('status', 1);
                }),
            ],
            'ten_san_pham' => 'required|max:255',
            'gia_ban'      => 'required|numeric|min:0|max:99999999.99',
            'hinh_anh'     => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ], [
            'code.required'         => 'Vui lòng nhập mã sản phẩm.',
            'code.unique'           => 'Mã sản phẩm đã tồn tại.',
            'code.regex'            => 'Mã sản phẩm chỉ được chứa số.',
            'ten_san_pham.required' => 'Vui lòng nhập tên sản phẩm.',
            'gia_ban.required'      => 'Vui lòng nhập giá bán.',
            'gia_ban.numeric'       => 'Giá bán phải là số.',
            'gia_ban.max'           => 'Giá bán không được vượt quá 99,999,999 VNĐ.',
            'hinh_anh.image'        => 'File phải là hình ảnh.',
            'hinh_anh.mimes'        => 'Ảnh phải có định dạng: jpg, jpeg, png, webp, gif.',
            'hinh_anh.max'          => 'Ảnh không được vượt quá 2MB.',
        ]);

        // Xử lý ảnh
        $tenHinhAnh = null;
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $extension = $file->getClientOriginalExtension();
            $tenHinhAnh = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $extension;
            $file->move(public_path('storage/image'), $tenHinhAnh);
        }

        $sanPham = SanPham::create([
            'code'              => $request->code,
            'ten_san_pham'      => $request->ten_san_pham,
            'gia_ban'           => $request->gia_ban,
            'hinh_anh'          => $tenHinhAnh,
            'mo_ta'             => $request->mo_ta,
            'ten_khoa_hoc'      => $request->ten_khoa_hoc,
            'ten_thong_thuong'  => $request->ten_thong_thuong,
            'quy_cach_san_pham' => $request->quy_cach_san_pham,
            'do_kho'            => $request->do_kho,
            'yeu_cau_anh_sang'  => $request->yeu_cau_anh_sang,
            'nhu_cau_nuoc'      => $request->nhu_cau_nuoc,
            'status'            => 1,
        ]);

        if ($request->filled('danh_muc')) {
            $sanPham->danhMucs()->attach($request->danh_muc);
        }

        return redirect()->route('admin.san-pham.index')->with('success', 'Thêm sản phẩm thành công!');
    }
}