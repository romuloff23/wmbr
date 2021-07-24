<?php 
    namespace App\Home; 

    class Home {
       /**
        *   Esta classe é responsavel por exibir o menu
        *   inicial da aplicação, ele é chamado quando a
        *   URL da aplicação estiver vazia.
        *
        *
        *   @author Rômulo F. Farias <romuloff23@gmail.com>
        *   @access public
        */

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