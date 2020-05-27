<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mobileia\Expressive\Installer\Generate\Flutter;

/**
 * Description of Api
 *
 * @author matiascamiletti
 */
class Api  extends \Mobileia\Expressive\Installer\Generate\BaseFile
{
    /**
     * Path del archivo a tener de base
     * @var string
     */
    protected $filePath = './vendor/mobileia/mia-installer-expressive/data/flutter/api.txt';
    /**
     * Path de la carpeta donde se va a guardar
     * @var string
     */
    protected $savePath = './data/flutter/apis/';
    /**
     * Nombre de la DB
     *
     * @var string
     */
    public $name = '';

    public function run()
    {
        $this->file = str_replace('%%nameClass%%', $this->getCamelCase($this->name), $this->file);
        $this->file = str_replace('%%name%%', $this->name, $this->file);
        
        try {
            mkdir($this->savePath, 0777, true);
        } catch (\Exception $exc) { }
        file_put_contents($this->savePath . $this->name . '.api.dart', $this->file);
    }
}
