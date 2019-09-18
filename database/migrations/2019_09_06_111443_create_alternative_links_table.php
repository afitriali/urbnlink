<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlternativeLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternative_links', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('url');
			$table->unsignedBigInteger('link_id');
			$table->unsignedBigInteger('link_type_id')->default(10)->nullable();
			$table->integer('priority');
			$table->string('description')->nullable();
            $table->timestamps();

			$table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
			$table->foreign('link_type_id')->references('id')->on('link_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alternative_links');
    }
}
