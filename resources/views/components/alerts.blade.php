@if (session('errorAlert'))
    <div class="alert alert-danger" role="alert">
        {{ session('errorAlert') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ $successMsg }}
    </div>
@endif
