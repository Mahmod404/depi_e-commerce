<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-commerce</title>
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- bootstrap css -->
    <link rel = "stylesheet" href = "{{ asset('css/bootstrap.min.css') }}">
    <!-- custom css -->
    <link rel = "stylesheet" href = "{{ asset('css/main.css') }}">
</head>

<body>
    <!-- navbar -->
    <nav class = "navbar navbar-expand-lg navbar-light bg-light py-4 sticky-top z-3">
        <div class = "container">

            <a class = "navbar-brand d-flex justify-content-between align-items-center order-lg-0"
                href = "{{ route('index') }}">
                <span class = "text-uppercase fw-lighter ms-2">home</span>
            </a>
            <div class = "order-lg-2 nav-btns">
                <button type = "button" class = "btn position-relative">
                    <a href="{{ route('cart.index') }}" class="text-decoration-none text-black"><i
                            class = "fa fa-shopping-cart"></i></a>
                </button>
                <button type = "button" class = "btn position-relative">
                    <a href="{{ route('wishlist') }}" class="text-decoration-none text-black"><i
                            class = "fa fa-heart"></i></a>
                </button>
            </div>

            <div class = "order-lg-2 nav-btns me-5">
                <div class="dropdown position-relative">
                    <button class="btn btn-secondary dropdown-toggle px-4" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-regular fa-user"></i>
                    </button>
                    <ul class="dropdown-menu text-center">
                        @if (auth()->user())
                            <li><a class="dropdown-item border-bottom border-1 border-dark"
                                    href="{{ route('profile') }}">Profile</a></li>
                            <li>
                                @if (auth()->user()->type === 'admin')
                            <li><a class="dropdown-item border-bottom border-1 py-2 border-dark"
                                    href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Log out') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        </li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>

                        <li><a class="dropdown-item" href="{{ route('login') }}">Log in</a></li>
                        @endif
                    </ul>
                </div>
            </div>



            <button class = "navbar-toggler border-0" type = "button" data-bs-toggle = "collapse"
                data-bs-target = "#navMenu">
                <span class = "navbar-toggler-icon"></span>
            </button>

            <div class = "collapse navbar-collapse order-lg-1" id = "navMenu">
                <ul class = "navbar-nav mx-auto text-center">
                    <li class = "nav-item px-1 py-2 border-bottom border-danger me-1">
                        <a class = "nav-link text-uppercase text-dark" href = "{{ route('index') }}">home</a>
                    </li>
                    <li class = "nav-item px-1 py-2 border-bottom border-danger me-1">
                        <a class = "nav-link text-uppercase text-dark"
                            href = "{{ route('products.index') }}">collection</a>
                    </li>
                    <li class = "nav-item px-1 py-2 border-bottom border-danger me-1">
                        <a class = "nav-link text-uppercase text-dark" href = "{{ route('blogs.index') }}">blogs</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end of navbar -->

    <!-- Content -->
    <div>
        @yield('content')
    </div>
    <!-- end of Content -->


    <!-- footer -->
    <footer class = "py-5 mt-5">
        <div class = "container">
            <div class = "row text-white g-4">
                <div class = "col-md-6 col-lg-3" id="footer-txt">
                    <a class = "text-uppercase text-decoration-none brand text-dark"
                        href = "{{ route('blogs.index') }}">Attire</a>
                    <p class = "text-white text-muted mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Doloribus commodi sint odio ut omnis vitae quaerat impedit, accusantium, officia delectus quia
                        fugiat voluptate aliquam beatae animi illum. Explicabo, ratione sint!.</p>
                </div>

                <div class = "col-md-6 col-lg-2">
                    <h5 class = "fw-light text-dark">Links</h5>
                    <ul class = "list-unstyled">
                        <li class = "my-3">
                            <a href = "{{ route('index') }}" class = "text-white text-decoration-none text-muted">
                                <i class = "fas fa-chevron-right me-1"></i> Home
                            </a>
                        </li>
                        <li class = "my-3">
                            <a href = "{{ route('products.index') }}"
                                class = "text-white text-decoration-none text-muted">
                                <i class = "fas fa-chevron-right me-1"></i> Collection
                            </a>
                        </li>
                        <li class = "my-3">
                            <a href = "{{ route('blogs.index') }}"
                                class = "text-white text-decoration-none text-muted">
                                <i class = "fas fa-chevron-right me-1"></i> Blogs
                            </a>
                        </li>
                        <li class = "my-3">
                            <a href = "{{ route('home') }}" class = "text-white text-decoration-none text-muted">
                                <i class = "fas fa-chevron-right me-1"></i> About Us
                            </a>
                        </li>
                    </ul>
                </div>

                <div class = "col-md-6 col-lg-4">
                    <h5 class = "fw-light text-dark mb-3">Contact Us</h5>
                    <div class = "d-flex justify-content-start align-items-start my-2 text-muted">
                        <span class = "me-3">
                            <i class = "fas fa-map-marked-alt"></i>
                        </span>
                        <span class = "fw-light">
                            Cairo, Egypt
                        </span>
                    </div>
                    <div class = "d-flex justify-content-start align-items-start my-2 text-muted">
                        <span class = "me-3">
                            <i class = "fas fa-envelope"></i>
                        </span>
                        <span class = "fw-light">
                            test@test.dev
                        </span>
                    </div>
                    <div class = "d-flex justify-content-start align-items-start my-2 text-muted">
                        <span class = "me-3">
                            <i class = "fas fa-phone-alt"></i>
                        </span>
                        <span class = "fw-light">
                            +20 111 111 1111
                        </span>
                    </div>
                </div>

                <div class = "col-md-6 col-lg-3">
                    <h5 class = "fw-light text-dark mb-3">Follow Us</h5>
                    <div>
                        <ul class = "list-unstyled d-flex">
                            <li>
                                <a href = "#" class = "text-white text-decoration-none text-muted fs-4 me-4">
                                    <i class = "fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href = "#" class = "text-white text-decoration-none text-muted fs-4 me-4">
                                    <i class = "fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href = "#" class = "text-white text-decoration-none text-muted fs-4 me-4">
                                    <i class = "fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href = "#" class = "text-white text-decoration-none text-muted fs-4 me-4">
                                    <i class = "fab fa-pinterest"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end of footer -->

    <!-- scripts -->
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- custom js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <script src="{{ asset('js/script.js') }}"></script>
    <!-- end of scripts -->
</body>

</html>
