@extends('admin.layouts.app')
@push('title', 'Contact Message Details')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.contact.message.index') }}">Contact Message</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">  {{-- Align items vertically --}}
            <h3 class="mb-0">Contact Message Details</h3>  {{-- Remove extra margin --}}
            <a href="{{ route('admin.contact.message.index') }}" class="btn btn-primary btn-sm">Back to Contact List</a> {{-- Smaller button --}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-section">  {{-- Add a class for styling --}}
                        <h4 class="detail-title">Contact Information</h4>  {{-- Add a title --}}
                        <p><strong>Name:</strong> {{ $contact->name }}</p>
                        <p><strong>Email:</strong> {{ $contact->email }}</p>
                        <p><strong>Phone:</strong> {{ $contact->phone }}</p>
                    </div>

                    <div class="detail-section mt-4">  {{-- Add margin top --}}
                        <h4 class="detail-title">Message Details</h4>
                        <p><strong>Subject:</strong> {{ $contact->subject ?? 'N/A' }}</p>
                        <p><strong>Created At:</strong> {{ $contact->created_at->format('d M Y H:i:s') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-section">
                        <h4 class="detail-title">Message Content</h4>
                        <pre class="message-content">{{ $contact->message }}</pre>  {{-- Add a class for styling --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
