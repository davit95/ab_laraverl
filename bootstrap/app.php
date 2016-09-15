<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Admin\Contracts\OwnerInterface::class,
    Admin\Services\OwnerService::class
);

$app->singleton(
    Admin\Contracts\CountryInterface::class,
    Admin\Services\CountryService::class
);

$app->singleton(
    Admin\Contracts\CityInterface::class,
    Admin\Services\CityService::class
);

$app->singleton(
    Admin\Contracts\RegionInterface::class,
    Admin\Services\RegionService::class
);

$app->singleton(
    Admin\Contracts\UsStateInterface::class,
    Admin\Services\UsStateService::class
);

$app->singleton(
    Admin\Contracts\CenterInterface::class,
    Admin\Services\CenterService::class
);

$app->singleton(
    Admin\Contracts\UserInterface::class,
    Admin\Services\UserService::class
);

$app->singleton(
    Admin\Contracts\MeetingRoomInterface::class,
    Admin\Services\MeetingRoomService::class
);

$app->singleton(
    Admin\Contracts\StaffInterface::class,
    Admin\Services\StaffService::class
);
$app->singleton(
    Admin\Contracts\WhiteSiteServiceInterface::class,
    Admin\Services\WhiteSiteService::class
);


/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
