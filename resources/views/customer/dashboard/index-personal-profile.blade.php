<x-layouts.main-layout>
    <x-slot:title> Dashboard Customer </x-slot:title>
    <div class="container-fluid mybg mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mt-5">
                <div class="text-center mb-4">
                    <h1 class="display-5"> Benvenuto nella tua area cliente </h1>
                    <p class="lead"> Gestisci il tuo profilo e accedi ai tuoi servizi. </p>
                </div>
                <div class="card shadow-lg border-0 p-4">
                    <h4 class="mb-4 text-center"> Gestione account </h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-primary w-100 py-4">
                                <div class="fs-2"> 👤 </div>
                                Profilo personale
                                <small class="d-block mt-2">
                                    Dati anagrafici, telefono e indirizzi
                                </small>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-outline-primary w-100 py-4">
                                <div class="fs-2"> 📦 </div>
                                Indirizzi
                                <small class="d-block mt-2">
                                    Spedizione e fatturazione
                                </small>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-outline-success w-100 py-4">
                                <div class="fs-2"> 🛒 </div>
                                Ordini
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('customer.index') }}" class="btn btn-secondary w-100 py-4">
                                <div class="fs-2"> ⇦ </div>
                                Area cliente
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main-layout>