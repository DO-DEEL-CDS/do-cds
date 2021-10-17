<?php

use App\Enums\ArticleStatus;
use App\Models\State;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('content');
            $table->tinyInteger('status')->default(ArticleStatus::Draft);
            $table->foreignId('author')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('category_id');
            $table->foreignIdFor(State::class, 'state_code')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
