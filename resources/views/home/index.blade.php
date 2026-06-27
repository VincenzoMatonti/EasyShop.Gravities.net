<x-layouts.main-layout>
    <x-slot:title>Home</x-slot:title>
    <div class="container text-center bg-body-tertiary margin-top-custom">
        <div class="row justify-content-center align-items-center mybg">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                <h1 class="display-1 mt-5">{{env('APP_NAME')}}</h1>
                <p class="fw-bold display-6 mt-5">prova</p>
            </div>
        </div>
    </div>
</x-layouts.main-layout>