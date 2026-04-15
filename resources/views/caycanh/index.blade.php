<x-cay-canh-layout>
    <x-slot name="title">
        Cây cảnh
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

        <a class="btn btn-danger btn-sm"
           href="{{ route('home') }}"> Reset
        </a>
    </div>

    <div class="list-cay-canh">

        @if(isset($products) && count($products) > 0)

            @foreach($products as $p)
                <div class="cay-canh">
                    <img src="{{ asset('storage/image/'.$p->hinh_anh) }}" alt="{{ $p->ten_san_pham }}">

                    <div class="thong-tin">
                        <h6 class="ten-sp">
                            {{ $p->ten_san_pham }}
                        </h6>

                        <p class="gia-sp">
                            {{ number_format($p->gia_ban) }} VND
                        </p>
                    </div>
                </div>
            @endforeach

        @else
            <p>Không có sản phẩm</p>
        @endif

    </div>

    <style>
        /* Container danh sách */
        .list-cay-canh {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            align-items: stretch; /* Ép tất cả các thẻ trong 1 hàng có chiều cao bằng nhau */
        }

        /* Thẻ sản phẩm */
        .cay-canh {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            background: white;
            display: flex;            /* Biến thẻ thành flexbox */
            flex-direction: column;   /* Xếp ảnh và chữ theo chiều dọc */
            height: 100%;             /* Chiều cao phủ kín không gian grid */
        }

        /* Hình ảnh */
        .cay-canh img {
            width: 100%;
            height: 220px;       /* Cố định chiều cao ảnh để đều nhau */
            object-fit: cover;   /* Giúp ảnh bao phủ toàn bộ vùng height mà không bị méo */
        }

        /* Khu vực chứa tên và giá */
        .thong-tin {
            padding: 15px 10px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;        /* Chiếm toàn bộ khoảng trống còn lại bên dưới ảnh */
        }

        /* Tên sản phẩm */
        .ten-sp {
            font-weight: bold;   /* In đậm tên sản phẩm */
            font-size: 15px;
            line-height: 1.4;
            color: #333;
            margin-bottom: 1px; 
        }

        /* Giá sản phẩm */
        .gia-sp {
            color: red;
            font-weight: bold;
            font-size: 16px;
            margin-top: auto;   
            margin-bottom: 0;
        }
    </style>

</x-cay-canh-layout>