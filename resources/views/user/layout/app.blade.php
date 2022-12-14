
<!doctype html>
<html lang="en">
  <head>
    @include('user.layout.head')
  </head>
<body>
<header>
    @include('user.layout.header')
</header>

<main>
    @yield('content')
</main>

@include('user.layout.footer')
</body>
</html>
