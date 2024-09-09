<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->char('cellid')->nullable();
           $table->char('testcode')->nullable();
            $table->char('testid')->nullable();
            $table->string('demoPart')->nullable();
            $table->string('devices')->nullable();
            $table->string('browser')->nullable();
            $table->string('OS')->nullable();
            $table->string('MobileOS')->nullable();
            $table->char('index')->nullable();
            $table->char('rt')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
      
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
