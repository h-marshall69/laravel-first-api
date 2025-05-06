<?php

namespace App\Http\Controllers;

use App\Models\GlobalState;
use Illuminate\Http\Request;

class GlobalStateController extends Controller
{
    public function show()
    {
        $state = GlobalState::first();
        if (!$state) {
            $state = GlobalState::create(['value' => false]);
        }
        return response()->json(['status' => $state->value]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'value' => 'required|boolean',
        ]);

        $state = GlobalState::first();
        if (!$state) {
            $state = GlobalState::create(['value' => $request->value]);
        } else {
            $state->value = $request->value;
            $state->save();
        }

        return response()->json(['status' => $state->value]);
    }
}
