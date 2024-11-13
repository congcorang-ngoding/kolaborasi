<x-auth.layout>
    @slot('title')
        Reset Password
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
                        <a class="d-flex flex-center text-decoration-none mb-4" href="{{ asset('backend') }}/index.html">
                            <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block"><img
                                    src="{{ asset('backend') }}/assets/img/icons/logo.png" alt="phoenix"
                                    width="58" />
                            </div>
                        </a>
                        <div class="text-center mb-7">
                            <h3 class="text-body-highlight">Reset Password</h3>
                            <p class="text-body-tertiary">Please enter your new password</p>
                        </div>

                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="mb-3 text-start">
                                <label class="form-label" for="email">Email Address</label>
                                <div class="form-icon-container">
                                    <input class="form-control form-icon-input" id="email" name="email" type="email" value="{{ old('email', $request->email) }}" required autofocus />
                                    <span class="fas fa-envelope text-body fs-9 form-icon"></span>
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mb-3 text-start">
                                <label class="form-label" for="password">Password</label>
                                <div class="form-icon-container">
                                    <input class="form-control form-icon-input" id="password" name="password" type="password" required />
                                    <span class="fas fa-key text-body fs-9 form-icon"></span>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="mb-3 text-start">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <div class="form-icon-container">
                                    <input class="form-control form-icon-input" id="password_confirmation" name="password_confirmation" type="password" required />
                                    <span class="fas fa-key text-body fs-9 form-icon"></span>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <button class="btn btn-primary w-100 mb-3">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-auth.layout>