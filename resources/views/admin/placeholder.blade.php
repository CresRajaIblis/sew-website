<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Halaman Staff' }}</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 800px; margin: 50px auto; text-align: center; }
        h1 { color: #8B4545; margin-bottom: 20px; }
        p { color: #555; }
        .back-link { display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #F59B9A; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $title ?? 'Halaman Staff' }}</h1>
        <p>Halaman ini sedang dalam pengembangan. Fitur akan segera diimplementasikan.</p>
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Kembali ke Dashboard</a>
    </div>
</body>
</html>