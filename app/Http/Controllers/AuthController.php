<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Mom;
use App\Models\Patient;
use App\Models\Psychologist;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show Login Page
    public function showLogin()
    {
        return view('Auth.login');
    }

    // Proceed Login
    public function proceedLogin(Request $request)
    {
        try {
            $request->validate([
                'phoneNumber' => 'required',
                'password' => 'required',
            ]);

            $user = User::where('phoneNumber', $request->phoneNumber)->first();

            if(!$user || !Hash::check($request->password, $user->password)) {
                return back()->with('error', 'Nomor Telepon atau Kata Sandi yang Anda Coba Salah');
            }

            $userData = $user->toArray();

            // Check if user is Psychologist
            if($user->role === 'psychologist') {
                $psychologist = $user->psychologist;
                
                if(!$psychologist || $psychologist->status !== 'active') {
                    return back()->with('error', 'Nomor Telepon atau Kata Sandi yang Anda Coba Salah');
                }

                $userData['nested'] = $psychologist->toArray();
            }

            // Check if user is Mom
            if($user->role === 'mom') {
                $mom = $user->mom;

                if(!$mom) {
                    return back()->with('error', 'Nomor Telepon atau Kata Sandi yang Anda Coba Salah');
                }

                $userData['nested'] = $mom->toArray();
            }

            // Check if user is Family
            if($user->role === 'family') {
                $family = $user->family;

                if(!$family) {
                    return back()->with('error', 'Nomor Telepon atau Kata Sandi yang Anda Coba Salah');
                }

                $userData['nested'] = $family->toArray();
            }

            session(['users_data' => $userData]);

            return redirect()->back()->with('success', 'Berhasil');
        } catch (Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    // Show Register Page
    public function showRegister()
    {
        return view('Auth.register');
    }

    // Send Family or Mom new Data
    public function postUser(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string|max:255',
                'role' => 'required|string|in:mom,family',
                'address' => 'required|string|max:255',
                'photo' => 'required|image',
                'phoneNumber' => 'required|string|max:255',
                'password' => 'required|string',
            ];

            if ($request->role === 'family') {
                $rules['gender'] = 'required|string|in:male,female';
            } else if ($request->role === 'mom') {
                $rules['children_num'] = 'required|integer|min:0';
                $rules['year_marriage'] = 'required|integer|min:1900|max:' . date('Y');
            }

            $request->validate($rules);

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('profile-photos', 'public');
            }

            $user = new User;
            $user->role = $request->role;
            $user->phoneNumber = $request->phoneNumber;
            $user->password = bcrypt($request->password);

            $user->save();

            if ($request->role === 'family') {
                $family = new Family;
                $family->name = $request->name;
                $family->gender = $request->gender;
                $family->address = $request->address;
                $family->photo = $photoPath;
                $family->users_id = $user->id;
                $family->save();
            } else if ($request->role === 'mom') {
                $patient = new Mom;
                $patient->name = $request->name;
                $patient->gender = 'female';
                $patient->address = $request->address;
                $patient->photo = $photoPath;
                $patient->children_num = $request->children_num;
                $patient->year_marriage = $request->year_marriage;
                $patient->users_id = $user->id;
                $patient->save();
            }

            return redirect()->back()->with('success', 'Registrasi berhasil!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Send Psychologist new Data
    public function postPsychologist(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string|max:255',
                'id_card_number' => 'required|string|max:255',
                'gender' => 'required|string|in:male,female',
                'address' => 'required|string|max:255',
                'photo' => 'required|image',
                'phoneNumber' => 'required|string|max:255',
                'school' => 'required|string|max:255',
                'graduated_year' => 'required|integer|min:1900|max:' . date('Y'),
                'certificate' => 'required|file',
                'strp_number' => 'required|string',
                'strp' => 'required|file',
                'password' => 'required|string',
            ];

            $request->validate($rules);

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('profile-photos', 'public');
            }

            if ($request->hasFile('certificate')) {
                $certificatePath = $request->file('certificate')->store('certificates', 'public');
            }

            if ($request->hasFile('strp')) {
                $strpPath = $request->file('strp')->store('strp', 'public');
            }
            
            $user = new User;
            $user->role = 'psychologist';
            $user->phoneNumber = $request->phoneNumber;
            $user->password = bcrypt($request->password);

            $user->save();

            $psychologist = new Psychologist;
            $psychologist->name = $request->name;
            $psychologist->id_card_number = $request->id_card_number;
            $psychologist->gender = $request->gender;
            $psychologist->address = $request->address;
            $psychologist->photo = $photoPath;
            $psychologist->school = $request->school;
            $psychologist->graduated_year = $request->graduated_year;
            $psychologist->certificate = $certificatePath;
            $psychologist->strp_number = $request->strp_number;
            $psychologist->strp = $strpPath;
            $psychologist->status = 'inactive';
            $psychologist->users_id = $user->id;
            $psychologist->save();

            return redirect()->back()->with('success', 'Registrasi berhasil! Silahkan Tunggu Aktivasi Akun dari Admin');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Logout Function
    public function logout (Request $request)
    {
        $request->session()->forget('users_data');
        return redirect('/login');
    }

}
