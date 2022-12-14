<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layout.head')
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    @include('admin.layout.sidebar')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        @include('admin.layout.topbar')
        <!-- Topbar -->

        <!-- Container Fluid-->
        @yield('content')

        <!---Container Fluid-->
      </div>
      @include('notify::components.notify')

      <!-- Footer -->
      @include('admin.layout.footer')
      <!---Footer -->
</body>

</html>
