<x-layouts.main-layout>
    <x-slot:title>
        Verifica email
    </x-slot:title>
    <div class="container-fluid mybg mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 mt-5">
                <x-customer.personal-profile.section-card title="Verifica la tua email" icon="📧">
                    <div class="text-center">
                        <p>
                            Ti abbiamo inviato una mail di verifica.
                        </p>
                        <p class="text-muted">
                            Clicca sul link ricevuto per attivare il tuo account.
                        </p>
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button class="btn btn-primary mt-3">
                                Reinvia email
                            </button>
                        </form>
                    </div>
                </x-customer.personal-profile.section-card>
            </div>
        </div>
    </div>
</x-layouts.main-layout>