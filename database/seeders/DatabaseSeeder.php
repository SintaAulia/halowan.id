<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Topic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin & Demo Member
        $admin = User::firstOrCreate(
            ['email' => 'admin@halowan.id'],
            [
                'name'     => 'Admin Halowan',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
                'bio'      => 'Pengelola Komunitas Halowan.id.',
            ]
        );

        $member = User::firstOrCreate(
            ['email' => 'budi@halowan.id'],
            [
                'name'     => 'Budi Santoso',
                'password' => Hash::make('password123'),
                'role'     => 'member',
                'bio'      => 'Pecinta kopi, teknologi, dan eksplorasi hal-hal baru.',
            ]
        );

        // 2. Events
        $events = [
            [
                'judul'      => 'Kopdar Perdana Halowan',
                'slug'       => 'kopdar-perdana-halowan',
                'deskripsi'  => "Pertemuan pertama anggota Halowan.id. Kenalan, ngobrol santai, dan susun rencana kegiatan komunitas bersama.\n\nGratis untuk semua anggota. Bawa teman boleh!",
                'lokasi'     => 'Makassar (lokasi diumumkan menyusul)',
                'tanggal'    => Carbon::now()->addDays(14),
                'created_by' => $admin->id,
            ],
            [
                'judul'      => 'Workshop: Mulai Bangun Website Pertamamu',
                'slug'       => 'workshop-mulai-bangun-website',
                'deskripsi'  => "Workshop pemula untuk membuat website sederhana dari nol. Cocok untuk yang belum pernah coding.\n\nPeserta cukup membawa laptop.",
                'lokasi'     => 'Online (Zoom)',
                'tanggal'    => Carbon::now()->addDays(28),
                'created_by' => $admin->id,
            ],
            [
                'judul'      => 'Diskusi Santai: Cerita Komunitas',
                'slug'       => 'diskusi-santai-cerita-komunitas',
                'deskripsi'  => 'Obrolan ringan tentang pengalaman berkomunitas dan ide kegiatan ke depan.',
                'lokasi'     => 'Online (Google Meet)',
                'tanggal'    => Carbon::now()->subDays(10),
                'created_by' => $admin->id,
            ],
        ];

        foreach ($events as $ev) {
            Event::firstOrCreate(['slug' => $ev['slug']], $ev);
        }

        // 3. Articles
        $articles = [
            [
                'judul'     => 'Selamat Datang di Halowan.id',
                'slug'      => 'selamat-datang-di-halowan',
                'isi'       => "Halo! Terima kasih sudah mampir ke Halowan.id.\n\nKomunitas ini dibuat sebagai ruang untuk belajar, berbagi, dan saling terhubung. Kamu bisa mengikuti event, ikut berdiskusi di forum, atau menulis cerita untuk dibaca anggota lain.\n\nMulai dari mana? Buat akun, lengkapi profilmu, lalu sapa anggota lain di forum.",
                'author_id' => $admin->id,
            ],
            [
                'judul'     => 'Tiga Cara Aktif di Komunitas Tanpa Merasa Canggung',
                'slug'      => 'tiga-cara-aktif-di-komunitas',
                'isi'       => "Baru bergabung dan bingung mau mulai dari mana? Tenang, semua orang pernah di posisi itu.\n\n1. Perkenalkan diri di forum. Cukup tiga kalimat sudah cukup.\n\n2. Datang ke satu event kecil dulu. Event online adalah awal yang nyaman.\n\n3. Bantu menjawab satu pertanyaan. Berbagi hal yang kamu tahu adalah cara tercepat dikenal.",
                'author_id' => $admin->id,
            ],
        ];

        foreach ($articles as $art) {
            Article::firstOrCreate(['slug' => $art['slug']], $art);
        }

        // 4. Forum Topic & Comment
        $topic = Topic::firstOrCreate(
            ['judul' => 'Halo semuanya! Kenalan yuk di sini'],
            [
                'user_id' => $admin->id,
                'isi'     => "Selamat datang di Halowan.id! Buat kamu yang baru gabung, boleh drop perkenalan singkat kamu di bawah ya: nama, kesibukan, dan hal menarik tentang kamu!",
            ]
        );

        Comment::firstOrCreate(
            [
                'topic_id' => $topic->id,
                'user_id'  => $member->id,
            ],
            [
                'isi' => 'Halo semua! Salam kenal, saya Budi dari Makassar. Senang bisa bergabung di Halowan!',
            ]
        );

        // 5. Sample Message
        Message::firstOrCreate(
            ['email' => 'pengunjung@gmail.com'],
            [
                'nama'  => 'Rian Firmansyah',
                'pesan' => 'Halo tim Halowan, saya tertarik untuk menjadi volunteer di event kopdar berikutnya. Bagaimana cara pendaftarannya?',
            ]
        );
    }
}
