<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Managing {{ $data->shortlink }}</title>
</head>
<body>
<div class="container mx-auto my-5">
    <h5>Dikunjungi Sebanyak: {{ $data->hit[0]->linkhit}} kali</h5>
</div>
</body>
</html>