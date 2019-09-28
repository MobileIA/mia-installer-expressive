<?php

namespace Mobileia\Expressive\Installer\Generate;

class ListHandler extends BaseHandler
{
    /**
     * Path del archivo a tener de base
     * @var string
     */
    protected $filePath = './vendor/mobileia/mia-installer-expressive/data/g_handler_list.txt';
    /**
     * Path de la carpeta donde se va a guardar
     * @var string
     */
    protected $savePath = './src/App/src/Handler/';

    public function run()
    {
        $this->file = str_replace('%%nameClass%%', $this->getCamelCase($this->name), $this->file);
        $this->file = str_replace('%%name%%', $this->name, $this->file);
        
        try {
            mkdir($this->savePath . '/' . $this->getCamelCase($this->name), 0777, true);
        } catch (\Exception $exc) { }
        file_put_contents($this->savePath . '/' . $this->getCamelCase($this->name) . '/ListHandler.php', $this->file);

        // Agregamos route
        $this->addRoute('list', '', true);
    }
}
