@extends('layout.app')
@section('content')
<div class="login-card">
   {{-- Flash Messages --}}
              @if(session('successmessage'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('successmessage') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('errormessage'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('errormessage') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
  <h2 class="text-center">Billing Software Login</h2>
  <form action="{{ route('login.post') }}" method="POST" id="loginForm">
    @csrf
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" name="email" id="username" class="form-control" required />
    </div>
   <div class="mb-3">
  <label for="password" class="form-label">Password</label>
  <div class="input-group">
    <input type="password" name="password" id="password" class="form-control" required />
    <span class="input-group-text text-dark" id="togglePassword" style="cursor:pointer;">
      <i class="fa fa-eye" id="eyeIcon"></i>
    </span>
  </div>
</div>

    <div id="errorMsg" class="error"></div>
    <button type="submit" class="btn btn-custom w-100 mt-3">Login</button>
  </form>
</div>
@endsection
@push('scripts')

<script>
  function togglePassword() {
    const passwordField = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    if (passwordField.type === "password") {
      passwordField.type = "text";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
    } else {
      passwordField.type = "password";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
    }
  }
  document.getElementById("togglePassword").addEventListener("click", togglePassword);
</script>

</script>
     @endpush