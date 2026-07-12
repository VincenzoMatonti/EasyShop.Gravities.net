<div class="text-center py-5">
    <div class="display-3 mb-3">
        {{ $icon }}
    </div>
    <h5> {{ $title }} </h5>
    @if($description)
    <p class="text-muted mb-0">
        {{ $description }}
    </p>
    @endif
    {{ $slot }}
</div>