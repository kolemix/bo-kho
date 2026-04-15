<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class AdminSanPhamController extends Controller
{
    // Câu 7 - Danh sách (chỉ status = 1, lấy tất cả)
    public function index()
    {
        $sanPhams = SanPham::where('status', 1)->get(); // Đã sửa thành get()
        return view('admin.san_pham.index', compact('sanPhams'));
    }

    // Câu 7 - Chi tiết
   public function show($id)
{
    // Redirect đến trang chi tiết frontend
    return redirect()->route('san-pham.show', $id);
}

    // Câu 7 - Xóa mềm
    public function destroy($id)
    {
        $sanPham = SanPham::findOrFail($id);
        $sanPham->update(['status' => 0]);

        return redirect()->route('admin.san-pham.index')
            ->with('success', 'Xóa sản phẩm thành công!');
    }

    // Câu 8 - Form thêm
    public function create()
    {
        $danhMucs = DanhMuc::all();
        return view('admin.san_pham.create', compact('danhMucs'));
    }

    // Câu 8 - Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'code'         => 'required|unique:san_pham,code|max:50',
            'ten_san_pham' => 'required|max:255',
            'gia_ban'      => 'required|numeric|min:0',
            'hinh_anh'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'code.required'         => 'Vui lòng nhập mã sản phẩm.',
            'code.unique'           => 'Mã sản phẩm đã tồn tại.',
            'ten_san_pham.required' => 'Vui lòng nhập tên sản phẩm.',
            'gia_ban.required'      => 'Vui lòng nhập giá bán.',
            'gia_ban.numeric'       => 'Giá bán phải là số.',
            'hinh_anh.image'        => 'File phải là hình ảnh.',
            'hinh_anh.max'          => 'Ảnh không được vượt quá 2MB.',
        ]);

        // Xử lý ảnh
        $tenHinhAnh = null;
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $tenHinhAnh = $file->getClientOriginalName();
            $file->storeAs('public/image', $tenHinhAnh);
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

        // Gắn danh mục
        if ($request->filled('danh_muc')) {
            $sanPham->danhMucs()->attach($request->danh_muc);
        }

        return redirect()->route('admin.san-pham.index')
            ->with('success', 'Thêm sản phẩm thành công!');
    }
}