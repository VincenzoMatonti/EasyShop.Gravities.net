<div class="col-md-6">
    <a href="{{ $route }}" class="btn btn-outline-{{ $style }} w-100 py-4">
        <div class="fs-2">
            {{ $icon }}
        </div>
        <div>
            {{ $title }}
        </div>
        @if($description)
        <small class="d-block mt-2">
            {{ $description }}
        </small>
        @endif
    </a>
</div>