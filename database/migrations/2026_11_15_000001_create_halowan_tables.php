<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Events
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 150);
            $table->string('slug', 170)->unique();
            $table->text('deskripsi');
            $table->string('lokasi', 150);
            $table->dateTime('tanggal');
            $table->string('banner', 120)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('tanggal');
        });

        // 2. Event Registrations
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['event_id', 'user_id']);
        });

        // 3. Articles
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 150);
            $table->string('slug', 170)->unique();
            $table->mediumText('isi');
            $table->string('gambar', 120)->nullable();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('created_at');
        });

        // 4. Forum Topics
        Schema::create('forum_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('judul', 150);
            $table->text('isi');
            $table->timestamps();

            $table->index('created_at');
        });

        // 5. Forum Comments
        Schema::create('forum_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->constrained('forum_topics')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('isi');
            $table->timestamps();

            $table->index(['topic_id', 'created_at']);
        });

        // 6. Gallery
        Schema::create('gallery', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100);
            $table->string('gambar', 120);
            $table->timestamps();
        });

        // 7. Messages (Kontak & Konfirmasi Donasi)
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 80);
            $table->string('email', 120);
            $table->text('pesan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('gallery');
        Schema::dropIfExists('forum_comments');
        Schema::dropIfExists('forum_topics');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('event_registrations');
        Schema::dropIfExists('events');
    }
};
