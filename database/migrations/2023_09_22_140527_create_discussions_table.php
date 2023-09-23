<?php

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
        Schema::create('discussions', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('title')->comment('タイトル');

            $table->text('content')->comment('相談内容');

            $table->string('version')->comment('Laravelバージョン');

            $table->boolean('private')->default(false)->comment('非公開');

            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete(); //ユーザー削除時はnullにして相談は残す。

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discussions');
    }
};
