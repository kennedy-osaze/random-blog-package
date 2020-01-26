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
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identifier')->index();
            $table->string('slug')->unique();
            $table->string('title');
            $table->longText('body');
            $table->text('meta_data');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverses the migration
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('posts');
    }
}