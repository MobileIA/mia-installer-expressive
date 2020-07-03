<?php

namespace Mobileia\Expressive\Installer\Generate\Angular;

use \Illuminate\Database\Capsule\Manager as DB;

/**
 * Description of Entity
 *
 * @author matiascamiletti
 */
class Columns extends \Mobileia\Expressive\Installer\Generate\BaseFile
{
    /**
     * Path del archivo a tener de base
     * @var string
     */
    protected $filePath = './vendor/mobileia/mia-installer-expressive/data/angular/columns.txt';
    /**
     * Path de la carpeta donde se va a guardar
     * @var string
     */
    protected $savePath = './data/angular/columns/';
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
        
        // Obtener las columnas de la tabla
        $columns = DB::select('DESCRIBE ' . $this->name);
        // Recorremos las columnas
        $properties = '';
        foreach($columns as $column){
            
            $properties .= "    {
      key: '".$column->Field."',
      field_key: '".$column->Field."',
      type: 'string',
      title: '".$column->Field."'
    },\n";
            
        }
        $this->file = str_replace('%%properties%%', $properties, $this->file);
        
        try {
            mkdir($this->savePath . '/', 0777, true);
        } catch (\Exception $exc) { }
        file_put_contents($this->savePath . $this->name . '.columns.ts', $this->file);
    }
}
