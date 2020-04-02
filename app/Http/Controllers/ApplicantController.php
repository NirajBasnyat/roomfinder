<?php

namespace App\Http\Controllers;

use Session;
use App\Room;
use App\Applicant;
use Illuminate\Http\Request;
use App\Http\Helper\AppHelper;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    public function create($id)
    {
        $room = Room::findOrFail($id);
        return view('applicant.create', compact('room'));
    }

    public function store(Request $request, $room_id)
    {
        $this->validate($request, [
            'message' => 'required|string|min:10'
        ]);

        $applicant = Applicant::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'room_id' => $room_id
        ]);

        $applicant->rooms()->attach($room_id);
        Session::flash('success', 'Application sent successfully');
        return redirect()->route('seeker_room');
    }

    public function viewApplicants($user_id, $room_id)
    {
        $applicants = Room::findOrFail($room_id)->applicants;
        $applicant_count = $applicants->count();

        $hired = $applicants->filter(function ($applicant, $key) {
            return $applicant->status == 'hired';
        });

        //dd($hired);
        if ($applicant_count == 0 || $hired->isEmpty()) {
            $hired_status = 0;
        } else {
            $hired_status = 1;
        }

        return view('applicant.room_applicants', compact('applicants', 'room_id', 'hired_status'));
    }

    public function hire($user_id, $room_id)
    {
        $applicant = Applicant::where('user_id', $user_id)->where('room_id', $room_id)->first();
        $applicant->status = 'hired';
        $applicant->save();
        Session::flash('success', 'Applicant room request is accepted');
        return redirect()->route('seeker_room');
    }

    public function reject($user_id, $room_id)
    {
        $applicant = Applicant::where('user_id', $user_id)->where('room_id', $room_id)->first();
        $applicant->status = 'rejected';
        $applicant->save();
        Session::flash('success', 'Applicant room request is rejected');
        return redirect()->route('seeker_room');

    }
}
