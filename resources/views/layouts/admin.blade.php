<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">

    {{-- Sidebar --}}
    @include('profile.partials.sidebar')

    <div class="flex-grow-1">

        {{-- Header --}}
        @include('profile.partials.header')

        <div class="p-4">
            @yield('content')
        </div>

    </div>
</div>

</body>
</html>
