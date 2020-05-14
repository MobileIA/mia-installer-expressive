<?php

namespace Mobileia\Expressive\Installer\Generate\Flutter;

/**
 * Description of Screen
 *
 * @author matiascamiletti
 */
class Screen extends \Mobileia\Expressive\Installer\Generate\BaseFile
{
    /**
     * Nombre de la DB
     *
     * @var string
     */
    public $name = '';

    public function run()
    {
        $model = new Controller();
        $model->name = $this->name;
        $model->run();

        $model = new View();
        $model->name = $this->name;
        $model->run();
    }

    protected function openFile()
    {
        
    }
}
