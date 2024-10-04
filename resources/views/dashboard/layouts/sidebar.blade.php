<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ url('/') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><img width="35px" src="{{ asset('img/iconWeb.png') }}" alt="iconWeb"> Arsip Surat</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('dashmin/img/user.png') }}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                <span>{{ auth()->user()->username }}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ url('/dashboard') }}" class="nav-item nav-link {{ Request::is('dashboard') ? 'active' : '' }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ Request::is('it') || Request::is('ga') ? 'active' : '' }}" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>List Surat</a>
                <div class="dropdown-menu bg-transparent border-0">
                @if (auth()->user()->name == "IT Support" || auth()->user()->name == "superadmin")
                    <a href="{{ url('/dashboard/it') }}" class="dropdown-item {{ Request::is('dashboard/it*') ? 'active' : '' }}">
                        <i class="bi bi-window"></i> List Surat IT
                    </a>
                @endif
                @if (auth()->user()->name == "General Affair" || auth()->user()->name == "superadmin")
                    <a href="{{ url('/dashboard/ga') }}" class="dropdown-item {{ Request::is('dashboard/ga*') ? 'active' : '' }}"><i class="bi bi-window"></i> List Surat GA</a>
                @endif
                @if (auth()->user()->name == "Marketing Sales Shipping" || auth()->user()->name == "superadmin" || auth()->user()->name == "Ervina Wijaya")
                    <a href="{{ url('/dashboard/mss') }}" class="dropdown-item {{ Request::is('dashboard/mss*') ? 'active' : '' }}"><i class="bi bi-envelope"></i> List Surat MSS</a>
                @endif
                @if (auth()->user()->name == "Global Sinergi Maritim" || auth()->user()->name == "superadmin")
                    <a href="{{ url('/dashboard/gsm') }}" class="dropdown-item {{ Request::is('dashboard/gsm*') ? 'active' : '' }}"><i class="bi bi-envelope"></i> List Surat GSM</a>
                @endif
                <a href="{{ url('/feedback') }}" class="dropdown-item {{ Request::is('/feedback*') ? 'active' : '' }}"><i class="bi bi-window"></i> Feedback</a>
                @if(auth()->user()->name == "IT Support" || auth()->user()->name == "superadmin")
                <a href="{{ url('/feedback-show') }}" class="dropdown-item {{ Request::is('/feedback-show*') ? 'active' : '' }}"><i class="bi bi-window"></i> List Feedback</a>
                @endif
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
