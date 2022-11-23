<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Library Management System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


    <!-- Favicon -->
    <link href="{{asset('theme/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('theme/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('theme/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('theme/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('theme/css/style.css')}}" rel="stylesheet">

    <style>


        div.polaroid {
          width: 80%;
          background-color: white;
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
          margin-bottom: 25px;
        }


        </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>Online Library</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="#" class="nav-item nav-link active">Home</a>
                <a href="#about" class="nav-item nav-link">About</a>
                <a href="#featured" class="nav-item nav-link">Featured</a>
                <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
            </div>

        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('img/backgroun.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Online Library</h5>
                                <h1 class="display-3 text-white animated slideInDown">Library Management System</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Library management systems are designed to manage the movement of books and maintain records of the members in a library. The software solution is designed based on the system requirements, the people involved, the content of the operation and the activity to be performed.</p>

                                <a href="{{ route('login') }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{asset('theme/img/b1.jpeg')}}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Books</h5>
                                <h1 class="display-3 text-white animated slideInDown">Reserve your book now</h1>
                                <p class="fs-5 text-white mb-4 pb-2">The purpose of a library management system is to operate a library with efficiency and at reduced costs. The system being entirely automated streamlines all the tasks involved in operations of the library.</p>
                                <a href="{{ route('login') }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxl py-5" id="featured">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Books</h6>
            <h1 class="mb-5">Featured Books</h1>
        </div>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="polaroid" style="box-shadow: 10px 10px 5px lightblue;">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <img src="{{ asset('img/1.jpg') }}" alt="" style="max-width: 100%;height:200px;width:250px;
                                max-height: 100%;" class="mb-2">
                                <h5 class="mb-3">Advances in Machine Learning</h5>

                            </div>
                        </div>
                  </div>
                </div>

                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="polaroid"  style="box-shadow: 10px 10px 5px lightblue;">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <img src="{{ asset('img/2.jpg') }}" alt="" style="max-width: 100%;height:200px;width:250px;
                            max-height: 100%;" class="mb-2">
                            <h5 class="mb-3">Advances in Solid State Circuit Technologies</h5>

                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="polaroid" style="box-shadow: 10px 10px 5px lightblue;">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <img src="{{ asset('img/3.jpg') }}" alt="" style="max-width: 100%;height:200px;width:250px;
                            max-height: 100%;" class="mb-2">
                            <h5 class="mb-3">Algorithms & Data Structures</h5>

                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="polaroid" style="box-shadow: 10px 10px 5px lightblue;">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <img src="{{ asset('img/4.jpg') }}" alt="" style="max-width: 100%;height:200px;width:250px;
                            max-height: 100%;" class="mb-2">
                            <h5 class="mb-3">Applications of Data Mining in Engineering Management and  medicine</h5>

                        </div>
                    </div>
                    </div>
                </div>

            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="polaroid" style="box-shadow: 10px 10px 5px lightblue;">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <img src="{{ asset('img/5.jpg') }}" alt="" style="max-width: 100%;height:200px;width:250px;
                            max-height: 100%;" class="mb-2">
                            <h5 class="mb-3">Big Data Analytics - Methods and Applications</h5>

                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="polaroid" style="box-shadow: 10px 10px 5px lightblue;">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <img src="{{ asset('img/6.jpg') }}" alt="" style="max-width: 100%;height:200px;width:250px;
                            max-height: 100%;" class="mb-2">
                            <h5 class="mb-3">Block chain technologies and Crypto-currencies</h5>

                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="polaroid" style="box-shadow: 10px 10px 5px lightblue;">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <img src="{{ asset('img/7.jpg') }}" alt="" style="max-width: 100%;height:200px;width:250px;
                            max-height: 100%;" class="mb-2">
                            <h5 class="mb-3">Computational Fluid Mechanics and Dynamics for Science</h5>

                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="polaroid" style="box-shadow: 10px 10px 5px lightblue;">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <img src="{{ asset('img/8.jpg') }}" alt="" style="max-width: 100%;height:200px;width:250px;
                            max-height: 100%;" class="mb-2">
                            <h5 class="mb-3">Computer Based Management System & E-Commerce</h5>

                        </div>
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- About Start -->
    <div class="container-xxl py-5" id="about">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{ asset('img/main.jpg') }}" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                    <h1 class="mb-4">DFCAMCLP – SATELLITE CAMPUS</h1>
                    <p class="mb-4">Dr. Filemon C. Aguilar Memorial College (DFCAMCLP-SATELLITE CAMPUS) is located in Doña Manuela Subd., Pamplona 3, municipality of Las Piñas City. With the existence of the school in 1986, the school library was established. This school offered courses in BSIS and BSCPE. And this is a public scholar school handled by the Mayor of the City of Las Piñas, Imelda Aguilar.</p>

                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Authors</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Book Reservation</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Easy Reservation Process</p>
                        </div>

                    </div>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="{{ route('login') }}">Get Started</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Categories Start -->
    <div class="container-xxl py-5 category">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Books</h6>
                <h1 class="mb-5">Popular</h1>
            </div>
            <div class="row g-3">
                <div class="col-lg-7 col-md-6">
                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                            <a class="position-relative d-block overflow-hidden" >
                                <img class="img-fluid" src="{{asset('theme/img/2.png')}}" alt="">
                                <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                    <h5 class="m-0">Culture and Anarchy (1867-9)</h5>
                                    <small class="text-primary">Matthew Arnold</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                            <a class="position-relative d-block overflow-hidden" >
                                <img class="img-fluid" src="{{asset('theme/img/5.png')}}" alt="">
                                <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                    <h5 class="m-0">Harry Potter</h5>
                                    <small class="text-primary">J. K. Rowling</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                            <a class="position-relative d-block overflow-hidden" >
                                <img class="img-fluid" src="{{asset('theme/img/5.jpg')}}" alt="">
                                <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                    <h5 class="m-0">Readers Digets</h5>
                                    <small class="text-primary">Childhood</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                    <a class="position-relative d-block h-100 overflow-hidden" >
                        <img class="img-fluid position-absolute w-100 h-100" src="{{asset('theme/img/1.jpg')}}" alt="" style="object-fit: cover;">
                        <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin:  1px;">
                            <h5 class="m-0">Between Past and Future (1961)</h5>
                            <small class="text-primary">Hannah Arendt</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Categories Start -->





    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Authors</h6>
                <h1 class="mb-5">Top</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{asset('theme/img/a1.jpg')}}" alt="" style="width:100%;
                            height:350px;  object-fit: cover;">
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">J.K Rowling</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{asset('theme/img/a2.jpg')}}" alt="" style="width:100%;
                            height:350px;  object-fit: cover;">
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Stephen King</h5>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{asset('theme/img/a3.png')}}" alt="" style="width:100%;
                            height:350px;  object-fit: cover;">
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">James Patterson</h5>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{asset('theme/img/a4.jpg')}}" alt="" style="width:100%;
                            height:350px;  object-fit: cover;">
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">nicholas sparks</h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->





    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">

        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Library Management System 2022</a>, All Right Reserved.
                        <div class="d-flex pt-2 mt-3">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('theme/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('theme/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('theme/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('theme/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('theme/js/main.js')}}"></script>
</body>

</html>
