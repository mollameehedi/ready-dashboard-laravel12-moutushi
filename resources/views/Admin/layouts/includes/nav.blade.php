  <nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="index.html" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="assets/images/logo-full.png" alt="" class="logo logo-lg" />
                    <img src="assets/images/logo-abbr.png" alt="" class="logo logo-sm" />
                </a>
            </div>
            <div class="navbar-content">
               <ul class="nxl-navbar">

    <!-- Dashboard -->
    <li class="nxl-item">
        <a href="{{ route('dashboard.index') }}" class="nxl-link">
            <span class="nxl-micon"><i class="feather-airplay"></i></span>
            <span class="nxl-mtext">Dashboard</span>
        </a>
    </li>

    <!-- Category -->
   
    <!-- Contact Message -->
    <li class="nxl-item">
                <a href="{{ route('contact.message.index') }}"class="nxl-link">
            <span class="nxl-micon"><i class="feather-mail"></i></span>
            <span class="nxl-mtext">Contact Message</span>
        </a>
    </li>  

     <li class="nxl-item">
        <a href="{{ route('website.banner.index') }}" class="nxl-link">
            <span class="nxl-micon"><i class="feather-settings"></i></span>
            <span class="nxl-mtext"> Website Settings</span>
        </a>
    </li>

   <li class="nxl-item">
        <a href="{{ route('settings.general.index') }}" class="nxl-link">
            <span class="nxl-micon"><i class="feather-settings"></i></span>
            <span class="nxl-mtext">General Settings</span>
        </a>
    </li> 

    <!-- Profile -->
     <li class="nxl-item">
        <a href="{{ route('profile.index') }}" class="nxl-link">
            <span class="nxl-micon"><i class="feather-user"></i></span>
            <span class="nxl-mtext">Profile</span>
        </a>
    </li>

    <!-- Logout -->
    <li class="nxl-item">
        <a href="logout.html" class="nxl-link">
            <span class="nxl-micon"><i class="feather-power"></i></span>
            <span class="nxl-mtext">Logout</span>
        </a>
    </li>

</ul>
  
              
            </div>
        </div>
    </nav>