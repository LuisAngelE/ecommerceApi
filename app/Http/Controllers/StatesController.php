<?php

namespace App\Http\Controllers;

use App\Models\states;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    public function index()
    {
        $users = states::all();

        return response()->json([
            'success' => true,
            'data' => $users,
        ], 200);
    }

    public function getMunicipalitiesByState($state_id)
    {
        $state = states::find($state_id);

        if (!$state) {
            return response()->json([
                'success' => false,
                'message' => 'Estado no encontrado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $state->municipalities,
        ]);
    }


    public function store(Request $request)
    {
        //
    }

    public function show(states $states)
    {
        //
    }

    public function update(Request $request, states $states)
    {
        //
    }

    public function destroy(states $states)
    {
        //
    }
}
