{{-- Nav --}}
<ul class="nav nav-pills nav-fill">
    <li class="nav-item">
        <a class="nav-link h6 " href={{ url('/admin/user/show') }}>ตรวจสอบผู้ใช้</a>
    </li>
    <li class="nav-item">
        <a class="nav-link h6 active" href={{ url('/admin/user/add') }}>เพิ่มผู้ใช้</a>
    </li>
    <li class="nav-item">
        <a class="nav-link h6" href={{ url('/admin/user/edit', []) }}>แก้ไขผู้ใช้</a>
    </li>
</ul>
