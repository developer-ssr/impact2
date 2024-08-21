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
        Schema::create('main_dashboards', function (Blueprint $table) {
            $table->increments('id');
            $table->char('uuid')->nullable();
            $table->string('test_name')->nullable();
            $table->char('user_id')->nullable();
            $table->json('headers')->nullable();
            $table->json('warnings')->nullable();
            $table->json('instructions')->nullable();
            $table->json('images')->nullable();
             $table->json('footers')->nullable();
            $table->char('status')->nullable();
            $table->string('code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_dashboards');
    }
};
