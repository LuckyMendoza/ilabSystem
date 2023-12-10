<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;


class PatientController extends Controller{
    public function index(){
        $data['patients'] = User::where('user_type', 'patient')->get();

        return view('components.patient', $data);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'birthdate' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        try {
            User::create([
                'fname' => $validatedData['fname'],
                'lname' => $validatedData['lname'],
                'gender' => $validatedData['gender'],
                'email' => $validatedData['email'],
                'birthdate' => $validatedData['birthdate'],
                'contact' => $validatedData['contact'],
                'address' => $validatedData['address'],
                'is_verified' => '1',
                'user_type' => 'patient',
                'password' => Hash::make($validatedData['password'])
            ]);

            return redirect()->back()->with('success', 'Data has been inserted successful!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'inserting failed!');
        }
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'birthdate' => 'required',
            'email' => 'required',
        ]);

        try {
            User::where('id', $id)->update([
                'fname' => $validatedData['fname'],
                'lname' => $validatedData['lname'],
                'gender' => $validatedData['gender'],
                'birthdate' => $validatedData['birthdate'],
                'contact' => $validatedData['contact'],
                'address' => $validatedData['address'],
            ]);

            return redirect()->back()->with('success', 'Data has been Updated successful!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'updating failed!');
        }
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data has been Deleted successful!');
    }
}
