<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use App\Models\service_offers;
use App\Models\schedule_list;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserVerification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UsersController extends Controller
{
    //users
    public function viewDoctors(){
        return view('users');
    }

    public function getAllDoctors(){
        $query = User::where('user_type','doctor')->get();
        return DataTables::of($query)->make(true);
    }

    public function addDoctor(Request $request){
        $check_email = User::where('email',$request['email'])->count();
		if($check_email > 0){
			return 'email already in use';
		}

		DB::beginTransaction();

		$user = new User;
		$user->fname = $request['fname'];
        $user->lname = $request['lname'];
        $user->gender = $request['gender'];
        $user->email = $request['email'];
        $user->birthdate = $request['birthdate'];
        $user->contact = $request['contact'];
        $user->address = $request['address'];
        $user->is_verified = '1';
		$user->user_type = 'doctor';
        $user->password = Hash::make($request['password']);
		$user->save();

		if($user){
			DB::commit();
			return 'success';
		}else{
			return 'Something went wrong';
		}
    }

    public function updateDoctorData(Request $request){

        DB::beginTransaction();

        $user = User::where('id',$request['data_id'])->first();
        $user->fname = $request['fname'];
        $user->lname = $request['lname'];
        $user->email = $request['email'];
        $user->birthdate = $request['birthdate'];
        $user->contact = $request['contact'];
        $user->address = $request['address'];
		$user->save();

		if($user){
			DB::commit();
			return 'success';
		}else{
			return 'Something went wrong';
		}
    }

    public function viewAppointment(){
        $doctors = User::where('user_type','doctor')->get();
        $services = service_offers::all();
        return view('appointment',['doctors' => $doctors, 'services' => $services]);
    }

    public function viewScheduledAppointment(){

        $query = DB::table('schedule_lists as a')
                   ->join('users as b','b.id','a.user_id')
                   ->join('users as c','c.id','a.doctor')
                   ->join('service_offers as d','d.id','a.service')
                   ->select('a.*','b.fname as patient','c.fname as doctor_name','d.service_name as service','d.id as service_id'
                   ,'d.price');
        if(Auth::user()->user_type == 'doctor'){
            $query = $query->where('a.doctor',Auth::user()->id);
        }else if(Auth::user()->user_type == 'patient'){
            $query = $query->where('a.user_id',Auth::user()->id);
        }else{
            $query = $query->get();
        }



        return DataTables::of($query)->make(true);
    }

    public function createAppointmentSchedule(Request $request){

        $check_avail = schedule_list::where('doctor', $request['doctor'])->where('status', '1')->count();

        if ($check_avail > 10) {
            $patient = User::find(Auth::user()->id);
            $info = [
				'fname' => $patient->fname,
				'email_message' => 'Doctor appointment limit reached. Please wait for availability or try another time slot.',
				'is_sent' => true,

			];
            try {
                $patient->notify(new UserVerification($info));
            } catch (\Throwable $th) {
                $message = 'Email sending failed';
            }

            $result = $this->storeAppointment($request, '2');

            if($result){
                return 'warning';
            }else{
                return 'Something went wrong!';
            }
        }else{
            DB::beginTransaction();
            $check_appointment = schedule_list::where('user_id',Auth::user()->id)
                                              ->where('schedule_date',$request['schedule_date'])
                                              ->where('status','0')
                                              ->count();

            if($check_appointment > 0){
                return 'You have pending appointment schedule.! Please wait for confirmation';
            }

            $result = $this->storeAppointment($request, '0');

            if($result){
                DB::commit();
                return 'success';
            }else{
                return 'Something went wrong!';
            }
        }
    }

    private function storeAppointment($request, $status){
        try {
            $book_appointment = new schedule_list;
            $book_appointment->user_id = Auth::user()->id;
            $book_appointment->schedule_date = $request['schedule_date'];
            $book_appointment->time_from = $request['time_from'];
            $book_appointment->time_to = $request['time_to'];
            $book_appointment->service = $request['service'];
            $book_appointment->doctor = $request['doctor'];
            $book_appointment->status = $status;
            $book_appointment->save();

            $message = true;
        } catch (\Throwable $th) {
            $message = false;
        }
        return $message;
    }

    public function updateAppointmentSchedule(Request $request){

        DB::beginTransaction();
        $update = schedule_list::where('id',$request['data_id'])
                                ->update([
                                        'doctor' => $request['doctor'],
                                        'service' => $request['service'],
                                        'schedule_date' => $request['schedule_date'],
                                        'time_from' => $request['time_from'],
                                        'time_to' => $request['time_to']
                                    ]);

        if($update){

            DB::commit();
            return 'success';
        }else{
            return 'Something went wrong!';
        }

    }

    public function approveAppointmentSchedule($id,$status,$patientid){
        $stats = $status == 'approved' ? '1' : '2';
        DB::beginTransaction();
        $update = schedule_list::find($id)->update(['status' => $stats]);

        if($update){
            $patient = User::find($patientid);
            $info = [
				'fname' => $patient->fname,
				'email_message' => $status == 'approved' ? 'Good day.! Please be inform that your appointment has been approved.' : 'Good day.! Please be inform that your appointment has been disapproved.',
				'is_sent' => true,

			];
            try {
                $patient->notify(new UserVerification($info));
            } catch (\Throwable $th) {
                $message = 'Email sending failed';
            }
            DB::commit();
            return 'success';
        }else{
            return 'Something went wrong!';
        }

    }

    // public static function getMonthlyAnalytics(){
    //     $result = User::where('user_type', 'patient')
    //         ->whereYear('created_at', '=', Carbon::now()->year)
    //         ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
    //         ->groupBy('month')
    //         ->get();

    //     $data = [];
    //     $label = [];

    //     foreach ($result as $item) {
    //         $label[] = \DateTime::createFromFormat('!m', $item->month)->format('F');
    //         $data[] = $item->count;
    //     }

    //     return [
    //         'label' => $label,
    //         'data' => $data,
    //     ];
    // }

    // PHP code in your controller or model
    public static function getMonthlyAnalytics()
    {
        $result = User::where('user_type', 'patient')
            ->whereYear('created_at', '=', Carbon::now()->year)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        $data = [];
        $label = [];

        // Initialize label array for all months
        $allMonths = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // Iterate through all months and populate data array
        foreach ($allMonths as $month) {
            $label[] = $month;
            $data[] = 0; // Initialize count to 0 for each month
        }

        // Update count for months with data
        foreach ($result as $item) {
            $monthIndex = $item->month - 1; // Adjust index (1-based to 0-based)
            $data[$monthIndex] = $item->count;
        }

        return [
            'label' => $label,
            'data' => $data,
        ];
    }



    public function changePass(){
        return view('changepass');
    }

    public function updatePassword(Request $request){
        $new = Hash::make($request['new_password']);
        $update = User::where('id',Auth::user()->id)->update(['password' => $new]);

        if($update){
            return 'success';
        }else{
            return 'Something went wrong!';
        }
    }

}
