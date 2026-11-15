<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        return view('events.index', [
            'title'    => 'Event',
            'upcoming' => Event::upcoming()->get(),
            'past'     => Event::past(12)->get(),
        ]);
    }

    public function show(string $slug): View
    {
        $event = Event::with('creator')->where('slug', $slug)->firstOrFail();
        $isPast = $event->tanggal->isPast();
        $registered = Auth::check() && $event->isRegisteredBy(Auth::user());

        return view('events.show', [
            'title'      => $event->judul,
            'event'      => $event,
            'isPast'     => $isPast,
            'registered' => $registered,
        ]);
    }

    public function register(string $slug): RedirectResponse
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        if ($event->tanggal->isPast()) {
            return redirect()->route('events.show', $slug)->with('error', 'Event ini sudah berlalu.');
        }

        $user = Auth::user();
        if (!$event->isRegisteredBy($user)) {
            $event->participants()->attach($user->id);
        }

        return redirect()->route('events.show', $slug)->with(
            'success',
            'Kamu terdaftar di event "' . $event->judul . '". Sampai jumpa di sana!'
        );
    }

    public function unregister(string $slug): RedirectResponse
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $event->participants()->detach(Auth::id());

        return redirect()->route('events.show', $slug)->with('success', 'Pendaftaranmu dibatalkan.');
    }
}
