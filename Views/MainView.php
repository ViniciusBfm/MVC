<?php 
namespace Views;

class MainView
{
    private $fileName;
    private $header;
    private $footer;

    const titulo = 'Repros';
    
    public function __construct($fileName, $header = 'header', $footer = 'footer')
    {
        $this->fileName = $fileName;
        $this->header = $header;
        $this->footer = $footer;
    }
    
    public function render($arr = [])
    {
        // Extrair variáveis do array para uso no template
        extract($arr);

        if ($this->header) {
            include('pages/templates/'.$this->header.'.php');
        }

        include('pages/'.$this->fileName.'.php');
        
        if ($this->footer) {
            include('pages/templates/'.$this->footer.'.php');
        }
    }
}

?>