<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password; // <-- Pastikan ini ada
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini jika belum ada

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // Laravel 9+ tidak lagi secara eksplisit memerlukan use SendsPasswordResetEmails.
    // Fungsionalitasnya ditangani secara internal oleh broker password.

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email'); // Ini mengarahkan ke view yang benar
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Menggunakan Password broker untuk mengirim link reset
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        // Menangani respons berdasarkan status pengiriman
        return $response == Password::RESET_LINK_SENT
                    ? back()->with('status', __($response))
                    : back()->withErrors(['email' => __($response)]);
    }

    /**
     * Get the broker to be used by the password controller.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('dosens'); // Gunakan broker 'dosens' dari config/auth.php
    }

    /**
     * Get the guard to be used by the password controller.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    protected function guard()
    {
        return Auth::guard('dosen'); // Gunakan guard 'dosen'
    }
}
