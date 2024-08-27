<div class="content-flude">
    <div class="card">
        <div class="card-header">{{ $header ?? '' }}</div>
        <div class="card-body">
            @yield('content')
        </div>
        <div class="card-footer">
            @yield('footer-buttons')
        </div>
    </div>
</div>