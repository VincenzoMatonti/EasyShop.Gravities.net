<x-layouts.main-layout>
    <x-slot:title> Personal profile info </x-slot:title>
    <div class="container-fluid mybg mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mt-5">
                <x-customer.personal-profile.header title="Profilo personale" subtitle="Consulta e gestisci le informazioni del tuo account." />
                @foreach($profile->sections() as $section)
                <x-customer.personal-profile.section-card :title="$section['title']" :icon="$section['icon']">
                    @if(isset($section['badge']))
                    <x-slot:actions>
                        <x-customer.personal-profile.status-badge :label="$section['badge']['label']" :type="$section['badge']['type']" />
                    </x-slot:actions>
                    @endif
                    @foreach($section['rows'] as $row)
                    <x-customer.personal-profile.info-row :label="$row['label']" :value="$row['value']" />
                    @endforeach
                </x-customer.personal-profile.section-card>
                @endforeach
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <x-customer.personal-profile.back-button :route="route('customer.dashboard.personal')" label="Dashboard" />
                    <button class="btn btn-success" disabled>
                        Salva modifiche
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main-layout>