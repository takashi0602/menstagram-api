<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapV1AuthApiRoutes();
        $this->mapV1UserApiRoutes();
        $this->mapV1PostApiRoutes();
        $this->mapV1TimelineApiRoutes();
        $this->mapV1NoticeApiRoutes();
        $this->mapV1ReportApiRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * 認証系API
     */
    protected function mapV1AuthApiRoutes()
    {
        Route::prefix('api/v1')
                ->namespace($this->namespace . '\Api\V1')
                ->group(base_path('routes/api/v1/auth.php'));
    }

    /**
     * ユーザー系API
     */
    protected function mapV1UserApiRoutes()
    {
        Route::prefix('api/v1')
                ->middleware('api')
                ->namespace($this->namespace . '\Api\V1')
                ->group(base_path('routes/api/v1/user.php'));
    }

    /**
     * 投稿系API
     */
    protected function mapV1PostApiRoutes()
    {
        Route::prefix('api/v1')
                ->middleware('auth:api')
                ->namespace($this->namespace . '\Api\V1')
                ->group(base_path('routes/api/v1/post.php'));
    }

    /**
     * タイムライン系API
     */
    protected function mapV1TimelineApiRoutes()
    {
        Route::prefix('api/v1')
                ->middleware('auth:api')
                ->namespace($this->namespace . '\Api\V1')
                ->group(base_path('routes/api/v1/timeline.php'));
    }

    /**
     * 通知系API
     */
    protected function mapV1NoticeApiRoutes()
    {
        Route::prefix('api/v1')
                ->middleware('auth:api')
                ->namespace($this->namespace . '\Api\V1')
                ->group(base_path('routes/api/v1/notice.php'));
    }

    /**
     * 報告系API
     */
    protected function mapV1ReportApiRoutes()
    {
        Route::prefix('api/v1')
                ->middleware('auth:api')
                ->namespace($this->namespace . '\Api\V1')
                ->group(base_path('routes/api/v1/report.php'));
    }
}
