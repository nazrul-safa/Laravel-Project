@extends('layouts/tohoney')
@section('title')
   {{ $product_info->product_name }}
@endsection
@section('body')
     <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100"  style="background: url({{ asset('tohoney_assets//images/bg/5.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shop Page</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- single-product-area start-->
    <div class="single-product-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-single-img">
                        <div class="product-active owl-carousel">
                            <div class="item">
                                <img src="{{ asset('photo') }}/product/{{ $product_info->product_photo }}" alt="">
                            </div>
                            @foreach (App\Models\Featured_photo::where('product_id',$product_info->id)->get() as $featured_photo)
                            <div class="item">
                                <img src="{{ asset('photo') }}/product_featured/{{ $featured_photo->featured_photos }}" alt="">
                            </div>
                            @endforeach
                        </div>
                        <div class="product-thumbnil-active  owl-carousel">
                            <div class="item">
                                <img src="{{ asset('photo') }}/product/{{ $product_info->product_photo }}" alt="">
                            </div>
                            @foreach (App\Models\Featured_photo::where('product_id',$product_info->id)->get() as $featured_photo)
                            <div class="item">
                                <img src="{{ asset('photo') }}/product_featured/{{ $featured_photo->featured_photos }}" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-single-content">
                        <h3>{{ $product_info->product_name }}</h3>
                        <span class="badge badge-success">Available stocks: {{ $product_info->product_quantity }}</span>
                        <div class="rating-wrap fix">
                            <span class="pull-left">${{ $product_info->product_price }}</span>
                            <ul class="rating pull-right">
                                @for ($i = 1; $i <= floor($overall_reviews); $i++)
                                    <li><i class="fa fa-star"></i></li>
                                @endfor
                                @if (is_float($overall_reviews))
                                    <li><i class="fa fa-star-half-o"></i></li>
                                @endif
                                <li>({{ $reviews->count() }} Customar Review)</li>
                            </ul>
                        </div>
                        <p>{{ $product_info->product_short_description }}</p>
                        <form action="{{ route('addtocart', $product_info->id) }}" method="POST">
                            @csrf
                            <ul class="input-style">
                                <li class="quantity cart-plus-minus">
                                    <input type="text" value="1" name="quantity" />
                                </li>
                                <li>
                                    <button class="btn btn-danger">Add to Cart</button>
                                </li>
                            </ul>
                        </form>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <ul class="cetagory">
                            <li>Categories:</li>
                            <li><a href="#">{{ App\Models\Category::find($product_info->category_id)->category_name }}</a></li>
                        </ul>
                        <ul class="socil-icon">
                            <li>Share :</li>
                            <li><a href="http://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}_HERE&t=safa" target="_blank" class="share-popup"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="http://www.twitter.com/intent/tweet?url=URL_HERE&via=TWITTER_HANDLE_HERE&text=TITLE_HERE" target="_blank" class="share-popup"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-60">
                <div class="col-12">
                    <div class="single-product-menu">
                        <ul class="nav">
                            <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                            <li><a data-toggle="tab" href="#tag">Faq</a></li>
                            <li><a data-toggle="tab" href="#review">Review</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="description">
                            <div class="description-wrap">
                                <p>{{ $product_info->product_long_description }}</p>
                            
                            </div>
                        </div> 
                         
                        <div class="tab-pane" id="tag">
                           
                            <div class="faq-wrap" id="accordion">
                                @foreach ($faq_info as $faq)
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5><button class="{{ ($loop->index==0) ? '': 'collapsed' }}"data-toggle="collapse" data-target="#collapseOne{{ $faq->id }}" aria-expanded="true" aria-controls="collapseOne">{{ $faq->qus }} ?</button> </h5>
                                        </div>
                                        <div id="collapseOne{{ $faq->id }}" class="collapse {{ ($loop->index==0) ? 'show': '' }} " aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                            {{ $faq->ans }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach 
                            </div>
                             
                        </div>
                         
                        <div class="tab-pane" id="review">
                            <div class="review-wrap">
                                <ul>
                                   @foreach ($reviews as $review)
                                        <li class="review-items">
                                        <div class="review-img">
                                            <img src="{{ asset('tohoney_assets')}}/images/comment/1.png" alt="">
                                        </div>
                                        <div class="review-content">
                                            <h3><a href="#">{{ App\Models\User::find($review->user_id)->name}}</a></h3>
                                            <span>{{ $review->created_at->format('d M, Y') }} at {{ $review->created_at->format('h:i A') }}</span>
                                            <p>{{ $review->review_text }}.</p>
                                            <ul class="rating">
                                                @for($x =1; $x<= $review->stars; $x++)
                                                  <li><i class="fa fa-star"></i></li>
                                                @endfor   
                                            </ul>
                                        </div>
                                    </li>
                                   @endforeach
                                </ul>
                            </div>
            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- single-product-area end-->
    <!-- featured-product-area start -->
    <div class="featured-product-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-left">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($related_product as $rel_product)
                    <div class="col-lg-3 col-sm-6 col-12">
                    <div class="featured-product-wrap">
                        <div class="featured-product-img">
                            <img src="{{ asset('photo') }}/product/{{ $rel_product->product_photo }}" alt="">
                        </div>
                        <div class="featured-product-content">
                            <div class="row">
                                <div class="col-7">
                                    <h3><a href="{{ url('product/details')}}/{{ $rel_product->id }}">{{ $rel_product->product_name }}</a></h3>
                                    <p>{{ $rel_product->product_price }}</p>
                                </div>
                                <div class="col-5 text-right">
                                    <ul>
                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                        <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="alert alert-danger">Nothing To Show</div>
                    </div>   
                @endforelse
            </div>
        </div>
    </div>
    <!-- featured-product-area end -->
    
@endsection