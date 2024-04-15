<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="../images/customer/fevicon.png" type="image/png" />
    <title>Eiser ecommerce</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/customer/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/linericon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/customer/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/customer/css/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/customer/css/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/lightbox/simpleLightbox.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/nice-select/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/jquery-ui/jquery-ui.css') }}" />
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('css/customer/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/customer/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css') }}" />

</head>

<body>
  <!--================Header Menu Area =================-->
@include('customer.layouts.header')
  <!--================Header Menu Area =================-->

@yield('content')

  <!--================ start footer Area  =================-->
@include('customer.layouts.footer')
  <!--================ End footer Area  =================-->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="{{ asset('js/customer/js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('js/customer/js/popper.js') }}"></script>
  <script src="{{ asset('js/customer/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/customer/js/stellar.js') }}"></script>
  <script src="{{ asset('vendors/lightbox/simpleLightbox.min.js') }}"></script>
  <script src="{{ asset('vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
  <script src="{{ asset('vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendors/isotope/isotope-min.js') }}"></script>
  <script src="{{ asset('vendors/owl-carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/customer/js/jquery.ajaxchimp.min.js') }}"></script>
  <script src="{{ asset('vendors/counter-up/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('vendors/counter-up/jquery.counterup.js') }}"></script>
  <script src="{{ asset('js/customer/js/mail-script.js') }}"></script>
  <script src="{{ asset('js/customer/js/theme.js') }}"></script>
</body>

</html>
