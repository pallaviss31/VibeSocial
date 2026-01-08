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
        Schema::table('quizzes', function (Blueprint $table) {
            // Who created the quiz
            $table->foreignId('created_by')->nullable()->after('id')->constrained('users')->cascadeOnDelete();

            // Admin or user
            $table->enum('creator_role', ['admin', 'user'])->nullable()->after('created_by');

            // Approval workflow
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default('pending')->after('passing_marks');

            // Visibility
            $table->boolean('is_published')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            //
        });
    }
};
