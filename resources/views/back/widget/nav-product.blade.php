{{-- Nav --}}
<ul class="nav nav-pills nav-fill">
    <li class="nav-item">
        <a class="nav-link h6 " href={{ url('/admin/product/show') }}>ตรวจสอบสินค้า</a>
    </li>
    <li class="nav-item">
        <a class="nav-link h6 active" href={{ url('/admin/product/add') }}>เพิ่มสินค้า</a>
    </li>
    <li class="nav-item">
        <a class="nav-link h6" href={{ url('/admin/product/edit', []) }}>แก้ไขสินค้า</a>
    </li>
</ul>
