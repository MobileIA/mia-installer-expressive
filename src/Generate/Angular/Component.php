<?php

namespace Mobileia\Expressive\Installer\Generate\Angular;

use \Illuminate\Database\Capsule\Manager as DB;

/**
 * Description of Entity
 *
 * @author matiascamiletti
 */
class Component extends \Mobileia\Expressive\Installer\Generate\BaseFile
{
    /**
     * Path del archivo a tener de base
     * @var string
     */
    protected $filePath = './vendor/mobileia/mia-installer-expressive/data/angular/component.txt';
    protected $filePathHtml = './vendor/mobileia/mia-installer-expressive/data/angular/component.html.txt';
    /**
     * Path de la carpeta donde se va a guardar
     * @var string
     */
    protected $savePath = './data/angular/component/';
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
            mkdir($this->savePath . '/', 0777, true);
        } catch (\Exception $exc) { }
        file_put_contents($this->savePath . $this->name . '.component.ts', $this->file);
        
        $fileHtml = file_get_contents($this->filePathHtml);
        $fileHtml = str_replace('%%nameClass%%', $this->getCamelCase($this->name), $fileHtml);
        $fileHtml = str_replace('%%name%%', $this->name, $fileHtml);
        
        try {
            mkdir($this->savePath . '/', 0777, true);
        } catch (\Exception $exc) { }
        file_put_contents($this->savePath . $this->name . '.component.html', $fileHtml);
    }
}
