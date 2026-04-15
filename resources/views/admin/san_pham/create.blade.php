<x-cay-canh-layout>
    <x-slot name="title">
        Thêm sản phẩm
    </x-slot>

    <div class="container mt-4" style="max-width: 600px;">
        <h3 class="text-center mb-4" style="color: #0066cc; font-weight: bold;">THÊM</h3>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.san-pham.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label style="font-weight: bold;">- Mã sản phẩm</label>
                <input type="text" name="code" class="form-control" value="{{ old('code') }}" required oninput="this.value=this.value.replace(/[^0-9]/g,'')">
            </div>

            <div class="form-group">
                <label style="font-weight: bold;">- Tên sản phẩm</label>
                <input type="text" name="ten_san_pham" class="form-control" value="{{ old('ten_san_pham') }}" required>
            </div>

            <div class="form-group">
                <label style="font-weight: bold;">- Tên khoa học</label>
                <input type="text" name="ten_khoa_hoc" class="form-control" value="{{ old('ten_khoa_hoc') }}">
            </div>

            <div class="form-group">
                <label style="font-weight: bold;">- Tên thông thường</label>
                <input type="text" name="ten_thong_thuong" class="form-control" value="{{ old('ten_thong_thuong') }}">
            </div>

            <div class="form-group">
                <label style="font-weight: bold;">- Mô tả</label>
                <textarea name="mo_ta" class="form-control" rows="3">{{ old('mo_ta') }}</textarea>
            </div>

            <div class="form-group">
                <label style="font-weight: bold;">- Độ khó</label>
                <select name="do_kho" class="form-control">
                    <option value="">-- Chọn --</option>
                    <option value="Dễ chăm sóc" {{ old('do_kho') == 'Dễ chăm sóc' ? 'selected' : '' }}>Dễ chăm sóc</option>
                    <option value="Trung bình" {{ old('do_kho') == 'Trung bình' ? 'selected' : '' }}>Trung bình</option>
                    <option value="Khó chăm sóc" {{ old('do_kho') == 'Khó chăm sóc' ? 'selected' : '' }}>Khó chăm sóc</option>
                    <option value="Rất dễ chăm sóc" {{ old('do_kho') == 'Rất dễ chăm sóc' ? 'selected' : '' }}>Rất dễ chăm sóc</option>
                    <option value="Vừa phải" {{ old('do_kho') == 'Vừa phải' ? 'selected' : '' }}>Vừa phải</option>
                </select>
            </div>

            <div class="form-group">
                <label style="font-weight: bold;">- Yêu cầu ánh sáng</label>
                <select name="yeu_cau_anh_sang" class="form-control">
                    <option value="">-- Chọn --</option>
                    <option value="Ánh sáng tán xạ" {{ old('yeu_cau_anh_sang') == 'Ánh sáng tán xạ' ? 'selected' : '' }}>Ánh sáng tán xạ</option>
                    <option value="Nắng tán xạ" {{ old('yeu_cau_anh_sang') == 'Nắng tán xạ' ? 'selected' : '' }}>Nắng tán xạ</option>
                    <option value="Nắng trực tiếp" {{ old('yeu_cau_anh_sang') == 'Nắng trực tiếp' ? 'selected' : '' }}>Nắng trực tiếp</option>
                    <option value="Chịu được bóng râm" {{ old('yeu_cau_anh_sang') == 'Chịu được bóng râm' ? 'selected' : '' }}>Chịu được bóng râm</option>
                    <option value="Nắng tán xạ, chịu được nắng trực tiếp" {{ old('yeu_cau_anh_sang') == 'Nắng tán xạ, chịu được nắng trực tiếp' ? 'selected' : '' }}>Nắng tán xạ, chịu được nắng trực tiếp</option>
                </select>
            </div>

            <div class="form-group">
                <label style="font-weight: bold;">- Nhu cầu nước</label>
                <select name="nhu_cau_nuoc" class="form-control">
                    <option value="">-- Chọn --</option>
                    <option value="Tưới nước 2-3 lần/tuần" {{ old('nhu_cau_nuoc') == 'Tưới nước 2-3 lần/tuần' ? 'selected' : '' }}>Tưới nước 2-3 lần/tuần</option>
                    <option value="Ít nước, 2-3 lần/tuần" {{ old('nhu_cau_nuoc') == 'Ít nước, 2-3 lần/tuần' ? 'selected' : '' }}>Ít nước, 2-3 lần/tuần</option>
                    <option value="Tưới nước hằng ngày" {{ old('nhu_cau_nuoc') == 'Tưới nước hằng ngày' ? 'selected' : '' }}>Tưới nước hằng ngày</option>
                    <option value="Thay nước 2-3 lần/tháng" {{ old('nhu_cau_nuoc') == 'Thay nước 2-3 lần/tháng' ? 'selected' : '' }}>Thay nước 2-3 lần/tháng</option>
                </select>
            </div>

            <div class="form-group">
                <label style="font-weight: bold;">- Giá bán (tối đa 99,999,999 VNĐ)</label>
                <input type="number" step="0.01" name="gia_ban" class="form-control" value="{{ old('gia_ban', 0) }}" required max="99999999.99">
            </div>

            <div class="form-group">
                <label style="font-weight: bold;">- Danh mục</label>
                <select name="danh_muc[]" class="form-control" multiple size="4">
                    @foreach($danhMucs as $dm)
                        <option value="{{ $dm->id }}" {{ in_array($dm->id, old('danh_muc', [])) ? 'selected' : '' }}>
                            {{ $dm->ten_danh_muc }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Giữ Ctrl để chọn nhiều</small>
            </div>

            <div class="form-group">
                <label style="font-weight: bold;">- Ảnh</label>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <button type="button" class="btn btn-light border" onclick="document.getElementById('hinh_anh').click();">
                        Browse...
                    </button>
                    <span id="file-name" class="text-muted">No file selected.</span>
                    <input type="file" id="hinh_anh" name="hinh_anh" accept="image/*" style="display: none;">
                </div>
                <small class="text-muted">Chấp nhận: jpg, jpeg, png, webp, gif (tối đa 2MB)</small>
                <div id="image-preview" style="margin-top: 10px; display: none;">
                    <img id="preview" src="#" style="max-width: 200px; border: 1px solid #ddd; padding: 5px;">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{ route('admin.san-pham.index') }}" class="btn btn-secondary ml-2">Hủy</a>
            </div>
        </form>
    </div>

    <script>
        // Chặn nhập chữ vào mã sản phẩm
        document.querySelector('input[name="code"]').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Preview ảnh
        document.getElementById('hinh_anh').addEventListener('change', function(e) {
            var file = e.target.files[0];
            var fileName = file ? file.name : 'No file selected.';
            document.getElementById('file-name').textContent = fileName;
            
            var previewDiv = document.getElementById('image-preview');
            var previewImg = document.getElementById('preview');
            
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewDiv.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewDiv.style.display = 'none';
            }
        });
    </script>
</x-cay-canh-layout>