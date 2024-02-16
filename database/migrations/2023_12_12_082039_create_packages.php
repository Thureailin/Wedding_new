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
        Schema::create('packages', function (Blueprint $table) {$table->id();
            $table->string('code');
            $table->string('name');
            $table->integer('price');
            $table->integer('dress_id');
            $table->integer('theme_id');
            $table->integer('no_of_dress')->default(0);
            $table->integer('no_of_theme')->default(0);
            $table->integer('no_of_retouched_photo')->default(0);
            $table->integer('no_of_soft_copy_photo')->default(0);
            $table->integer('no_of_hard_copy');
            $table->boolean('frame_flag');
            $table->integer('no_of_frame');
            $table->string('frame_specification');
            $table->boolean('album_flag');
            $table->integer('no_of_album');
            $table->string('album_specification');
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('packages');
    }
};
