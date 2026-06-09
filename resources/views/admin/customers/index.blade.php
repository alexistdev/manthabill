@extends('layouts.admin')

@section('title', $title)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Clients</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('staff/Admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Clients</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {!! session('pesan') !!}
                    {!! session('pesan2') !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Clients Hosting</h3>
                            <a href="{{ route('admin.customers.create') }}" class="btn btn-sm btn-primary float-end">
                                <i class="fas fa-plus-square"></i> Tambah
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="tabelUser" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Tanggal Daftar</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $no = 1; @endphp
                                @foreach ($dataUser as $user)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">{{ $user->date_create ? $user->date_create->format('d-m-Y') : '-' }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.customers.show', encrypt($user->id_user)) }}">Detail</a>
                                            <button type="button" class="btn btn-danger btn-sm" id="tombolHapus"
                                                data-bs-toggle="modal" data-bs-target="#modalHapus"
                                                data-id="{{ encrypt($user->id_user) }}">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                </div>
                <div class="modal-body">Apakah anda yakin ingin menghapus data ini?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="formHapus" method="POST" action="" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#tabelUser').DataTable();
        $(document).on('click', '#tombolHapus', function () {
            var id = $(this).data('id');
            $('#formHapus').attr('action', '{{ url("staff/Admin/hapus_user") }}/' + id);
        });
    });
</script>
@endpush
