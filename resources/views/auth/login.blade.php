@extends('layouts.client')

@section('content')

<div class="container" style="max-width: 420px; margin-top: 80px;">

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <h3 class="text-center mb-4 fw-bold">
                Đăng nhập
            </h3>

            <!-- ERROR -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="{{ route('dangnhap') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           required autofocus>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           required>
                </div>

                <!-- Remember -->
                <div class="mb-3 form-check">
                    <input type="checkbox"
                           name="remember"
                           class="form-check-input">
                    <label class="form-check-label">
                        Ghi nhớ đăng nhập
                    </label>
                </div>

                <button class="btn btn-dark w-100">
                    Đăng nhập
                </button>

            </form>

            <div class="text-center mt-3">
                <a href="#">Quên mật khẩu?</a>
            </div>

        </div>
    </div>

</div>

@endsection
