<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        Paginator::useBootstrapFour();

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifikasi Akun RUANG BACA FST')
                ->view('email.email-verification', [
                    'user' => $notifiable,
                    'verificationUrl' => $url,
                    'verificationCode' => substr(md5($url), 0, 6) // Generate 6 digit code
                ]);
        });
        ResetPassword::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifikasi Akun RUANG BACA FST')
                ->view('email.reset-password', [
                    'user' => $notifiable,
                    'resetUrl' => url('/reset-password/' . $url),
                ]);
        });
    }
}
