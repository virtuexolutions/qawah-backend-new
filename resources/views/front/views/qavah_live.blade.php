@extends('front.views.layouts.default')

@section('title')
Qavah.us | Home
@endsection
@section('content')

<section class="pro-sec-1">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-5" data-aos="fade-right">
                <h2 class="b">Qavah Live</h2>
                <!-- <p class="c">Qavah Definition - Is the hebrew word that means to wait actively with anticipation,
                hopefully watching for YAH to act...</p> -->
                <!-- <a href="javascript:"><button class="btn-1"><img src="./assets/images/btn-img.png"
                        alt="btn-img"></button></a> -->
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <!-- Slider main container -->
                <!-- <swiper-container class="mySwiper" effect="cards" grab-cursor="true">
                <swiper-slide><img src="./assets/images/bg1.png" class="slide-1 img-fluid"></swiper-slide>
                <swiper-slide><img src="./assets/images/bg2.png" class="slide-1 img-fluid"></swiper-slide>
                <swiper-slide><img src="./assets/images/bg3.png" class="slide-1 img-fluid"></swiper-slide>
            </swiper-container> -->
            </div>
            <div class="col-md-1">
                <div class="social-icons">
                    <a href="javscript:"><i class="fa-brands fa-instagram"></i></a>
                    <a href="javscript:"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="javscript:"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-sec-1">
    <div class="container">
        <div class="row" data-aos="zoom-in">
            <div class="col-md-12">
              @php echo $sections["first_section_col"]["description"] @endphp
            </div>

        </div>
    </div>
</section>




@endsection