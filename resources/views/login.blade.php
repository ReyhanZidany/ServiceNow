<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('img/ipclands.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .logo {
            max-width: 100px;
            margin-bottom: 20px;
        }
        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .form-input:focus {
            outline: none;
            border-color: #4a90e2;
        }
        .form-button {
            width: 100%;
            padding: 10px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-button:hover {
            background-color: #357ebd;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="{{ asset('img/logotpk.png') }}" alt="Logo IPC" class="logo">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Login</h2>
        
        @if(session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif
        
        <form method="POST" action="{{ route('login.process') }}">
            @csrf
            <input type="text" name="email" placeholder="Email" class="form-input" required>
            <input type="password" name="password" placeholder="Password" class="form-input" required>
            <button type="submit" class="form-button">Login</button>
        </form>
    </div>
</body>
</html>
