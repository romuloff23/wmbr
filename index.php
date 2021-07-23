<?php
require_once "vendor/autoload.php";
use App\Wmbr_api\WMBR_API;
use App\NotificacaoService\NotificacaoService;
use App\Home\Home;


    if($_GET['url']){
        $url = explode("/",$_GET['url']);
        $class = ucfirst(strtolower($url[0]));
        $classe = '\App\\'.$class.'\\'.$class; 
        array_shift($url);
        $method = isset($url[0]) ? $url[0] : null;
        if(class_exists($classe)){
            $pagina = new $classe($url[0]);
            if(!empty($method) AND (method_exists($classe, $method)) ){
                $pagina->$method($url[0]);
            }
            $pagina->show();
        }else{
            http_response_code(404);
            echo"404<br>";
        }
    }else{
        $teste = new WMBR_API;
        //$teste->StatusSefaz();
        $teste->emitirNota();
        //$teste->consultarNota();
        //$teste->cancelarNota();
        //$teste->validadeA1();
        //$pagina = new Home();
        //$pagina->show();
    }
    

    