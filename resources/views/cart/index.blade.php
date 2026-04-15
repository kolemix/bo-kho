<x-cay-canh-layout>
    <x-slot name="title">
        Giỏ hàng
    </x-slot>

    <div class="container mt-4">
        <h3 style="color: #2f5d3a;">🛒 Giỏ hàng của bạn</h3>

        {{-- Thông báo --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        @if(empty($cart))
            <div class="text-center py-5">
                <p class="text-muted">🛒 Giỏ hàng trống.</p>
                <a href="{{ url('/') }}" class="btn btn-success">
                    ← Tiếp tục mua sắm
                </a>
            </div>
        @else
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $total = 0; 
                            $stt = 1;
                        @endphp
                        
                        @foreach($cart as $id => $item)
                            @php 
                                $thanhTien = $item['gia_ban'] * $item['so_luong'];
                                $total += $thanhTien;
                            @endphp
                            <tr>
                                <td>{{ $stt++ }}</td>
                                <td>
                                    @if(isset($item['hinh_anh']) && $item['hinh_anh'])
                                        <img src="{{ asset('storage/image/' . $item['hinh_anh']) }}" 
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $item['ten_san_pham'] }}</td>
                                <td>{{ $item['so_luong'] }}</td>
                                <td>{{ number_format($item['gia_ban'], 0, ',', '.') }} đ</td>
                                <td>{{ number_format($thanhTien, 0, ',', '.') }} đ</td>
                                <td>
                                    <a href="{{ route('cart.remove', $id) }}" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Xóa sản phẩm này khỏi giỏ hàng?')">
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-right">Tổng cộng:</th>
                            <th>{{ number_format($total, 0, ',', '.') }} đ</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                    ← Tiếp tục mua sắm
                </a>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="btn btn-success"
                            onclick="return confirm('Xác nhận đặt hàng?')">
                        ✅ Đặt hàng
                    </button>
                </form>
            </div>
        @endif
    </div>
</x-cay-canh-layout>