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
            $table->text('additional_address');
            $table->string('road');
            $table->string('alley');
            $table->string('village_number');
            $table->string('house_number');
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
