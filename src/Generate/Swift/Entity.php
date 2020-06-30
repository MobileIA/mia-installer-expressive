<?php

namespace Mobileia\Expressive\Installer\Generate\Swift;

use \Illuminate\Database\Capsule\Manager as DB;

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
    protected $filePath = './vendor/mobileia/mia-installer-expressive/data/swift/entity.txt';
    /**
     * Path de la carpeta donde se va a guardar
     * @var string
     */
    protected $savePath = './data/swift/Entity/';
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
        $coding = '';
        $init = '';
        foreach($columns as $column){
            if(stripos($column->Type, 'int') === false){
                $properties .= "    @objc dynamic var $column->Field = \"\"\n";
                $init .= "$column->Field = try container.decodeIfPresent(String.self, forKey: .$column->Field) ?? \"\"\n";
            }else{
                $properties .= "    @objc dynamic var $column->Field = 0\n";
                $init .= "        do{
            id = try container.decode(Int.self, forKey: .$column->Field)
        }catch{
            $column->Field = Int(try container.decode(String.self, forKey: .$column->Field))!;
        }\n";
            }
            
            $coding .= "        case $column->Field\n";
        }
        $this->file = str_replace('%%properties%%', $properties, $this->file);
        $this->file = str_replace('%%coding%%', $coding, $this->file);
        $this->file = str_replace('%%init%%', $init, $this->file);
        
        try {
            mkdir($this->savePath . '/', 0777, true);
        } catch (\Exception $exc) { }
        file_put_contents($this->savePath . $this->getCamelCase($this->name) . '.swift', $this->file);
    }
}
