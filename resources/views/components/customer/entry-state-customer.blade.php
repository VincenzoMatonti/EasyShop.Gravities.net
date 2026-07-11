<div class="card shadow-lg border-0 p-4 mt-4">
    <div class="text-center mb-4">
        <h4 class="mb-2">
            La tua area cliente
        </h4>
        <p class="text-muted mb-0">
            {{ $state->profileLabel() }}
        </p>
    </div>
    <div class="row g-3">
        @if($state->showCreateProfile())
        <div class="col-12 col-md-4">
            <a href="{{ route('customer.profile.create') }}" class="btn btn-primary w-100 py-3">
                <div class="fs-4 mb-2">
                    +
                </div>
                {{ $state->createProfileLabel() }}
            </a>
        </div>
        @endif
        @if($state->showProfileSelection())
        <div class="col-12 col-md-4">
            <a href="{{ route('customer.profile.select') }}" class="btn btn-outline-primary w-100 py-3">
                <div class="fs-4 mb-2">
                    ⇄
                </div>
                Seleziona profilo
            </a>
        </div>
        @endif
        @if($state->showDashboard())
        <div class="col-12 col-md-4">
            <a href="{{ route('customer.dashboard') }}" class="btn btn-success w-100 py-3">
                <div class="fs-4 mb-2">
                    →
                </div>
                Vai alla dashboard
            </a>
        </div>
        @endif
    </div>
</div>