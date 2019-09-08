<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->char('slug', 40)->unique()->nullable();
			$table->char('name', 40)->nullable();
			$table->char('domain', 40)->default(env('DEFAULT_SHORT_DOMAIN', 'ur.bn'))->nullable();
			$table->string('url');
			$table->boolean('is_blocked')->default(false);
			$table->boolean('is_active')->default(true);
			$table->boolean('is_conditional')->default(false);
			$table->unsignedBigInteger('link_type_id')->default(10)->nullable();
			$table->unsignedBigInteger('project_id')->nullable();
            $table->timestamps();
			$table->softDeletes();

			$table->collation = 'utf8mb4_0900_as_cs';

			$table->foreign('link_type_id')->references('id')->on('link_types')->onDelete('set null');
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
        });

		Schema::table('projects', function(Blueprint $table) {
			$table->foreign('default_link_id')->references('id')->on('links')->onDelete('set null');
		});

		DB::statement('ALTER TABLE links AUTO_INCREMENT = 101');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
