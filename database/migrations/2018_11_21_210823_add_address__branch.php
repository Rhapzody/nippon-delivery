<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressBranch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branch', function (Blueprint $table) {
            $table->text('additional_address')->nullable();
            $table->string('road')->nullable();
            $table->string('alley')->nullable();
            $table->string('village_number')->nullable();
            $table->string('house_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branch', function (Blueprint $table) {
            $table->dropColumn('additional_address');
            $table->dropColumn('road');
            $table->dropColumn('alley');
            $table->dropColumn('village_number');
            $table->dropColumn('house_number');
        });
    }
}
