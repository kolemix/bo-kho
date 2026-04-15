<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>{{ $sanPham->ten_san_pham }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

{{-- Navbar với giỏ hàng --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="/">🌿 Cây Cảnh</a>
        <a href="#" class="btn btn-outline-light ms-auto">
            🛒 Giỏ hàng
            <span class="badge bg-danger">
                {{ array_sum(array_column(session('gio_hang', []), 'so_luong')) }}
            </span>
        </a>
    </div>
</nav>

<div class="container mt-4">

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        {{-- Ảnh sản phẩm --}}
        <div class="col-md-5">
            <img src="{{ asset('storage/image/' . $sanPham->hinh_anh) }}"
                 class="img-fluid rounded shadow" alt="{{ $sanPham->ten_san_pham }}">
        </div>

        {{-- Thông tin chi tiết --}}
        <div class="col-md-7">
            <h2>{{ $sanPham->ten_san_pham }}</h2>
            <h4 class="text-success">{{ number_format($sanPham->gia, 0, ',', '.') }} đ</h4>
            <hr>

            <table class="table table-bordered">
                <tr><th>Tên khoa học</th><td>{{ $sanPham->ten_khoa_hoc ?? '—' }}</td></tr>
                <tr><th>Tên gọi khác</th><td>{{ $sanPham->ten_goi_khac ?? '—' }}</td></tr>
                <tr><th>Kích thước</th><td>{{ $sanPham->kich_thuoc ?? '—' }}</td></tr>
                <tr><th>Độ khó chăm sóc</th><td>{{ $sanPham->do_kho_cham_soc ?? '—' }}</td></tr>
                <tr><th>Yêu cầu ánh sáng</th><td>{{ $sanPham->yeu_cau_anh_sang ?? '—' }}</td></tr>
                <tr><th>Tưới nước</th><td>{{ $sanPham->tuoi_nuoc ?? '—' }}</td></tr>
            </table>

            <p>{{ $sanPham->mo_ta }}</p>

            {{-- Form thêm vào giỏ hàng --}}
            <form action="{{ route('gio-hang.them') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $sanPham->id }}">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <label class="fw-bold">Số lượng:</label>
                    <input type="number" name="so_luong" value="1" min="1" class="form-control w-25">
                </div>
                <button type="submit" class="btn btn-success btn-lg">
                    🛒 Thêm vào giỏ hàng
                </button>
                <a href="/" class="btn btn-outline-secondary btn-lg ms-2">← Quay lại</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>