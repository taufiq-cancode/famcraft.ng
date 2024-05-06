<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifies = Notify::all();
        return view('notification', compact('notifies'));
    }

    public function store(Request $request)
    {
        try {
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }
                
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'details' => 'required|string|max:255',
            ]);

            $data['type'] = 'others';
            $notification = Notify::create($data);

            $userIds = User::pluck('id')->all();

            if ($notification && !empty($userIds)) {
                $notification->users()->attach($userIds);
            }
            
            return back()->with('success', 'Notification posted successfully.');

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }

    public function view($notificationId)
    {
        $user = auth()->user();

        $notification = $user->notifies()->findOrFail($notificationId);
        $notification = Notify::findOrFail($notificationId);
    
        $user->notifies()->updateExistingPivot($notificationId, ['read_at' => now()]);

        return view('details.notification', compact('notification'));
    }

    public function update(Request $request, $notificationId)
    {
        try { 
            $admin = auth()->user();
            if ($admin->role !== 'Administrator'){
                return back()->with('error', 'Unauthorized access');
            }

            $data = $request->validate([
                'type' => 'sometimes|string|in:pricing,others',
                'title' => 'sometimes|string|max:255',
                'details' => 'sometimes|string|max:255',
            ]);

            $notification = Notify::findOrFail($notificationId);
    
            $notification->update($data);

            return back()->with('success', 'Notification updated successfully');

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($notificationId)
    {
        $admin = auth()->user();
        if ($admin->role !== 'Administrator'){
            return back()->with('error', 'Unauthorized access');
        }
        
        $notification = Notify::findOrFail($notificationId);
        $notification->delete();

        return back()->with('success', 'Notification deleted successfully');

    }
}
