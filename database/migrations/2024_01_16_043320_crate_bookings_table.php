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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->text('customer_phone');
            $table->text('customer_email');
            $table->text('customer_address');
            $table->text('recommendation');
            $table->foreignId('package_id')->constrained('packages')->cascadeOnDelete();
            $table->foreignId('dress_id')->constrained('dresses')->cascadeOnDelete();
            $table->foreignId('theme_id')->constrained('themes')->cascadeOnDelete();
            $table->string('date');
            $table->string('time');
            $table->enum('status', ['pending', 'cancel', 'done']);
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
        //
    }
};
