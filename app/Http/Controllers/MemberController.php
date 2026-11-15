<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(): View
    {
        return view('members.index', [
            'title'   => 'Anggota',
            'members' => User::latest()->get(),
        ]);
    }

    public function profile(int $id): View
    {
        $member = User::with('registeredEvents')->findOrFail($id);

        return view('members.profile', [
            'title'  => $member->name,
            'member' => $member,
            'events' => $member->registeredEvents,
        ]);
    }

    public function edit(): View
    {
        return view('members.edit', [
            'title'  => 'Pengaturan Akun',
            'member' => Auth::user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama'   => 'required|string|min:2|max:60',
            'bio'    => 'nullable|string|max:300',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user->name = $validated['nama'];
        $user->bio = $validated['bio'] ?? null;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $user->avatar = $filename;
        }

        $user->save();

        return redirect()->route('account')->with('success', 'Profilmu berhasil diperbarui.');
    }
}
