<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
  integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
  integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
  integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="{{ asset("frontTheme") }}/assets/css/style.css" rel="stylesheet">
<link rel="script" href="{{ asset("frontTheme") }}/assets/css/myscript.js">

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body>
@include('front.views.layouts.header')


<div class="content">
  @yield('content')
  <!-- /.container-fluid -->
</div>

@include('front.views.layouts.footer')

</body>
<script type="text/javascript">
  function PopUp(hideOrshow) {
      if (hideOrshow == 'hide') document.getElementById('ac-wrapper').style.display = "none";
      else document.getElementById('ac-wrapper').removeAttribute('style');
  }
  window.onload = function () {
      setTimeout(function () {
          PopUp('show');
      }, 1000);
  }
  </script>
  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
          crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.3.js"
          integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
  $(document).click(function()
  {
       popups_close();
  })
  
  function popups_close()
  {
      $("#popup").remove();
  }  
  </script>
      <script>
          AOS.init({once: true});
      </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.0.5/swiper-bundle.min.js" integrity="sha512-cEcJcdNCHLm3YSMAwsI/NeHFqfgNQvO0C27zkPuYZbYjhKlS9+kqO5hZ9YltQ4GaTDpePDQ2SrEk8gHUVaqxig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script>
          var swiper = new Swiper(".mySwiper", {
          effect: "cards",
          grabCursor: true,
          autoplay: true,
        });
      </script>
      <script>
      const heading = document.getElementById('boh4');
  
  const imageMouse = document.getElementById('boimg1');
  
  imageMouse.addEventListener('mouseover', function handleMouseOver() {
    heading.style.visibility = 'visible';
  
  });
  
  imageMouse.addEventListener('mouseout', function handleMouseOut() {
    heading.style.visibility = 'hidden';
  
  });
  
  const heading1 = document.getElementById('bth4');
  
  const imageMouse1 = document.getElementById('boimg2');
  
  imageMouse1.addEventListener('mouseover', function handleMouseOver() {
    heading1.style.visibility = 'visible';
  
  });
  
  imageMouse1.addEventListener('mouseout', function handleMouseOut() {
    heading1.style.visibility = 'hidden';
  
  });
  
  const heading2 = document.getElementById('bthh4');
  
  const imageMouse2 = document.getElementById('boimg3');
  
  imageMouse2.addEventListener('mouseover', function handleMouseOver() {
    heading2.style.visibility = 'visible';
  
  });
  
  imageMouse2.addEventListener('mouseout', function handleMouseOut() {
    heading2.style.visibility = 'hidden';
  
  });
  
  const heading3 = document.getElementById('bfh4');
  
  const imageMouse3 = document.getElementById('boimg4');
  
  imageMouse3.addEventListener('mouseover', function handleMouseOver() {
    heading3.style.visibility = 'visible';
  
  });
  
  imageMouse3.addEventListener('mouseout', function handleMouseOut() {
    heading3.style.visibility = 'hidden';
  
  });
  
  const heading4 = document.getElementById('bfih4');
  
  const imageMouse4 = document.getElementById('boimg5');
  
  imageMouse4.addEventListener('mouseover', function handleMouseOver() {
    heading4.style.visibility = 'visible';
  
  });
  
  imageMouse4.addEventListener('mouseout', function handleMouseOut() {
    heading4.style.visibility = 'hidden';
  
  });
  </script>
</html>