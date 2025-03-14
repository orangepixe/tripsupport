<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'supports', function (Blueprint $table){
            $table->id();
            $table->integer('support_id')->default();
            $table->integer('client')->default(0);
            $table->integer('assignment')->default(0);
            $table->string('headline')->nullable();
            $table->string('importance')->nullable();
            $table->string('stage')->nullable();
            $table->integer('category')->default(0);
            $table->text('summary')->nullable();
            $table->integer('created_id')->default(0);
            $table->integer('parent_id')->default(0);
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supports');
    }
}
