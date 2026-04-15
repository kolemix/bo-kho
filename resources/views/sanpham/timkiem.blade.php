<x-cay-canh-layout>
    <x-slot name="title">
        Tìm kiếm: {{ $keyword }}
    </x-slot>

    <div style="margin:15px 0; display:flex; gap:10px; flex-wrap:wrap;">
        <a class="btn {{ request('sort') == 'asc' ? 'btn-secondary' : 'btn-outline-secondary' }} btn-sm"
           href="{{ request()->fullUrlWithQuery(['sort'=>'asc']) }}">
            Giá tăng dần
        </a>

        <a class="btn {{ request('sort') == 'desc' ? 'btn-secondary' : 'btn-outline-secondary' }} btn-sm"
           href="{{ request()->fullUrlWithQuery(['sort'=>'desc']) }}">
            Giá giảm dần
        </a>

        <a class="btn {{ request('care') == 'de' ? 'btn-success' : 'btn-outline-success' }} btn-sm"
           href="{{ request()->fullUrlWithQuery(['care'=>'de']) }}">
            Dễ chăm sóc
        </a>

        <a class="btn {{ request('light') == 'bong_ram' ? 'btn-success' : 'btn-outline-success' }} btn-sm"
           href="{{ request()->fullUrlWithQuery(['light'=>'bong_ram']) }}">
            Chịu bóng râm
        </a>

        <a class="btn btn-danger btn-sm" href="{{ route('home') }}">
            Reset
        </a>
    </div>

    <h4 style="margin-bottom: 15px;">
        Kết quả tìm kiếm cho: <span style="color: #0066cc;">"{{ $keyword }}"</span>
        <small class="text-muted">({{ count($ketQua) }} sản phẩm)</small>
    </h4>

    <div class="list-cay-canh">
        @if(isset($ketQua) && count($ketQua) > 0)
            @foreach($ketQua as $p)
                <a href="{{ route('san-pham.show', $p->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="cay-canh">
                        @if($p->hinh_anh)
                            <img src="{{ asset('storage/image/'.$p->hinh_anh) }}" alt="{{ $p->ten_san_pham }}">
                        @else
                            <div style="height: 220px; background: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                                <span style="color: #999;">Chưa có ảnh</span>
                            </div>
                        @endif

                        <div class="thong-tin">
                            <h6 class="ten-sp">{{ $p->ten_san_pham }}</h6>
                            <p class="gia-sp">{{ number_format($p->gia_ban, 0, ',', '.') }} VND</p>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <p style="grid-column: 1/-1; text-align: center; color: #e74c3c;">
                Không tìm thấy cây cảnh nào phù hợp với từ khóa "{{ $keyword }}"!
            </p>
        @endif
    </div>

    <style>
        .list-cay-canh {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            align-items: stretch;
        }

        .cay-canh {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            background: white;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .cay-canh:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .cay-canh img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .thong-tin {
            padding: 15px 10px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .ten-sp {
            font-weight: bold;
            font-size: 15px;
            line-height: 1.4;
            color: #333;
            margin-bottom: 8px;
        }

        .gia-sp {
            color: #e74c3c;
            font-weight: bold;
            font-size: 16px;
            margin-top: auto;
            margin-bottom: 0;
        }
    </style>
</x-cay-canh-layout>