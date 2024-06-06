<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Email</title>
</head>
<body>
    <h1>Hello, {{ $account->name }}</h1>
    <p>Please click the link below to verify your email address:</p>
    <a href="{{ URL::temporarySignedRoute('account.verify', now()->addMinutes(30), ['id' => $account->user_id]) }}" class="btn btn-primary">Verify Email</a>
</body>
</html>
