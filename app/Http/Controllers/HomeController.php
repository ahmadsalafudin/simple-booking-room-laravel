<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['data'] = Room::all();
        return view('welcome', $data);
    }

    public function book(Request $request)
    {
        try {
            Room::where('id', $request->id)->update(['status' => 'isi']);
            Agenda::create([
                'room_id' => $request->id,
                'title' => $request->title,
                'start_date' => $request->start_date,
                'finish_date' => $request->finish_date,
            ]);
            return redirect('/')->with(['sukses' => 'Rungan berhasil di booking']);
        } catch (\Throwable $th) {
            return redirect('/')->with(['error' => 'Rungan gagal di booking']);
        }
    }

    public function detail($id)
    {
        $data['data'] = Agenda::where('room_id', $id)->first();
        return response()->json($data);
    }

    public function cancel(Request $request)
    {
        try {
            Room::where('id', $request->id)->update(['status' => 'kosong']);
            Agenda::where('room_id', $request->id)->delete();
            return response()->json(true);
        } catch (\Throwable $th) {
            return response()->json(false);
        }
    }

    public function cancelAll()
    {
        try {
            $room = Room::all();
            foreach ($room as $key) {
                Room::where('id', $key->id)->update(['status' => 'kosong']);
            }
            $agenda = Agenda::all();
            foreach ($agenda as $key) {
                Agenda::where('room_id', $key->id)->delete();
            }
            return response()->json(true);
        } catch (\Throwable $th) {
            return response()->json(false);
        }
    }
}
