<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name') }}</title>
  @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-black">
{{--      style="background: linear-gradient(--}}
{{--      to bottom,--}}
{{--      #020617 0%, #020617 55%,--}}
{{--      #1e3a8a 55%, #1e3a8a 75%,--}}
{{--      #3b82f6 75%, #3b82f6 90%,--}}
{{--      #93c5fd 90%, #93c5fd 100%--}}
{{--      );">--}}
  <x-header/>
  {{ $slot }}
  <x-footer/>
</body>
</html>
