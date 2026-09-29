<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Week 4 - Laboratory Activity 4: Develop CRUD APIs.
     *
     * `department` is kept here as the free-text column the module's
     * Week 4 lecture notes show. Week 5 adds a proper `department_id`
     * foreign key (see the 2026_09_23_000004 migration) once the
     * Department model and relationship are introduced, so `department`
     * is made nullable and is superseded by the relationship from then on.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('department')->nullable();
            $table->string('position');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
