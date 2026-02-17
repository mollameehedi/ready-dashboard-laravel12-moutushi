@extends('admin.layouts.app')
@push('title', 'General | Settings')
@push('settings', 'active')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">General Settings</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
          <div class="card border border-2 border-primary p-4">
                <div class="card-body">
                    <h4 class="card-title pb-2">Settings</h4>
                    <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                        @include('admin.pages.settings.sidebar')
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card border border-2 border-primary p-4">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="mb-0 text-primary">General Information</h4>
                    </div>
                </div>
                <form action="{{ route('admin.settings.general.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card-body">
        <div class="row">

            <div class="col-md-6 mt-3">
                <label>Website Name</label>
                <input type="text" class="form-control"
                    name="website_name"
                    value="{{ setting('website_name') ?? old('website_name') }}"
                    placeholder="Enter Website Name">
            </div>

            <div class="col-md-6 mt-3">
                <label>Email</label>
                <input type="email" class="form-control"
                    name="email"
                    value="{{ setting('email') ?? old('email') }}"
                    placeholder="Enter Email">
            </div>

            <div class="col-md-6 mt-3">
                <label>Number</label>
                <input type="text" class="form-control"
                    name="number"
                    value="{{ setting('number') ?? old('number') }}"
                    placeholder="Enter Number">
            </div>

            <div class="col-md-6 mt-3">
                <label>Currency</label>
                <input type="text" class="form-control"
                    name="currency"
                    value="{{ setting('currency') ?? old('currency') }}"
                    placeholder="Enter Currency">
            </div>

            <div class="col-md-6 mt-3">
                <label>Currency Position</label>
                <select name="currency_position" class="form-select">
                    @foreach ($currencyPossition as $key => $name)
                        <option {{ setting('currency_position') == $key ? 'selected' : '' }}
                                value="{{ $key }}">
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mt-3">
                <label>Inside of Dhaka (Delivery Charge)</label>
                <input type="number" class="form-control"
                    name="inside_dhaka"
                    value="{{ setting('inside_dhaka') ?? old('inside_dhaka') }}">
            </div>

            <div class="col-md-6 mt-3">
                <label>Outside of Dhaka (Delivery Charge)</label>
                <input type="number" class="form-control"
                    name="outside_dhaka"
                    value="{{ setting('outside_dhaka') ?? old('outside_dhaka') }}">
            </div>

            <div class="col-md-6 mt-3">
                <label>Address</label>
                <input type="text" class="form-control"
                    name="address"
                    value="{{ setting('address') ?? old('address') }}">
            </div>

            <div class="col-12 mt-3">
                <label>Website Description</label>
                <textarea name="website_description"
                    class="form-control"
                    rows="3">{{ setting('website_description') ?? old('website_description') }}</textarea>
            </div>

            <div class="col-12 mt-3">
                <label>Footer Text</label>
                <input type="text" class="form-control"
                    name="footer_text"
                    value="{{ setting('footer_text') ?? old('footer_text') }}">
            </div>

            <div class="col-12 mt-3">
                <x-utils.image name="shop_banner"
                    label="Shop Page Banner"
                    :value="setting_img('shop_banner')" />
            </div>

            <div class="col-12 mt-4">
                <button class="btn btn-primary px-4">Update</button>
            </div>

        </div>
    </div>
</form>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
