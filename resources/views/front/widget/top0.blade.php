<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title primary-btn cta-btn">เมนูยอดฮิต</h3>
                    <div class="section-nav">
                        {{-- <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab2">Laptops</a></li>
                            <li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
                            <li><a data-toggle="tab" href="#tab2">Cameras</a></li>
                            <li><a data-toggle="tab" href="#tab2">Accessories</a></li>
                        </ul> --}}
                    </div>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">

                               @foreach ($top_menu as $menu)
                                <div class="product">
                                        <div class="product-img">
                                            <img src="{{ getUrl($menu->menuPictures[0]->name) }}" alt="" >
                                            <div class="product-label">
                                                {{-- <span class="sale">-30%</span>
                                                <span class="new">NEW</span> --}}
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">ประเภท: {{$menu->menuType->name}}</p>
                                            <h3 class="product-name"><a href="{{url('product',[$menu->id])}}">{{$menu->name}}</a></h3>
                                            <h4 class="product-price">{{$menu->price}} บาท</h4>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist" onclick="addWhishList({{$menu->id}});"><i class="fa fa-heart-o"></i><span class="tooltipp">เพิ่มลงรายการที่ชอบ</span></button>
                                                <button class="quick-view"><a href="{{url('product',[$menu->id])}}"><i class="fa fa-eye"></i></a><span class="tooltipp">ดูรายละเอียดสินค้า</span></button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn" onclick="addToCart({{$menu->id}}, 1)"><i class="fa fa-shopping-cart"></i> เพิ่มลงตะกร้า</button>
                                        </div>
                                    </div>
                               @endforeach

                            </div>
                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
