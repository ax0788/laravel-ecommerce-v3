<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

use App\Http\Responses\LoginResponse;
use App\Http\Responses\LogoutResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
/*     public function register()
    {
        $this->registerResponseBindings();

    }
    protected function registerResponseBindings()
    {
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
    }

 */    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });


        // Login Response bind
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
        // Logout Response bind
        $this->app->singleton(
            LogoutResponseContract::class,
           LogoutResponse::class
        );


        //  Fortify View Pages

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });
        // Forget Password
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.passwords.forget');
        });

        Fortify::resetPasswordView(function () {
            return view('auth.passwords.reset');
        });

    }
}
