<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title> Billing Software</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
 <link rel="stylesheet" href="{{ asset('css/sale.css') }}">

</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h4 class="text-white text-center mb-4">Billing Menu</h4>
    <!-- Sidebar Navigation -->
<a href="{{ route('dashboard') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
<a href="{{ route('register') }}"><i class="fas fa-chart-line"></i> Register</a>
<a href="{{ route('customers.index') }}"><i class="fas fa-users"></i> Customers</a>
<a href="{{ route('products.index') }}"><i class="fas fa-boxes"></i> Products</a>
<a href="{{ route('sell.index') }}"><i class="fas fa-file-invoice"></i> Create Bill</a>
<!--<a href="history.html"><i class="fas fa-history"></i> Bill History</a>
<a href="gst-invoice.html"><i class="fas fa-receipt"></i> GST Invoice</a>
<a href="payment.html"><i class="fas fa-credit-card"></i> Payment</a>
<a href="product-stock.html"><i class="fas fa-warehouse"></i> Product Stock</a> -->
<a href="{{route('purchases.index')}}"><i class="fas fa-shopping-cart"></i> Purchase</a>
<!-- <a href="reports.html"><i class="fas fa-chart-bar"></i> Reports</a> -->
<a href="{{ route('suppliers.index') }}"><i class="fas fa-truck"></i> Supplier</a>
<a href="{{ route('units.index') }}"><i class="fas fa-balance-scale"></i> Unit Details</a>
<a href="{{ route('brands.index') }}"><i class="fas fa-tags"></i> Brands</a>
<a href="{{ route('variations.index') }}"><i class="fas fa-random"></i> Variation</a>
<a href="{{ route('categories.index') }}"><i class="fas fa-list"></i> Category</a>
<a href="{{ route('business-settings.index') }}"><i class="fas fa-building"></i> Business & Settings</a>
<a href="logout.html"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div> 

 <main class="main-content">
    @yield('content')
  </main>

  
 @stack('scripts')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> 

<script>
    // Enable all Bootstrap tooltips
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        new bootstrap.Tooltip(el);
    });

    // Toastr messages
    @if(session('successmessage'))
        toastr.success("{{ session('successmessage') }}", "Success", {
            closeButton: true,
            progressBar: true
        });
    @endif

    @if(session('errormessage'))
        toastr.error("{{ session('errormessage') }}", "Error", {
            closeButton: true,
            progressBar: true
        });
    @endif

    @if(session('infomessage'))
        toastr.info("{{ session('infomessage') }}", "Info", {
            closeButton: true,
            progressBar: true
        });
    @endif
    toastr.options = {
    closeButton: true,
    progressBar: true,
    timeOut: 3000,
    positionClass: "toast-top-right"
};

</script>

</body>
</html>
