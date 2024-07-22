<?php

use App\Models\Destination;
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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text('description');
            $table->integer("adult_price");
            $table->integer("children_price");
            $table->integer("infant_price");
            $table->string("type");  #type of trip (Luxury or super_price etc...)
            $table->date("date");
            $table->date("first_date");
            $table->date("end_date");
            $table->integer("avibality");
            $table->foreignIdFor(Destination::class);
            $table->integer("duration");  #this row for how much seats in this trip 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
