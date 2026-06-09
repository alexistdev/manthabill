@extends('layouts.user')

@section('title', 'Invoice')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Invoice</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Invoice Anda</h3>
                        </div>
                        <div class="card-body">
                            @if(session('pesan'))
                                {!! session('pesan') !!}
                            @endif
                            <table id="tabelku" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">INVOICE</th>
                                        <th class="text-center">TANGGAL</th>
                                        <th class="text-center">EXPIRE</th>
                                        <th class="text-end">TOTAL</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($invoices as $i => $invoice)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td class="text-center">{{ strtoupper($invoice->no_invoice) }}</td>
                                        <td class="text-center">{{ $invoice->inv_date->format('d-m-Y') }}</td>
                                        <td class="text-center">{{ $invoice->due->format('d-m-Y') }}</td>
                                        <td class="text-end">Rp. {{ number_format($invoice->total_jumlah, 0, ',', '.') }}, -</td>
                                        <td class="text-center">
                                            @if($invoice->status_inv === 1)
                                                <span class="badge bg-primary">LUNAS</span>
                                            @elseif($invoice->status_inv === 2)
                                                <span class="badge bg-warning text-dark">PENDING</span>
                                            @elseif($invoice->status_inv === 3)
                                                <span class="badge bg-info">SEDANG DIREVIEW</span>
                                            @else
                                                <span class="badge bg-danger">VOID</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('invoice.detail', encrypt($invoice->id)) }}" class="btn btn-sm btn-info">VIEW</a>
                                            @if($invoice->status_inv === 2)
                                                <a href="{{ route('invoice.bayar', encrypt($invoice->id)) }}" class="btn btn-sm btn-danger">BAYAR</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-3">Tidak ada invoice</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
        if ($('#tabelku').length) {
            $('#tabelku').DataTable({ responsive: true, autoWidth: false });
        }
    });
</script>
@endpush
