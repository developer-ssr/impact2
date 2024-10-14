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
      
       
       
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->char('uuid')->nullable();
            $table->string('test_name')->nullable();
            $table->char('user_id')->nullable();
            $table->json('quadrants')->nullable();
            $table->json('settings')->nullable();
            $table->char('status')->nullable();
            $table->string('code')->nullable();
            $table->string('createby')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
