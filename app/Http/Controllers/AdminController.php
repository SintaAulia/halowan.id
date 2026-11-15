<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminController extends Controller
{
    /* ============ Dashboard ============ */
    public function dashboard(): View
    {
        return view('admin.dashboard', [
            'title'  => 'Dashboard Admin',
            'stats'  => [
                'Anggota' => User::count(),
                'Event'   => Event::count(),
                'Artikel' => Article::count(),
                'Diskusi' => Topic::count(),
                'Pesan'   => Message::count(),
            ],
            'users'  => User::latest()->limit(5)->get(),
            'topics' => Topic::with('user')->latest()->limit(5)->get(),
        ]);
    }

    /* ============ Users ============ */
    public function users(): View
    {
        return view('admin.users', [
            'title' => 'Kelola Anggota',
            'users' => User::latest()->get(),
        ]);
    }

    public function userRole(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users')->with('error', 'Kamu tidak bisa mengubah peran akunmu sendiri.');
        }

        $user->role = $user->role === 'admin' ? 'member' : 'admin';
        $user->save();

        return redirect()->route('admin.users')->with('success', $user->name . ' sekarang berperan sebagai ' . $user->role . '.');
    }

    public function userDelete(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users')->with('error', 'Kamu tidak bisa menghapus akunmu sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus.');
    }

    /* ============ Events ============ */
    public function events(): View
    {
        return view('admin.events_index', [
            'title'  => 'Kelola Event',
            'events' => Event::withCount('participants as peserta')->latest('tanggal')->get(),
        ]);
    }

    public function eventCreate(): View
    {
        return view('admin.events_form', [
            'title' => 'Buat Event Baru',
            'event' => null,
        ]);
    }

    public function eventStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul'     => 'required|string|min:4|max:150',
            'deskripsi' => 'required|string|min:10',
            'lokasi'    => 'required|string|min:3|max:150',
            'tanggal'   => 'required|date',
            'banner'    => 'nullable|image|max:2048',
        ]);

        $bannerName = null;
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $bannerName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $bannerName);
        }

        Event::create([
            'judul'      => $validated['judul'],
            'slug'       => Str::slug($validated['judul']) . '-' . Str::random(4),
            'deskripsi'  => $validated['deskripsi'],
            'lokasi'     => $validated['lokasi'],
            'tanggal'    => $validated['tanggal'],
            'banner'     => $bannerName,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.events')->with('success', 'Event berhasil dibuat.');
    }

    public function eventEdit(int $id): View
    {
        $event = Event::findOrFail($id);
        return view('admin.events_form', [
            'title' => 'Edit Event: ' . $event->judul,
            'event' => $event,
        ]);
    }

    public function eventUpdate(Request $request, int $id): RedirectResponse
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'judul'     => 'required|string|min:4|max:150',
            'deskripsi' => 'required|string|min:10',
            'lokasi'    => 'required|string|min:3|max:150',
            'tanggal'   => 'required|date',
            'banner'    => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $bannerName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $bannerName);
            $event->banner = $bannerName;
        }

        $event->update([
            'judul'     => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'lokasi'    => $validated['lokasi'],
            'tanggal'   => $validated['tanggal'],
        ]);

        return redirect()->route('admin.events')->with('success', 'Event berhasil diperbarui.');
    }

    public function eventDelete(int $id): RedirectResponse
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('admin.events')->with('success', 'Event dihapus.');
    }

    public function eventRegistrants(int $id): View
    {
        $event = Event::with('participants')->findOrFail($id);
        return view('admin.event_peserta', [
            'title'      => 'Peserta: ' . $event->judul,
            'event'      => $event,
            'peserta'    => $event->participants,
        ]);
    }

    /* ============ Articles ============ */
    public function articles(): View
    {
        return view('admin.articles_index', [
            'title'    => 'Kelola Artikel',
            'articles' => Article::with('author')->latest()->get(),
        ]);
    }

    public function articleCreate(): View
    {
        return view('admin.articles_form', [
            'title'   => 'Tulis Artikel Baru',
            'article' => null,
        ]);
    }

    public function articleStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul'  => 'required|string|min:4|max:150',
            'isi'    => 'required|string|min:20',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $imgName = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $imgName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $imgName);
        }

        Article::create([
            'judul'     => $validated['judul'],
            'slug'      => Str::slug($validated['judul']) . '-' . Str::random(4),
            'isi'       => $validated['isi'],
            'gambar'    => $imgName,
            'author_id' => Auth::id(),
        ]);

        return redirect()->route('admin.articles')->with('success', 'Artikel berhasil diterbitkan.');
    }

    public function articleEdit(int $id): View
    {
        $article = Article::findOrFail($id);
        return view('admin.articles_form', [
            'title'   => 'Edit Artikel: ' . $article->judul,
            'article' => $article,
        ]);
    }

    public function articleUpdate(Request $request, int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'judul'  => 'required|string|min:4|max:150',
            'isi'    => 'required|string|min:20',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $imgName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $imgName);
            $article->gambar = $imgName;
        }

        $article->update([
            'judul' => $validated['judul'],
            'isi'   => $validated['isi'],
        ]);

        return redirect()->route('admin.articles')->with('success', 'Artikel diperbarui.');
    }

    public function articleDelete(int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('admin.articles')->with('success', 'Artikel dihapus.');
    }

    /* ============ Forum ============ */
    public function forum(): View
    {
        return view('admin.forum', [
            'title'  => 'Kelola Forum',
            'topics' => Topic::with('user')->withCount('comments')->latest()->get(),
        ]);
    }

    public function forumDelete(int $id): RedirectResponse
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        return redirect()->route('admin.forum')->with('success', 'Topik forum dihapus.');
    }

    /* ============ Gallery ============ */
    public function gallery(): View
    {
        return view('admin.gallery', [
            'title'  => 'Kelola Galeri',
            'photos' => Gallery::latest()->get(),
        ]);
    }

    public function galleryStore(Request $request): RedirectResponse
    {
        $request->validate([
            'judul'  => 'required|string|max:100',
            'gambar' => 'required|image|max:3072',
        ]);

        $file = $request->file('gambar');
        $imgName = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $imgName);

        Gallery::create([
            'judul'  => $request->input('judul'),
            'gambar' => $imgName,
        ]);

        return redirect()->route('admin.gallery')->with('success', 'Foto berhasil ditambahkan ke galeri.');
    }

    public function galleryDelete(int $id): RedirectResponse
    {
        $item = Gallery::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.gallery')->with('success', 'Foto galeri dihapus.');
    }

    /* ============ Messages ============ */
    public function messages(): View
    {
        return view('admin.messages', [
            'title'    => 'Pesan Masuk & Konfirmasi Donasi',
            'messages' => Message::latest()->get(),
        ]);
    }
}
