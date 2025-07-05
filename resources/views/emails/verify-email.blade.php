<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
</head>
<body>
    <h2>Verify Your Email</h2>
    <p>Hi {{ $user->name }},</p>
    <p>Thanks for signing up! Please verify your email address by clicking the link below:</p>

    <p>
        <a href="{{ $url }}" style="display:inline-block;padding:10px 20px;background:#1d4ed8;color:white;text-decoration:none;border-radius:5px;">
            Verify Email
        </a>
    </p>

    <p>If you didn’t request this, you can safely ignore it.</p>

    <p>Thanks,<br>Your Wallet Team</p>
</body>
</html>
