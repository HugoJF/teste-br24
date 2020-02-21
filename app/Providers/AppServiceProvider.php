<?php

namespace App\Providers;

use App\Company;
use App\Contact;
use App\Observers\CompanyObserver;
use App\Observers\ContactObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerObservers();
    }

    /**
     * Register observers used to keep Bitrix24 up-to-date
     */
    protected function registerObservers()
    {
        Company::observe(CompanyObserver::class);
        Contact::observe(ContactObserver::class);
    }
}
