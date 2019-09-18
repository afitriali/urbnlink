<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hits', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('country')->nullable();
			$table->string('agent', 500)->nullable();
			$table->string('referrer')->nullable();
			$table->string('page')->nullable();
			$table->unsignedBigInteger('link_id');
            $table->timestamps();

			$table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hits');
    }
}
