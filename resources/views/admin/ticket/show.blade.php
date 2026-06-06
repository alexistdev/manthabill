@extends('layouts.admin')

@section('title', 'Detail Ticket — Admin')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Ticket</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.tickets.inbox') }}">Ticket</a>
                        </li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('pesan'))
                {!! session('pesan') !!}
            @endif
            @if(session('pesan2'))
                {!! session('pesan2') !!}
            @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                @endforeach
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="timeline">

                        <div class="time-label">
                            <span class="bg-red">{{ date('d-M-Y', $ticket->time) }}</span>
                        </div>

                        {{-- Opening message --}}
                        <div>
                            @if($ticket->is_adm === 1)
                                <i class="fas fa-bullhorn bg-danger"></i>
                            @else
                                <i class="fas fa-envelope bg-blue"></i>
                            @endif
                            <div class="timeline-item">
                                <span class="time">
                                    <i class="fas fa-clock"></i>
                                    {{ date('H:i', $ticket->time) }}
                                </span>
                                @if($ticket->is_adm !== 1)
                                    @php
                                        $namaDepan  = $ticket->user?->detail?->nama_depan ?? '';
                                        $namaBelakang = $ticket->user?->detail?->nama_belakang ?? '';
                                        $pengirim   = trim($namaDepan . ' ' . $namaBelakang);
                                        if ($pengirim === '') {
                                            $pengirim = 'Client No #' . ($ticket->user?->id_user ?? '');
                                        }
                                    @endphp
                                    <h3 class="timeline-header">
                                        <span class="text-primary font-weight-bold">{{ $pengirim }}</span>
                                        &mdash;
                                        <span class="font-weight-bold">{{ ucwords($ticket->judul) }}</span>
                                    </h3>
                                @else
                                    <h3 class="timeline-header">
                                        <span class="text-danger font-weight-bold">Administrator</span>
                                        &mdash;
                                        <span class="font-weight-bold">{{ ucwords($ticket->judul) }}</span>
                                    </h3>
                                @endif
                                <div class="timeline-body">
                                    {{ $ticket->pesan }}
                                </div>
                            </div>
                        </div>

                        {{-- Reply messages --}}
                        @foreach($replies as $reply)
                        <div>
                            @if($reply->is_admin === 1)
                                <i class="fas fa-comments bg-yellow"></i>
                            @else
                                <i class="fas fa-envelope bg-blue"></i>
                            @endif
                            <div class="timeline-item">
                                <span class="time">
                                    <i class="fas fa-clock"></i>
                                    {{ date('d-m-Y H:i', $reply->time) }}
                                </span>
                                @if($reply->is_admin !== 1)
                                    <h3 class="timeline-header">
                                        <span class="text-danger font-weight-bold">User</span>
                                    </h3>
                                @else
                                    <h3 class="timeline-header">
                                        <span class="text-blue font-weight-bold">Admin</span>
                                        &mdash;
                                        <span class="font-weight-bold">Membalas</span>
                                    </h3>
                                @endif
                                <div class="timeline-body">
                                    {{ $reply->pesan }}
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>

                    </div>
                </div>
            </div>

            @if($ticket->status_inbox !== 3)
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('admin.tickets.reply', $ticket->key_token) }}" method="POST">
                            @csrf
                            <div class="form-floating">
                                <textarea name="isiPesan"
                                          id="isiPesan"
                                          class="form-control"
                                          rows="5"
                                          placeholder="Tulis pesan balasan disini"
                                          maxlength="400"
                                          required>{{ old('isiPesan') }}</textarea>
                            </div>
                            <div class="form-group clearfix mt-3">
                                <a href="{{ route('admin.tickets.inbox') }}" class="btn btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-primary">Balas</button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('admin.tickets.inbox') }}" class="btn btn-danger">
                    <i class="fas fa-chevron-circle-left"></i> Kembali
                </a>
            @endif

        </div>
    </section>
</div>
@endsection
