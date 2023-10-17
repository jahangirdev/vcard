<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vcards', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('template')->nullable();
            $table->string('designation')->nullable();
            $table->string('slug')->nullable();
            $table->text('about')->nullable();
            $table->string('profile_img')->nullable();
            $table->string('cover')->nullable();
            $table->string('website')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->integer('status')->default(0);
            $table->string('lang')->nullable();
            $table->integer('show_social_icons')->default(1);
            $table->integer('show_contact_info')->default(1);
            $table->integer('show_services')->default(1);
            $table->integer('show_portfolios')->default(1);
            $table->integer('show_testimonials')->default(1);
            $table->integer('show_business_hours')->default(1);
            $table->integer('show_contact_form')->default(1);
            $table->string('qr_code')->nullable();
            $table->integer('views')->default(0);
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
        Schema::dropIfExists('vcards');
    }
}
