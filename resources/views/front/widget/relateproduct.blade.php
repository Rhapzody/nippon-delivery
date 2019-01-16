<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">เมนูที่เกี่ยวข้อง</h3>
                </div>
            </div>

            @forelse ($menus as $menu)
                <!-- product -->
                <div class="col-md-3 col-xs-6">
                    <div class="product">
                        <div class="product-img">
                            <img src="{{getUrl($menu->menuPictures[0]->name)}}" alt="">
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
                                <button class="add-to-wishlist" onclick="addWhishList({{$menu->id}});"><i class="fa fa-heart-o"></i><span
                                        class="tooltipp">เพิ่มลงรายการที่ชอบ</span></button>
                                <button class="quick-view"><a href="{{url('product',[$menu->id])}}"><i class="fa fa-eye"></i></a><span
                                        class="tooltipp">ดูรายละเอียดสินค้า</span></button>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <button class="add-to-cart-btn" onclick="addToCart({{$menu->id}}, 1)"><i class="fa fa-shopping-cart"></i>
                                เพิ่มลงตะกร้า</button>
                        </div>
                    </div>
                </div>
                <!-- /product -->
            @empty
                ไม่มี
            @endforelse

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->
