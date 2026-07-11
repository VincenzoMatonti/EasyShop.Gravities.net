<div class="d-flex gap-3">
    @if($state->showCreateProfile())
        <a href="{{ route('customer.profile.create') }}">
            Crea profilo
        </a>
    @endif
    @if($state->showDashboard())
        <a href="{{ route('customer.dashboard') }}">
            Vai alla dashboard
        </a>
    @endif
    @if($state->showProfileSelection())
        <a href="{{ route('customer.profile.select') }}">
            Seleziona profilo
        </a>
    @endif
</div>