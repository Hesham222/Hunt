<?php

namespace Admin\Providers;

use Admin\Models\{
    Admin,
};

use Admin\Models\Area;
use Admin\Models\Broker;
use Admin\Models\City;
use Admin\Models\Developer;
use Admin\Models\Individual;
use Admin\Models\Listings\Listing;
use Admin\Models\Posts\Post;
use Admin\Models\Reports\AccountReport;
use Admin\Models\Reports\PostReport;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AdminServiceProvider extends ServiceProvider
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
        view()->composer('Admin::_components.layout.sidebar', function ($view) {
            $view->with([
                'adminTrashesCount'    => Admin::onlyTrashed()->count(),
                'cityTrashesCount'    => City::onlyTrashed()->count(),
                'areaTrashesCount'    => Area::onlyTrashed()->count(),
                'individualTrashesCount'    => Individual::onlyTrashed()->count(),
                'brokerTrashesCount'    => Broker::onlyTrashed()->count(),
                'developerTrashesCount'    => Developer::onlyTrashed()->count(),
                'postTrashesCount'    => Post::onlyTrashed()->count(),
                'postRequestsCount'    => Post::where('post_status_id', 1)->count(),
                'reportPostsTrashesCount'    => PostReport::onlyTrashed()->count(),
                'reportPostsRequestsCount'    => PostReport::where('status',"Pending")->count(),
                'reportAccountsTrashesCount'    => AccountReport::onlyTrashed()->count(),
                'reportAccountsRequestsCount'    => AccountReport::where('status',"Pending")->count(),
                'listingTrashesCount'    => Listing::onlyTrashed()->count(),
                'listingRequestsCount'    => Listing::where('listing_status_id', 1)->count(),
                'developersBlockedCount'    => Developer::where('status','blocked')->count(),
                'brokersBlockedCount'    => Broker::where('status','blocked')->count(),
                'individualsBlockedCount'    => Individual::where('status','blocked')->count(),
                'reportAccountsDismissedCount'    => AccountReport::where('status','Dismissed')->count(),
                'reportPostsDismissedCount'    => PostReport::where('status','Dismissed')->count(),

            ]);
        });

        $moduleName = 'Admin';
        config([
            $moduleName => File::getRequire(loadConfigFile('routePrefix', $moduleName))
        ]);
        $this->loadRoutesFrom(loadRoute('web', $moduleName));
        $this->loadViewsFrom(loadViews($moduleName), $moduleName);
        $this->loadTranslationsFrom(loadTranslations($moduleName), $moduleName);
        $this->loadMigrationsFrom(loadMigrations($moduleName));
        Blade::componentNamespace('Admin\View\Components', 'admin');
    }
}
