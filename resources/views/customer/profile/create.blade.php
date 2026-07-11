<x-layouts.main-layout>
    <x-slot:title>Create-Profile</x-slot:title>
    <div class="container-fluid mybg mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 mt-3">
                <div class="card shadow p-4">
                    <h3 class="mb-4"> Create your personal profile </h3>
                    <form method="POST" action="{{ route('customer.profile.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Name
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="form-label">
                                Surname
                            </label>
                            <input
                                type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ old('surname') }}" required>
                            @error('surname')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tax_code" class="form-label">
                                Tax Code
                            </label>

                            <input
                                type="text"
                                class="form-control @error('tax_code') is-invalid @enderror"
                                id="tax_code"
                                name="tax_code"
                                value="{{ old('tax_code') }}">

                            @error('tax_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="birth_date" class="form-label">
                                Birth Date
                            </label>

                            <input
                                type="date"
                                class="form-control @error('birth_date') is-invalid @enderror"
                                id="birth_date"
                                name="birth_date"
                                value="{{ old('birth_date') }}">

                            @error('birth_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="phone_prefix" class="form-label">
                                Phone Prefix
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="phone_prefix"
                                name="phone_prefix"
                                value="{{ old('phone_prefix', '+39') }}">
                        </div>


                        <div class="mb-3">
                            <label for="phone" class="form-label">
                                Phone
                            </label>

                            <input
                                type="text"
                                class="form-control @error('phone') is-invalid @enderror"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}">

                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            Create Profile
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-layouts.main-layout>