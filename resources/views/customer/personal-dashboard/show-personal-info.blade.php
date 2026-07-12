<x-layouts.main-layout>
    <x-slot:title> Personal profile info </x-slot:title>
    <div class="container-fluid mybg mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mt-5">
                <x-customer.personal-profile.header
                    title="Profilo personale"
                    subtitle="Consulta e gestisci le informazioni del tuo account." />

                <x-customer.personal-profile.section-card
                    title="Dati anagrafici"
                    icon="👤">

                    <x-slot:actions>
                        <button class="btn btn-sm btn-outline-primary" disabled>
                            Modifica
                        </button>
                    </x-slot:actions>

                    <x-customer.personal-profile.info-row
                        label="Nome"
                        value="Mario" />

                    <x-customer.personal-profile.info-row
                        label="Cognome"
                        value="Rossi" />

                    <x-customer.personal-profile.info-row
                        label="Codice fiscale"
                        value="RSSMRA90A01H501X" />

                    <x-customer.personal-profile.info-row
                        label="Data di nascita"
                        value="01/01/1990" />

                </x-customer.personal-profile.section-card>


                <x-customer.personal-profile.section-card
                    title="Email"
                    icon="✉️">

                    <x-slot:actions>

                        <x-customer.personal-profile.status-badge
                            label="Verificata"
                            :type="\App\Enum\Customer\PersonalProfileBadgeType::Success" />

                    </x-slot:actions>

                    <x-customer.personal-profile.info-row
                        label="Email principale"
                        value="mario@email.it" />

                </x-customer.personal-profile.section-card>


                <x-customer.personal-profile.section-card
                    title="Telefono"
                    icon="📱">

                    <x-slot:actions>

                        <x-customer.personal-profile.status-badge
                            label="Da verificare"
                            :type="\App\Enum\Customer\PersonalProfileBadgeType::Warning" />

                    </x-slot:actions>

                    <x-customer.personal-profile.info-row
                        label="Telefono principale"
                        value="+39 333 1234567" />

                </x-customer.personal-profile.section-card>


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