@extends('front.views.layouts.default')

@section('title')
Qavah.us | Home
@endsection
@section('content')


<section class="sec-1">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-5" data-aos="fade-right">
                <h3 class="a">{{ $slider->greeting_text }}</h3>
                <h2 class="b">{{ $slider->heading }}</h2>
                <p class="c">{{ $slider->sub_text }}</p>
                 
                <a href="{{ $slider->button_url }}"><button class="btn-1"><img src="{{ asset("frontTheme") }}/assets/images/btn-img.png"
                            alt="btn-img"></button></a>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <!-- Slider main container -->
                <swiper-container class="mySwiper" effect="cards" grab-cursor="true">
                   @foreach(json_decode($slider->swiper_images) as $k => $v)
                    <swiper-slide><img src="{{$v}}" class="slide-1 img-fluid"></swiper-slide>
                   @endforeach
                </swiper-container>
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
<section class="sec-2">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6 extra-class" data-aos="zoom-in-right">
                <div class="center-phone">
                    <img class="main-second-image" src="{{ asset("frontTheme") }}/orbit/full-circle.png" alt="about">
                    <div class="onepicture"></div>
                    <div class="twopicture"></div>
                    <div class="threepicture"></div>
                    <!-- <a class="main-anchor"> -->
                    <!-- <img class="main-mid-image" src="./orbit/center-phone.png" alt="about"> -->
                    <!-- 
                </a> -->
                   
            </div>
            </div>

            <div class="col-md-6" data-aos="zoom-in-left">
              @php echo($sections["first_section_col"]["description"]) @endphp
            </div>
        </div>
    </div>
</section>
<section class="sec-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" data-aos="zoom-in">
                <div class="miles-sec">
                    <div class="miles-a bounceone">
                        <h4 id="boh4" class="i">5 Miles</h4>
                        <img id="boimg1" src="{{ asset("frontTheme") }}/assets/images/1-min.png" alt="5min" class="min">
                        <img src="{{ asset("frontTheme") }}/assets/images/1a.png" alt="5min" class="min1">
                    </div>
                    <div class="miles-b bouncetwo">
                        <h4 id="bth4" class="i">80 Miles</h4>
                        <img id="boimg2" src="{{ asset("frontTheme") }}/assets/images/2-min.png" alt="5min" class="min">
                        <img src="{{ asset("frontTheme") }}/assets/images/1a.png" alt="5min" class="min1">
                    </div>
                    <div class="miles-a bouncethree">
                        <h4 id="bthh4" class="i">12 Miles</h4>
                        <img id="boimg3" src="{{ asset("frontTheme") }}/assets/images/3-min.png" alt="5min" class="min">
                        <img src="{{ asset("frontTheme") }}/assets/images/1a.png" alt="5min" class="min1">
                    </div>
                    <div class="miles-b bouncefour">
                        <h4 id="bfh4" class="i">7 Miles</h4>
                        <img id="boimg4" src="{{ asset("frontTheme") }}/assets/images/4-min.png" alt="5min" class="min">
                        <img src="{{ asset("frontTheme") }}/assets/images/1a.png" alt="5min" class="min1">
                    </div>
                    <div class="miles-a bouncefive">
                        <h4 id="bfih4" class="i">144 Miles</h4>
                        <img id="boimg5" src="{{ asset("frontTheme") }}/assets/images/5-min.png" alt="5min" class="min">
                        <img src="{{ asset("frontTheme") }}/assets/images/1a.png" alt="5min" class="min1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sec-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4" data-aos="zoom-in-right">
                @php echo($sections["second_section_col_1"]["description"]) @endphp
            
            </div>
            <div class="col-md-4" data-aos="zoom-in">
                @php echo($sections["second_section_col_2"]["description"]) @endphp
            </div>
            <div class="col-md-4" data-aos="zoom-in-left">
                @php echo($sections["second_section_col_3"]["description"]) @endphp
            </div>
        </div>
    </div>
</section>
<section class="sec-5">
    <div class="col-1a" data-aos="zoom-in">
        <img src="{{ asset("frontTheme") }}/assets/images/newsletter-min.png" alt="newsletter-image" class="newsletter-image">
        <div class="co1-1b" data-aos="zoom-in">
            <video width="320" height="240" muted loop autoplay>
              <source src="{{ asset("frontTheme") }}/assets/images/video.mp4" type="video/mp4">
            </video>
            <!-- <h3 class="l">Get The App</h3>
            <p class="m">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in dolor ac dolor luctus
                ornare. Morbi volutpat lobortis dapibus. Ut volutpat auctor tortor id ornare. Mauris vulputate
                viverra consectetur. Phasellus hendrerit, mi vel volutpat tempor.</p>
            <img src="{{ asset("frontTheme") }}/assets/images/arrow.png" alt="arrow" class="arrow bounce2"> -->
        </div>
    </div>
</section>
<section class="sec-6">
    <div class="col-1c">
        <a href="javascript:"><img src="{{ asset("frontTheme") }}/assets/images/gplay.png" alt="gplay" class="gplay"></a>
        <a href="javascript:"><img src="{{ asset("frontTheme") }}/assets/images/appstore.png" alt="gplay" class="gplay"></a>
        <h4 class="comingsoon">Coming Soon</h4>
    </div>
</section>








@endsection