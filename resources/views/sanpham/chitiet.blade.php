<div class="container mt-5">
    <h2>Chi tiết cây cảnh</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mt-4">
        <div class="col-md-5">
            <img src="{{ asset('storage/image/' . $sanPham->hinh_anh) }}" 
                 class="img-fluid rounded shadow" 
                 alt="{{ $sanPham->ten_san_pham }}">
        </div>
        <div class="col-md-7">
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="id_san_pham" value="{{ $sanPham->id }}">
                
                <h3>{{ $sanPham->ten_san_pham }}</h3>
                <p><strong>Mô tả:</strong> {{ $sanPham->mo_ta ?? 'Đang cập nhật...' }}</p>
                
                <h4 class="text-danger fst-italic">
                    Giá: {{ number_format($sanPham->gia_ban, 0, ',', '.') }} VNĐ
                </h4>
                
                <div class="form-group mt-3">
                    <label><strong>Số lượng mua:</strong></label>
                    <input type="number" name="so_luong" class="form-control w-25" value="1" min="1">
                </div>
                
                <button type="submit" class="btn btn-primary mt-3 shadow">Thêm vào giỏ hàng</button>
            </form>
        </div>
    </div>
</div>