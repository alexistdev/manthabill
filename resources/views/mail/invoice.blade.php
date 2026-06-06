<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Informasi Invoice</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <p>Yth.Pelanggan, kami telah menerima konfirmasi pembayaran anda:</p>
    <p>{{ $invoice->detail_produk }}</p>
    <p>=====================================================================</p>
    <p>
        Nomor Invoice: <strong>{{ strtoupper($invoice->no_invoice) }}</strong><br>
        Harga: Rp.{{ number_format($invoice->total_jumlah, 0, ',', '.') }}<br>
        @if($invoice->hosting)
            Register: {{ $invoice->hosting->start_hosting ? $invoice->hosting->start_hosting->format('d-m-Y') : '-' }}<br>
            Expired: {{ $invoice->hosting->end_hosting ? $invoice->hosting->end_hosting->format('d-m-Y') : '-' }}<br>
        @else
            Tanggal Invoice: {{ $invoice->inv_date ? $invoice->inv_date->format('d-m-Y') : '-' }}<br>
        @endif
    </p>
    <p>
        Jika anda membutuhkan bantuan lebih lanjut, silahkan membuka support tiket melalui halaman dashboard akun anda.
    </p>
    <p>
        Regards<br>
        Admin
    </p>
</body>
</html>
