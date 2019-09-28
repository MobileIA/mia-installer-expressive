<?php namespace Mobileia\Expressive\Installer\Generate;

abstract class BaseFile 
{
    /**
     * Path del archivo a tener de base
     * @var string
     */
    protected $filePath = '';
    /**
     * Almacena el contenido del archivo
     * @var string
     */
    protected $file = '';
    /**
     * Path de la carpeta donde se va a guardar
     * @var string
     */
    protected $savePath = '';
    
    public function __construct()
    {
        // Abrir el archivo
        $this->openFile();
    }

    abstract function run();
    
    protected function openFile()
    {
        $this->file = file_get_contents($this->filePath);
    }
    /**
     * Convierte el texto en camelcase
     * 
     * Ej: blog_tag => BlogTag
     * Ej: blog-tag => BlogTag
     *
     * @param [type] $text
     * @return void
     */
    protected function getCamelCase($text)
    {
        return str_replace(' ', '', ucwords(str_replace(['_', '-'], [' ', ' '], $text)));
    }
}