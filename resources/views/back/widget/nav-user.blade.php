{{-- Nav --}}
<ul class="nav nav-pills nav-fill">
    <li class="nav-item">
        <a class="nav-link h6 {{($nav == 'show')?'active':''}}" href={{ url('/staff/user/') }}>
            <span class="la la-group"> </span>
            ตรวจสอบผู้ใช้
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link h6 {{($nav == 'add')?'active':''}}" href={{ url('/staff/user/add') }}>
            <span class="la la-plus"></span>
            เพิ่มผู้ใช้
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link h6 {{($nav == 'edit')?'active':''}}" href={{ url('/staff/user/edit', []) }}>
            <span class="la la-pencil-square"></span>
            แก้ไขผู้ใช้
        </a>
    </li>
</ul>
