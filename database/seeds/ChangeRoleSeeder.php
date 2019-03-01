<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChangeRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')
            ->where('id', 2)
            ->update(['name' => 'พนักงานรับออเดอร์']);

        DB::table('roles')
            ->where('id', 3)
            ->update(['name' => 'พนักงานส่งสินค้า']);

        DB::table('roles')
            ->where('id', 5)
            ->delete();
    }
}

// เมื่อมีการลบสินค้า
// - ต้องไม่แสดงสินค้าในทุกหน้าร้าน
// - ต้องไม่แสดงสินค้าในรายการที่ชอบ
// - ต้องไม่แสดงสินค้าในเมนูยอดฮิต *ยอดขาย
// - ไม่สามารถเพิ่มสินค้าในตะกร้า หรือรายการที่ชอบได้อีก
// - หน้าจัดการสินค้า ให้แสดงว่าสินค้าไหนที่ถูกลบ และยกเลิกการลบได้

// หน้านำส่ง ชื่อผู้ใช้ไม่ถูกต้อง
// เมื่อมีการลบผู้ใช้งาน
// - หน้าจัดการผู้ใช้ แสดงว่าผู้ใช้ไหนถูกลบ และยกเลิกการลบได้
// - ผู้ใช้ที่ถูกลบ ไม่สามารถเข้าสู่ระบบได้