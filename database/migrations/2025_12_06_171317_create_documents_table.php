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
            Schema::create('documents', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('branch');
                $table->string('semester');
                $table->string('subject')->nullable();
                $table->enum('type', ['notes', 'assignment', 'pyq']);
                $table->string('file_path');  
                $table->string('thumbnail')->nullable();
                $table->integer('views')->default(0);
                $table->integer('downloads')->default(0);

                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
