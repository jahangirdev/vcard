<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('facebook')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('youtube')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('instagram')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('tiktok_link')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('snapchat_link')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('pinterest_link')->nullable();
            $table->string('reddit')->nullable();
            $table->string('reddit_link')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('twitter')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('github')->nullable();
            $table->string('github_link')->nullable();
            $table->string('behance')->nullable();
            $table->string('behance_link')->nullable();
            $table->string('dribbble')->nullable();
            $table->string('dribbble_link')->nullable();
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
        Schema::dropIfExists('social_links');
    }
}
