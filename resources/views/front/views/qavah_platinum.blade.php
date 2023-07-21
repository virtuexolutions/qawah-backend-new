@extends('front.views.layouts.default')

@section('title')
Qavah.us | Home
@endsection
@section('content')

<section class="pro-sec-1">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-5" data-aos="fade-right">
                <h3 class="a">Products</h3>
                <h2 class="b">Qavah Platinum</h2>
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

<section class="pro-sec-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col car" data-aos="zoom-in-right" style="padding: 0px 150px;">
                <!-- <img src="./assets/images/Path 679.png" alt="icon-star" class="icon-star"> -->
                <h4 class="pj">{{ $sections["first_section_col"]["icon_title_1"] }}</h4>
                <p class="k para-con">{{ $sections["first_section_col"]["icon_text_1"] }}</p>
           </div>
           
        </div>
    </div>
</section>

<section class="pro-sec-div">
    <div class="container">
        <div class="row">
            <div class="divider-den"></div>
        </div>        
    </div>
</section>

<section class="pro-sec-3">
    <div class="container firstpro">
        <div class="row">
            <div class="col-md-4" data-aos="zoom-in-right">
                <div class="car-d">
                   <h4 class="pp">{{ $sections["second_section_col_1"]["bullet_heading_1"] }}</h4>
                    <p class="ppp">{{ $sections["second_section_col_1"]["bullet_text_1"] }}</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in">
                <div class="car-d">
                    <h4 class="pp">{{ $sections["second_section_col_2"]["bullet_heading_1"] }}</h4>
                    <p class="ppp">{{ $sections["second_section_col_2"]["bullet_text_1"] }}</p>
                 </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in">
                <div class="car-d">
                    <h4 class="pp">{{ $sections["second_section_col_3"]["bullet_heading_1"] }}</h4>
                    <p class="ppp">{{ $sections["second_section_col_3"]["bullet_text_1"] }}</p>
            </div>
            </div>
        </div>
    </div>
    <div class="container secondpro">
        <div class="row">
            <div class="col-md-4" data-aos="zoom-in-right">
                <div class="car-d">
                    <h4 class="pp">{{ $sections["second_section_col_4"]["bullet_heading_1"] }}</h4>
                    <p class="ppp">{{ $sections["second_section_col_4"]["bullet_text_1"] }}</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in">
                <div class="car-d">
                    <h4 class="pp">{{ $sections["second_section_col_5"]["bullet_heading_1"] }}</h4>
                    <p class="ppp">{{ $sections["second_section_col_5"]["bullet_text_1"] }}</p>
              
            </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in">
                <div class="car-d">
                    <h4 class="pp">{{ $sections["second_section_col_6"]["bullet_heading_1"] }}</h4>
                    <p class="ppp">{{ $sections["second_section_col_6"]["bullet_text_1"] }}</p>
            </div>
            </div>
        </div>
    </div>
    <div class="container thirdpro">
        <div class="row">
            <div class="col-md-4" data-aos="zoom-in-right">
                <div class="car-d">
                    <h4 class="pp">{{ $sections["second_section_col_7"]["bullet_heading_1"] }}</h4>
                    <p class="ppp">{{ $sections["second_section_col_7"]["bullet_text_1"] }}</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in">
                <div class="car-d">
                  <h4 class="pp">{{ $sections["second_section_col_8"]["bullet_heading_1"] }}</h4>
                  <p class="ppp">{{ $sections["second_section_col_8"]["bullet_text_1"] }}</p>
            </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in">
                <div class="car-d">
                  <h4 class="pp">{{ $sections["second_section_col_9"]["bullet_heading_1"] }}</h4>
                  <p class="ppp">{{ $sections["second_section_col_9"]["bullet_text_1"] }}</p>
            </div>
            </div>
        </div>
    </div>
</section>

<section class="pro-sec-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12" data-aos="zoom-in-right">
                <div class="btn-sec">
                    {{-- <a href="javascript:"><button class="btn-5">Get Started Now</button></a> --}}
                </div>
            </div>
        </div>
    </div>
</section>




@endsection