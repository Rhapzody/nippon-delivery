{{-- Nav --}}
<ul class="nav nav-pills nav-fill">
    <li class="nav-item">
        <a class="nav-link h6 {{($nav == 'show')?'active':''}}" href={{ url('/staff/product/') }}>
            <span class="la la-search"></span>
            ตรวจสอบสินค้า
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link h6 {{($nav == 'add')?'active':''}}" href={{ url('/staff/product/add') }}>
            <span class="la la-cart-plus"></span>
            เพิ่มสินค้า
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link h6 {{($nav == 'edit')?'active':''}}" href="#">
            <span class="la la-pencil-square"></span>
            แก้ไขสินค้า
        </a>
    </li>
</ul>
{{-- img --}}
