<x-auth.layout>
    @slot('title')
        Confirm Password
    @endslot

    <main class="main" id="top">
        <div class="row vh-100 g-0">
            <div class="col-lg-6 position-relative d-none d-lg-block">
                <div class="bg-holder" style="background-image:url({{ asset('backend') }}/assets/img/bg/30.png);">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row flex-center h-100 g-0 px-4 px-sm-0">
                    <div class="col col-sm-6 col-lg-7 col-xl-6">
                        <div class="text-center mb-7">
                            <h3 class="text-body-highlight">Confirm Password</h3>
                            <p class="text-body-tertiary">Please confirm your password before continuing.</p>
                        </div>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="mb-3 text-start">
                                <label class="form-label" for="password">Password</label>
                                <div class="form-icon-container">
                                    <input class="form-control form-icon-input" id="password" name="password"
                                        type="password" required autocomplete="current-password" />
                                    <span class="fas fa-key text-body fs-9 form-icon"></span>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <button class="btn btn-primary w-100 mb-3">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-auth.layout>
