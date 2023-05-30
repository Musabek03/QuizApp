<?php

use App\Models\Category;
use App\Models\User;
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
        Schema::create('collection', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained('categories');
            $table->foreignIdFor(User::class)->constrained('users');
            $table->string('name', 255)->index();
            $table->longText('description');
            $table->string('code')->unique();
            $table->enum('allowed_type', ['public', 'url', 'limitedUsers']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection');
    }
};
