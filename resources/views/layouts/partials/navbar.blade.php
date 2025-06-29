<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                {{-- <span class="badge badge-danger badge-counter">{{ auth()->user()->unreadNotifications->count() }}</span> --}}
                <span class="badge badge-danger badge-counter">
                    @if (auth('web')->check())
                        {{-- untuk user/admin --}}
                        <span>{{ auth('web')->user()->unreadNotifications->count() }}</span>
                    @elseif(auth('customer')->check())
                        {{-- untuk customer --}}
                        <span>{{ auth('customer')->user()->unreadNotifications->count() }}</span>
                    @endif
                </span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Pemberitahuan
                </h6>
                @if (auth('web')->check())
                    @forelse(auth()->user()->notifications as $notification)
                        <a class="dropdown-item d-flex align-items-center" href="{{ $notification->data['link'] }}?key={{ $notification->id }}">
                            <div class="mr-3">
                                <div class="icon-circle {{ $notification->read_at ? 'bg-secondary' : 'bg-success' }}">
                                    <i
                                        class="fas {{ $notification->data['type'] == 'ticket' ? 'fa-fw fa-flag' : 'fa fa-comments' }} text-white"></i>
                                </div>
                            </div>
                            <div>
                                <span class="font-weight-bold">{{ $notification->data['message'] }}</span>
                            </div>
                        </a>
                    @empty
                    @endforelse
                @elseif(auth('customer')->check())
                    @forelse(auth('customer')->user()->notifications as $notification)
                        <a class="dropdown-item d-flex align-items-center" href="{{ $notification->data['link'] }}?key={{ $notification->id }}">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i
                                        class="fas {{ $notification->data['type'] == 'ticket' ? 'fa-fw fa-flag' : 'fa fa-comments' }} text-white"></i>
                                </div>
                            </div>
                            <div>
                                <span class="font-weight-bold">{{ $notification->data['message'] }}</span>
                            </div>
                        </a>
                    @empty
                    @endforelse
                @endif
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600">
                    {{-- {{ Auth::guard('web')->check() && Auth::guard('web')->user()->name || Auth::guard('customer')->check() && Auth::guard('customer')->user()->name }} --}}
                    @auth('web')
                        {{ Auth::guard('web')->user()->nama }}
                        @elseauth('customer')
                        {{ Auth::guard('customer')->user()->name }}
                    @endauth
                </span>

            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile.index') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        {{-- <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> --}}
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Keluar
                    </button>
                </form>
        </li>
    </ul>
    </form>

</nav>
