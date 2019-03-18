<?php namespace Zombiecorp\Brdocs;

use Yaml;
use File;
use System\Classes\PluginBase;
use RainLab\User\Models\User as UserModel;
use RainLab\User\Controllers\Users as UsersController;

// use RainLab\Notify\Models\Notification as NotificationModel;
// use RainLab\Notify\NotifyRules\SaveDatabaseAction;
// use RainLab\User\Classes\UserEventBase;


class Plugin extends PluginBase
{
    public $require = ['RainLab.User', 'RainLab.Location', 'RainLab.Notify'];

    public function boot(){
        $this->extendUserModel();
        $this->extendUsersController();
    }

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }


    /** EXTEND RAINLAB'S USER MODEL  */
    protected function extendUserModel()
    {
        UserModel::extend(function($model) {
            $model->addFillable([
                'cpf', 'rg', 'cnh',
                'titulo_de_eleitor', 'passaporte',
                'pis', 'nis',
            ]);
        });
    }

    protected function extendUsersController()
    {
        UsersController::extendFormFields(function($widget) {
            // Prevent extending of related form instead of the intended User form
            if (!$widget->model instanceof UserModel) {
                return;
            }
            $configFile = plugins_path('zombiecorp/brdocs/config/profile_fields.yaml');
            $config = Yaml::parse(File::get($configFile));
            $widget->addTabFields($config);
        });
    }

}
