<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\Message;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home.index', [
            'title'    => null,
            'stats'    => [
                'anggota' => User::count(),
                'event'   => Event::count(),
                'diskusi' => Topic::count(),
            ],
            'events'   => Event::upcoming(3)->get(),
            'topics'   => Topic::with('user')->latest()->limit(5)->get(),
            'articles' => Article::with('author')->latest()->limit(3)->get(),
        ]);
    }

    public function about(): View
    {
        return view('home.about', [
            'title' => 'About Halowan',
        ]);
    }

    public function contact(): View
    {
        return view('home.contact', [
            'title' => 'Kontak Kami',
        ]);
    }

    public function contactSend(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama'  => 'required|string|min:2|max:80',
            'email' => 'required|email|max:120',
            'pesan' => 'required|string|min:10|max:2000',
        ], [
            'nama.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.min'      => 'Pesan minimal 10 karakter.',
        ]);

        Message::create($validated);

        return redirect()->route('contact')->with('success', 'Terima kasih! Pesanmu sudah kami terima.');
    }

    public function donation(): View
    {
        return view('home.donation', [
            'title' => 'Donation · Dukung Halowan.id',
        ]);
    }

    public function donationConfirm(Request $request): RedirectResponse
    {
        $request->validate([
            'nominal' => 'required',
            'metode'  => 'required|string',
        ]);

        $nama    = trim($request->input('nama') ?: 'Kawan Halowan');
        $email   = strtolower(trim($request->input('email') ?: ''));
        $nominal = trim($request->input('nominal'));
        $metode  = trim($request->input('metode'));
        $pesan   = trim($request->input('pesan') ?: '');

        $cleanNominal = preg_replace('/[^0-9]/', '', $nominal);
        if ($cleanNominal === '' || (int)$cleanNominal < 1000) {
            return back()->withInput()->withErrors(['nominal' => 'Nominal donasi minimal Rp 1.000.']);
        }

        $formattedNominal = 'Rp ' . number_format((int)$cleanNominal, 0, ',', '.');
        $isiPesan = "[KONFIRMASI DONASI]\n"
                  . "Nominal: {$formattedNominal}\n"
                  . "Metode: {$metode}\n"
                  . "Pesan/Doa: " . ($pesan ?: '-');

        Message::create([
            'nama'  => $nama,
            'email' => $email ?: 'donasi@halowan.id',
            'pesan' => $isiPesan,
        ]);

        return redirect()->route('donation')->with(
            'success',
            "Terima kasih banyak, {$nama}! Konfirmasi donasi sebesar {$formattedNominal} telah kami terima. Semoga membawa berkah untuk kita semua."
        );
    }
}
