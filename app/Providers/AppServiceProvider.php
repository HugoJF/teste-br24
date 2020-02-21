<?php

namespace App\Providers;

use App\Company;
use App\Contact;
use App\Observers\CompanyObserver;
use App\Observers\ContactObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        $this->updateStringLength();
        $this->registerObservers();
    }

    /**
     * Update defaultStringLength to support MariaDB
     */
    protected function updateStringLength(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register observers used to keep Bitrix24 up-to-date
     */
    protected function registerObservers(): void
    {
        Company::observe(CompanyObserver::class);
        Contact::observe(ContactObserver::class);
    }
}
