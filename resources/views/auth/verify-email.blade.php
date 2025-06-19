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
                <p class="register-box-msg">
                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 text-sm text-success">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @else
                        <span>Thanks for signing up! Before getting started, could you verify your email address by
                            clicking on the link we just emailed to you? If you didn\'t receive the email, we will
                            gladly send you another.</span>
                    @endif
                </p>
                <form action="{{ route('verification.send') }}" method="post">
                    @csrf
                    <!--begin::Row-->
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-8">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                            </div>
                            <div class="col-4">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
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
