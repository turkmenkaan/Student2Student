<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreated;
use \App\User;
use App\Reservation;
use App\Jobs\SendAccountCreatedMail;
use Carbon\CarbonPeriod;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use function PHPSTORM_META\type;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * This section registers non-teacher users
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'school' => 'required',
        ]);

        $student = new User;
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->password = bcrypt($request->input('password'));
        $student->school = $request->input('school');
        $student->class = $request->input('class');
        $student->gradYear = $request->input('grad-year');
        $student->isTeacher = 0;
        $student->description = 'Burayı henüz doldurmamış bir öğrenciyim...';
        $student->phone = $request->input('phone');
        $student->save();

        SendAccountCreatedMail::dispatch($student)->delay(now()->addSeconds(5));

        return redirect('home');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function dashboard() {
        $user = auth()->user();

        if ($user->isTeacher) {
            $futureReservations = Reservation::where('teacher_id', $user->id)
                ->where('isDone', 0)
                ->where('isCancelled', 0)->get();

            $pastReservations = Reservation::where('teacher_id', $user->id)
                ->where('isDone', 1)
                ->where('isCancelled', 0)->get();

            $comments = User::find($user->id)->comments;

            $currentDate = Carbon::now();
            $period = CarbonPeriod::create($currentDate, 7);
            $dates = $period->toArray();

            return view('teacher_dashboard', compact('futureReservations', 'pastReservations', 'comments', 'dates'));
        } else {
            echo 'You\'re not a teacher';
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $class = $this->classToString($user->class);

        // Check if the requested person is a teacher
        if ($user->isTeacher) {
            $comments = DB::table('comments')->where('user_id', $id)->get();
            $courses = DB::table('courses')->where('teacher_id', $id)->get();

            // This query retrieves the requested teacher's available times in the following 7 days
            $times = DB::table('timeslots')->where([
                ['teacher_id', '=', $id],
                ['isAvailable', '=', true],
                ['date', '<', Carbon::now()->addDays(7)]
            ])->orderBy('date')->get();

            /*
               This for loop is aimed at finding which day of week that date corresponds to.
               This helps us to create the table in the profile page. There might be more than
               one date on each day so each day holds an array of keys.
             */
            $availableTimes = [
                'Pazartesi' => [],
                'Sali' => [],
                'Carsamba' => [],
                'Persembe' => [],
                'Cuma' => [],
                'Cumartesi' => [],
                'Pazar' => [],
            ];
            // LONG LIVE CARBON <3
            foreach ($times as $time) {
                $date = Carbon::parse($time->date);
                $dow = $date->dayOfWeekIso;
                $dowString = $this->dowToString($dow);
                array_push($availableTimes[$dowString], $date);
            }
            //die(print_r($availableTimes));

            $currentDate = Carbon::now();
            $period = CarbonPeriod::create($currentDate, 7);

            $dates = $period->toArray();

            return view('profile',
                compact('user', 'comments', 'courses', 'class', 'dates'));
        }

        // If the requested person is not a teacher, redirect the user to the previous page
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Finding the specified user
        $user = User::find($id);

        // Assigning request data to variables for easier operations
        $school = $request->input('school');
        $class = $request->input('class');
        $cost = $request->input('cost');
        $desc = $request->input('description');

        // Checking if any of the fields are empty
        if ($school != '') $user->school = $school;
        if ($class != '') $user->class = $class;
        if ($cost != '') $user->cost = $cost;
        if ($desc != '') $user->description = $desc;

        // Dealing with the profile picture update
        if ($request->file('profilePic') != null) {
            if ($request->file('profilePic')->isValid()) {
                /*
                $imagePath = $request->file('profilePic')->store('public/images');
                $img = Image::make($imagePath);
                die($img);
                $img->resize(300,300)->save($imagePath);
                $fileName = explode('/', $imagePath);
                $user->photoUrl = 'storage/images/' . $fileName[2];
                */

                // returns Intervention\Image\Image
                $resize = Image::make($request->file('profilePic'))->fit(300)->encode('jpeg');

                // calculate md5 hash of encoded image
                $hash = md5($resize->__toString());

                // use hash as a name
                $path = "storage/images/{$hash}.jpg";

                // save it locally to ~/public/images/{$hash}.jpg
                $resize->save(public_path($path));

                // $url = "/images/{$hash}.jpg"
                $url = "/" . $path;

                // Save image path to the database
                $user->photoUrl = $url;

            }
        }

        $user->save();

        return redirect(route('profile', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*
     * --------------------------------------------------------------------------
     * THE FUNCTIONS BELOW ARE CUSTOM HELPER FUNCTIONS AIMED TO ORGANIZE THE CODE
     * --------------------------------------------------------------------------
     */

    /**
     * Returns User's Rating For Axios
     *
     * @param $id
     * @return float
     */
    public function showRating($id)
    {
        $user = User::find($id);
        return [$user->rating, $user->ratersNumber];
    }

    /**
     * @param Request $request
     */
    public function updateRating(Request $request)
    {
        $id = $request->input('id');
        $rating = $request->input('rating');
        $user = User::find($id);
        $user->rating = $rating;
        $user->ratersNumber += 1;
        $user->save();
    }

    /**
     * Convert database class values to human readable class strings
     * Database: 1-4 for university classes and 9-12 for high school classes
     * @param int $class
     * @return string
     */
    private function classToString(int $class) {
        switch ($class) {
            case 9:
                return 'Lise 1';
            case 10:
                return 'Lise 2';
            case 11:
                return 'Lise 3';
            case 12:
                return 'Lise 4';
            case 1:
                return 'Üniversite 1';
            case 2:
                return 'Üniversite 2';
            case 3:
                return 'Üniversite 3';
            case 4:
                return 'Üniversite 4';
            default:
                return 'Sınıf girilmedi!';
        }
    }

    /**
     * Converts the integer output of Carbon's dayOfWeek function to the corresponding
     * day of week.
     * DOW stands for Day Of Week
     * @param int $dow
     * @return string
     */
    private function dowToString(int $dow) {
        switch ($dow) {
            case 1:
                return 'Pazartesi';
            case 2:
                return 'Sali';
            case 3:
                return 'Carsamba';
            case 4:
                return 'Persembe';
            case 5:
                return 'Cuma';
            case 6:
                return 'Cumartesi';
            case 7:
                return 'Pazar';
            default:
                return 'Hata saptandı!';
        }
    }
}
