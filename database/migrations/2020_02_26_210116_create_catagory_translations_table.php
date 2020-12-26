<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatagoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catagory_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('catagory_id');
            $table->string('locale')->index();

            $table->string('name');

            $table->unique(['catagory_id','locale']);
            $table->foreign('catagory_id')->references('id')->on('catagories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catagory_translations');
    }
}
