<?php

namespace App\Http\Controllers;

use App\Models\schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //
    public function create(Request $request) {
        $data = $request->validate([
            'from_place_id' => 'required',
            'to_place_id' => 'required',
            'line' => 'required',
            'distance' => 'required',
            'speed' => 'required',
        ]);
        $res = Schedule::create([
            'from_place_id' => $data['from_place_id'],
            'to_place_id' => $data['from_place_id'],
            'line' => $data['from_place_id'],
            'departure_time' => now(),
            'arrival_time' => now(),
            'distance' => $data['from_place_id'],
            'speed' => $data['from_place_id'],

        ]);
        return $res;
    }
    public function update(Request $request) {
        $data = $request->validate([
            'from_place_id' => 'required',
            'to_place_id' => 'required',
            'line' => 'required',
            'distance' => 'required',
            'speed' => 'required',
        ]);
        $schedule = Schedule::where('id', $request['id']);
        $res = $schedule->update([
            'from_place_id' => $data['from_place_id'],
            'to_place_id' => $data['from_place_id'],
            'line' => $data['from_place_id'],
            'departure_time' => now(),
            'arrival_time' => now(),
            'distance' => $data['from_place_id'],
            'speed' => $data['from_place_id'],
        ]);
        return $res;
    }
    public function delete(Request $request) {
        $response = Schedule::where('id', $request['id'])->delete();
        return $response . $request['id'];
    }
    public function all(Request $request) {
        return Schedule::get();
    }
}
