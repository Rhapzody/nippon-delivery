<!-- STORE -->
<div id="store" class="col-md-9">

    <!-- store products -->
    @foreach ($menus as $i => $menu)
        {!!($i==0 || $i==3 || $i==6)?'<div class="row">':''!!}
            <!-- product -->
            <div class="col-md-4">
                <div class="product">
                    <div class="product-img">
                        <img src="{{url('/storage',[$menu->menuPictures[0]->name])}}" alt="" >
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
            </div>
            <!-- /product -->
        @if ($loop->last)
            </div>
        @else
            {!!($i==2 || $i==5 || $i==8)?'</div>':''!!}
        @endif
    @endforeach
    <!-- /store products -->

    <div class="row"></div>
    <!-- store bottom filter -->
    <div class="store-filter clearfix">
        @if ($searching == false)
            {{ $menus->links() }}
        @endif
        <script>
            var page = document.getElementsByClassName('pagination')[0];
            page.classList.remove('pagination');
            page.classList.add('store-pagination');
        </script>
    </div>
    <!-- /store bottom filter -->
</div>
<!-- /STORE -->
