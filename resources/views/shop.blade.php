@extends('layouts.master')

@section('content')

{{ Breadcrumbs::render('shop') }}


<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
            <div class="sidebar-categories">
                <div class="head">Browse Categories</div>
                <ul class="main-categories">
                    @foreach ($categories as $category)
                    <li class="main-nav-list"><a data-toggle="collapse" href="#fruitsVegetable" aria-expanded="false">
                        <a href="{{ route('shop.index', [ 'category'=> $category->slug ])}}">
                          {{ $category->name }} <span class="number">( {{ count($category->products) }})</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
              </div>
            </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
            <!-- Start Filter Bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center">
                <div class="dropdown">
                    <a class="btn" href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'asc']) }}">Accending price</a>
                    <a class="btn" href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'desc']) }}">Decreasing price</a>
                </div>
                <div class="pagination">
                @php
                    $page = request()->query('page');
                @endphp
                    <a @if($page === "1") class="active" @endif href="http://www.4handyshop.com/shop?category=handy&amp;page=1">1</a>
                    <a @if($page === "2") class="active" @endif href="http://www.4handyshop.com/shop?category=handy&amp;page=2">2</a>
                    
               				
                </div>
            </div>
            <!-- End Filter Bar -->
            <!-- Start Best Seller -->
            <section class="lattest-product-area pb-40 category-list">
                <div class="row">
                    @foreach ($products as $product)
                    <!-- single product -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-product">
                            <a href="{{ route('shop.show', $product->slug) }}">
                                <img class="img-fluid" src="{{ Voyager::image($product->image) }}" alt="">
                            </a>
                            <div class="product-details">
                                <h6>{{ $product->name }}</h6>
                                <p>{{ $product->details }}</p>
                                <div class="price">
                                    <h6>{{ $product->price }} CHF</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            <!-- End Best Seller -->
            <!-- Start Filter Bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center mb-5">
                <div class="dropdown">
                    <a class="btn" href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'asc']) }}">Accending price</a>
                    <a class="btn" href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'desc']) }}">Decreasing price</a>
                </div>
                <div class="pagination ml-auto">
                        <a href="http://127.0.0.1:8000/shop?category=handy&amp;page=1">1</a>
						<a href="http://127.0.0.1:8000/shop?category=handy&amp;page=2">2</a>
                </div>
            </div>
            
            <!-- End Filter Bar -->
        </div>
    </div>
    

</div>

                


</section>

@stop

