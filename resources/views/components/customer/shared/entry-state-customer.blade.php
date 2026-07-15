<div class="card shadow-lg border-0 p-4 mt-4">
    <div class="text-center mb-4">
        <h4 class="mb-2">La tua area cliente</h4>
        <p class="text-muted mb-0">{{ $state->profileLabel() }}</p>
        @if($state->defaultProfileLabel())
        <div class="alert alert-info text-center">
            <strong>Profilo principale:</strong>
            {{ $state->defaultProfileLabel() }}
        </div>
        @endif
    </div>
    <div class="d-flex flex-wrap justify-content-center gap-3">
        @if($state->showCreateProfile())
        <div class="col-12 col-md-4">
            <div class="dropdown">
                <button class="btn btn-primary w-100 py-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="fs-4 mb-2"> + </div>
                    {{ $state->createProfileLabel() }}
                </button>
                <ul class="dropdown-menu w-100 shadow">
                    <li>
                        @if($state->canCreatePersonalProfile())
                        <a class="dropdown-item py-3 text-center" href="{{ route('customer.personal.profile.create') }}">
                            <div class="fs-5">👤</div>
                            Profilo personale
                        </a>
                        @else
                        <button class="dropdown-item py-3 text-center disabled" type="button">
                            <div class="fs-5">👤</div>
                            Profilo personale già creato
                            <small class="d-block text-muted">
                                Puoi creare altri profili business
                            </small>
                        </button>
                        @endif
                    </li>
                    <li>
                        <button class="dropdown-item py-3 text-center disabled" type="button">
                            <div class="fs-5"> 🏢 </div>
                            Profilo business
                            <small class="d-block text-muted">
                                Disponibile prossimamente
                            </small>
                        </button>
                    </li>
                </ul>
            </div>
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
            <a href="{{ route('customer.dashboard.personal') }}" class="btn btn-success w-100 py-3">
                <div class="fs-4 mb-2">
                    →
                </div>
                Vai alla dashboard
            </a>
        </div>
        @endif
    </div>
</div>