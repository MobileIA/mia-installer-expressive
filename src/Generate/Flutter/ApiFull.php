<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mobileia\Expressive\Installer\Generate\Flutter;

/**
 * Description of ApiFull
 *
 * @author matiascamiletti
 */
class ApiFull extends \Mobileia\Expressive\Installer\Generate\BaseFile
{
    /**
     * Nombre de la DB
     *
     * @var string
     */
    public $name = '';

    public function run()
    {
        $model = new Api();
        $model->name = $this->name;
        $model->run();

        $model = new ApiChopper();
        $model->name = $this->name;
        $model->run();
    }

    protected function openFile()
    {
        
    }
}
