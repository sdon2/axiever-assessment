<x-guest-layout>

    @section('page', 'register-page')

    <div class="register-box">
        <!-- /.register-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="#" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                    <h1 class="mb-0"><b>Admin</b>LTE</h1>
                </a>
            </div>
            <div class="card-body register-card-body">
                <p class="register-box-msg">Reset your password</p>
                <form action="{{ route('password.store') }}" method="post">
                    @csrf
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input name="email" id="registerEmail" type="email" class="form-control"
                                placeholder="" value="{{ old('email', $request->email) }}" autocomplete="new-email" />
                            <label for="registerEmail">Email</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                        @error('email')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input name="password" id="registerPassword" type="password" class="form-control"
                                placeholder="" autocomplete="new-password" />
                            <label for="registerPassword">Password</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input name="password_confirmation" id="registerPasswordConfirmation" type="password" class="form-control"
                                placeholder="" autocomplete="new-password" />
                            <label for="registerPasswordConfirmation">Confirm Password</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        @error('password_confirmation')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Reset Password</button>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!--end::Row-->
                </form>
            </div>
            <!-- /.register-card-body -->
        </div>
    </div>
</x-guest-layout>
