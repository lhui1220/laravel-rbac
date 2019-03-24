<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2019/3/24
 * Time: 20:01
 */

namespace geekio\rbac;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

/**
 * RBAC权限管理服务提供者
 *
 * Class RbacServiceProvider
 * @package geekio\rbac
 */
class RbacServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->singleton('role', function () {
            return new RoleService();
        });

        $this->app->singleton('permission', function () {
            return new PermissionService();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/rbac.php' => config_path('rbac.php')
        ], 'config');

        $this->loadViewsFrom(__DIR__. '/../resources/views', 'rbac');
        $this->publishes([
            __DIR__. '/../resources/views' => resource_path('views/vendor/rbac')
        ], 'views');
    }

    public function provides()
    {
        return [];
    }

}