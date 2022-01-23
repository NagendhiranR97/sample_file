<link rel="stylesheet" href="{{ asset('assets/css/style1.css')}}">
<script src="{{ asset('assets/js/admin.js') }}"></script>

<div class="grid-container">
   <div class="menu-icon">
    <i class="fas fa-bars header__menu"></i>
  </div>
   
  <header class="header">
    <div class="header__search"></div>
    <div class="header__avatar">Logout</div>
  </header>

  <aside class="sidenav">
    <div class="sidenav__close-icon">
      <i class="fas fa-times sidenav__brand-close"></i>
    </div>
    <ul class="sidenav__list">
      <li class="sidenav__list-item">
      <a class="nav-link linkclr" href="{{ Url('/') }}">DASHBOARD</a></li>
      <li class="sidenav__list-item">
      <a class="nav-link linkclr" href="{{ Url('/usersview') }}">USERS LIST</a></li>
    </ul>
  </aside>

  <main class="main">
   
    <div class="main-overview">
  <a class="nav-link linkclr" href="{{ Url('/register') }}">
      <div class="overviewcard">
        <div class="overviewcard__icon">Companies</div>
      </div>
</a>
  <a class="nav-link linkclr" href="{{ Url('/usersview') }}">
      <div class="overviewcard">
        <div class="overviewcard__icon">Employees</div>
      </div></a>
     
    </div>

    
  </main>

  <footer class="footer">
    <div class="footer__copyright">&copy; 2021 </div>
    <div class="footer__signature"></div>
  </footer>
</div>
