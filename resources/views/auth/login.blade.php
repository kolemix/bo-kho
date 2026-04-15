<x-cay-canh-layout :title="'Đăng nhập tài khoản'">
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
                        Đăng nhập tài khoản
                    </div>

                    <div class="card-body">
                        <!-- Hiển thị trạng thái session -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Địa chỉ Email</label>
                                <input id="email" type="email" class="form-control" name="email"
                                       :value="old('email')" required autofocus autocomplete="username">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Mật khẩu -->
                            <div class="form-group mt-3">
                                <label for="password">Mật khẩu</label>
                                <input id="password" type="password" class="form-control" name="password"
                                       required autocomplete="current-password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Ghi nhớ đăng nhập -->
                            <div class="form-group mt-3">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox"
                                           class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500"
                                           name="remember">
                                    <span class="ms-2 text-sm text-gray-600">Ghi nhớ đăng nhập</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-between mt-4">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                       href="{{ route('password.request') }}">
                                        Quên mật khẩu?
                                    </a>
                                @endif

                                <button type="submit" class="btn btn-custom-green">
                                    Đăng nhập
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
        color: #228B22;
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
