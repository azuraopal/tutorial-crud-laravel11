<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Portfolio | Noval">
    <meta name="author" content="Devcrud">
    <title>Portfolio | Noval</title>
    <!-- font icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/themify-icons/css/themify-icons.css') }}">
    <!-- Bootstrap + Meyawo main styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/meyawo.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <!-- Page Navbar -->
    <nav class="custom-navbar" data-spy="affix" data-offset-top="20">
        <div class="container">
            <a class="logo" href="#">Portfolio</a>
            <ul class="nav">
                <li class="item">
                    <a class="link" href="#home">Home</a>
                </li>
                <li class="item">
                    <a class="link" href="#about">About</a>
                </li>
                <li class="item">
                    <a class="link" href="#skill">Skill</a>
                </li>
                <li class="item">
                    <a class="link" href="#project">Project</a>
                </li>
                <li class="item">
                    <a class="link" href="#certificate">Certificate</a>
                </li>
                <li class="item">
                    <a class="link" href="#contact">Contact</a>
                </li>
                <li class="item ml-md-3">
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                        @endif
                    @endauth

                </li>
            </ul>
            <a href="javascript:void(0)" id="nav-toggle" class="hamburger hamburger--elastic">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </a>
        </div>
    </nav><!-- End of Page Navbar -->

    <!-- page header -->
    <header id="home" class="header">
        <div class="overlay"></div>
        <div class="header-content container">
            <h1 class="header-title">
                <span class="up">Hai, I Am</span>
                <span class="down">Muhammad</span>
                <span class="">Noval </span>
            </h1>
            <p class="header-subtitle">Backend Developer</p>
            <a href="https://www.instagram.com/nopalspryd/" class="btn btn-primary">Visit My Instagram</a>
        </div>
    </header><!-- end of page header -->

    <!-- about section -->
    <section class="section pt-0" id="about">
        <!-- container -->
        <div class="container text-center">
            @if ($abouts->isNotEmpty())
                @foreach ($abouts as $about)
                    <!-- about wrapper -->
                    <div class="about">
                        <div class="about-img-holder">
                            <img src="{{ asset('storage/' . $about->image) }}" class="about-img rounded-img"
                                alt="{{ $about->title }}">
                        </div>
                        <div class="about-caption">
                            <p class="section-subtitle">Who Am I ?</p>
                            <h2 class="section-title mb-3">{{ $about->title }}</h2>
                            <p>{{ $about->description }}</p>
                            <button class="btn-rounded btn btn-outline-primary mt-4">Learn More</button>
                        </div>
                    </div><!-- end of about wrapper -->
                @endforeach
            @else
                <p class="text-muted">No About data available.</p>
            @endif
        </div><!-- end of container -->
    </section> <!-- end of about section -->


    <!-- skill section -->
    <section class="section" id="skill">
        <div class="container text-center">
            <p class="section-subtitle"></p>
            <h6 class="section-title mb-6">Skill</h6>

            <!-- row -->
            <div class="row">
                @forelse ($skills as $skill)
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card shadow-sm border-light">
                            <div class="card-body text-center">
                                <!-- Gambar tanpa efek hover, hanya menggunakan margin bawah -->
                                <img src="{{ asset('images/' . $skill->icon_path) }}" alt="{{ $skill->name }}"
                                    class="icon mb-4 img-fluid">
                                <h6 class="title">{{ $skill->name }}</h6>
                                <p class="subtitle text-muted">{{ $skill->category }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Jika data kosong, tampilkan pesan -->
                    <div class="col-12">
                        <p>Data tidak ada</p>
                    </div>
                @endforelse
            </div><!-- end of row -->
        </div><!-- end of container -->
    </section><!-- end of skill section -->


    <!-- Tambahkan CSS untuk mempercantik hover dan penataan -->
    <style>
        .card {
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            /* Mengangkat card sedikit saat dihover */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            /* Efek bayangan lembut */
        }

        .icon {
            width: 100%;
            /* Sesuaikan ukuran gambar */
            height: auto;
            max-height: 150px;
            max-width: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
            /* Menambahkan transisi pada gambar */
        }

        .card-body:hover .icon {
            transform: scale(1.1);
            /* Zoom halus pada gambar saat card dihover */
        }

        .title {
            font-size: 18px;
            font-weight: 600;
        }

        .subtitle {
            font-size: 14px;
            color: #6c757d;
        }
        .rounded-img {
            border-radius: 12px;
        }
    </style>

    <!-- project section -->
    <section class="section" id="project">
        <div class="container text-center">
            <p class="section-subtitle"></p>
            <h6 class="section-title mb-6">Project</h6>
            <!-- row -->
            <div class="row">
                @forelse ($projects as $project)
                    <div class="col-md-4">
                        <a href="{{ $project->link ?? '#' }}" class="portfolio-card" target="blank">
                            <img class="portfolio-card-img rounded-img"
                                src="{{ $project->image ? asset('storage/' . $project->image) : asset('assets/imgs/folio-1.jpg') }}"
                                class="img-responsive rounded-img
                                " alt="{{ $project->title }}">
                            <span class="portfolio-card-overlay">
                                <span class="portfolio-card-caption">
                                    <h4>{{ $project->title }}</h5>
                                        <p class="font-weight-normal">{{ $project->description }}</p>
                                </span>
                            </span>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <p>Data tidak ada</p>
                    </div>
                @endforelse
            </div><!-- end of row -->
        </div><!-- end of container -->
    </section> <!-- end of project section -->

    <style>
        .portfolio-card-img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            /* Menjaga gambar sepenuhnya terlihat */
            object-position: center;
        }

        @media (max-width: 768px) {
            .portfolio-card-img {
                height: 150px;
                /* Menurunkan tinggi gambar pada perangkat kecil */
            }
        }
    </style>

    <!-- section -->
    <section class="section-sm bg-primary">
        <!-- container -->
        <div class="container text-center text-sm-left">
            <!-- row -->
            <div class="row align-items-center">
                <div class="col-sm offset-md-1 mb-4 mb-md-0">
                    <h6 class="title text-light">Want to work with me?</h6>
                    <p class="m-0 text-light">Always feel Free to Contact & Hire me</p>
                </div>
                <div class="col-sm offset-sm-2 offset-md-3">
                    <button class="btn btn-lg my-font btn-light rounded">Hire Me</button>
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </section> <!-- end of section -->

    <!-- certificate section -->
    <section class="section" id="certificate">
        <!-- container -->
        <div class="container text-center">
            <p class="section-subtitle"></p>
            <h6 class="section-title mb-6">Certificate</h6>
            <!-- Loop through certificates -->
            @foreach ($certificates as $certificate)
                <div class="blog-card">
                    <div class="blog-card-header">
                        <!-- Display certificate image from storage -->
                        <embed src="{{ asset('storage/certificates/' . basename($certificate->file)) }}"
                            type="application/pdf" width="100%" height="300px" class="blog-card-img"
                            alt="{{ $certificate->name }}">
                    </div>
                    <div class="blog-card-body">
                        <h5 class="blog-card-title">{{ $certificate->name }}</h5>
                        <p class="blog-card-caption">
                            <a href="#">Issued by: {{ $certificate->issued_by }}</a>
                            <a href="#"><i class="ti-heart text-danger"></i> 234</a>
                            <a href="#"><i class="ti-comment"></i> 123</a>
                        </p>
                        <p>{{ $certificate->description }}</p>
                        <p><b>Issued at: {{ \Carbon\Carbon::parse($certificate->issued_at)->format('F d, Y') }}</b></p>
                        <a href="{{ asset('/storage/' . $certificate->file) }}" target="_blank"
                            class="text-blue-500 hover:underline">
                            View File
                        </a>
                    </div>
                </div><!-- end of blog wrapper -->
            @endforeach
        </div><!-- end of container -->
    </section><!-- end of certificate section -->


    <!-- contact section -->
    <section class="section" id="contact">
        <div class="container text-center">
            <p class="section-subtitle">How can you communicate?</p>
            <h6 class="section-title mb-5">Contact Me</h6>
            <!-- contact form -->
            <form action="" class="contact-form col-md-10 col-lg-8 m-auto">
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <input type="text" size="50" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <input type="email" class="form-control" placeholder="Enter Email" requried>
                    </div>
                    <div class="form-group col-sm-12">
                        <textarea name="comment" id="comment" rows="6" class="form-control" placeholder="Write Something"></textarea>
                    </div>
                    <div class="form-group col-sm-12 mt-3">
                        <input type="submit" value="Send Message" class="btn btn-outline-primary rounded">
                    </div>
                </div>
            </form><!-- end of contact form -->
        </div><!-- end of container -->
    </section><!-- end of contact section -->

    <!-- Footer -->
    <div class="container">
        <footer class="footer">
            <p class="mb-0">Copyright
                <script>
                    document.write(new Date().getFullYear())
                </script> &copy; <a href="https://portfolio-v2-nopal.vercel.app/">Azuranopal</a>
            </p>

            <!-- Dynamic Contact Section -->
            <div class="contact-details text-left mt-4">
                @foreach ($contacts as $contact)
                    <div class="contact-item mb-3">
                        <!-- Title -->
                        <h6 class="contact-title font-bold">{{ $contact->title }}</h6>
                        <!-- Description -->
                        <p class="contact-description text-gray-700">{{ $contact->description }}</p>
                        <!-- Contact -->
                        <p class="contact-info">
                            <i class="ti-mobile"></i> {{ $contact->contact }}
                        </p>
                        <!-- Link -->
                        <a href="{{ $contact->link }}" target="_blank"
                            class="contact-link text-blue-500 hover:underline">
                            <i class="bi bi-whatsapp"></i> {{ $contact->link }}
                        </a>
                    </div>
                @endforeach
            </div>
        </footer>
    </div>

    <style>
        .contact-details {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .contact-title {
            font-weight: bold;
            font-size: 1.1rem;
            color: #000;
        }

        .contact-description {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .contact-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #4b5563;
        }

        .contact-link {
            color: #2563eb;
            text-decoration: none;
        }

        .contact-link:hover {
            text-decoration: underline;
        }
    </style>


    <!-- core -->
    <script src="{{ asset('assets/vendors/jquery/jquery-3.4.1.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.js') }}"></script>

    <!-- bootstrap 3 affix -->
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.affix.js') }}"></script>

    <!-- Meyawo js -->
    <script src="{{ asset('assets/js/meyawo.js') }}"></script>


</body>

</html>
