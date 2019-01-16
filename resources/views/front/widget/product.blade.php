<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    @foreach ($product->menuPictures as $pic)
                        <div class="product-preview">
                            <img src="{{ getUrl($pic->name) }}" alt="">
                        </div>
                    @endforeach

                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs">
                    @foreach ($product->menuPictures as $pic)
                        <div class="product-preview">
                            <img src="{{ getUrl($pic->name) }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h1 style="font-size:24px" class="product-name" id="product-name">{{$product->name}}</h1>
                    <div>
                        {{-- <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <a class="review-link" href="#">10 Review(s) | Add your review</a> --}}
                    </div>
                    <div>
                        <h3 class="product-price">{{$product->price}} บาท</h3>
                        {{-- <span class="product-available">In Stock</span> --}}
                    </div>
                    <p>{{$product->description}}</p>

                    {{-- <div class="product-options">
                        <label>
                            Size
                            <select class="input-select">
                                <option value="0">X</option>
                            </select>
                        </label>
                        <label>
                            Color
                            <select class="input-select">
                                <option value="0">Red</option>
                            </select>
                        </label>
                    </div> --}}

                    <div class="add-to-cart">
                        <div class="qty-label" style="font-size:20px">
                            จำนวน
                            <div class="input-number">
                                <input type="number" id="qty" value="1" min="1" max="99">
                                <span class="qty-up" id="qty-up">+</span>
                                <span class="qty-down" id="qty-down">-</span>
                            </div>
                        </div>
                        <button class="add-to-cart-btn" style="font-size:20px" onclick="addToCart({{$product->id}}, getQty());">
                            <i class="fa fa-shopping-cart"></i> เพิ่มลงตะกร้า
                        </button>
                    </div>

                    <ul class="product-btns">
                        <li><a href="#product-name" style="font-size:20px;text-decoration: underline;" onclick="addWhishList({{$product->id}})">
                            <i class="fa fa-heart-o" id="whish-icon"></i> เพิ่มในรายการที่ชอบ</a>
                        </li>
                    </ul>

                    <ul class="product-links h5">
                        <li style="font-size:20px">ประเภท:</li>
                        <li><a style="font-size:20px;text-decoration: underline;" href="{{url('store',[$product->menuType->name])}}">{{$product->menuType->name}}</a></li>
                    </ul>

                    <ul class="product-links">
                        <li style="font-size:20px">แท็ก:</li>
                        @forelse ($product->tags as $tag)
                            <span class="label label-danger"><a style="color:white;" class="h5" href="{{url('store/tag') . '?tagId=' . $tag->id . '&search=' . $tag->name}}">{{$tag->name}}</a></span>
                        @empty
                            <span class="h5">ไม่มีแท็ก</span>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
