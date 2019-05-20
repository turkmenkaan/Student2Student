<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Reservation;
use App\CourseRequest;
use App\Message;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    public function getModal($modal) {
        switch ($modal) {
            case 'users':
                $users = User::paginate(10)->onEachSide(3);
                return view('admin_panel/users', compact('users'));
            case 'teachers':
                $teachers = User::where('isTeacher', 1)->paginate(10)->onEachSide(3);
                return view('admin_panel/teachers', compact('teachers'));
            case 'courses':
                $courses = Course::paginate(10)->onEachSide(3);
                return view('admin_panel/courses', compact('courses'));
            case 'reservations':
                $pastReservations = Reservation::where('isDone', 1)->paginate(7)->onEachSide(3);
                $futureReservations = Reservation::where('isDone', 0)->where('isCancelled', 0)->paginate(6)->onEachSide(3);
                $cancelledReservations = Reservation::where('isCancelled', 1)->paginate(6)->onEachSide(3);
                return view('admin_panel/reservations', compact('pastReservations', 'futureReservations', 'cancelledReservations'));
            case 'course-requests':
                $requests = CourseRequest::paginate(10)->onEachSide(3);
                return view('admin_panel/course-requests', compact('requests'));
            case 'messages':
                $messages = Message::paginate(5)->onEachSide(3);
                return view('admin_panel/messages', compact('messages'));
            default:
                $resources = '';
                break;
        }
        return view('admin', compact('resources'));
    }

    public function viewContact ()
    {
        return view('contact');
    }

    public function storeContact (Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'content' => 'required'
        ]);

        $message = new Message;
        $message->name = $request->name;
        $message->email = $request->email;
        $message->content = $request->content;
        $message->save();
        return redirect()->back()->with('success', 'Mesajınız Gönderildi');
    }

}
