<x-cay-canh-layout>
    <x-slot name="title">
        {{ $sanPham->ten_san_pham }}
    </x-slot>

    <div class="container mt-4">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active">{{ $sanPham->ten_san_pham }}</li>
            </ol>
        </nav>

        {{-- Thông báo --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <div class="row mt-3">
            {{-- Ảnh sản phẩm --}}
            <div class="col-md-5">
                @if($sanPham->hinh_anh)
                    <img src="{{ asset('storage/image/' . $sanPham->hinh_anh) }}" 
                         class="img-fluid rounded shadow" 
                         alt="{{ $sanPham->ten_san_pham }}">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                         style="height: 350px;">
                        <span class="text-muted">Chưa có ảnh</span>
                    </div>
                @endif
            </div>

            {{-- Thông tin chi tiết --}}
            <div class="col-md-7">
                <h2>{{ $sanPham->ten_san_pham }}</h2>
                
                {{-- Danh mục --}}
                <div class="mb-3">
                    @foreach($sanPham->danhMucs as $dm)
                        <span class="badge badge-success mr-1">{{ $dm->ten_danh_muc }}</span>
                    @endforeach
                </div>

                <h4 class="text-danger fst-italic mb-3">
                    {{ number_format($sanPham->gia_ban, 0, ',', '.') }} VNĐ
                </h4>
                
                <hr>

                <table class="table table-bordered">
                    <tr>
                        <th style="width: 180px; background: #f8f9fa;">Tên khoa học</th>
                        <td><i>{{ $sanPham->ten_khoa_hoc ?? '—' }}</i></td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Tên thông thường</th>
                        <td>{{ $sanPham->ten_thong_thuong ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Quy cách</th>
                        <td>{!! nl2br(e($sanPham->quy_cach_san_pham ?? '—')) !!}</td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Độ khó chăm sóc</th>
                        <td>{{ $sanPham->do_kho ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Yêu cầu ánh sáng</th>
                        <td>{{ $sanPham->yeu_cau_anh_sang ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Nhu cầu nước</th>
                        <td>{{ $sanPham->nhu_cau_nuoc ?? '—' }}</td>
                    </tr>
                </table>

                <p><strong>Mô tả:</strong> {{ $sanPham->mo_ta ?? 'Đang cập nhật...' }}</p>

                {{-- Form thêm vào giỏ hàng --}}
                <form action="{{ route('cart.add') }}" method="POST" class="mt-4 p-3 bg-light rounded">
                    @csrf
                    <input type="hidden" name="id_san_pham" value="{{ $sanPham->id }}">
                    
                    <div class="form-group">
                        <label class="fw-bold">Số lượng:</label>
                        <input type="number" name="so_luong" value="1" min="1" class="form-control w-25">
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-lg mt-3">
                        🛒 Thêm vào giỏ hàng
                    </button>
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-lg mt-3 ms-2">
                        ← Quay lại
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-cay-canh-layout>