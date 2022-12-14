<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
   
    public function register()
    {
        $request = request();
        if($request->is('formateur/*')){
            Config::set('fortify.guard' ,'formateur');
            Config::set('fortify.prefix' ,'formateur');
        }
        if($request->is('stagaire/*')){
            Config::set('fortify.guard' ,'stagaire');
            Config::set('fortify.prefix' ,'stagaire');
        }
        if($request->is('admin/*')){
            Config::set('fortify.guard' ,'admin');
            Config::set('fortify.prefix' ,'admin');
        }
    }

    /**
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

        Fortify::loginView(function(){
           
            return view('Auth.login');
        });
        Fortify::registerView(function(Request $request ){
           
          
            return view('Front.notFound');
        });
        Fortify::verifyEmailView(function(){

            return view('Auth.verify');
        });
        Fortify::requestPasswordResetLinkView(function(){

            return view('Auth.Passwords.reset');
        });
        Fortify::resetPasswordView(function(){

            return view('Auth.Passwords.confirm');
        });
    }
}
