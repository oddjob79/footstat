<body>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- <title>@yield('title')</title> -->
      <link rel="stylesheet" href="footstat/fonts/font-awesome/css/font-awesome.css">

      <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">

  </head>

<div id="app">
    <foot-stat-header></foot-stat-header>
    <div class="container">
        @yield('content')
    </div>
</div>
</body>

<script src="{{ mix('/js/app.js') }}"></script>
<!-- </html> -->
