<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;
use App\Actions\ImportAction; // Импортируем ваш кастомный Action

class VoyagerServiceProvider extends \TCG\Voyager\VoyagerServiceProvider
{
    /**
     * Boot the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Регистрируем кастомный Action
        Voyager::addAction(ImportAction::class);
    }
}