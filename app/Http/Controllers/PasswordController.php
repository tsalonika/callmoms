<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('Auth.reset-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $customMessage = [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email tidak terdaftar',
        ];

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], $customMessage);

        $token = Str::random(60);

        PasswordResetToken::updateOrCreate(
            [
                'email' => $request->email
            ],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now()
            ]
        );

        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return back()->with('success', 'Link Reset Kata Sandi Berhasil dikirim ke Email Anda');
    }

    public function showResetForm(Request $request, $token)
    {
        $getToken = PasswordResetToken::where('token', $token)->first();

        if(!$getToken) {
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }

        return view('Auth.reset', compact('token'));
    }

    public function reset(Request $request) {
        try {
            $customMessage = [
                'password.required' => 'Password tidak boleh kosong',
            ];
    
            $request->validate([
                'password' => 'required'
            ], $customMessage);
    
            $token = PasswordResetToken::where('token', $request->token)->first();
    
            if(!$token) {
                return redirect()->route('password.request')->with('failed', 'Token tidak valid');
            }
    
            $user = User::where('email', $token->email)->first();
    
            if(!$user) {
                return redirect()->route('login')->with('failed', 'Email tidak terdaftar di dalam database');
            }
    
            $user->update([
                'password' => bcrypt($request->password)
            ]);
    
            $token->delete();
    
            return redirect('/login')->with('successEmail', 'Kata sandi berhasil di reset');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
}
