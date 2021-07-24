<?php

    

    namespace App\WmbrServices;
    use App\Wmbr_api\WMBR_API;
    use App\NotasGeradas\NotasGeradas;

    class WmbrServices{

        /**
        *   Esta classe é responsavel por se comunicar com os modeuls,
        *   tratar os dados e exibir na tela.
        *
        *
        *   @author Rômulo F. Farias <romuloff23@gmail.com>
        *   @access public
        */

        private $uuid;
        private $chave;
        private $wmbr_api;
        private $ng;
        private $status;
        //partes da interface
        private $titulo;
        private $html;

        function __construct(){
            $this->wmbr_api = new WMBR_API;
            $this->ng = new NotasGeradas();
            $this->html = file_get_contents('App/View/wmbr.html');
            $this->titulo = "WMBR";
        }
        
        public function gerarNota(){
            try{
                $a =  $this->wmbr_api->emitirNota();
                $this->uuid = $a['uuid'];
                $this->chave = $a['chave'];
                $this->status = $a['status'];
                $this->ng->insarteNota($this->uuid,$this->chave,$this->status);
                $this->alerta("Nota gerado com sucesso");
                $this->tabela();
            }catch(\Exception $e){
                echo $e;
            }
        }

        public function Sefaz(){
            try{
               $a = $this->wmbr_api->StatusSefaz();
               $this->alerta("Sefaz está: ".$a['status']);
               $this->tabela();
            }catch(\Exception $e){
                echo $e;
            }
        }

        public function Certificado(){
            try{
                $a=$this->wmbr_api->validadeA1();
                $this->alerta("Seu certificado expita em ".$a['expiration']. " dias");
                $this->tabela();
                
            }catch(\Exception $e){
                echo $e;
            }
        }

        public function consultarNota(){
            try{
                $this->uuid = $_GET['uuid'];
                $a = $this->wmbr_api->consultarNota($this->uuid);
                $id = $this->ng->consultarChave($this->chave);
                $this->ng->updateStatus($id['id'],$a["status"]);
                $this->alerta("Status da nota: ".$a["status"]);
                $this->tabela();
            }catch(\Exception $e){
                echo $e;
            }
        }

        public function cancelarNota(){
            try{
                $this->chave = $_GET['chave'];
                $a = $this->wmbr_api->cancelarNota($this->chave);
                array_key_exists( "error",$a) ? $error =true: $error = false;

                $this->alerta("Nota Cancelada com sucesso");

                $this->tabela();
                if($error){
                    return $a["error"];
                }else{
                    $id = $this->ng->consultarChave($this->chave);
                    $this->ng->updateStatus($id['id'],"cancelada");
                }
            }catch(\Exception $e){
                echo $e;
            }
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

        public function verNota(){
            $this->tabela();
        }

        private function alerta($mensagem){
            $alerta = file_get_contents('App/View/partes/alerta.html');
            $alerta = str_replace('{mensagem}',$mensagem,$alerta);
            echo$alerta;
        }
        
        private function tabela(){
            $dados = $this->ng->selectAll();
            $itensTotal ="";
            foreach($dados as $valor ){
                $tabela = file_get_contents('App/View/partes/tabela.html');
                $tabela = str_replace('{id}',$valor['id'], $tabela);
                $tabela = str_replace('{uuid}',$valor['uuid'], $tabela);
                $tabela = str_replace('{chave}',$valor['chave'], $tabela);
                $tabela = str_replace('{status}',$valor['status'], $tabela);
                $itensTotal .= $tabela;
            }
            $this->html = str_replace('{itens}',$itensTotal, $this->html );
        }        

        public function show(){
            $this->load();
            print $this->html;
        }

    }

?>
    