<?php

namespace Mobileia\Expressive\Installer\Generate;

use \Illuminate\Database\Capsule\Manager as DB;

class AbmHandler extends BaseFile
{
    /**
     * Nombre de la DB
     *
     * @var string
     */
    public $name = '';

    public function run()
    {
        $model = new Model();
        $model->name = $this->name;
        $model->run();

        $model = new Repository();
        $model->name = $this->name;
        $model->run();

        $model = new FetchHandler();
        $model->name = $this->name;
        $model->run();

        $model = new ListHandler();
        $model->name = $this->name;
        $model->run();

        $model = new RemoveHandler();
        $model->name = $this->name;
        $model->run();

        $model = new SaveHandler();
        $model->name = $this->name;
        $model->run();
    }
}
