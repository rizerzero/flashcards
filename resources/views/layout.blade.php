<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Flashcards</title>
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
  @livewireAssets
</head>

<body class="bg-gray-300 w-full h-full">
  @yield('content')
</body>

<script src="{{ mix('/js/app.js') }}"></script>
</html>