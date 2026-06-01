@extends('layouts.user')

@section('title', 'Layout Test')

@push('styles')
{{-- page-specific styles can be stacked here --}}
@endpush

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Layout Test</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('Member') }}">Home</a></li>
                        <li class="breadcrumb-item active">Layout Test</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">TASK-07 Layout Verification</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Title renders: <strong>{{ 'Layout Test' }}</strong></li>
                                <li>Content section renders: <strong>OK</strong></li>
                                <li>Navbar partial: <strong>included above</strong></li>
                                <li>Sidebar partial: <strong>included left</strong></li>
                                <li>Footer partial: <strong>included below</strong></li>
                                <li>Company name from Setting: <strong>{{ \App\Models\Setting::first()->nama_hosting ?? 'N/A (no DB row)' }}</strong></li>
                                <li>AdminLTE CSS: <strong><a href="{{ asset('assets/AdminLTE3/dist/css/adminlte.min.css') }}" target="_blank">check link</a></strong></li>
                                <li>jQuery: <strong><a href="{{ asset('assets/AdminLTE3/plugins/jquery/jquery.min.js') }}" target="_blank">check link</a></strong></li>
                                <li>Font Awesome: <strong><a href="{{ asset('assets/AdminLTE3/plugins/fontawesome-free/css/all.min.css') }}" target="_blank">check link</a></strong></li>
                                <li>Favicon: <strong><a href="{{ asset('gambar/myicon.png') }}" target="_blank">check link</a></strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
{{-- page-specific scripts can be stacked here --}}
@endpush
