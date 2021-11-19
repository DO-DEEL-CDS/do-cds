<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('state_code')->nullable();
            $table->year('year')->nullable();
            $table->string('batch')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('author_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();

            $table->foreign('state_code')->references('state_code')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
