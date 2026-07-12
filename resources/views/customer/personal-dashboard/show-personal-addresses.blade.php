<x-layouts.main-layout>
    <x-slot:title> Personal profile addresses </x-slot:title>
    <div class="container-fluid mybg mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mt-5">
                <x-customer.personal-profile.header
                    title="Area personale"
                    subtitle="Consulta e gestisci gli indirizzi del tuo account." />

                <x-customer.personal-profile.section-card
                    title="Indirizzi"
                    icon="📍">

                    <x-customer.personal-profile.empty-state
                        title="Nessun indirizzo disponibile"
                        description="Aggiungi un indirizzo di spedizione o fatturazione per completare il tuo profilo.">

                        <div class="mt-3">
                            <button class="btn btn-primary" disabled>
                                Aggiungi indirizzo
                            </button>
                        </div>

                    </x-customer.personal-profile.empty-state>

                </x-customer.personal-profile.section-card>


                <div class="d-flex justify-content-between align-items-center mt-4">

                    <x-customer.personal-profile.back-button
                        :route="route('customer.dashboard.personal')"
                        label="Dashboard" />

                    <button class="btn btn-success" disabled>
                        Salva modifiche
                    </button>

                </div>
            </div>
        </div>
    </div>
</x-layouts.main-layout>