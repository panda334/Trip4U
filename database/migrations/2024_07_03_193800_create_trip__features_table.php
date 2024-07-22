<?php

use App\Models\Features;
use App\Models\Trip;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trip__features', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Trip::class);
            $table->foreignIdFor(Features::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip__features');
    }
};
