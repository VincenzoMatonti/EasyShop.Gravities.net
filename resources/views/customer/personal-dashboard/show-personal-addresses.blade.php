<x-layouts.main-layout>
    <x-slot:title> Personal profile addresses </x-slot:title>
    <div class="container-fluid mybg mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mt-5">
                <x-customer.personal-profile.header :title="$addresses->headerTitle()" :subtitle="$addresses->headerSubtitle()" />
                @foreach($addresses->sections() as $section)
                <x-customer.personal-profile.section-card :title="$section['title']" :icon="$section['icon']">
                    @if($addresses->hasAddresses($section['addresses']))
                        @foreach($section['addresses'] as $address)
                            @foreach($address['rows'] as $row)
                            <x-customer.personal-profile.info-row :label="$row['label']" :value="$row['value']" />
                            @endforeach
                            @if($address['badge'])
                            <x-customer.personal-profile.status-badge :label="$address['badge']['label']" :type="$address['badge']['type']" />
                            @endif
                        <hr>
                        @endforeach
                    @else
                    <x-customer.personal-profile.empty-state :title="$addresses->emptyTitle()" :description="$addresses->emptyDescription()" />
                    @endif
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