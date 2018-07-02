<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('line_id')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->integer('package_id')->unsigned()->nullable();
            $table->string('line_type')->default('official');
            $table->string('reseller_notes')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('package_id')->references('package_id')->on('packages')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('lines');
    }
}
