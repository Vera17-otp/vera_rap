<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('multiple_uploads', function (Blueprint $table) {
    $table->id();
    $table->string('ref_table', 100); // ⭐ tabel pemilik
    $table->unsignedInteger('ref_id'); // ⭐ id pemilik
    $table->string('filename'); 
    $table->string('original_name');
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('multiple_uploads');
    }
};
