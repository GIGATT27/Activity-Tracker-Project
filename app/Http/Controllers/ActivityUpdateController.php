<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\ActivityUpdate;

class ActivityUpdateController extends Controller
{
   public function update(Activity $activity, Request $request)
{
    // Validation rules
    $data = $request->validate([
        'status' => 'required|in:done,pending',
        'remarks' => 'nullable|string|max:255',
    ]);

    // Create a new ActivityUpdate record
    $activityUpdate = new ActivityUpdate([
        'activity_id' => $activity->id,
        'user_id' => auth()->id(),
        'status' => $request->input('status'),
        'remarks' => $request->input('remarks'),
    ]);
    $activityUpdate->save();

    // Update the Activity record
    $activity->update($data);

    return redirect('/Home');
}
}
