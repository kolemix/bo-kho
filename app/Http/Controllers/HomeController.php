<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            QUẢN LÝ SẢN PHẨM
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Quản lý sản phẩm</h3>
            <a href="{{ route('admin.san-pham.create') }}" class="btn btn-success">
                + Thêm sản phẩm
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table id="tableSanPham" class="table table-striped table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Tên khoa học</th>
                            <th>Tên thông thường</th>
                            <th>Độ khó</th>
                            <th>Yêu cầu ánh sáng</th>
                            <th>Nhu cầu nước</th>
                            <th>Giá bán</th>
                            <th class="text-center">Ảnh</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sanPhams as $sp)
                        <tr>
                            <td>{{ $sp->ten_san_pham }}</td>
                            <td>{{ $sp->ten_khoa_hoc ?? '-' }}</td>
                            <td>{{ $sp->ten_thong_thuong ?? '-' }}</td>
                            <td>{{ $sp->do_kho ?? '-' }}</td>
                            <td>{{ $sp->yeu_cau_anh_sang ?? '-' }}</td>
                            <td>{{ $sp->nhu_cau_nuoc ?? '-' }}</td>
                            <td>{{ number_format($sp->gia_ban, 0, ',', '.') }} đ</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/image/' . $sp->hinh_anh) }}"
                                     alt="{{ $sp->ten_san_pham }}"
                                     class="img-thumbnail"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.san-pham.show', $sp->id) }}"
                                   class="btn btn-primary btn-sm">Xem</a>
                                <form action="{{ route('admin.san-pham.destroy', $sp->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"
                                            class="btn btn-danger btn-sm">
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

    {{-- Bootstrap + DataTables --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tableSanPham').DataTable({
                pageLength: 10,
                searching: true,
                ordering: true,
                language: {
                    search: "Tìm kiếm cây cảnh:",
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
</x-app-layout>
