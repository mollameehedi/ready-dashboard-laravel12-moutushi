<html>
<head>
    <title>Login</title>
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card my-5">
                <div class="card-body">
    <div class="border p-4 rounded">
        <div class="text-center">
            <h3 class="">Sign in</h3>
        </div>
        <div class="form-body">
            <form class="row g-3" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="col-12">
                    <label for="inputnumberAddress" class="form-label">Phone Number</label>
                    <input type="number" class="form-control @error('number') is-invalid @enderror"
                           id="inputnumberAddress" name="number"
                           value="{{ old('number') }}"
                           placeholder="Enter Your Phone Number">
                    @error('number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="inputChoosePassword" class="form-label">Enter Password</label>
                    <div class="input-group" id="show_hide_password">
                        <input type="password"
                               class="form-control border-end-0 @error('password') is-invalid @enderror"
                               id="inputChoosePassword"
                               name="password"
                               placeholder="Enter Password">
                        <a href="javascript:;" class="input-group-text bg-transparent">
                            <i class='bx bx-hide'></i>
                        </a>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox"
                               id="flexSwitchCheckChecked"
                               name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label"
                               for="flexSwitchCheckChecked">Remember Me</label>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('password.request') }}">Forgot Password ?</a>
                </div>
                <div class="col-12">
                    <div class="w-25 mx-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bxs-lock-open"></i>Sign in
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>