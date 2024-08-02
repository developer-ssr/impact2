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
        Schema::create('filter_details', function (Blueprint $table) {
            $table->increments('id');
            $table->char('filter')->nullable();
            $table->string('type')->nullable();
            $table->char('operator')->nullable();
            $table->text('ids')->nullable();
            $table->string('parameter')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filter_details');
    }
};
