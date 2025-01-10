<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressesController extends Controller
{
    public function index()
    {
        $addresses = Addresses::with(['user', 'state', 'municipality'])->get();

        return response()->json([
            'message' => 'Addresses retrieved successfully',
            'data' => $addresses,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'zip_code' => 'required|string|max:10',
            'colony' => 'required|string|min:3|max:100',
            'street_name' => 'required|string|min:3|max:100',
            'numero_int' => 'nullable|string|max:10',
            'numero_ext' => 'required|string|max:10',
            'phone_number' => 'nullable|string|max:15',
            'is_default' => 'boolean',
            'user_id' => 'required|exists:users,id',
            'state_id' => 'required|exists:states,id',
            'municipality_id' => 'required|exists:municipalities,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $addresses = Addresses::create([
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'zip_code' => $request->zip_code,
            'colony' => $request->colony,
            'street_name' => $request->street_name,
            'numero_int' => $request->numero_int,
            'numero_ext' => $request->numero_ext,
            'phone_number' => $request->phone_number,
            'is_default' => $request->is_default ?? false,
            'user_id' => $request->user_id,
            'state_id' => $request->state_id,
            'municipality_id' => $request->municipality_id,
        ]);

        return response()->json([
            'message' => 'Address created successfully',
            'data' => $addresses,
        ], 201);
    }

    public function show($id)
    {
        $address = Addresses::with(['user', 'state', 'municipality'])->find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        return response()->json([
            'message' => 'Address retrieved successfully',
            'data' => $address,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'zip_code' => 'required|string|max:10',
            'colony' => 'required|string|min:3|max:100',
            'street_name' => 'required|string|min:3|max:100',
            'numero_int' => 'nullable|string|max:10',
            'numero_ext' => 'required|string|max:10',
            'phone_number' => 'nullable|string|max:15',
            'is_default' => 'boolean',
            'user_id' => 'required|exists:users,id',
            'state_id' => 'required|exists:states,id',
            'municipality_id' => 'required|exists:municipalities,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $address = Addresses::find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        $address->update([
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'zip_code' => $request->zip_code,
            'colony' => $request->colony,
            'street_name' => $request->street_name,
            'numero_int' => $request->numero_int,
            'numero_ext' => $request->numero_ext,
            'phone_number' => $request->phone_number,
            'is_default' => $request->is_default ?? $address->is_default,
            'user_id' => $request->user_id,
            'state_id' => $request->state_id,
            'municipality_id' => $request->municipality_id,
        ]);

        return response()->json([
            'message' => 'Address updated successfully',
            'data' => $address,
        ]);
    }

    public function destroy($id)
    {
        $address = Addresses::find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        $address->delete();

        return response()->json(['message' => 'Address deleted successfully'], 200);
    }
}
