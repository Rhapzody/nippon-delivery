<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDetailToSumCostDiscountAtRestaurantDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurant_detail', function (Blueprint $table) {
            $table->dropColumn('detail');
            $table->decimal('sum_price_discount', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurant_detail', function (Blueprint $table) {
            $table->dropColumn('sum_price_discount');
            $table->json('detail');
        });
    }
}
