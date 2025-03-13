@extends('layouts.client')

@section('title')
    Hướng dẫn
@endsection

@section('css')
@endsection

@section('breadcrumb')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Hướng dẫn</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">Hướng dẫn</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <!-- Blog Section Start -->
    <section class="blog-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xxl-9 col-xl-8 col-lg-7 order-lg-2">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="blog-box blog-list wow fadeInUp">
                                <div class="blog-image">
                                    <img src="../assets/images/inner-page/blog/1.jpg" class="blur-up lazyload"
                                        alt="">
                                </div>

                                <div class="blog-contain blog-contain-2">
                                    <div class="blog-label">
                                        <span class="time"><i data-feather="clock"></i> <span>25 Feg, 2022</span></span>
                                        <span class="super"><i data-feather="user"></i> <span>Mark J.
                                                Speight</span></span>
                                    </div>
                                    <a href="{{ route('huongdans.chitiet', 1) }}">
                                        <h3>one pot creamy mediterranean chicken pasta cream.</h3>
                                    </a>
                                    <p>Monterey jack cheese slices cream cheese cream cheese hard cheese roquefort
                                        emmental lancashire. Who moved my cheese dolcelatte st. agur blue cheese fromage
                                        mozzarella say cheese mascarpone blue castello.</p>
                                    <button onclick="location.href = '{{ route('huongdans.chitiet', 1) }}';"
                                        class="blog-button">Read
                                        More <i class="fa-solid fa-right-long"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="blog-box blog-list wow fadeInUp" data-wow-delay="0.05s">
                                <div class="blog-image">
                                    <img src="../assets/images/inner-page/blog/2.jpg" class="blur-up lazyload"
                                        alt="">
                                </div>

                                <div class="blog-contain blog-contain-2">
                                    <div class="blog-label">
                                        <span class="time"><i data-feather="clock"></i> <span>25 Feg, 2022</span></span>
                                        <span class="super"><i data-feather="user"></i> <span>rebeus
                                                hagrid</span></span>
                                    </div>
                                    <a href="{{ route('huongdans.chitiet', 1) }}">
                                        <h3>Crispy Frozen Vegetable is the on the Tempura.</h3>
                                    </a>
                                    <p>Manchego cauliflower cheese st. agur blue cheese red leicester monterey jack
                                        cheesecake the big cheese edam. Gouda monterey jack roquefort hard cheese feta
                                        croque monsieur cheeseburger manchego.</p>
                                    <button onclick="location.href = '{{ route('huongdans.chitiet', 1) }}';"
                                        class="blog-button">Read
                                        More <i class="fa-solid fa-right-long"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="blog-box blog-list wow fadeInUp" data-wow-delay="0.1s">
                                <div class="blog-image">
                                    <a href="{{ route('huongdans.chitiet', 1) }}">
                                        <img src="../assets/images/inner-page/blog/3.jpg" class="blur-up lazyload"
                                            alt="">
                                    </a>
                                    <label><i class="fa-solid fa-bolt-lightning"></i> popular</label>
                                </div>

                                <div class="blog-contain blog-contain-2">
                                    <div class="blog-label">
                                        <span class="time"><i data-feather="clock"></i> <span>25 Feg, 2022</span></span>
                                        <span class="super"><i data-feather="user"></i> <span>Chris C.
                                                Hall</span></span>
                                    </div>
                                    <a href="{{ route('huongdans.chitiet', 1) }}">
                                        <h3>How to start regrowing green onions and other vegetables.</h3>
                                    </a>
                                    <p>Cheese triangles say cheese cheese and biscuits dolcelatte jarlsberg cream cheese
                                        taleggio fromage frais. Who moved my cheese cottage cheese cheese on toast
                                        rubber cheese melted cheese ricotta.</p>
                                    <button onclick="location.href = '{{ route('huongdans.chitiet', 1) }}';"
                                        class="blog-button">Read
                                        More <i class="fa-solid fa-right-long"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="blog-box blog-list wow fadeInUp" data-wow-delay="0.15s">
                                <a href="{{ route('huongdans.chitiet', 1) }}" class="blog-image">
                                    <img src="../assets/images/inner-page/blog/4.jpg" class="blur-up lazyload"
                                        alt="">
                                </a>

                                <div class="blog-contain blog-contain-2">
                                    <div class="blog-label">
                                        <span class="time"><i data-feather="clock"></i> <span>25 Feg, 2022</span></span>
                                        <span class="super"><i data-feather="user"></i> <span>James M.
                                                Martin</span></span>
                                    </div>
                                    <a href="{{ route('huongdans.chitiet', 1) }}">
                                        <h3>Starting a vegetable garden: the basics.</h3>
                                    </a>
                                    <p>Jarlsberg swiss edam. Goat everyone loves cheese strings ricotta cheese and wine
                                        pepper jack dolcelatte halloumi. Cream cheese queso croque monsieur camembert de
                                        normandie cheddar cheesecake cheese slices croque monsieur.</p>
                                    <button onclick="location.href = '{{ route('huongdans.chitiet', 1) }}';"
                                        class="blog-button">Read
                                        More <i class="fa-solid fa-right-long"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="blog-box blog-list wow fadeInUp" data-wow-delay="0.2s">
                                <a href="{{ route('huongdans.chitiet', 1) }}" class="blog-image">
                                    <img src="../assets/images/inner-page/blog/5.jpg" class="blur-up lazyload"
                                        alt="">
                                </a>

                                <div class="blog-contain blog-contain-2">
                                    <div class="blog-label">
                                        <span class="time"><i data-feather="clock"></i> <span>25 Feg, 2022</span></span>
                                        <span class="super"><i data-feather="user"></i> <span>Cecil M.
                                                Levis</span></span>
                                    </div>
                                    <a href="{{ route('huongdans.chitiet', 1) }}">
                                        <h3>Adapt this simple pasta salad to whatever vegetable.</h3>
                                    </a>
                                    <p>Cream cheese cheese slices chalk and cheese cottage cheese cheddar port-salut
                                        everyone loves dolcelatte. Cream cheese camembert de normandie cow chalk and
                                        cheese brie gouda cottage cheese cheesy grin.</p>
                                    <button onclick="location.href = '{{ route('huongdans.chitiet', 1) }}';"
                                        class="blog-button">Read
                                        More <i class="fa-solid fa-right-long"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="blog-box blog-list wow fadeInUp" data-wow-delay="0.25s">
                                <a href="{{ route('huongdans.chitiet', 1) }}" class="blog-image">
                                    <img src="../assets/images/inner-page/blog/1.jpg" class="blur-up lazyload"
                                        alt="">
                                </a>

                                <div class="blog-contain blog-contain-2">
                                    <div class="blog-label">
                                        <span class="time"><i data-feather="clock"></i> <span>25 Feg, 2022</span></span>
                                        <span class="super"><i data-feather="user"></i> <span>Mary R.
                                                Hernandez</span></span>
                                    </div>
                                    <a href="{{ route('huongdans.chitiet', 1) }}">
                                        <h3>With chefs idle and vegetables rotting, China's virus-hit.</h3>
                                    </a>
                                    <p>Monterey jack chalk and cheese cheese and biscuits cream cheese fondue say cheese
                                        stilton halloumi. Gouda everyone loves chalk and cheese everyone loves stinking
                                        bishop manchego stilton.</p>
                                    <button onclick="location.href = '{{ route('huongdans.chitiet', 1) }}';"
                                        class="blog-button">Read
                                        More <i class="fa-solid fa-right-long"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="blog-box blog-list wow fadeInUp" data-wow-delay="0.3s">
                                <a href="{{ route('huongdans.chitiet', 1) }}" class="blog-image">
                                    <img src="../assets/images/inner-page/blog/2.jpg" class="blur-up lazyload"
                                        alt="">
                                </a>

                                <div class="blog-contain blog-contain-2">
                                    <div class="blog-label">
                                        <span class="time"><i data-feather="clock"></i> <span>25 Feg, 2022</span></span>
                                        <span class="super"><i data-feather="user"></i> <span>Cheryl D.
                                                Moser</span></span>
                                    </div>
                                    <a href="{{ route('huongdans.chitiet', 1) }}">
                                        <h3>Turn that bowl of pasta into a supercharged veggie vehicle.</h3>
                                    </a>
                                    <p>The big cheese fondue st. agur blue cheese. Cheese on toast paneer lancashire
                                        cheese and biscuits rubber cheese macaroni cheese queso feta. Stinking bishop
                                        fromage brie edam cheesy feet smelly cheese fromage frais paneer.</p>
                                    <button onclick="location.href = '{{ route('huongdans.chitiet', 1) }}';"
                                        class="blog-button">Read
                                        More <i class="fa-solid fa-right-long"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="blog-box blog-list wow fadeInUp" data-wow-delay="0.35s">
                                <a href="{{ route('huongdans.chitiet', 1) }}" class="blog-image">
                                    <img src="../assets/images/inner-page/blog/3.jpg" alt=""
                                        class="blur-up lazyload">
                                </a>

                                <div class="blog-contain blog-contain-2">
                                    <div class="blog-label">
                                        <span class="time"><i data-feather="clock"></i> <span>25 Feg, 2022</span></span>
                                        <span class="super"><i data-feather="user"></i> <span>Mina M.
                                                Short</span></span>
                                    </div>
                                    <a href="{{ route('huongdans.chitiet', 1) }}">
                                        <h3>Health, care and skin on the for your organic.</h3>
                                    </a>
                                    <p>Cheesy grin brie croque monsieur cheesy grin cottage cheese cheese strings
                                        dolcelatte cheeseburger. Cheesy feet queso red leicester fromage frais hard
                                        cheese cheeseburger fromage when the cheese comes out everybody's happy.</p>
                                    <button onclick="location.href = '{{ route('huongdans.chitiet', 1) }}';"
                                        class="blog-button">Read
                                        More <i class="fa-solid fa-right-long"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="blog-box blog-list wow fadeInUp" data-wow-delay="0.4s">
                                <a href="{{ route('huongdans.chitiet', 1) }}" class="blog-image">
                                    <img src="../assets/images/inner-page/blog/4.jpg" alt=""
                                        class="blur-up lazyload">
                                </a>

                                <div class="blog-contain blog-contain-2">
                                    <div class="blog-label">
                                        <span class="time"><i data-feather="clock"></i> <span>25 Feg, 2022</span></span>
                                        <span class="super"><i data-feather="user"></i> <span>Marie S.
                                                Santiago</span></span>
                                    </div>
                                    <a href="{{ route('huongdans.chitiet', 1) }}">
                                        <h3>Fresh organicsm, brand, fresh and picnic place awesome.</h3>
                                    </a>
                                    <p>Macaroni cheese camembert de normandie airedale. Cheese triangles babybel cow
                                        blue castello cheddar cheese and biscuits jarlsberg melted cheese. Caerphilly
                                        fromage frais ricotta manchego edam boursin edam swiss.</p>
                                    <button onclick="location.href = '{{ route('huongdans.chitiet', 1) }}';"
                                        class="blog-button">Read
                                        More <i class="fa-solid fa-right-long"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav class="custom-pagination">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="javascript:void(0)" tabindex="-1">
                                    <i class="fa-solid fa-angles-left"></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="javascript:void(0)">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)">
                                    <i class="fa-solid fa-angles-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-5 order-lg-1">
                    @include('clients.huongdans.sidebar')
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection

@section('js')
@endsection
