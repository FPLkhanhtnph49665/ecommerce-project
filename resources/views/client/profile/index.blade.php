@extends('layouts.client')

@section('content')
<div class="container">

    <h3 class="mb-4">👤 Hồ sơ cá nhân</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <p><strong>Tên:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>

        </div>
    </div>

</div>
@endsection
