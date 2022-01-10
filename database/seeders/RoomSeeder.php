<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::insert([
            ['name' => 'Room 1', 'status' => 'isi'],
            ['name' => 'Room 2', 'status' => 'isi'],
            ['name' => 'Room 3', 'status' => 'kosong'],
            ['name' => 'Room 4', 'status' => 'kosong'],
            ['name' => 'Room 5', 'status' => 'kosong'],
            ['name' => 'Room 6', 'status' => 'kosong'],
            ['name' => 'Room 7', 'status' => 'kosong'],
            ['name' => 'Room 8', 'status' => 'kosong'],
        ]);
    }
}
