<nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user d-flex align-items-center">
                                {{-- <div class="my-auto">
                                </div> --}}
                                <i class="bi bi-person-circle fs-4 mb-3"></i>
                                <div class="d-none d-md-block d-lg-inline-block">&nbsp;Hi, Saugi</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                {{-- <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item active" href="#"><i data-feather="mail"></i> Messages</a>
                                <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div> --}}
                                <form action="{{ route('logout') }}" method="POST">
                                    @method('POST')
                                    @csrf

                                    <button class="dropdown-item"><i data-feather="log-out"></i> Logout</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>