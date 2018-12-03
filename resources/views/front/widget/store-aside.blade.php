<!-- ASIDE -->
<div id="aside" class="col-md-3">

    <!-- aside Widget -->
    <div class="aside">
        <h3 class="aside-title">เมนูใหม่</h3>
        @foreach ($new_menu as $menu)
            <div class="product-widget">
                <div class="product-img">
                    <img src="{{url('/storage',[$menu->menuPictures[0]->name])}}" alt="">
                </div>
                <div class="product-body">
                    <p class="product-category">ประเภท: {{$menu->menuType->name}}</p>
                    <h3 class="product-name"><a href="{{url('product',[$menu->id])}}">{{$menu->name}}</a></h3>
                    <h4 class="product-price">{{$menu->price}} บาท</h4>
                </div>
            </div>
        @endforeach
    </div>
    <!-- /aside Widget -->

    <!-- aside Widget -->
    <div class="aside">
        <h3 class="aside-title">เมนูยอดฮิต</h3>
        @foreach ($top_menu as $menu)
            <div class="product-widget">
                <div class="product-img">
                    <img src="{{url('/storage',[$menu->menuPictures[0]->name])}}" alt="">
                </div>
                <div class="product-body">
                    <p class="product-category">ประเภท: {{$menu->menuType->name}}</p>
                    <h3 class="product-name"><a href="{{url('product',[$menu->id])}}">{{$menu->name}}</a></h3>
                    <h4 class="product-price">{{$menu->price}} บาท</h4>
                </div>
            </div>
        @endforeach
    </div>
    <!-- /aside Widget -->

    <!-- aside Widget -->
    <div class="aside">
        <h3 class="aside-title">แท็ก</h3>
        @foreach ($tags as $tag)
            <span class="label label-danger" ><a href="{{url('store/tag') . '?tagId=' . $tag->id . '&search=' .$tag->name}}" style="color:white;">{{$tag->name}}</a></span>
        @endforeach
    </div>
    <!-- /aside Widget -->

</div>
<!-- /ASIDE -->
