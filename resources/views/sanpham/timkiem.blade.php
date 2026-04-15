<div class="container mt-5">
    <h2>Kết quả tìm kiếm cho từ khóa: <span class="text-primary">"{{ $keyword }}"</span></h2>

    <div class="row list-cay-canh mt-4">
        
        @if($ketQua->isEmpty())
            <div class="col-12">
                <p class="text-danger">Không tìm thấy cây cảnh nào phù hợp với từ khóa của bạn!</p>
            </div>
        @else
            @foreach($ketQua as $sp)
                <div class="col-md-3 col-sm-6 mb-4 cay-canh">
                    <div class="card h-100 shadow-sm cay-canh-info">
                        
                        <img src="{{ asset('storage/image/' . $sp->hinh_anh) }}" 
                             class="card-img-top" 
                             alt="{{ $sp->ten_san_pham }}" 
                             style="height: 200px; object-fit: cover;">
                        
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $sp->ten_san_pham }}</h5>
                            <p class="card-text text-danger fw-bold fst-italic">
                                {{ number_format($sp->gia_ban, 0, ',', '.') }} VNĐ
                            </p>
                            <a href="{{ route('san-pham.show', $sp->id) }}" class="btn btn-outline-success btn-sm">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>