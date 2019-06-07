<?php namespace App\Modules;

/**
 *
 * Сервис провайдер для подключения модулей
 */

class ModulesServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        //получаем список модулей, которые надо подгрузить
        $modules = config("module.modules");

        if ($modules)
        {
            foreach ($modules as $module)
            {

                //Загружаем View
                if (is_dir(__DIR__ . '/' . $module . '/Views'))
                {
                    $this->loadViewsFrom(__DIR__ . '/' . $module . '/Views', $module);
                }

                //Подгружаем миграции
                if (is_dir(__DIR__ . '/' . $module . '/Migration'))
                {
                    $this->loadMigrationsFrom(__DIR__ . '/' . $module . '/Migration');
                }

            }
        }
    }

    public function register()
    {

    }
}
