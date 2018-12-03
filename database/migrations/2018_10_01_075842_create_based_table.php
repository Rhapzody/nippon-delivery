<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->integer('type_id')->unsigned();
            $table->decimal('price', 8, 2);
            $table->foreign('type_id')->references('id')->on('menu_type')->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::create('tag', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
        });

        Schema::create('menu_tag', function (Blueprint $table) {
            $table->integer('menu_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->primary(['menu_id', 'tag_id']);
            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tag_id')->references('id')->on('tag')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('menu_picture', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('menu_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('cart', function (Blueprint $table) {
            $table->integer('menu_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->primary(['menu_id', 'user_id']);
            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('whish_list', function (Blueprint $table) {
            $table->integer('menu_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->primary(['menu_id', 'user_id']);
            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('order_menu_status', function (Blueprint $table) {
            $table->increments('code');
            $table->string('name')->unique();
        });

        Schema::create('order_status', function (Blueprint $table) {
            $table->increments('code');
            $table->string('name')->unique();
        });

        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('status_code')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('status_code')->references('code')->on('order_status')->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::create('order_menu', function (Blueprint $table) {
            $table->integer('menu_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('status_code')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->primary(['menu_id', 'order_id']);
            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_code')->references('code')->on('order_menu_status')->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::create('restaurant_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->json('detail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_detail');
        Schema::dropIfExists('order_menu');
        Schema::dropIfExists('order');
        Schema::dropIfExists('order_status');
        Schema::dropIfExists('order_menu_status');
        Schema::dropIfExists('whish_list');
        Schema::dropIfExists('cart');
        Schema::dropIfExists('menu_picture');
        Schema::dropIfExists('menu_tag');
        Schema::dropIfExists('tag');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('menu_type');
    }
}
