@extends('admin.layouts.app')
@push('title', 'General | Settings')
@push('settings', 'active')
@section('main')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">General Settings</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title pb-2">Settings</h4>
                    <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                        @include('admin.pages.settings.sidebar')
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card border-top border-0 border-4 border-primary p-4">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="mb-0 text-primary">General Information</h4>
                    </div>
                </div>
                <form action="{{ route('settings.general.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="form-group mt-2">
                            <label for="website_name">Website Name</label>
                            <input type="text" class="form-control input-lg" name="website_name"
                                value="{{setting('website_name') ?? old('website_name') }}" placeholder="Enter Your Website Name">
                        </div>

                        <div class="form-group mt-2">
                            <label for="website_description">Website Description</label>
                            <textarea name="website_description" id="website_description" class="form-control" placeholder="Enter Your Website Description">{{ setting('website_description') ?? old('website_description') }}</textarea>
                        </div>

                        <div class="form-group mt-2">
                            <label for="email">Email</label>
                            <input type="email" class="form-control input-lg" name="email"
                                placeholder="Enter Your Email" value="{{setting('email') ?? old('email') }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="website_number">Number</label>
                            <input type="text" class="form-control input-lg" name="number"
                                placeholder="Enter Your Website Number" value="{{setting('number') ?? old('number') }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="address">Address</label>
                            <input type="text" class="form-control input-lg" name="address"
                                placeholder="Enter Your Address" value="{{setting('address') ?? old('address') }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="currency">Currency</label>
                            <input type="text" class="form-control input-lg" name="currency"
                                placeholder="Enter Your currency" value="{{setting('currency') ?? old('currency') }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="currency_position" class="col-form-label">Currency Position</label>
                                <select name="currency_position" class="form-select" id="">
                                    @foreach ($currencyPossition as $key => $name)
                                    <option {{setting('currency_position') == $key? 'selected':' '}} value="{{  $key }}">{{  $name }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="address">Inside of Dhaka (Delivary Charge)</label>
                            <input type="number" class="form-control input-lg" name="inside_dhaka"
                                placeholder="Enter Your Inside of Dhaka" value="{{setting('inside_dhaka') ?? old('inside_dhaka') }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="address">Outside of Dhaka (Delivary Charge)</label>
                            <input type="number" class="form-control input-lg" name="outside_dhaka"
                                placeholder="Enter Your Outside of Dhaka" value="{{setting('outside_dhaka') ?? old('outside_dhaka') }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="footer_text">Footer Text</label>
                            <input type="text" class="form-control input-lg"
                                value="{{setting('footer_text') ?? old('footer_text') }}" name="footer_text"
                                placeholder="Footer Text">
                        </div>
                        <div class="form-group mt-2">
                           <x-utils.image name="shop_banner" label="Shop Page Banner" :value="setting_img('shop_banner')" />
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-primary rounded">Update</button>
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
