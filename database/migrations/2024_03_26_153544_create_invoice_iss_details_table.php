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
        Schema::create('invoice_iss_details', function (Blueprint $table) {

            $table->id();
            $table->foreignId('issu_id')->constrained('invoice_isses')->cascadeOnDelete()->default(0);
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
            $table->string('unit');
            $table->decimal('quantity',8,2)->default(0.00);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_iss_details');
    }
};
