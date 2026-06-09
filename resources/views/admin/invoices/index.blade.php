@extends('layouts.admin')

@section('title', $title)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Invoice</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
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
                            <h3 class="card-title">Daftar Invoice</h3>
                        </div>
                        <div class="card-body">
                            <table id="tabelInvoice" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">No Invoice</th>
                                        <th class="text-center">Client</th>
                                        <th class="text-center">Produk</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-center">Due</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($daftarInvoice as $i => $inv)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td class="text-center fw-bold">{{ strtoupper($inv->no_invoice) }}</td>
                                        <td class="text-center">
                                            @if($inv->user)
                                                <a href="{{ route('admin.customers.show', encrypt($inv->user->id_user)) }}">
                                                    #{{ $inv->user->client }}
                                                </a>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>{{ $inv->detail_produk }}</td>
                                        <td class="text-end">Rp {{ konversiRupiah((int)$inv->total_jumlah) }}</td>
                                        <td class="text-center">{{ konversiTanggal($inv->due?->format('Y-m-d')) }}</td>
                                        <td class="text-center">
                                            @if($inv->status_inv == 1)
                                                <span class="badge bg-success">Paid</span>
                                            @elseif($inv->status_inv == 2)
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($inv->status_inv == 3)
                                                <span class="badge bg-info">Confirmed</span>
                                            @else
                                                <span class="badge bg-secondary">Void</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.invoices.show', encrypt($inv->id)) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($inv->status_inv != 1)
                                            <button type="button"
                                                    class="btn btn-sm btn-success btn-confirm-pay"
                                                    data-invoice="{{ strtoupper($inv->no_invoice) }}"
                                                    data-url="{{ route('admin.invoices.pay', encrypt($inv->id)) }}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="8" class="text-center">Belum ada invoice.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Confirmation Modal --}}
    <div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalKonfirmasiLabel">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Konfirmasi pembayaran untuk invoice <strong id="modalNoInvoice"></strong>?</p>
                    <p class="text-muted mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a id="modalConfirmBtn" href="#" class="btn btn-success">
                        <i class="fas fa-check-circle"></i> Konfirmasi
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#tabelInvoice').DataTable({ responsive: true, order: [[0, 'desc']] });

        $(document).on('click', '.btn-confirm-pay', function () {
            $('#modalNoInvoice').text($(this).data('invoice'));
            $('#modalConfirmBtn').attr('href', $(this).data('url'));
            $('#modalKonfirmasi').modal('show');
        });
    });
</script>
@endpush
