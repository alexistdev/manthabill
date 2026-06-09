@extends('layouts.user')

@section('title', 'Detail Ticket')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Ticket</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ticket.index') }}">Ticket</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
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

                        {{-- Opening ticket message --}}
                        <div>
                            <i class="fas fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    <i class="fas fa-clock"></i>
                                    {{ date('H:i', $ticket->time) }}
                                </span>
                                <h3 class="timeline-header">
                                    <span class="text-primary fw-bold">
                                        {{ $ticket->user?->detail?->nama_depan ?: 'Member' }}
                                    </span>
                                    &mdash;
                                    <span class="fw-bold">{{ ucwords($ticket->judul) }}</span>
                                </h3>
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
                                    {{ date('H:i', $reply->time) }}
                                </span>
                                @if($reply->is_admin !== 1)
                                    <h3 class="timeline-header">
                                        <span class="text-danger fw-bold">Anda</span>
                                    </h3>
                                @else
                                    <h3 class="timeline-header">
                                        <span class="text-blue fw-bold">Admin</span>
                                        &mdash;
                                        <span class="fw-bold">Membalas</span>
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
                        <form action="{{ route('ticket.reply', $ticket->key_token) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea name="isiPesan"
                                          id="isiPesan"
                                          class="form-control"
                                          rows="5"
                                          placeholder="Tulis pesan balasan disini"
                                          maxlength="400"
                                          required>{{ old('isiPesan') }}</textarea>
                            </div>
                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('ticket.index') }}" class="btn btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-primary">Balas</button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('ticket.index') }}" class="btn btn-danger">
                    <i class="fas fa-chevron-circle-left"></i> Kembali
                </a>
            @endif

        </div>
    </div>
@endsection
