<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agenda::insert([
            ['title' => 'Meeting Proggress Report', 'start_date' => '2022-01-10 03:26:11', 'finish_date' => '2022-01-10 04:26:11', 'room_id' => 1],
            ['title' => 'Meeting Penyelenggaraan KPI karyawan', 'start_date' => '2022-01-10 03:26:11', 'finish_date' => '2022-01-10 04:26:11', 'room_id' => 2],
            // ['title' => 'Sosialisasi penggunaan aplikasi', 'start_date' => '2022-01-10 03:26:11', 'finish_date' => '2022-01-10 04:26:11', 'room_id' => 1],
        ]);
    }
}
