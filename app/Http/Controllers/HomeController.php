<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['data'] = Room::all();
        return view('welcome', $data);
    }

    public function updateRoom(Request $request)
    {
        try {
            Room::where('id', $request->id)->update(['status' => 'isi']);
            return response()->json(true);
        } catch (\Throwable $th) {
            return response()->json(false);
        }
    }
}
