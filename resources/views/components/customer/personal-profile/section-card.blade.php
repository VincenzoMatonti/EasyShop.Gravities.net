<div class="card shadow-sm mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            @if($icon)
            <span class="me-2">{{ $icon }}</span>
            @endif
            {{ $title }}
        </h5>
        @isset($actions)
        {{ $actions }}
        @endisset
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>