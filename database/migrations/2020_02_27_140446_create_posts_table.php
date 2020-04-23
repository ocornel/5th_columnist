<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('created_by');
            $table->dateTime('publish_date')->default(now());
            $table->enum('status', [\App\Post::STATUS_DRAFT, \App\Post::STATUS_PUBLISHED, \App\Post::STATUS_DELETED])->default(\App\Post::defaultPostStatus());
            $table->text('content')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('comment_status',[\App\Post::COMMENTS_ENABLED, \App\Post::COMMENTS_DISABLED])->default(\App\Post::COMMENTS_ENABLED);
            $table->string('password')->nullable();
            $table->string('name')->default(\App\Post::generateName());
            $table->bigInteger('comment_count')->default(0);
            $table->bigInteger('view_count')->default(0);
            $table->bigInteger('likes')->default(0);
            $table->bigInteger('dislikes')->default(0);
            $table->float('rating')->default(0.0);
            $table->string('tags')->nullable();
            $table->string('feature_image')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');;;
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');;;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
