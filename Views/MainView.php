<?php 
namespace Views;

class MainView
{
    private $fileName;
    private $header;
    private $footer;

    const titulo = 'Projeto MVC';

    public $menuitens = array('Home','Produtos','Sobre');
    public $menudrop = array('Fale conosco','Duvidas frequentes','Contato');
    
    public function __construct($fileName, $header = 'header', $footer = 'footer')
    {
        $this->fileName = $fileName;
        $this->header = $header;
        $this->footer = $footer;
    }
    
    public function render($arr = []){
        // Inclui o header se não for null
        if ($this->header) {
            include('pages/templates/'.$this->header.'.php');
        }

        include('pages/'.$this->fileName.'.php');
        
        // Inclui o footer se não for null
        if ($this->footer) {
            include('pages/templates/'.$this->footer.'.php');
        }
    }
}

?>