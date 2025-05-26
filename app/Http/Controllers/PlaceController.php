<?php

namespace App\Http\Controllers;

use App\Models\place;
use App\Models\SearchHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    //
    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'x' => 'required',
            'y' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);
        $path = $request->file('image')->store('places', 'public');
        $result = Place::create(
            ['name' => $data['name'],
             'latitude' => $data['latitude'],
             'longitude' => $data['longitude'],
             'x' => $data['x'],
             'y' => $data['y'],
                'image_path' => $path,
                'open_time' => now(),
                'close_time' => now(),
                'description' => 'test',

            ]);
        if ($result) {
            return response()->json(['message' => 'create success']);
        }
        return response()->json(['message' => 'Data cannot be processed'], 422);
    }

    public function findPlace(Request $request) {
        SearchHistory::updateOrCreate(
            ['user_id' => $request->user()->id, 'place_id' => $request['id']],
            ['count' => DB::raw('count + 1')]
        );
        if ($request['id']) {
            return Place::where('id', $request['id'])->first();
        }
    }

    public function allPlaces(Request $request) {
        $history = SearchHistory::where('user_id', $request->user()->id)
            ->pluck('count', 'place_id');

        $places = Place::all();

        $sorted = $places->sortByDesc(function ($place) use ($history) {
            return $history[$place->id] ?? 0;
        });
        return $sorted;
    }
    public function delete(Request $request) {
        $result = Place::where('id', $request['id'])->delete();
        if ($result) {
            return $result;
        }
    }
    public function update(Request $request) {
        $place = Place::where('id', $request['id']);
        $data = $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'x' => 'required',
            'y' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);
        $path = $request->file('image')->store('places', 'public');

        $res = $place->update(['name' => $data['name'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'x' => $data['x'],
            'y' => $data['y'],
            'image_path' => $path,
            'open_time' => now(),
            'close_time' => now(),
            'description' => 'test',

        ]);
        if ($res) {
            return 'success';
        }
    }
}
