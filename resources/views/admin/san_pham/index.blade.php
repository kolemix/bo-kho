<x-cay-canh-layout>
    <x-slot name="title">
        Quản lý sản phẩm
    </x-slot>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 style="color: #2f5d3a;">Danh sách sản phẩm</h3>
            <a href="{{ route('admin.san-pham.create') }}" class="btn btn-success">
                + Thêm sản phẩm
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tableSanPham" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Tên khoa học</th>
                                <th>Độ khó</th>
                                <th>Giá bán</th>
                                <th class="text-center">Ảnh</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sanPhams as $sp)
                            <tr>
                                <td>{{ $sp->id }}</td>
                                <td>{{ $sp->ten_san_pham }}</td>
                                <td>{{ $sp->ten_khoa_hoc ?? '-' }}</td>
                                <td>{{ $sp->do_kho ?? '-' }}</td>
                                <td>{{ number_format($sp->gia_ban, 0, ',', '.') }} đ</td>
                                <td class="text-center">
                                    @if($sp->hinh_anh)
                                        <img src="{{ asset('storage/image/' . $sp->hinh_anh) }}" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{-- Nút Xem -> chuyển đến trang chi tiết frontend --}}
                                    <a href="{{ route('san-pham.show', $sp->id) }}" 
                                       class="btn btn-sm btn-primary" 
                                       target="_blank">
                                        Xem
                                    </a>
                                    
                                    {{-- Nút Xóa --}}
                                    <form action="{{ route('admin.san-pham.destroy', $sp->id) }}" 
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Xóa sản phẩm này?')"
                                                class="btn btn-sm btn-danger">
                                            Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#tableSanPham').DataTable({
                pageLength: 10,
                language: {
                    search: "Tìm kiếm:",
                    lengthMenu: "Hiển thị _MENU_ sản phẩm",
                    info: "Hiển thị _START_ đến _END_ trong tổng _TOTAL_ sản phẩm",
                    paginate: {
                        first: "Đầu",
                        last: "Cuối",
                        next: "Sau",
                        previous: "Trước"
                    },
                    zeroRecords: "Không tìm thấy sản phẩm"
                }
            });
        });
    </script>
</x-cay-canh-layout>