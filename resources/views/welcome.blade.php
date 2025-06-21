<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bumi Sicurem</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f5f9;
            color: #1e293b;
            font-family: Arial, sans-serif;
            text-align: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .brand {
            position: absolute;
            top: 20px;
            left: 30px;
            font-weight: bold;
            font-size: 20px;
            color: #0f172a;
        }

        .container {
            flex: 1;
            padding: 100px 20px 20px;
        }

        h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }

        h3 {
            font-weight: normal;
            color: #64748b;
            margin-bottom: 40px;
        }

        .btn {
            background-color: #3b82f6;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2563eb;
        }

        .logo {
            margin-bottom: 40px;
        }

        .logo img {
            max-width: 120px;
            height: auto;
        }

        .footer {
            background-color: #e2e8f0;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #475569;
        }
    </style>
</head>
<body class="antialiased">


    <div class="container">
        <div class="logo">
            <img src="{{ asset('logo.jpeg') }}" alt="Logo Bumitekno">
        </div>
        <h1>Selamat Datang di<br>Website SICUREM</h1>
        <h3>Sistem Informasi Customer Relationship Management<br>Pengaduan Keluhan Layanan Anda Lebih Efektif dan Efisien</h3>
        <a href="{{ route('login') }}" class="btn">Mulai Sekarang</a>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} SICUREM | PT. Bumi Tekno Indonesia | ISMI A DIGITECH
    </div>
</body>
</html>
