<x-layouts.main-layout>
    <x-slot:title>Dashboard-Customer-Profile</x-slot:title>
    <div class="container-fluid mybg mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 height-custom mt-3">
                <div class="text-center">
                    <h1 class="display-5"> Benvenuto nella tua area cliente </h1>
                    <p class="lead">Gestisci la tua area e accedi ai tuoi servizi.</p>
                    <a href="{{ route('customer.index') }}" class="btn btn-secondary w-100 mt-2">
                        Go back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main-layout>