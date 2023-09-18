<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Esewa</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div class="align-content-center">
    <form action="{{ route('esewaProcess') }}" method="post">
        @csrf
        <input type="hidden" name="user_id" value="1221">
        <input type="hidden" name="name" value="Saroj">
        <input type="hidden" name="email" value="sarojsardar25@gmail.com">
        <input type="hidden" name="amount" value="1">

        <input type="submit" value="Pay With Esewa">

    </form>
</div>
</body>
</html>
