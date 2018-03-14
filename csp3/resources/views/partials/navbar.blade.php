<nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color">
    <a class="navbar-brand" href="{{ url(" / ") }}">
        {{ config("app.name", "EventBook") }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ganapNavbar" aria-controls="ganapNavbar"
        aria-expanded="false" aria-label="Toggle navigation" style="">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="ganapNavbar">
        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light text-right" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">
                    <i class="fa fa-sign-in" aria-hidden="true"></i> Login / Register </a>
                <div class="dropdown-menu dropdown-menu-right px-4">
                    <form id="loginForm" class="p-2">
                        <div class="form-group">
                            <label for="exampleDropdownFormEmail1">Username</label>
                            <input type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}"
                                id="DropdownFormUsername" placeholder="Username" autocomplete="username" required> @if ($errors->has("username"))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first("username") }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleDropdownFormPassword1">Password</label>
                            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="DropdownFormPassword"
                                placeholder="Password" autocomplete="current-password" required> @if ($errors->has("password"))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first("password") }}</strong>
                            </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item" data-toggle="modal" data-target="#modalRegisterForm">New around here? Sign up</a>
                </div>
            </li>
            @else
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light text-right" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">
                    <i class="fa fa-user"></i> {{ Auth::user()->username }} </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                    @if ($admin == 1)
                    <a class="dropdown-item waves-effect waves-light" href="" id="adminAcct" data-toggle="modal" data-target="#modalAdminForm">Create Admin</a>
                    <a class="dropdown-item waves-effect waves-light" href="" id="delUsers" data-toggle="modal" data-target="#userDeleteModal">Delete User</a>
                    @endif
                    <a class="dropdown-item waves-effect waves-light" href="" id="editAcct" data-toggle="modal" data-target="#modalEditForm">Edit Account</a>
                    <a class="dropdown-item waves-effect waves-light" href="" data-toggle="modal" data-target="#modalChangeForm">Change Password</a>
                    <a class="dropdown-item waves-effect waves-light" href="" id="delAcct">Delete Account</a>
                    <a class="dropdown-item waves-effect waves-light logOut" href="">Logout</a>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</nav>