<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id(); 
            $table->string('category'); 
            $table->string('question'); 
            $table->string('option_no_one'); 
            $table->string('option_no_two'); 
            $table->string('option_no_three'); 
            $table->string('option_no_four');  
            $table->boolean('is_deleted')->nullable();  
            $table->softDeletes(); 
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
        Schema::dropIfExists('exams');
    }
}
