@extends('frontend.home.layout')
@section('content')

<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="background-elements">
            <div class="bg-circle circle-1"></div>
            <div class="bg-circle circle-2"></div>
        </div>

        <div class="hero-content">

            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                        <div class="hero-text">
                            <h1>Proto<span class="accent-text">folio</span></h1>
                            <h2>{{$slider->title}}</h2>
                            <p class="lead">I'm a <span class="typed" data-typed-items="{{$slider->sub_title}}"></span></p>
                            <p class="description">{{$slider->description}}.</p>

                            <div class="hero-actions">
                                <a href="#portfolio" class="btn btn-primary">View My Work</a>
                                <a href="#contact" class="btn btn-outline">Get In Touch</a>
                            </div>

                            <div class="social-links">
                                <a href="{{$settings->valueOf('twitter')}}" class="twitter"><i class="bi bi-twitter-x"></i></a>
                                <a href="{{$settings->valueOf('facebook')}}" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="{{$settings->valueOf('instagram')}}" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="{{$settings->valueOf('linkedin')}}" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                <a href="{{$settings->valueOf('github')}}"><i class="bi bi-github"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                        <div class="hero-visual">
                            <div class="profile-container">
                                <div class="profile-background"></div>
                                <img src="{{$slider->image}}" alt="Image" class="profile-image">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row">
                <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
                    <div class="profile-card">
                        <div class="profile-header">
                            <div class="profile-image">
                                <img src="{{$about->image}}" alt="Image" class="img-fluid">
                            </div>
                            <div class="profile-badge">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                        </div>

                        <div class="profile-content">
                            <h3>{{$about->name}}</h3>
                            <p class="profession">{{$about->postion}}</p>

                            <div class="contact-links">
                                <a href="mailto:{{$settings->valueOf('email')}}" class="contact-item">
                                    <i class="bi bi-envelope"></i>
                                    {{$settings->valueOf('email')}}
                                </a>
                                <a href="tel:{{$settings->valueOf('phone')}}" class="contact-item">
                                    <i class="bi bi-telephone"></i>
                                    {{$settings->valueOf('phone')}}
                                </a>
                                <a href="#" class="contact-item">
                                    <i class="bi bi-geo-alt"></i>
                                    {{$settings->valueOf('address')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
                    <div class="about-content">
                        <div class="section-header">
                            <span class="badge-text">Get to Know Me</span>
                            <h2>{{$about->title}}</h2>
                        </div>

                        <div class="description">
                            <p>{{$about->description}}.</p>
                        </div>



                        <div class="details-grid">
                            <div class="detail-row">
                                @foreach($about->details as $detail)
                                <div class="detail-item">
                                    <span class="detail-label">{{$detail['name']}}</span>
                                    <span class="detail-value">{{$detail['description']}}</span>
                                </div>
                                    @endforeach
                            </div>
                        </div>

                        <div class="cta-section">

                            <a href="#" class="btn btn-outline">
                                <i class="bi bi-chat-dots"></i>
                                Let's Talk
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- /About Section -->



    <!-- Skills Section -->
    <section id="skills" class="skills section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Skills</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
@php
    $skillsChunks=$skills->chunk(ceil($skills->count() / 2));
            @endphp

            <div class="row">
                <div class="col-lg-6">

                    <div class="skills-category" data-aos="fade-up" data-aos-delay="200">
                        <div class="skills-animation">
                            @foreach($skillsChunks[0] as $skill)
                            <div class="skill-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>HTML/CSS</h4>
                                    <span class="skill-percentage">{{$skill->rate}}%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{$skill->rate}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="skill-tooltip">{{$skill->description}}</div>
                            </div>
                            @endforeach


                        </div>
                    </div><!-- End Frontend Skills -->
                </div>

                <div class="col-lg-6">
                    <div class="skills-category" data-aos="fade-up" data-aos-delay="300">
                        <div class="skills-animation">
                            @foreach($skillsChunks[1] as $skill)
                                <div class="skill-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4>HTML/CSS</h4>
                                        <span class="skill-percentage">{{$skill->rate}}%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$skill->rate}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="skill-tooltip">{{$skill->description}}</div>
                                </div>
                            @endforeach
                        </div>
                    </div><!-- End Backend Skills -->
                </div>
            </div>

        </div>

    </section><!-- /Skills Section -->



    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Portfolio</h2>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <div class="row">
                    <!-- الجانب الأيسر: قائمة الفئات -->
                    <div class="col-lg-3 filter-sidebar">
                        <div class="filters-wrapper" data-aos="fade-right" data-aos-delay="150">
                            <ul class="portfolio-filters isotope-filters">
                                <li data-filter="*" class="filter-active">All Projects</li>
                                @foreach($categories as $category)
                                    <li data-filter=".filter-{{ Str::slug($category->name) }}">
                                        {{ $category->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- الجانب الأيمن: عرض المشاريع -->
                    <div class="col-lg-9">
                        <div class="row gy-4 portfolio-container isotope-container" data-aos="fade-up" data-aos-delay="200">
                            @foreach($categories as $category)
                                @foreach($category->projects as $project)
                                    <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-{{ Str::slug($category->name) }}">
                                        <div class="portfolio-wrap">
                                            <!-- صورة المشروع -->
                                            <img src="{{ asset($project->images->first()->image) }}"
                                                 class="img-fluid"
                                                 alt="{{ $project->title }}"
                                                 loading="lazy"
                                                 style="height: 250px; object-fit: cover; width: 100%;">

                                            <!-- معلومات المشروع عند التحويم -->
                                            <div class="portfolio-info">
                                                <div class="content">
                                                    <span class="category">{{ $category->name }}</span>
                                                    <h4>{{ $project->title }}</h4>
                                                    <div class="portfolio-links">
                                                        <!-- مشاهدة الصورة الكبيرة -->
                                                        <a href="{{ asset($project->images->first()->image) }}"
                                                           class="glightbox"
                                                           title="{{ $project->title }}">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </a>
                                                        <!-- تفاصيل المشروع -->
                                                        <a href="{{ route('project_details', $project->id) }}"
                                                           title="More Details">
                                                            <i class="bi bi-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Portfolio Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Services</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="service-header">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-12">
                        <div class="service-intro">
                            <h2 class="service-heading">
                                <div>Innovative business</div>
                                <div><span>performance solutions</span></div>
                            </h2>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">

                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                @foreach($services as $service)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card position-relative z-1">
                        <div class="service-icon">
                            <i class="bi bi-palette"></i>
                        </div>
                            <i class="{{$service->icon}}"></i>

                        <h3>
                                 <span>{{$service->name}}</span>

                        </h3>
                        <p>
                            {{$service->description}}
                        </p>
                    </div>
                </div>
                    @endforeach
            </div>

        </div>

    </section><!-- /Services Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Testimonials</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="testimonial-masonry">
                @foreach($testimonials as $test)
                <div class="testimonial-item" data-aos="fade-up">
                    <div class="testimonial-content">
                        <div class="quote-pattern">
                            <i class="bi bi-quote"></i>
                        </div>
                        <p>{{$test->message}}.</p>
                        <div class="client-info">
                            <div class="client-image">
                                <img src="{{$test->image}}" alt="Client">
                            </div>
                            <div class="client-details">
                                <h3>{{$test->name}}</h3>
                                <span class="position">{{$test->position}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                    @endforeach


            </div>

        </div>

    </section><!-- /Testimonials Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row g-4 g-lg-5">
                <div class="col-lg-5">
                    <div class="info-box">
                        <h3>Contact Info</h3>
                        <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis.</p>

                        <div class="info-item">
                            <div class="icon-box">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="content">
                                <h4>Our Location</h4>
                                <p>{{$settings->valueOf('address')}}</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="icon-box">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div class="content">
                                <h4>Phone Number</h4>
                                <p>{{$settings->valueOf('phone')}}</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="icon-box">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="content">
                                <h4>Email Address</h4>
                                <p>{{$settings->valueOf('email')}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="contact-form">
                        <h3>Get In Touch</h3>
                        <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis.</p>

                        <form action="{{route('contact.submit')}}" method="post" >
                            @csrf
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                                </div>

                                <div class="col-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                                </div>

                                <div class="col-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                </div>

                                <div class="col-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit" class="btn">Send Message</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Contact Section -->

</main>



<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector('form[action="{{ route('contact.submit') }}"]');

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // منع الإرسال العادي

                const formData = new FormData(form);

                fetch("{{ route('contact.submit') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 200) {
                            // ✅ نجاح
                            Swal.fire({
                                icon: 'success',
                                title: 'تم بنجاح!',
                                text: data.message,
                                confirmButtonText: 'موافق'
                            }).then(() => {
                                form.reset(); // إعادة تعيين الفورم
                            });
                        } else {
                            // ❌ خطأ
                            Swal.fire({
                                icon: 'error',
                                title: 'خطأ!',
                                text: data.message,
                                confirmButtonText: 'موافق'
                            });
                        }
                    })
                    .catch(() => {
                        // ❌ خطأ في الاتصال
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ!',
                            text: 'فشل الاتصال بالخادم. تحقق من الإنترنت وحاول مجددًا.',
                            confirmButtonText: 'موافق'
                        });
                    });
            });
        }
    });
</script>
@endsection
