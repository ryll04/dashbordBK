<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard Bouquet</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/design-system.css'])
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: rgba(0, 0, 0, 0.5); /* Scrim background per DESIGN.md */
        }
        .login-card {
            width: 100%;
            max-width: 480px;
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.1);
        }
        .login-logo {
            text-align: center;
            margin-bottom: var(--space-xl);
            color: var(--color-primary);
        }
    </style>
</head>
<body>
    <div class="card card-lg login-card">
        <div class="login-logo text-heading-xl">
            Bouquet Admin
        </div>
        
        <h1 class="text-heading-lg" style="text-align: center; margin-bottom: var(--space-xl);">Welcome back</h1>

        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div style="margin-bottom: var(--space-lg);">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus>
            </div>

            <div style="margin-bottom: var(--space-xl);">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; height: 44px; font-size: 16px;">
                Log in
            </button>
        </form>
    </div>
</body>
</html>
