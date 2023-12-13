<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id')->nullable();;
            $table->unsignedBigInteger('user_id'); // Foreign key na tumutukoy sa id ng users
            $table->longText('comments')->nullable();
            $table->integer('star_rating')->nullable();;
            $table->enum('status', ['active', 'deactive'])->nullable();
            $table->timestamps();
    
            // I-dagdag ang foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    // ...
    
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
