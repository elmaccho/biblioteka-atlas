<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Powiadomienie;
use Illuminate\Http\Request;

class PowiadomieniaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $powiadomienia = Powiadomienie::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('powiadomienia', compact('powiadomienia'));
    }

    public function marked($id)
    {
        $powiadomienie = Powiadomienie::findOrFail($id);
        $powiadomienie->read_at = now();
        $powiadomienie->save();

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Przeczytano powiadomienie',
            'details' => [
                'powiadomienie_id' => $powiadomienie->id,
                'name' => auth()->user()->name,
                'lastname' => auth()->user()->lastname,
            ],
        ]);

        return redirect()->back()->with('success', 'Powiadomienie oznaczone jako przeczytane');
    }
}
