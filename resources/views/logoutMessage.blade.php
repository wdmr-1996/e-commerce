<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Message</title>
</head>
<body>
    <script>
        console.log("Se ha cerrado la sesión");
        window.location.href = "{{ route('login') }}";
    </script>
    
</body>
</html>
