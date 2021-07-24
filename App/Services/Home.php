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
            $head = '';
            $menu = '';
            try{
                $head = file_get_contents('App/View/partes/head.html');
                $menu = file_get_contents('App/View/partes/menu.html');
            }catch (\Exception $e) {
                print $e->getMessage();
            }
            $head = str_replace('{Titulo}',$this->titulo,$head);
            $this->html = str_replace('{Titulo}',$this->titulo,$this->html);
            $this->html = str_replace('{head}',$head,$this->html);
            $this->html = str_replace('{menu}',$menu, $this->html );
        }

        public function show(){
            $this->load();
            print $this->html;
        }

    }

?>