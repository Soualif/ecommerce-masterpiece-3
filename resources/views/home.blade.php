@extends('layouts.master')


    @include('layouts.header')
    <!-- start banner Area -->
    <section class="banner-area organic-bradcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-lg-12">
                    <div class="active-banner-slider owl-carousel">
                        <!-- single-slide -->
                        @foreach ($news as $new)
                            <div class="row single-slide align-items-center d-flex">
                                <div class="col-lg-5 col-md-6">
                                    <div class="banner-content">
                                        <h2 class="message-product text-black">New Flavor!</h2>
                                        <h3 class="title-product">{{ $new->name }}</h3>
                                        <span class="details-product">{{ $new->details }}</span>
                                        <div class="add-bag d-flex align-items-center">
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $new->id }}">
                                                <input type="hidden" name="name" value="{{ $new->name }}">
                                                <input type="hidden" name="price" value="{{ $new->price }}">
                                                <button type="submit" class="primary-btn d-flex justify-content-center align-items-center">
                                                    <p class="add-text text-uppercase text-white w-100 text-center p-0">Add to Bag</p>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="banner-img">
                                        <img class="img-fluid" src="{{ Voyager::image($new->image) }}" width="80" height="500" alt="" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->


    <!-- start product Area -->
    <section class="owl-carousel active-product-area section_gap">
        <!-- single product slide -->
        <div class="">
            <div class="single-product-slider">
                <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-6 text-center">
                                    <div class="section-title">
                                          <h1>Latest Products</h1>
                                          <p></p>
                                    </div>
                                </div>
                            </div>
                    <div class="row">
                        @foreach ($latestProducts as $product)
                            <!-- single product -->
                            <div class="col-lg-3 col-md-6">
                                <div class="single-product">
                                    <div class="d-flex justify-content-center">
                                        <img class="img-fluid shadow-sm" src="{{ Voyager::image($product->image) }}" alt="">
                                    </div>
                                    <div class="product-details">
                                        <h6>{{ $product->name }}</h6>
                                        <p>{{ $product->details }}</p>
                                        <div class="price">
                                            <h6>{{ $product->price }} CHF</h6>
                                        </div>
                                        <div class="prd-bottom">
                                            <form action="{{ route('cart.store') }}" method="POST" class="form-addProduct">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="name" value="{{ $product->name }}">
                                                <input type="hidden" name="price" value="{{ $product->price }}">
                                                <button type="submit" class="primary-btn py-1 m-0">
                                                <i class="bi bi-plus-circle"></i>
                                                </button>
                                            </form> 
                                            
                                            <a href="{{ route('shop.show', $product->slug) }}" class="link-showProduct">
                                                <button class="primary-btn py-1 m-0">
                                                <i class="bi bi-eye-fill"></i>
                                                </button>  
                                            </a> 

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- single product slide -->
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>Best Sellers</h1>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($bestsellers as $bestseller)
                        <!-- single product -->
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <div class="d-flex justify-content-center">
                                    <img class="img-fluid shadow-sm" src="{{ Voyager::image($bestseller->image) }}" alt="">
                                </div>
                                <div class="bestseller-details">
                                    <h6 class="">{{ $bestseller->name }}</h6>
                                    <div class="price text-center">
                                    </div>
                                    <p><small>{{ $bestseller->details }}</small></p>
                                    <h6>{{ $bestseller->price }} CHF</h6>
                                    <div class="prd-bottom d-flex justify-content-around">
                                        <form action="{{ route('cart.store') }}" method="POST" class="form-addProduct">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $bestseller->id }}">
                                            <input type="hidden" name="name" value="{{ $bestseller->name }}">
                                            <input type="hidden" name="price" value="{{ $bestseller->price }}">
                                            <button type="submit" class="primary-btn py-1 m-0">
                                            <i class="bi bi-plus-circle"></i>
                                            </button>
                                        </form> 
                                        <a href="{{ route('shop.show', $bestseller->slug) }}" class="link-showProduct">
                                            <button class="primary-btn py-1 m-0">
                                            <i class="bi bi-eye-fill"></i>
                                            </button>  
                                        </a> 
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
        
</section>


