<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <p>Anda telah meminta reset password untuk akun anda, silahkan klik link dibawah ini:</p>
    <p>
        Reset Password: <a href="{{ $resetLink }}">{{ $resetLink }}</a>
    </p>
    <p>
        Jika anda tidak merasa melakukan permintaan reset password, abaikan saja email ini.
        Email ini akan expired setelah 24 jam.
    </p>
    <p>
        Regards<br>
        Admin
    </p>
</body>
</html>
