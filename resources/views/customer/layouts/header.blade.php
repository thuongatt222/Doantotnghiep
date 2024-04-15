<header class="header_area">
    <div class="top_menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="float-left">
                        <p>Phone: +01 256 25 235</p>
                        <p>email: info@eiser.com</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="float-right">
                        <ul class="right_side">
                            <li>
                                <a href="{{route('customer.cart')}}">
                                    gift card
                                </a>
                            </li>
                            <li>
                                <a href="{{route('customer.tracking')}}">
                                    track order
                                </a>
                            </li>
                            <li>
                                <a href="{{route('customer.contact')}}">
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main_menu">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light w-100">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{route('customer.home')}}">
                    <img src="../images/customer/logo.png" alt="" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
                    <div class="row w-100 mr-0">
                        <div class="col-lg-7 pr-0">
                            <ul class="nav navbar-nav center_nav pull-right">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('customer.home')}}">Home</a>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                       aria-expanded="false">Shop</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('customer.category')}}">Shop Category</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('customer.single-product')}}">Product Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('customer.cart')}}">Shopping Cart</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('customer.checkout')}}">Product Checkout</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                       aria-expanded="false">Blog</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('customer.blog')}}">Blog</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('customer.single-blog')}}">Blog Details</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                       aria-expanded="false">Pages</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('customer.tracking')}}">Tracking</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('customer.contact')}}">Contact</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-5 pr-0">
                            <ul class="nav navbar-nav navbar-right right_nav pull-right">
                                <li class="nav-item">
                                    <a href="{{route('customer.category')}}" class="icons">
                                        <i class="ti-search" aria-hidden="true"></i>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('customer.cart')}}" class="icons">
                                        <i class="ti-shopping-cart"></i>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('customer.cart')}}" class="icons">
                                        <i class="ti-user" aria-hidden="true"></i>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('customer.cart')}}" class="icons">
                                        <i class="ti-heart" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>

<!--================Home Banner Area =================-->
<section class="home_banner_area mb-40">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content row">
                <div class="col-lg-12">
                    <p class="sub text-uppercase">men Collection</p>
                    <h3><span>Show</span> Your <br />Personal <span>Style</span></h3>
                    <h4>Fowl saw dry which a above together place.</h4>
                    <a class="main_btn mt-40" href="#">View Collection</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->
