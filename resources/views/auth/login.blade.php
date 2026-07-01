<x-layouts.main-layout>
    <x-slot:title>Log in</x-slot:title>
    <div class="container-fluid mybg mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 height-custom mt-3">
                <form action="{{route('login')}}" method="POST" class="mybgsec shadow rounded p-5 mt-5">
                    @csrf
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">E-mail:</label>
                        <input type="email" class="form-control shadow" id="loginEmail" name="email" placeholder="Ex.mariorossi@mail.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control shadow" id="password" name="password">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="mybutton btn shadow mt-3" type="submit">Enter<i class="fa-solid fa-door-open"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.main-layout>