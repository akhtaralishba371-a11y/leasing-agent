<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login · Leasing Agent</title>
    <style>
        * { box-sizing: border-box; }
        body { margin:0; font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
               background:#111827; color:#111827; display:flex; min-height:100vh; align-items:center; justify-content:center; }
        .box { background:#fff; width:360px; border-radius:12px; padding:32px; box-shadow:0 10px 40px rgba(0,0,0,.3); }
        .brand { text-align:center; font-size:22px; font-weight:700; margin-bottom:4px; }
        .sub { text-align:center; color:#6b7280; font-size:13px; margin-bottom:24px; }
        label { display:block; font-size:13px; font-weight:600; margin:14px 0 5px; }
        input { width:100%; padding:10px 12px; border:1px solid #e3e6ea; border-radius:8px; font-size:14px; }
        .btn { width:100%; margin-top:20px; background:#2563eb; color:#fff; border:0; padding:11px; border-radius:8px; font-size:15px; cursor:pointer; }
        .errors { background:#fee2e2; color:#991b1b; padding:10px 14px; border-radius:8px; margin-bottom:14px; font-size:13px; }
        .remember { display:flex; align-items:center; gap:7px; margin-top:14px; font-size:13px; font-weight:500; }
        .remember input { width:auto; }
    </style>
</head>
<body>
    <form class="box" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="brand">🏢 Leasing Agent</div>
        <div class="sub">Admin sign in</div>

        @if ($errors->any())
            <div class="errors">{{ $errors->first() }}</div>
        @endif

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus>

        <label>Password</label>
        <input type="password" name="password" required>

        <label class="remember"><input type="checkbox" name="remember"> Remember me</label>

        <button class="btn">Sign In</button>
    </form>
</body>
</html>
