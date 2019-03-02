<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
                    <ul class="hot-deal-countdown">
                        <li>
                            <div>
                                <h3>วันที่</h3>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3 title="วัน" id="today"></h3>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3 title="เดือน" id="thismonth"></h3>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3 id="thisyear"></h3>
                            </div>
                        </li>
                        <script>
                            var today = new Date();
                            document.getElementById('today').innerHTML = today.getDate();
                            document.getElementById('thismonth').innerHTML = today.getMonth()+1;
                            document.getElementById('thisyear').innerHTML = today.getFullYear();
                        </script>
                    </ul>
                    <h1 class="text-uppercase">ฟรี ค่า จัด ส่ง</h1>
                    <p>> > > เมื่อสั่งครบ {{$promotion->sum_price_discount}} บาท < < <</p>
                    <p>หรือภายในเขตที่สาขาดูแลอยู่</p>
                    <a class="primary-btn cta-btn h3" href="{{url('store')}}">สั่งเลย!</a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->
