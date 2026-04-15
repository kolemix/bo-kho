<x-cay-canh-layout :title="'Đăng ký tài khoản'">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                {{-- Logo cây cảnh --}}
                <div class="text-center mb-4">
                    <h1 class="logo-text">
                        🍃 ५ꪇ <span class="flipped-leaf">🍃</span>
                    </h1>
                </div>

                <div class="card">
                    <div class="card-header text-center font-weight-bold text-custom-green">
                        Đăng ký tài khoản
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Họ và tên -->
                            <div class="form-group">
                                <label for="name">Họ và tên</label>
                                <input id="name" type="text" class="form-control" name="name"
                                       :value="old('name')" required autofocus autocomplete="name">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div class="form-group mt-3">
                                <label for="email">Địa chỉ Email</label>
                                <input id="email" type="email" class="form-control" name="email"
                                       :value="old('email')" required autocomplete="username">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Mật khẩu -->
                            <div class="form-group mt-3">
                                <label for="password">Mật khẩu</label>
                                <input id="password" type="password" class="form-control" name="password"
                                       required autocomplete="new-password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Xác nhận mật khẩu -->
                            <div class="form-group mt-3">
                                <label for="password_confirmation">Xác nhận mật khẩu</label>
                                <input id="password_confirmation" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-between mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                   href="{{ route('login') }}">
                                    Đã có tài khoản? Đăng nhập
                                </a>

                                <button type="submit" class="btn btn-custom-green">
                                    Đăng ký
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-cay-canh-layout>

<style>
    .logo-text {
        font-family: 'Brush Script MT', cursive;
        font-size: 48px;
        color: #228B22; /* xanh lá cây */
        text-shadow: 2px 2px 4px #aaa;
        letter-spacing: 2px;
    }
    .flipped-leaf {
        display: inline-block;
        transform: scaleX(-1); /* lật ngược lá bên phải */
    }
    .text-custom-green {
        color: #228B22;
        font-weight: bold;
    }
    .btn-custom-green {
        background-color: #228B22;
        color: #fff;
        font-weight: bold;
        padding: 6px 20px;
        border-radius: 4px;
    }
    .btn-custom-green:hover {
        background-color: #1e7b1e;
        color: #fff;
    }
</style>
