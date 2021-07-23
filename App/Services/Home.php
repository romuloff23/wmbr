<?php 
    namespace App\Home; 

    class Home {
       
        private $titulo;
        private $html;

        public function __construct(){
            $this->html = file_get_contents('App/View/home.html');
            $this->titulo = "Home";
        }

        public function load(){
            
            try{
                
                $this->html = str_replace('{Titulo}',$this->titulo,$this->html);
            }catch (\Exception $e) {
                print $e->getMessage();
            }
            
        }

        public function show(){
            $this->load();
            print $this->html;
        }

    }

?>