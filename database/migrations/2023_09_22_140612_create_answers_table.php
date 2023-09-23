<?php

use App\Models\Discussion;
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
        Schema::create('answers', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->text('content')->comment('回答');

            $table->foreignIdFor(User::class)
                ->nullable()//回答は匿名でも登録ユーザーでも可能。
                ->constrained()
                ->nullOnDelete();

            $table->foreignIdFor(Discussion::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
