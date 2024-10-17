<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sticker Effect</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/BENOW.png') }}" />
    
    <!-- Styles CSS -->
    <link rel="stylesheet" href="{{ asset('styles/app.css') }}" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <span>CODE</span>
        <span>STICKER</span>
    </nav>
    <div id="app"></div>

    <!-- Scripts -->
    <script type="module" src="{{ asset('scripts/main.js') }}"></script>
</body>
</html>
