<?php

namespace Mobileia\Expressive\Installer\Added;

use \Illuminate\Database\Capsule\Manager as DB;

class Route extends \Mobileia\Expressive\Installer\Generate\BaseFile
{
    /**
     * Path del archivo a tener de base
     * @var string
     */
    protected $filePath = './config/routes.php';
    /**
     * Path de la carpeta donde se va a guardar
     * @var string
     */
    protected $savePath = './config/routes.php';
    /**
     * Nombre de la DB
     *
     * @var string
     */
    public $name = '';
    public $nameHandler = '';
    public $paramsRequired = '';
    public $isAuth = false;
    public $isRole = -1;

    public function run()
    {
        $addRoute = '    $app->route(\'/'.$this->name.'/'. $this->nameHandler . '\', [';

        if($this->paramsRequired != ''){
            $addRoute .= 'new Mobileia\Expressive\Request\MiaVerifyParamHandler(array('.$this->paramsRequired.')), ';
        }

        if($this->isAuth){
            $addRoute .= '\Mobileia\Expressive\Auth\Handler\AuthInternalHandler::class, ';
        }

        if($this->isRole > -1){
            $addRoute .= 'new Mobileia\Expressive\Auth\Middleware\MiaRoleAuthMiddleware([\Mobileia\Expressive\Auth\Model\MIAUser::ROLE_ADMIN]), ';
        }

        $addRoute .= 'App\Handler\\'.$this->getCamelCase($this->name).'\\' . $this->getCamelCase($this->nameHandler) . 'Handler::class], [\'GET\', \'POST\', \'OPTIONS\', \'HEAD\'], \'' . $this->name .'.'. $this->nameHandler .'\');';

        $addRoute .= '
};';

        $this->file = str_replace('};', $addRoute, $this->file);
        file_put_contents($this->savePath, $this->file);
    }
}
