<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dresses', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('code');
            $table->string('name');
            $table->enum('type',['Traditional','Western','Thai','Vietnam','Chinese']);
            $table->enum('gender',['Men','Women']);
            $table->string('main_photo')->nullable();
            $table->string('related_photos')->nullable();
            $table->longText('description')->nullable();
            $table->integer('current_qty')->nullable();
            $table->integer('borrow_price')->default(0);
            $table->integer('selling_price')->default(0);
            //   $table->enum('status',[0,1,2])->default(0);
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
        Schema::dropIfExists('dresses');
    }
};
