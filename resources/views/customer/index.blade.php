<x-layouts.main-layout>
    <x-slot:title>Customer-Area</x-slot:title>
    <div class="container-fluid mybg mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 height-custom mt-3">
                <div class="container">
                    <h1>
                        Benvenuto nella tua area personale
                    </h1>
                    <x-customer.entry-state-customer :state="$state" />
                </div>
            </div>
        </div>
    </div>
</x-layouts.main-layout>