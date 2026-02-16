<div class="email-navigation">
    <div class="list-group list-group-flush">
        <a href="{{ route('website.banner.index') }}"
            class="list-group-item d-flex align-items-center
            {{ Route::is('settings.website.banner*') ? 'active' : '' }}">
            <i class='bx bx-cog me-3 font-20'></i><span>Home Banner</span>
        </a>
        <a href="{{ route('website.page.index') }}"
            class="list-group-item d-flex align-items-center
            {{ Route::is('website.page*') ? 'active' : '' }}">
            <i class='bx bx-cog me-3 font-20'></i><span>Pages</span>
        </a>
        <a href="{{ route('website.map.index') }}"
            class="list-group-item d-flex align-items-center
            {{ Route::is('settings.website.map*') ? 'active' : '' }}">
            <i class='bx bx-cog me-3 font-20'></i><span>Google Map</span>
        </a>
    </div>
</div>
