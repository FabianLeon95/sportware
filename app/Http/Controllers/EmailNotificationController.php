<?php

namespace App\Http\Controllers;

use App\Events\EmailNotificationCreated;
use App\Http\Requests\EmailNotificationRequest;
use App\Models\EmailNotification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmailNotificationController extends Controller
{
    /**
     * EmailNotificationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,stats,medic');
    }

    public function index()
    {
        $notifications = EmailNotification::with('user')->paginate();
        return view('email_notification.index', compact('notifications'));
    }

    public function create()
    {
        return view('email_notification.create');
    }

    public function store(EmailNotificationRequest $request)
    {
        $users = User::whereIn('role_id', $request->recipients, 'and')->get();

        $notification = EmailNotification::create([
           'user_id' => Auth::user()->id,
           'subject' => $request->subject,
           'body' => $request->message,
           'recipients' => json_encode($request->recipients)
        ]);

        event(new EmailNotificationCreated($users, $notification));

        return redirect()->route('notification.index');
    }
}
