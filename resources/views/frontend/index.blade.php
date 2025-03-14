@php
    $profile = asset(Storage::url('upload/profile'));
    $settings = settings();
    $user = \App\Models\User::find(1);
    \App::setLocale($user->lang);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="author" content="{{ !empty($settings['app_name']) ? $settings['app_name'] : env('APP_NAME') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ !empty($settings['app_name']) ? $settings['app_name'] : env('APP_NAME') }} - @yield('page-title') </title>

    <meta name="title" content="{{ $settings['meta_seo_title'] }}">
    <meta name="keywords" content="{{ $settings['meta_seo_keyword'] }}">
    <meta name="description" content="{{ $settings['meta_seo_description'] }}">


    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:title" content="{{ $settings['meta_seo_title'] }}">
    <meta property="og:description" content="{{ $settings['meta_seo_description'] }}">
    <meta property="og:image" content="{{ asset(Storage::url('upload/seo')) . '/' . $settings['meta_seo_image'] }}">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:title" content="{{ $settings['meta_seo_title'] }}">
    <meta property="twitter:description" content="{{ $settings['meta_seo_description'] }}">
    <meta property="twitter:image"
        content="{{ asset(Storage::url('upload/seo')) . '/' . $settings['meta_seo_image'] }}">


    <link rel="icon" href="{{ asset(Storage::url('upload/logo')) . '/' . $settings['company_favicon'] }}"
        type="image/x-icon" />
    <link href="{{ asset('assets/css/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins/swiper-bundle.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
        id="main-font-link" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/phosphor/duotone/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        header:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: none;
            background-position: right bottom;
            background-size: 80%;
            background-repeat: no-repeat;
            z-index: 1;
        }

        header {
            padding: 100px 0;
            display: flex;
            align-items: center;
            min-height: 60vh;
            background: linear-gradient(360deg, rgb(238, 242, 246) 1.09%, rgb(255, 255, 255) 100%);
            overflow: hidden;
            position: relative;
        }

        .frcard {
            background: rgba(var(--bs-secondary-rgb), 0.2);
            color: var(--bs-secondary);
        }

        section {
            padding: 60px 0;
        }
    </style>
</head>

<body class="landing-page" data-pc-preset="{{ $settings['accent_color'] }}" data-pc-sidebar-theme="light"
    data-pc-sidebar-caption="{{ $settings['sidebar_caption'] }}" data-pc-direction="{{ $settings['theme_layout'] }}"
    data-pc-theme="{{ $settings['theme_mode'] }}">


    <nav class="navbar navbar-expand-md navbar-light default">
        <div class="container">
            <a class="navbar-brand landing-logo" href="#">
                <img src="{{ asset(Storage::url('upload/logo/landing_logo.png')) }}" alt="logo"
                    class="img-fluid " />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#FAQs">{{ __('FAQs') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">{{ __('Blog') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#KnowledgeBase">{{ __('Knowledge Base') }}</a>
                    </li>
                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- [ Nav ] start -->
    <!-- [ Header ] start -->


    <header id="home">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="land-title">
                        <h2 class="wow fadeInLeft text-center"
                            style="visibility: visible; animation-name: fadeInLeft;">
                            {{ __('Create Ticket') }}</h2>
                        <p class="wow fadeInRight text-center"
                            style="visibility: visible; animation-name: fadeInRight;">
                            {{ __('A support ticket creation process involves users submitting requests for assistance or reporting issues to a support team or system') }}
                        </p>
                    </div>
                    <div class="card">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-primary">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card-body">
                            {{ Form::open(['route' => ['ticket.data.store', $code], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                            <div class="form-group">
                                <div class="small-group row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        {{ Form::label('name', __('Requester Name'), ['class' => 'form-label']) }}
                                        {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => __('Enter requester name')]) }}
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        {{ Form::label('email', __('Requester Email Address'), ['class' => 'form-label']) }}
                                        {{ Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => __('Enter requester email address')]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="small-group row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        {{ Form::label('password', __('Requester Password'), ['class' => 'form-label']) }}
                                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter requester password')]) }}
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        {{ Form::label('headline', __('Headline'), ['class' => 'form-label']) }}
                                        {{ Form::text('headline', old('headline'), ['class' => 'form-control', 'placeholder' => __('Enter ticket headline')]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="small-group row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        {{ Form::label('category', __('Category'), ['class' => 'form-label']) }}
                                        {{ Form::select('category', $category, old('category'), ['class' => 'form-control hidesearch basic-select']) }}
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        {{ Form::label('importance', __('Importance'), ['class' => 'form-label']) }}
                                        {{ Form::select('importance', $importance, old('importance'), ['class' => 'form-control hidesearch basic-select']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="small-group">
                                    <div>
                                        {{ Form::label('attachment', __('File Attachment'), ['class' => 'form-label']) }}
                                        {{ Form::file('attachment[]', ['class' => 'form-control', 'multiple']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('summary', __('Ticket Summary'), ['class' => 'form-label']) }}
                                {{ Form::textarea('summary', old('summary'), ['class' => 'form-control', 'rows' => 2, 'placeholder' => __('summary...')]) }}
                            </div>
                            <div class="form-group mb-0">
                                <div class="group-btn">
                                    {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary btn-rounded']) }}
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </header>

    <!-- [ Header ] End -->
    <!-- [ section ] start -->


    <section class="frameworks-section" id="FAQs">


        <div class="container">
            <div class="row justify-content-center title">
                <div class="col-md-9 col-lg-6 text-center">
                    <h2 class="h1">
                        {{ __('FAQs') }}
                    </h2>
                    <p class="text-lg">
                        {{ __('Our FAQ provides valuable insights and solutions to help you navigate and utilize our support services effectively.') }}
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="accordion accordion-flush" id="accordionFlushExample">

                        @foreach ($faqs as $FAQ_key => $faq)
                            <div class="accordion-item">

                                <h2 class="accordion-header" id="flush-{{ $faq->id }}">
                                    <button class="accordion-button {{ $FAQ_key == 0 ? '' : 'collapsed' }} text-muted"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse-{{ $faq->id }}" aria-expanded="false"
                                        aria-controls="flush-collapseThree">
                                        <b>{{ $faq->title }}</b>
                                    </button>
                                </h2>
                                <div id="flush-collapse-{{ $faq->id }}"
                                    class="accordion-collapse collapse {{ $FAQ_key == 0 ? 'collapse show' : '' }}"
                                    aria-labelledby="flush-{{ $faq->id }}"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body text-muted">{{ $faq->description }}</div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>


    </section>




    <!-- [ section ] start -->

    <section id="blog" class="bg-body">



        <div class="container">
            <div class="row justify-content-center title">
                <div class="col-md-9 col-lg-6 text-center">
                    <h2 class="h1">
                        {{ __('Blog') }}
                    </h2>
                    <p class="text-lg">
                        {{ __('The support ticket blog serves as a centralized hub for users to access valuable resources, including guides, tutorials, and updates, aimed at enhancing their experience with the support ticket system') }}
                    </p>
                </div>
            </div>

            <div class="row">

                @foreach ($blogs as $blog)
                    <div class="col-sm-6 col-lg-4 col-xxl-4">
                        <div class="card border">
                            <div class="card-body p-2">
                                <div class="position-relative">
                                    <a class="hover-link" href="#"> <img
                                            src="{{ asset('/storage/upload/blog/' . $blog->thumbnail) }}"
                                            alt="1.jpg" class="img-fluid w-100" />
                                    </a>
                                </div>
                                <ul class="list-group list-group-flush my-2">
                                    <li class="list-group-item px-0 py-2">
                                        <p>{{ $blog->description }}</p>
                                    </li>

                                    <li class="list-group-item px-0 py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 me-2">
                                                <span
                                                    class="btn btn-sm btn-outline-secondary mb-2">{{ !empty($blog->categories) ? $blog->categories->category : '-' }}</span>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <span>{{ $blog->created_at }}</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="d-flex align-items-center">

                                    <div class="date-info"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>

    <!-- [ section ] End -->
    <!-- [ section ] start -->

    <section id="KnowledgeBase">
        <div class="container">
            <div class="row justify-content-center title">
                <div class="col-md-9 col-lg-6 text-center">
                    <h2 class="h1">
                        {{ __('Knowledge Base') }}
                    </h2>
                    <p class="text-lg">
                        {{ __('A support ticket knowledge base is a comprehensive collection of articles, guides, troubleshooting steps, and frequently asked questions (FAQs) aimed at providing users with self-service resources to resolve their issues') }}
                    </p>
                </div>
            </div>
            <div class="row">
                @foreach ($articles as $article)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="card follower-card">
                            <div class="card-body p-3">

                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h4 class="fw-semibold mb-0 text-truncate">{{ $article->title }}</h4>

                                </div>
                                <div class="g-2">
                                    <div class="col-12">
                                        <p>{{ $article->description }}</p>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid d-flex">
                                            <i data-feather="calendar"></i>
                                            <div class="ms-2">{{ $article->created_at }}</div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>


    <!-- [ section ] End -->



    <footer class="bg-dark sub-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col my-1 wow fadeInUp" data-wow-delay="0.4s">
                    <p class="mb-0 text-white text-opacity-75 f-20 text-center">

                        @if (!empty($settings['copyright']))
                            {{ $settings['copyright'] }}
                        @else
                            {{ __('Copyright') }} {{ date('Y') }} {{ env('APP_NAME') }}
                        @endif
                    </p>
                </div>

            </div>
        </div>
    </footer>


    {{-- <div class="scroll-top"><i class="fa fa-angle-double-up"></i></div> --}}

    <div class="modal fade" id="customModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5><a href="javascript:void(0);" data-bs-dismiss="modal"><i
                            class="ti-close"></i></a>
                </div>
                <div class="body">
                </div>
            </div>
        </div>
    </div>






    <!-- [ footer ] End -->
    <!-- Required Js -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>


    <!-- old -->

    <script src="{{ asset('assets/js/icons/feather-icon/feather.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        //*** Menu Js ***//
        $(document).on("click", '.menu-action', function() {
            $('.menu-list').toggleClass('open');
        });
        $(document).on("click", '.close-menu', function() {
            $('.menu-list').removeClass('open');
        });

        //*** BACK TO TOP START ***//
        $(window).scroll(function() {
            if ($(window).scrollTop() > 450) {
                $('.scroll-top').addClass('show');
            } else {
                $('.scroll-top').removeClass('show');
            }
        });
        $(document).ready(function() {
            $(document).on("click", '.scroll-top', function() {
                $('html, body').animate({
                    scrollTop: 0
                }, '450');
            });
        });

        //*** WOW Js ***//
        new WOW().init();
    </script>

    <!-- old -->

    <script>
        font_change('Roboto');
    </script>

    <!-- [Page Specific JS] start -->
    <script src="{{ asset('assets/js/plugins/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/swiper-bundle.js') }}"></script>
    <script>
        // Start [ Menu hide/show on scroll ]
        let ost = 0;
        document.addEventListener('scroll', function() {
            let cOst = document.documentElement.scrollTop;
            if (cOst == 0) {
                document.querySelector('.navbar').classList.add('top-nav-collapse');
            } else if (cOst > ost) {
                document.querySelector('.navbar').classList.add('top-nav-collapse');
                document.querySelector('.navbar').classList.remove('default');
            } else {
                document.querySelector('.navbar').classList.add('default');
                document.querySelector('.navbar').classList.remove('top-nav-collapse');
            }
            ost = cOst;
        });
        // End [ Menu hide/show on scroll ]
        var wow = new WOW({
            animateClass: 'animated'
        });
        wow.init();
        const app_Swiper = new Swiper('.app-slider', {
            loop: true,
            slidesPerView: '1.2',
            centeredSlides: true,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            }
        });
        const choose_Swiper = new Swiper('.choose-slider', {
            direction: 'vertical',
            loop: true,
            centeredSlides: true,
            slidesPerView: '4',
            autoplay: {
                delay: 2500,
                disableOnInteraction: false
            }
        });
        const frameworks_Swiper = new Swiper('.frameworks-slider', {
            loop: true,
            centeredSlides: true,
            spaceBetween: 24,
            slidesPerView: 2,
            pagination: {
                el: '.swiper-pagination',
                dynamicBullets: true,
                clickable: true
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 4
                },
                1024: {
                    slidesPerView: 5
                }
            }
        });
    </script>
    <!-- [Page Specific JS] end -->
</body>

</html>
