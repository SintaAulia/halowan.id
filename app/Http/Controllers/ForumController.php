<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ForumController extends Controller
{
    public function index(): View
    {
        return view('forum.index', [
            'title'  => 'Forum Diskusi',
            'topics' => Topic::with('user')->latest()->limit(50)->get(),
        ]);
    }

    public function show(int $id): View
    {
        $topic = Topic::with(['user', 'comments.user'])->findOrFail($id);

        return view('forum.show', [
            'title'    => $topic->judul,
            'topic'    => $topic,
            'comments' => $topic->comments,
        ]);
    }

    public function create(): View
    {
        return view('forum.create', [
            'title' => 'Buat Topik Baru',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => 'required|string|min:5|max:150',
            'isi'   => 'required|string|min:10|max:5000',
        ]);

        $topic = Topic::create([
            'user_id' => Auth::id(),
            'judul'   => $validated['judul'],
            'isi'     => $validated['isi'],
        ]);

        return redirect()->route('forum.show', $topic->id)->with('success', 'Topik berhasil dibuat.');
    }

    public function comment(Request $request, int $id): RedirectResponse
    {
        $topic = Topic::findOrFail($id);

        $validated = $request->validate([
            'isi' => 'required|string|min:2|max:2000',
        ]);

        Comment::create([
            'topic_id' => $topic->id,
            'user_id'  => Auth::id(),
            'isi'      => $validated['isi'],
        ]);

        return redirect()->route('forum.show', $id . '#komentar')->with('success', 'Komentarmu terkirim.');
    }
}
