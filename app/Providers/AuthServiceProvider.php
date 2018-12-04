<?php

namespace App\Providers;

use App\Certificate;
use App\Exam;
use App\Policies\CertificatePolicy;
use App\Policies\ExamPolicy;
use App\Policies\SubjectPolicy;
use App\Subject;
use App\Token;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {

        // Here you register policies
        $this->registerPolicies();


        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {

            $headerValue = null;

            if ($request->has('Authorization') ) {
                $headerValue = $request->input('Authorization');
            } else if ( $request->headers->has('Authorization') ) {
                $headerValue = $request->header('Authorization');
            }

            $matches = [];
            preg_match('/^Bearer ([^ ]+)/',$headerValue,$matches);

            $tokenValue = null;
            if (count($matches) > 1) {
                $tokenValue = $matches[1];
            }

            $authToken = Token::where([
                ['type', 'auth token'],
                ['value' , $tokenValue],
            ])->first();

            Token::session($authToken);

            if (is_null($authToken)) {
                return null;
            }

            return $authToken->user;
        });

    }

    public function registerPolicies() {
        Gate::policy(Certificate::class, CertificatePolicy::class);
        Gate::policy(Subject::class,SubjectPolicy::class);
        Gate::policy(Exam::class,ExamPolicy::class);
    }
}
