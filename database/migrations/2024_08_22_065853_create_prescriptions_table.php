<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to the user
            $table->string('note')->nullable();
            $table->string('delivery_address');
            $table->string('delivery_time');
            $table->timestamps();
        });
    
        Schema::create('prescription_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')->constrained()->onDelete('cascade'); // Link to the prescription
            $table->string('image_path');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('prescription_images');
        Schema::dropIfExists('prescriptions');
    }
};
