<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //Se pasa las variables con los array para construir el menú a la vista
        view()->composer('layouts.menu.menu-left', function($view) {
            $view->with('menusLeft', session()->get('menusLeft'));
        });
        view()->composer('layouts.menu.menu-top', function($view) {
            $view->with('menusTop', session()->get('menusTop'));
        });

        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('d/m/Y h:i A'); ?>";
        });

        Blade::directive('rinclude', function($expression) {
            $viewBasePath = \Config::get('view.paths')[0];
            $curCompiledFilePath = Blade::getPath();
            $paths = explode('/', substr($curCompiledFilePath, strlen($viewBasePath)), -1);
            $basePath = '';

            foreach($paths as $path) {
                $basePath .= $path . '.';
            }

            $basePath = trim($basePath, '.');

            if (starts_with($expression, '('))
                $expression = substr($expression, 2, -2);

            $expression = "'$basePath.$expression'";

            return "<?php echo \$__env->make($expression, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
