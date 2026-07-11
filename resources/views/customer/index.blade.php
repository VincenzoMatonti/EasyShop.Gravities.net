<x-layouts.main-layout>
    <x-slot:title> Customer Area </x-slot:title>
    <div class="container-fluid mybg mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mt-5">
                <div class="text-center">
                    <h1 class="display-5"> Benvenuto nella tua area personale </h1>
                    <p class="lead">Gestisci i tuoi profili cliente e accedi ai tuoi servizi.</p>
                </div>
                <x-customer.entry-state-customer :state="$state" />
            </div>
        </div>
    </div>
</x-layouts.main-layout>