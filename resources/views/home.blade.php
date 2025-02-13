<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from solverwp.com/demo/html/edumint/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 Jan 2025 05:06:16 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel=icon href="assets/img/favicon.png" sizes="20x20" type="image/png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('fe/assets/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('fe/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fe/assets/css/responsive.css') }}">

</head>

<body>

    <!-- preloader area start -->
    <!-- <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div> -->
    <!-- preloader area end -->

    <!-- search popup start-->
    <div class="td-search-popup" id="td-search-popup">
        <form action="https://solverwp.com/demo/html/edumint/index.html" class="search-form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search.....">
            </div>
            <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!-- search popup end-->
    <div class="body-overlay" id="body-overlay"></div>

    <!-- navbar start -->
    <div class="navbar-area">

        <nav class="navbar navbar-area-2 navbar-area navbar-expand-lg">
            <div class="container nav-container">
                <div class="responsive-mobile-menu">
                    <button class="menu toggle-btn d-block d-lg-none" data-target="#edumint_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-left"></span>
                        <span class="icon-right"></span>
                    </button>
                </div>
                <div class="logo">
                    <a href="index.html"><img src="{{ asset('be/dist/assets/images/logo/logo-arsi.png') }}" alt="img" style="width: 80px !important;"></a>
                </div>

                <div class="collapse navbar-collapse" id="edumint_main_menu">
                    <ul class="navbar-nav menu-open">
                        <li>
                            <a href="#">Home</a>

                        </li>
                        <li>
                            <a href="#">Visi Misi</a>

                        </li>

                        <li>
                            <a href="#">Publikasi Akreditasi</a>

                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Bidang Unggulan</a>
                            <ul class="sub-menu">
                                <li><a href="about.html">Kerja sama</a></li>
                                <li><a href="event.html">Penelitian</a></li>
                                <li><a href="event-details.html">Pendidikan</a></li>

                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="nav-right-part nav-right-part-desktop style-black">
                    <!-- <a class="signin-btn" href="signin.html">Sign In</a> -->
                    <a class="btn btn-base" href="{{ route('login') }}">Login</a>
                    <!-- <a class="search-bar" href="#"><i class="fa fa-search"></i></a> -->
                </div>
            </div>
        </nav>
    </div>
    <!-- navbar end -->

    <!-- banner start -->
    <div class="banner-area banner-area-2" style="background-image: url('{{ asset('fe/assets/img/banner/2.png') }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 align-self-center">
                    <div class="banner-inner style-white text-center text-lg-left m-0 p-0">
                        <h4 class="b-animate-2 title">Universitas Yarsi
                            <br>

                            Sistem Manajeen Akreditasi Fakultasi
                        </h4>
                        <a class="btn btn-border-white b-animate-3" href="blog.html">Tentang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->

    <!-- intro start -->
    <div class="intro-area intro-area--top">
        <div class="container">
            <div class="intro-area-inner-2">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <!-- <div class="section-title text-center">
                            <h6 class="sub-title double-line">FEATURES</h6>
                            <h2 class="title">An exemplary <br> learning community</h2>
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-intro-inner style-thumb text-center">
                            <div class="thumb">
                                <img src="{{ asset('fe/assets/img/intro/4.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <h5>E-Arsip</h5>
                                <span style="font-size: 12px !important;">Penyimpanan dokumen akreditasi tiap fakultas</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-intro-inner style-thumb text-center">
                            <div class="thumb">
                                <img src="{{ asset('fe/assets/img/intro/5.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <h5>E-Reporting</h5>
                                <span style="font-size: 12px !important;">Reporting akreditasi tiap fakultas Universitas Yarsi</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-intro-inner style-thumb text-center">
                            <div class="thumb">
                                <img src="{{ asset('fe/assets/img/intro/6.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <h5>Publkasi Akreditasi</h5>
                                <span style="font-size: 12px !important;">Publikasi akreditasi tiap fakultas Universitas Yarsi</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- intro end -->

    <!-- about area start -->
    <div class="about-area pd-top-50">
        <div class="container">
            <div class="about-area-inner">
                <div class="row">

                    <div class="col-lg-12 col-md-6">
                        <div class="about-inner-wrap">
                            <div class="section-title mb-0">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="single-list-wrap">
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> <strong>Visi</strong>
                                            </li>

                                            {!! $visi_misi->visi  !!}


                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="single-list-wrap">
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> <strong>Misi</strong>
                                            </li>
                                            {!! $visi_misi->misi !!}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about area end -->

    <!-- course area start -->
    <div class="course-area pd-top-110 pd-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">

                        <h5 class="sub-title double-line">Bidang Unggulan</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-course-inner style-two">

                        <div class="thumb">
                            <img src="{{ asset('fe/assets/img/course/1.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">Pendidikan</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-course-inner style-two">

                        <div class="thumb">
                            <img src="{{ asset('fe/assets/img/course/1.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">Pendidikan</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-course-inner style-two">

                        <div class="thumb">
                            <img src="{{ asset('fe/assets/img/course/1.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">Pendidikan</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-course-inner style-two">

                        <div class="thumb">
                            <img src="{{ asset('fe/assets/img/course/1.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">Pendidikan</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- course area end -->

    <div class="course-area pd-top-50 pd-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">

                        <h5 class="sub-title double-line">Berita Terbaru</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-course-inner style-two">

                        <div class="thumb">
                            <img src="{{ asset('fe/assets/img/course/1.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">Pendidikan</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-course-inner style-two">

                        <div class="thumb">
                            <img src="{{ asset('fe/assets/img/course/1.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">Pendidikan</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-course-inner style-two">

                        <div class="thumb">
                            <img src="{{ asset('fe/assets/img/course/1.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">Pendidikan</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-course-inner style-two">

                        <div class="thumb">
                            <img src="{{ asset('fe/assets/img/course/1.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">Pendidikan</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- footer area start -->
    <!-- <footer class="footer-area footer-area-2 bg-white-50">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="widget widget_about text-center">
                            <a href="index.html"><img src="{{ asset('be/dist/assets/images/logo/logo-arsi.png') }}" alt="img"></a>
                            <div class="details">
                                <ul class="social-media">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget widget_contact">
                            <h4 class="widget-title">Contact Us</h4>
                            <ul class="details">
                                <li><i class="fa fa-map-marker"></i> 420 Love Sreet 133/2 Street NewYork</li>
                                <li><i class="fa fa-envelope"></i> <a href="https://solverwp.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="61080f070e4f020e0f1500021521060c00080d4f020e0c">[email&#160;protected]</a></li>
                                <li><i class="fa fa-phone"></i> 012 345 678 9101</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget widget_blog_list">
                            <h4 class="widget-title">News & Blog</h4>
                            <ul>
                                <li>
                                    <h6><a href="blog-details.html">Big Ideas Of Business Branding Info.</a></h6>
                                    <span class="date"><i class="fa fa-calendar"></i>December 7, 2022</span>
                                </li>
                                <li>
                                    <h6><a href="blog-details.html">Ui/Ux Ideas Of Business Branding Info.</a></h6>
                                    <span class="date"><i class="fa fa-calendar"></i>December 7, 2022</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget widget_nav_menu">
                            <h4 class="widget-title">Course</h4>
                            <ul>
                                <li><a href="course.html">Branding design</a></li>
                                <li><a href="course.html">Ui/Ux designing </a></li>
                                <li><a href="course.html">Make Elements</a></li>
                                <li><a href="course.html">Business</a></li>
                                <li><a href="course.html">Graphics design</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer> -->
    <!-- footer area end -->

    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <!-- back to top area end -->


    <script src="{{ asset('fe/assets/js/vendor.js') }}"></script>
    <script src="{{ asset('fe/assets/js/main.js') }}"></script>
</body>

<!-- Mirrored from solverwp.com/demo/html/edumint/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 Jan 2025 05:06:16 GMT -->

</html>
