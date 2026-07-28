<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name') }}</title>
  @vite('resources/css/app.css')
  <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col font-sans text-white bg-[#082A45]">

<x-header/>

<main class="flex-grow flex flex-col justify-center items-center relative overflow-hidden bg-cover bg-center bg-no-repeat p-6"
      style="background-image: url('{{ asset('images/bg.jpg') }}');">

  {{ $slot }}

  <!--montanhas-->
  <div class="absolute bottom-0 left-0 right-0 z-0 pointer-events-none opacity-40 flex items-end">
    <svg class="w-full h-32 md:h-40" viewBox="0 0 1000 200" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
      <polygon points="0,200 150,80 300,200" fill="#a0c8e6"/>
      <polygon points="200,200 450,20 700,200" fill="#03111d"/>
      <polygon points="600,200 800,90 1000,200" fill="#2083b9"/>
    </svg>
  </div>
</main>
<x-footer/>
</body>
</html>
