<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Billing Software</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

 <main class="main-content">
     @yield('content')
  </main>
 @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
        new bootstrap.Tooltip(el);
    });

    @if (Session::has('successmessage'))
        toastr.success("{{ Session::get('successmessage') }}", "Success", { closeButton: true, progressBar: true });
    @endif

    @if (Session::has('errormessage'))
        toastr.error("{{ Session::get('errormessage') }}", "Error", { closeButton: true, progressBar: true });
    @endif

    @if (Session::has('infomessage'))
        toastr.info("{{ Session::get('infomessage') }}", "Info", { closeButton: true, progressBar: true });
    @endif
</script>
  </body>
</html>
