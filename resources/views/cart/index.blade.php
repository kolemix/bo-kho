<x-cay-canh-layout :title="'Giỏ hàng'" :categories="$categories">
    <div class="container mt-4">
        
        <h2 class="mb-4 text-custom-blue text-center">DANH SÁCH SẢN PHẨM</h2>

        <table class="table table-bordered w-100">
            <thead>
                <tr>
                    <th class="font-weight-bold text-dark">STT</th>
                    <th class="font-weight-bold text-dark">Tên sản phẩm</th>
                    <th class="font-weight-bold text-dark">Số lượng</th>
                    <th class="font-weight-bold text-dark">Đơn giá</th>
                    <th class="font-weight-bold text-dark">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cart as $index => $item)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['price'], 0, ',', '.') }} đ</td>
                        <td>
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Giỏ hàng trống</td>
                    </tr>
                @endforelse

                {{-- Hàng tổng cộng --}}
                <tr>
                    <td colspan="3" class="text-center font-weight-bold">Tổng cộng</td>
                    <td class="font-weight-bold">
                        {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']), 0, ',', '.') }} đ
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        {{-- Hình thức thanh toán --}}
        <div class="text-center mb-3">
            <label for="payment" class="font-weight-bold">Hình thức thanh toán</label><br>
            <select id="payment" class="form-control w-auto d-inline-block mt-2">
                <option value="cash">Tiền mặt</option>
                <option value="bank">Chuyển khoản</option>
            </select>
        </div>

        {{-- Nút đặt hàng --}}
        <div class="text-center">
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-custom-blue">ĐẶT HÀNG</button>
            </form>
        </div>

        {{-- Hiển thị thông báo --}}
        @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
        @endif

    </div>
</x-cay-canh-layout>

<style>
    .text-custom-blue {
        color: #0066cc; 
        font-weight: bold;
    }
    .btn-custom-blue {
        background-color: #0066cc; /* xanh biển hơi đậm */
        color: #fff;              /* chữ trắng */
        font-weight: bold;
    }
    .btn-custom-blue:hover {
        background-color: #005bb5; /* xanh đậm hơn khi hover */
        color: #fff;
    }
</style>
