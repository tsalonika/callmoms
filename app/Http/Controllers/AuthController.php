<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Mom;
use App\Models\Patient;
use App\Models\Psychologist;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
                'username' => 'required',
                'password' => 'required',
            ]);

            $user = User::where('username', $request->username)->first();

            if(!$user || !Hash::check($request->password, $user->password)) {
                return back()->with('error', 'Username atau Kata Sandi yang Anda Coba Salah');
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

        $photoPath = null;

        try {
            $rules = [
                'name' => 'required|string|max:255',
                'role' => 'required|string|in:mom,family',
                'username' => 'required|string|unique:users,username',
                'email' => 'required|string|unique:users,email',
                'address' => 'required|string|max:255',
                'birthOfDate' => 'required|date',
                'birthOfPlace' => 'required|string',
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
                $file = $request->file('photo');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage/profile-photos'), $filename);
                $photoPath = 'profile-photos/' . $filename;
            }

            $user = new User;
            $user->role = $request->role;
            $user->phoneNumber = $request->phoneNumber;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->name = $request->name;
            if($request->role === 'mom') {
                $user->gender = 'female';
            } else {
                $user->gender = $request->gender;
            }
            $user->address = $request->address;
            $user->photo = $photoPath;
            $user->password = bcrypt($request->password);
            $user->birthOfDate = $request->birthOfDate;
            $user->birthOfPlace = $request->birthOfPlace;
            $user->save();

            
            if ($request->role === 'mom') {
                $patient = new Mom;
                $patient->children_num = $request->children_num;
                $patient->year_marriage = $request->year_marriage;
                $patient->users_id = $user->id_users;
                $patient->save();
            }

            return redirect()->back()->with('success', 'Registrasi berhasil!');
        } catch (\Exception $e) {
            if ($photoPath) {
                unlink(public_path('storage/' . $photoPath));
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Send Psychologist new Data
    public function postPsychologist(Request $request)
    {

        $photoPath = null;
        $certificatePath = null;
        $strpPath = null;

        try {
            $rules = [
                'name' => 'required|string|max:255',
                'id_card_number' => 'required|string|max:255',
                'gender' => 'required|string|in:male,female',
                'username' => 'required|string|unique:users,username',
                'email' => 'required|string|unique:users,email',
                'address' => 'required|string|max:255',
                'photo' => 'required|image',
                'birthOfDate' => 'required|string',
                'birthOfPlace' => 'required|string',
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
                $file = $request->file('photo');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage/profile-photos'), $filename);
                $photoPath = 'profile-photos/' . $filename;
            }

            if ($request->hasFile('certificate')) {
                $file = $request->file('certificate');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage/certificates'), $filename);
                $certificatePath = 'certificates/' . $filename;
            }

            if ($request->hasFile('strp')) {
                $file = $request->file('strp');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage/strp'), $filename);
                $strpPath = 'strp/' . $filename;
            }
            
            $user = new User;
            $user->role = 'psychologist';
            $user->phoneNumber = $request->phoneNumber;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->photo = $photoPath;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->password = bcrypt($request->password);
            $user->birthOfDate = $request->birthOfDate;
            $user->birthOfPlace = $request->birthOfPlace;
            $user->save();

            $psychologist = new Psychologist;
            $psychologist->id_card_number = $request->id_card_number;
            $psychologist->school = $request->school;
            $psychologist->graduated_year = $request->graduated_year;
            $psychologist->certificate = $certificatePath;
            $psychologist->strp_number = $request->strp_number;
            $psychologist->strp = $strpPath;
            $psychologist->status = 'inactive';
            $psychologist->users_id = $user->id_users;
            $psychologist->save();

            return redirect()->back()->with('success', 'Registrasi berhasil! Silahkan Tunggu Aktivasi Akun dari Admin');
        } catch (\Exception $e) {
            if ($photoPath) {
                unlink(public_path('storage/' . $photoPath));
            }
            if ($certificatePath) {
                unlink(public_path('storage/' . $certificatePath));
            }
            if ($strpPath) {
                unlink(public_path('storage/' . $strpPath));
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Logout Function
    public function logout (Request $request)
    {
        $request->session()->forget('users_data');
        return redirect('/login');
    }

    // Profile function
    public function showProfile()
    {
        return view('Auth.profile');
    }

    public function updateProfile(Request $request)
    {
        $photoPath = null;

        try {
            $user = User::find($request->id);
            
            $rules = [
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'birthOfDate' => 'required|date',
                'birthOfPlace' => 'required|string',
                'phoneNumber' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'email' => 'required|string|max:255',
            ];

            if ($request->phoneNumber !== $user->phoneNumber) {
                $rules['phoneNumber'] .= '|unique:users,phoneNumber';
            }

            if ($request->username !== $user->username) {
                $rules['username'] .= '|unique:users,username';
            }

            $request->validate($rules);

            $user->phoneNumber = $request->phoneNumber;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->birthOfDate = $request->birthOfDate;
            $user->birthOfPlace = $request->birthOfPlace;
            $user->name = $request->name;
            $user->address = $request->address;
            $user->gender = $user->gender;

            if ($request->password) {
                $user->password = bcrypt($request->password);
            }

            if ($request->hasFile('photo')) {

                if($user->photo) {
                    $oldPhotoPath = public_path('storage/' . $user->photo);
                    if(file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath);
                    }
                }

                $file = $request->file('photo');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage/profile-photos'), $filename);
                $photoPath = 'profile-photos/' . $filename;
                $user->photo = $photoPath;
            }

            $user->save();

            $userData = $user->toArray();

            if ($request->role === 'psychologist') {
                $psychologistData = $user->psychologist;
                $userData['nested'] = $psychologistData->toArray();
            }

            if ($request->role === 'mom') {
                $momData = $user->mom;
                $userData['nested'] = $momData->toArray();
            }
            session(['users_data' => $userData]);

            return redirect()->back()->with('success', 'Perbarui Profil berhasil!');
            
        } catch (\Exception $e) {
            if ($photoPath) {
                unlink(public_path('storage/' . $photoPath));
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
