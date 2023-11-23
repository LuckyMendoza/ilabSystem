<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\service_offers;
use App\Models\schedule_list;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{
    public function dashboard(){
        $doctors = User::where('user_type','doctor')->get();
        $services = service_offers::all();

        if(Auth::user()->user_type == 'patient'){
            return view('appointment',['doctors' => $doctors, 'services' => $services]);
        }else{
            // $data['user'] = User::where('user_type','patient')->count();

            $data['doctors'] = User::where('user_type','doctor')->count();
            $data['appointments'] = schedule_list::count();

            $data['user'] = User::registered_patients_per_month();

            return view('dashboard', $data);
        }

    }


}
