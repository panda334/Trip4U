<?php

use App\Models\Advantage;
use App\Models\Trip;
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
        Schema::create('advantage_trips', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Advantage::class);
            $table->foreignIdFor(Trip::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advantage_trips');
    }
};
