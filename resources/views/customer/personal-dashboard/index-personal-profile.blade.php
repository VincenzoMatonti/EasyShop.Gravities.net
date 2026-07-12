<x-layouts.main-layout>
    <x-slot:title> Dashboard Customer </x-slot:title>
    <div class="container-fluid mybg mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mt-5">
                <div class="text-center mb-4">
                    <h1 class="display-5"> Benvenuto nella tua area cliente </h1>
                    <p class="lead"> Gestisci il tuo profilo e accedi ai tuoi servizi. </p>
                </div>
                <x-customer.personal-profile.section-card :title="$dashboard->status->statusLabel()" icon="📋">
                    @foreach($dashboard->status->items() as $item)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>
                            {{ $item['label'] }}
                        </span>
                        <x-customer.personal-profile.status-badge :label="$item['badge']['label']" :type="$item['badge']['type']" />
                    </div>
                    @endforeach
                </x-customer.personal-profile.section-card>
                <div class="card shadow-lg border-0 p-4">
                    <h4 class="mb-4 text-center"> Gestione account </h4>
                    <div class="row g-3">
                        @foreach($dashboard->menuItems() as $item)
                        <x-customer.personal-profile.menu-card
                            :route="$item['route']"
                            :icon="$item['icon']"
                            :title="$item['title']"
                            :description="$item['description']"
                            :style="$item['style']" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main-layout>