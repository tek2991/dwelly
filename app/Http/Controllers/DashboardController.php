<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Task;
use App\Models\User;
use App\Models\Property;
use App\Models\RentOut;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'Total properties' => Property::count(),
            'Properties available' => Property::where('is_available', true)->count(),
            'Pending tasks' => Task::whereNot('task_state_id', 4)->count(),
            'Total Users' => User::count(),
            'Contact requests' => Contact::count(),
            'Rentout Submissions' => RentOut::count(),
        ];

        return view('app.dashboard', compact('stats'));
    }
}
