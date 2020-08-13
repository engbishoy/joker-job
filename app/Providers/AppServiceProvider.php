<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\CategoryTechnical;
use App\Models\Order;
use App\Models\Pull_credit;
use App\Models\Section;
use App\Models\Service_work;
use App\User;
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
        //

        view()->composer(
            'layouts.site.headerCategories',
            function ($view) {
                $view->with('category', Category::all());
            }
        );

        view()->composer(
            'layouts.site.navbar',
            function ($view) {
                $view->with('category', Category::all());
            }
        );


        // myorder navbar
        view()->composer(
            'site.orders.navbar',
            function ($view) {
                $view->with('orderAll', Order::where('user_id',auth()->user()->id)->get());
            }
        );

        
        view()->composer(
            'site.orders.navbar',
            function ($view) {
                $view->with('orderCompleted', Order::where('user_id',auth()->user()->id)->where('status',1)->orWhere('status',4)->get());
            }
        );

        view()->composer(
            'site.orders.navbar',
            function ($view) {
                $view->with('orderCanceled', Order::where('user_id',auth()->user()->id)->where('status',3)->orWhere('sale_service_approve',2)->get());
            }
        );

        //end



        // requests received navbar

        
        view()->composer(
            'site.requests_received.navbar',
            function ($view) {
                $view->with('user',User::find(auth()->user()->id));
            }
        );



        //admin 
        
        view()->composer(
            'layouts.admin.app',
            function ($view) {
                $view->with('categoryTechnical', CategoryTechnical::all())->with('categories', Category::all())
                ->with('sections', Section::all())
                ->with('services', Service_work::all())
                ->with('orders', Order::all())
                ->with('requiredTransfer', Pull_credit::where('pull_status',0)->get())
                ->with('completedTransfer',  Pull_credit::where('pull_status',1)->get())
                ->with('categoryTechnical', CategoryTechnical::all())
                ->with('admins',  Admin::whereRoleIs('admin')->where('id','!=',auth()->user()->id)->get())
                ->with('users',  User::all());
            }
        );

    }
}
