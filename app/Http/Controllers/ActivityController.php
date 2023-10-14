<?php

namespace App\Http\Controllers;

use auth;
use Carbon\Carbon;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\ActivityUpdate;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function update(Request $request, Activity $activity) {
        $data = $request->validate([
            'status' => 'required|in:done,pending',
            'remarks' => 'nullable|string|max:255',
        ]);

        $activity->update($data);

        return redirect()->route('Home')->with('success', 'Activity updated successfully.');


    }

    public function Home()
{
    // Retrieve all activities or any other logic to filter and retrieve activities
    $activities = Activity::all();

    return view('activities.home', compact('activities'));
}

    public function create(Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'remarks' => 'required',
            // 'user_id' => 'required',

        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['status'] = strip_tags($incomingFields['status']);
        $incomingFields['remarks'] = strip_tags($incomingFields['remarks']);
        $incomingFields['user_id'] = auth()->id();
        Activity::create($incomingFields);

        return redirect('/Home');
    }

    


public function daily_updates(Request $request) {
    // Get the selected date from the form input (default to today if not provided)
    $selectedDate = $request->input('date', Carbon::now()->format('Y-m-d'));

    // Use Carbon to format the selected date
    $formattedDate = Carbon::createFromFormat('Y-m-d', $selectedDate)->format('Y-m-d');

    // Query updates based on the selected date
    $dailyUpdates = Activity::with(['updates' => function ($query) use ($formattedDate) {
        $query->whereDate('update_timestamp', '=', $formattedDate);
    }])->get();

    return view('daily-activity-updates', compact('dailyUpdates', 'selectedDate'));
}



    public function getUpdatedActivities(Request $request)
{
    $selectedDate = $request->input('date');
    
    // Retrieve activities for the selected date and return them as a blade view
    $activities = Activity::whereDate('created_at', $selectedDate)->get();
    
    return view('activity.updated_table', compact('activities'));
}

public function showActivityUpdates($activityId)
{
    $activity = Activity::findOrFail($activityId);
    $updates = $activity->updates;

    return view('update-activity', compact('updates'));
}




}
