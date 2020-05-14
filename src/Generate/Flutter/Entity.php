<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mobileia\Expressive\Installer\Generate\Flutter;

/**
 * Description of Entity
 *
 * @author matiascamiletti
 */
class Entity extends \Mobileia\Expressive\Installer\Generate\BaseFile
{
    /**
     * Path del archivo a tener de base
     * @var string
     */
    protected $filePath = './vendor/mobileia/mia-installer-expressive/data/flutter/view.txt';
    /**
     * Path de la carpeta donde se va a guardar
     * @var string
     */
    protected $savePath = './data/flutter/domain/entities/';
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
        $from = '';
        $maps = '';
        foreach($columns as $column){
            if($column->Field == 'id'){
                continue;
            }
            if(stripos($column->Type, 'int') !== false){
                $properties .= "  String ".$this->getCamelCaseVar($column->Field).";\n";
            }else{
                $properties .= "  int ".$this->getCamelCaseVar($column->Field)." = 0;\n";
            }
            
            $from .= "    entity.".$this->getCamelCaseVar($column->Field)." = data['".$column->Field."'];\n";
            $maps .= "      '".$column->Field."': ".$this->getCamelCaseVar($column->Field).",\n";
        }
        $this->file = str_replace('%%properties%%', $properties, $this->file);
        $this->file = str_replace('%%from%%', $from, $this->file);
        $this->file = str_replace('%%maps%%', $maps, $this->file);
        
        try {
            mkdir($this->savePath . $this->name . '/', 0777, true);
        } catch (\Exception $exc) { }
        file_put_contents($this->savePath . $this->name  . '/' . $this->name . '.entity.dart', $this->file);
    }
}
