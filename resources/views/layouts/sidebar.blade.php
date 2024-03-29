<!--font-->




<!-- Dashboard -->
@if(Auth::user()->user_type != 'patient')
<li class="menu-item @yield('dashboard')">
  <a href="{{ route('dashboard') }}" class="menu-link">
    <i class="menu-icon tf-icons bx bx-home-circle"></i>
    <div data-i18n="Analytics">Dashboard </div>
  </a>
</li>
@endif

<!-- My Appointments or Appointment List or Appointment -->
<li class="menu-item">
  <a href="/appointment" class="menu-link">
    <i class="menu-icon tf-icons bx bx-receipt"></i>
    @if(Auth::user()->user_type == 'patient')
      <div data-i18n="Basic">My Appointments</div>
    @elseif(Auth::user()->user_type == 'doctor')
      <div data-i18n="Basic">Appointment List</div>
    @else
      <div data-i18n="Basic">Appointment</div>
    @endif
  </a>
</li>

<!-- Services -->
@if(Auth::user()->user_type != 'patient')
<li class="menu-item">
  <a href="/services" class="menu-link">
    <i class="menu-icon tf-icons bx bx-receipt"></i>
    <div data-i18n="Basic">Services</div>
  </a>
</li>
  @if(Auth::user()->user_type == 'admin')
    <!-- Staff -->
    <li class="menu-item @yield('users')">
      <a href="/doctor" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Basic">Staff</div>
      </a>
    </li>
    <!-- Patient -->
    <li class="menu-item {{ (request()->is('patient*')) ? 'active' : '' }} ">
        <a href="/patient" class="menu-link">
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div data-i18n="Basic">Patient</div>
        </a>
      </li>
  @endif
@endif

<!-- Feedback -->
@if(Auth::user()->user_type == 'patient')
  <li class="menu-item @yield('feedback')">
    <a href="/feedback" class="menu-link">
      <i class="menu-icon tf-icons bx bx-comment"></i>
      <div data-i18n="Basic">Feedback</div>
    </a>
  </li>
@endif



<li class="menu-item {{ (request()->is('chat*')) ? 'active' : '' }}">
  <a href="/chat" class="menu-link">
    <i class="menu-icon tf-icons bx bx-message"></i>
    <div data-i18n="Messages">Messages</div>
  </a>
</li>
  

<!-- Change Password -->
<li class="menu-item">
  <a href="/changepassword" class="menu-link">
    <i class="menu-icon tf-icons bx bx-lock"></i>
    <div data-i18n="Settings">Settings</div>
  </a>
</li>



