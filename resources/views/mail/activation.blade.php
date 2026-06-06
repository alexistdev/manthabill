<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aktivasi Akun</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <p>Selamat anda telah berhasil mendaftar akun di <strong>{{ $namaHosting }}</strong>, berikut informasi akun anda:</p>
    <p>
        Username: {{ $email }}<br>
        Password: {{ $password }}
    </p>
    <p>
        Anda harus mengklik Link Aktivasi berikut:<br>
        <a href="{{ $activationUrl }}">{{ $activationUrl }}</a>
    </p>
    <p>
        Regards<br>
        Admin
    </p>
</body>
</html>
