<li class="col-xl-3 col-lg-4 col-sm-6 col-12">
    <div class="product-wrap"> 
        <div class="product-img">
            <span>Sale</span>
            <img src="{{ asset('photo') }}/product/{{ $product->product_photo }}" alt="">
            {{-- <img src="{{ asset('photo/product') }}/{{ $product->product_name }}" alt=""> --}}
            <div class="product-icon flex-style">
                <ul>
                    <li><a data-toggle="modal" data-target="#exampleModalCenter{{ $product->id }}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                    {{-- <li><a href="{{ url('wishlist')}}/{{ $product->id }}"><i class="fa fa-heart"></i></a></li> --}}
                    <li><a href="{{ route('cart') }} "><i class="fa fa-shopping-bag"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="product-content">
            <h3><a href="{{ url('product/details')}}/{{ $product->id }}">{{ $product->product_name }}</a></h3>
            <p class="pull-left">${{ $product->product_price  }}
            </p>
            <ul class="pull-right d-flex">
                @php
                    use App\Models\Review;
                    if(Review::where('product_id', $product->id)->exists()){
                        $overall_review = Review::where('product_id', $product->id)->sum('stars') / Review::where('product_id', $product->id)->count();
                    }
                    else{
                        $overall_review = 0;
                    }
                @endphp
                @for ($i = 1; $i <= floor($overall_review); $i++)
                    <li><i class="fa fa-star"></i></li>
                @endfor
                @if (is_float($overall_review))
                    <li><i class="fa fa-star-half-o"></i></li>
                @endif
            </ul>
        </div>
    </div>
</li>
 <!-- Modal area start -->
 <div class="modal fade" id="exampleModalCenter{{ $product->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body d-flex">
                <div class="product-single-img w-50">
                    <img src="{{ asset('photo') }}/product/{{ $product->product_photo }}" alt="">
                </div>
                <div class="product-single-content w-50">
                    <h3>
                        {{ $product->product_name }}
                    </h3>
                    <div class="rating-wrap fix">
                        <span class="pull-left">${{$product->product_price }}</span>
                    </div>
                     <p>{{ $product->product_short_description }}</p>
                    <form action="{{ route('addtocart', $product->id) }}" method="POST">
                            @csrf
                            <ul class="input-style">
                                <li class="quantity cart-plus-minus">
                                    <input type="text" value="1" name="quantity" />
                                </li>
                                <li>
                                    <input type="submit" class="text-white bg-danger border-0 addtocart"  style="padding: 5.5px 10px" value="Add to cart" min="1" onclick="ShowDiv()">
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
                        <li><a href="#">{{ App\Models\Category::find($product->category_id)->category_name }}</a></li>
                    </ul>
                    <ul class="socil-icon">
                        <li>Share :</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal area start -->