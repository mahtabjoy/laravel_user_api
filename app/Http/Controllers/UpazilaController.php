<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upazila;

class UpazilaController extends Controller
{
    public function getUpazillaInformation($upazillaId)
    {
        $upazilla = Upazila::with('unions')->with('cc')->with('sessions')->find($upazillaId);

        if (!$upazilla) {
            return response()->json(['message' => 'Upazilla not found'], 404);
        }

        return response()->json($upazilla);
    }
}
