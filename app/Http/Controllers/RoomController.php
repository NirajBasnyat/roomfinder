<?php

namespace App\Http\Controllers;

use Session;
use App\Room;
use App\City;
use App\Place;
use App\Seeker;
use App\Facility;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Helper\AppHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware(['owner'])->except('show');
    }

    public function index()
    {
        $rooms = Room::where('user_id', auth()->id())->get();
        return view('room.index')->withRooms($rooms);
    }

    public function create()
    {
        //to make sure that the room owner has to profile (so errors donot occur in view)
        if(AppHelper::hasProfile('owner') != null){
            return AppHelper::hasProfile('owner')->with('info','Create Profile first');
        }
        $cities = City::all(['name', 'id']);
        $places = Place::all(['name', 'id']);
        $categories = Category::all();
        $facilities = Facility::all();
        return view('room.create', compact('cities', 'places', 'categories', 'facilities'));
    }

    public function store(Request $request)
    {
        $this->validateRequest();
        // collect($this->validateRequest())->except(['images'])->toArray() gives request->all() except images
        $room = Room::create(array_merge(collect($this->validateRequest())->except(['images'])->toArray(), ['user_id' => Auth::user()->id]));
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $groupId = $room->images == 0 ? 0 : $room->images;
                $imageId = $this->manageUploads($img, 'room', $groupId);
                $room->images = $imageId;
                $room->save();
            }
        }
        $room->facilities()->attach($request->facilities);
        Session::flash('success', 'Room ' . AppHelper::DataAdded);
        return redirect()->route('room.index');
    }


    public function show(Room $room)
    {
        //to make sure that the room seeker has a profile (so errors donot occur in view)
        if(AppHelper::hasProfile('seeker') != null && \auth()->user()->role  == 2){
            return AppHelper::hasProfile('seeker')->with('info','Create Profile first');
        }

        $user_id = Auth::id();
        $room_id = $room->id;
        $room = $room->load('facilities')->load('city'); //lazy loading
        //for views in db
        $uniqueKey = 'key_' . $room->id;
        if (!Session::has($uniqueKey)) {
            $room->views++;
            Session::put($uniqueKey, 1);
        }
        $room->save();

        $seeker = Seeker::where('user_id',\auth()->user()->id)->first();

        //to check if user has (already) applied to a job or not
        $is_applied = DB::table('applicants')
            ->join('rooms', 'rooms.id', '=', 'applicants.room_id')
            ->when($room_id, function ($query) use ($room_id) {
                return $query->where('applicants.room_id', $room_id);
            })->when($user_id, function ($query) use ($user_id) {
                return $query->where('applicants.user_id', $user_id);
            })->select('applicants.id','status')->first();

        return view('room.show', compact('room','is_applied','seeker'));
    }


    public function edit(Room $room)
    {
        $cities = City::all(['name', 'id']);
        $places = Place::all(['name', 'id']);
        $categories = Category::all();
        $facilities = Facility::all();
        return view('room.edit', compact('room', 'cities', 'places', 'categories', 'facilities'));
    }

    public function update(Request $request, Room $room)
    {
        $this->validateRequest();
        $room->update(array_merge(collect($this->validateRequest())->except(['images'])->toArray(), ['user_id' => Auth::user()->id]));

        if ($request->hasFile('images')) {
            //delete old upload
            $this->deleteUploads($room);
            foreach ($request->file('images') as $img) {
                $groupId = $room->images == 0 ? 0 : $room->images;
                $imageId = $this->manageUploads($img, 'room/files', $groupId);
                $room->images = $imageId;
                $room->save();
            }
        }

        $room->facilities()->sync($request->facilities);
        Session::flash('success', 'Room ' . AppHelper::DataUpdated);
        return redirect()->route('room.index');
    }

    public function destroy(Room $room)
    {
        $this->deleteUploads($room);
       // $room->delete();
        $room->forceDelete();
        return redirect()->back()->with('error', 'Room ' . AppHelper::DataDeleted);
    }

    public function validateRequest()
    {
        return request()->validate([
            'title' => 'required|string|min:2',
            'city_id' => 'required|numeric',
            'place_id' => 'required|numeric',
            'price' => 'required|min:3|numeric',
            'total_rooms' => 'required|numeric',
            'category_id' => 'required|numeric',
            'description' => 'required|string|min:10',
            'images' => 'sometimes|max:2048',
        ]);
    }
}
