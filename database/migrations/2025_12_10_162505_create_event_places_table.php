<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_places', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();

            $table->string('image')->nullable();

            $table->date('date');
            $table->time('time');

            $table->enum('event_type', ['online', 'offline', 'hybrid']);

            $table->string('venue')->nullable();  // For offline events
            $table->string('meet_link')->nullable();  // For online events

            $table->string('department')->nullable();
            $table->string('year')->nullable();

            $table->integer('max_participants')->nullable();

            // IMPORTANT — You missed this earlier (why error came)
            $table->unsignedBigInteger('organizer_id');
            $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_places');
    }
};
