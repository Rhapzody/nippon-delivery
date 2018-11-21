<!-- aside Widget -->
<div class="aside" style="padding-bottom:20px;">
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="{{($unav == 'edit')?'active':''}}"><a href="{{url('user/edit?unav=edit')}}">แก้ไขข้อมูล</a></li>
        <li role="presentation" class="{{($unav == 'whish')?'active':''}}"><a href="{{url('user/whishlist?unav=whish')}}">รายการที่ชอบ</a></li>
        <li role="presentation" class="{{($unav == 'cart')?'active':''}}"><a href="{{url('user/cart?unav=cart')}}">สินค้าในตะกร้า</a></li>
        <li role="presentation" class="{{($unav == 'history')?'active':''}}"><a href="{{url('user/history?unav=history')}}">การสั่งสินค้า</a></li>

    </ul>

</div>
<!-- /aside Widget -->
