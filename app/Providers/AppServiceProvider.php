<?php

namespace App\Providers;
use App\Models\Admin\admin;
use App\Models\Admin\sanpham;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
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
        $admin=admin::all();
        View::share('admin',$admin);

        $data=sanpham::all();
        View::share('data',$data);

        Paginator::useBootstrap();
    }
}
