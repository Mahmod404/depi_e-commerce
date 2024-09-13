@extends('main')

@section('content')
    <!-- header -->
    <header id = "header" class = "vh-100 carousel slide" data-bs-ride = "carousel" style = "padding-top: 104px;">
        <div class = "container h-100 d-flex align-items-center carousel-inner">
            <div class = "text-center carousel-item active">
                <h2 class = "text-capitalize text-white">best collection</h2>
                <h1 class = "text-uppercase py-2 fw-bold text-white">new arrivals</h1>
                <a href = "{{ route('products.index') }}" class = "btn mt-3 text-uppercase">shop now</a>
            </div>
            <div class = "text-center carousel-item">
                <h2 class = "text-capitalize text-white">best price & offer</h2>
                <h1 class = "text-uppercase py-2 fw-bold text-white">new season</h1>
                <a href = "{{ route('products.index') }}" class = "btn mt-3 text-uppercase">buy now</a>
            </div>
        </div>

        <button class = "carousel-control-prev" type = "button" data-bs-target="#header" data-bs-slide = "prev">
            <span class = "carousel-control-prev-icon"></span>
        </button>
        <button class = "carousel-control-next" type = "button" data-bs-target="#header" data-bs-slide = "next">
            <span class = "carousel-control-next-icon"></span>
        </button>
    </header>
    <!-- end of header -->
    <!-- collection -->
    <section id = "new collection" class = "py-5">
        <div class = "container">
            <div class = "title text-center">
                <h2 class = "position-relative d-inline-block">New Collection</h2>
            </div>
            {{-- <div class = "row g-0">          
                <div class = "d-flex flex-wrap justify-content-center mt-5 filter-button-group">
                    <button type = "button" class = "btn m-2 text-dark active-filter-btn" data-filter = "*">All</button>
                    <button type = "button" class = "btn m-2 text-dark" data-filter = ".best">Best Sellers</button>
                    <button type = "button" class = "btn m-2 text-dark" data-filter = ".feat">Featured</button>
                    <button type = "button" class = "btn m-2 text-dark" data-filter = ".new">New Arrival</button>
                </div> 
                </div> --}}

            @php
                $products = App\Models\Product::latest()->take(8)->get();
            @endphp

            <div class = "collection-list mt-4 row gx-0 gy-3">
                @foreach ($products as $product)
                    <div class = "col-md-6 col-lg-4 col-xl-3 p-2 best">
                        <div class = "collection-img position-relative">
                            <a href="{{ route('product.show', $product->id) }}"><img src = "{{ $product->image }}"
                                    class = "w-100"></a>
                        </div>
                        <div class = "text-center">
                            <div class = "rating mt-3">
                                <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                <span class = "text-primary"><i class = "fas fa-star"></i></span>
                            </div>
                            <p class = "text-capitalize my-1">{{ $product->name }}</p>
                            <span class = "fw-bold">$ {{ $product->price }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
    </section>
    <!-- end of collection -->

    <!-- special products -->
    <section id = "special" class = "py-5">
        <div class = "container">
            <div class = "title text-center py-5">
                <h2 class = "position-relative d-inline-block">Special Selection</h2>
            </div>
            @php
                $special_product = App\Models\Product::orderBy('price', 'desc')->take(4)->get();
            @endphp

            <div class = "special-list row g-0">
                @foreach ($special_product as $product)
                    <div class = "col-md-6 col-lg-4 col-xl-3 p-2">
                        <div class = "special-img position-relative overflow-hidden">
                            <a href="{{ route('product.show', $product->id) }}"><img src = "{{ $product->image }}"
                                    class = "w-100"></a>
                            <span
                                class = "position-absolute d-flex align-items-center justify-content-center text-primary fs-4">
                                <i class = "fas fa-heart"></i>
                            </span>
                        </div>
                        <div class = "text-center">
                            <p class = "text-capitalize mt-3 mb-1">{{ $product->name }}</p>
                            <span class = "fw-bold d-block">$ {{ $product->price }}</span>
                            {{-- <a href = "" class = "btn btn-primary mt-3">Add to Cart</a> --}}
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary mt-3">View
                                Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end of special products -->

    <!-- blogs -->
    <section id = "offers" class = "py-5">
        <div class = "container">
            <div
                class = "row d-flex align-items-center justify-content-center text-center justify-content-lg-start text-lg-start">
                <div class = "offers-content">
                    <span class = "text-white">Discount Up To 40%</span>
                    <h2 class = "mt-2 mb-4 text-white">Grand Sale Offer!</h2>
                    <a href = "{{ route('products.index') }}" class = "btn">Buy Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end of blogs -->

    <!-- blogs -->
    <section id = "blogs" class = "py-5">
        <div class = "container">
            <div class = "title text-center py-5">
                <h2 class = "position-relative text-uppercase d-inline-block">Our Latest Blog</h2>
            </div>
            @php
                $blogs = App\Models\Blog::orderBy('id', 'desc')->take(3)->get();
            @endphp
            <div class = "row g-3">
                @foreach ($blogs as $blog)
                    @php
                        $user = App\Models\User::Where('id', $blog->user_id)->get();
                    @endphp
                    @foreach ($user as $user)
                        <div class = "card border-0 col-md-6 col-lg-4 bg-transparent my-3">
                            <div class = "card-body px-0">
                                <h4 class = "card-title">{{ $blog->title }}</h4>
                                <p class = "card-text mt-3 text-muted">{{ $blog->description }}</p>
                                <p class = "card-text">
                                    <small class = "text-muted">
                                        <span class = "fw-bold">Author: </span> {{ $user->name }}
                                    </small>
                                </p>
                                <a href = "{{ route('blogs.index') }}" class = "btn">Read More</a>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
    <!-- end of blogs -->

    <!-- about us -->
    <section id = "about" class = "py-5">
        <div class = "container">
            <div class = "row gy-lg-5 align-items-center">
                <div class = "col-lg-6 order-lg-1 text-center text-lg-start">
                    <div class = "title py-5">
                        <h2 class = "position-relative text-uppercase d-inline-block">About Us</h2>
                    </div>
                    <h3 class = "text-muted ms-3">Lorem, ipsum dolor.</h3>
                    <p class="ms-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis earum explicabo
                        laborum dicta, quidem dolore non dolores corrupti, omnis quo quibusdam obcaecati similique, placeat
                        incidunt labore ipsam eaque laudantium sit. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Nesciunt incidunt ducimus saepe aperiam excepturi amet magnam doloremque. Voluptates, voluptas.
                        Cumque dignissimos incidunt consequuntur, soluta repellat quidem laboriosam quos earum laborum?.</p>
                </div>
                <div class = "col-lg-6 order-lg-0">
                    <img src = "{{ asset('imgs/about.jpg') }}" alt = "" class = "img-fluid">
                </div>
            </div>
        </div>
    </section>
    <!-- end of about us -->
@endsection
