<ul class="metismenu" id="menu">
    <li class="{{request()->is('admin/dashboard*')?'mm-active':''}}">
        <a href="{{ route('admin.dashboard') }}">
            <div class="parent-icon"><i class="bx bx-home-circle"></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>

    <li class="{{request()->is('admin/contact/message*')?'mm-active':''}}">
        <a href="{{ route('admin.contact.message.index') }}">
            <div class="parent-icon"><i class="bx bx-user-circle"></i>
            </div>
            <div class="menu-title">Contact Message</div>
        </a>
    </li>
    <li class="{{request()->is('admin/settings/website*')?'mm-active':''}}">
        <a href="{{ route('admin.settings.website.banner.index') }}">
            <div class="parent-icon"><i class="bx bx-cog"></i>
            </div>
            <div class="menu-title">Website Settings</div>
        </a>
    </li>
    
    <li class="{{request()->is('admin/settings/settings*')?'mm-active':''}}">
        <a href="{{ route('admin.settings.general.index') }}">
            <div class="parent-icon"><i class="bx bx-cog"></i>
            </div>
            <div class="menu-title">General Settings</div>
        </a>
    </li>
     <li class="{{request()->is('admin/profile*')?'mm-active':''}}">
        <a href="{{ route('admin.profile.index') }}">
            <div class="parent-icon"><i class="bx bx-user-circle"></i>
            </div>
            <div class="menu-title">Profile</div>
        </a>
    </li>


