@extends('frontend.home.layout')
@section('content')

<main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Portfolio Details</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="current">Portfolio Details</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper init-swiper">

                        <script type="application/json" class="swiper-config">
                            {
                              "loop": true,
                              "speed": 600,
                              "autoplay": {
                                "delay": 5000
                              },
                              "slidesPerView": "auto",
                              "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                              }
                            }
                        </script>

                        <div class="swiper-wrapper align-items-center">
@foreach($project->images as $image)
                            <div class="swiper-slide">
                                <img src="{{asset($image->image)}}" alt="Portfolio Image" class="img-fluid" loading="lazy">
                            </div>
    @endforeach


                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info" data-aos="fade-left" data-aos-delay="200">
                        <h3>Project Information</h3>
                        <ul>
                            <li><strong>Category</strong>:{{$project->category->name}}</li>
                            <li><strong>Project date</strong>: {{$project->created_at->format('Y-m-d H:i:s') }}</li>
                            <li><strong>Project URL</strong>: <a href="{{$project->url}}" target="_blank">{{$project->url}}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                        <h2>Project Overview</h2>
                        <p>
                            {{$project->overview}}.
                            </p>

                        <div class="features mt-4">
                            <h3>Key Features</h3>
                            <div class="row gy-3">
                                @foreach($project->features as $feature)
                                <div class="col-md-6">
                                    <div class="feature-item" data-aos="fade-up" data-aos-delay="400">
                                        <h4>{{$feature['name']}}</h4>
                                        <p>{{$feature['description']}}</p>
                                    </div>
                                </div>
                                    @endforeach

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Portfolio Details Section -->

</main>

<

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

@endsection
