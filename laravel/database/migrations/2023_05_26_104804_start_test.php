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
        Schema::create('start_tests', function (Blueprint $table) {
            $table->timestamps();
            $table->string('user_id');
            $table->foreignId('test_id');
            // $table->time('time_test');
            $table->time('time_start_test')->nullable();
            $table->time('time_remaining_test')->nullable();
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