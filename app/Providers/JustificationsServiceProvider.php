<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Justifications\Contracts\{
    JustificationRepository, ClassroomRepository
};
use App\Infrastructure\Persistence\Eloquent\Justifications\{
    EloquentJustificationRepository, EloquentClassroomRepository
};

class JustificationsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(JustificationRepository::class, EloquentJustificationRepository::class);
    }

    public function boot(): void {}
}
