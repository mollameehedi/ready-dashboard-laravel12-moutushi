<div class="email-navigation">
    <div class="list-group list-group-flush">
        <a href="{{ route('admin.settings.general.index') }}"
            class="list-group-item d-flex align-items-center
            {{ Route::is('admin.settings.general.index') ? 'active' : '' }}">
            <i class='bx bx-cog me-3 font-20'></i><span>General</span>
        </a>
        <a href="{{ route('admin.settings.appearance') }}"
            class="list-group-item d-flex align-items-center
            {{ Route::is('admin.settings.appearance') ? 'active' : '' }}">
            <i class='bx bx-images me-3 font-20'></i><span>Logo & Favicon</span>
        </a>
        <a href="{{ route('admin.settings.social_media') }}"
            class="list-group-item d-flex align-items-center
            {{ Route::is('admin.settings.social_media') ? 'active' : '' }}">
            <i class='bx bx-envelope me-3 font-20'></i><span>Social Media</span>
        </a>
        <a href="{{ route('admin.settings.meta_tag') }}"
            class="list-group-item d-flex align-items-center
            {{ Route::is('admin.settings.meta_tag') ? 'active' : '' }}">
            <i class='bx bx-cog me-3 font-20'></i><span>Meta Tag</span>
        </a>
        <a href="{{ route('admin.settings.fb_pixel') }}"
            class="list-group-item d-flex align-items-center
            {{ Route::is('admin.settings.fb_pixel') ? 'active' : '' }}">
            <i class='bx bx-cog me-3 font-20'></i><span>Pixels</span>
        </a>
        <a href="{{ route('admin.settings.gtm') }}"
            class="list-group-item d-flex align-items-center
            {{ Route::is('admin.settings.gtm') ? 'active' : '' }}">
            <i class='bx bx-cog me-3 font-20'></i><span>GTM</span>
        </a>
    </div>
</div>
