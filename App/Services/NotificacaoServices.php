<?php
    namespace App\NotificacaoService;
    use App\Notificacao\Notificacao;
    
    class NotificacaoService{
        /**
        *   Esta classe é responsavel por receber as notificações
        *   da API e salvalos no banco de dados
        *
        *
        *   @author Rômulo F. Farias <romuloff23@gmail.com>
        *   @access public
        */
        function show(){

            if(isset($_POST['uuid'])){
                $mensagem = 'UUID'.$_POST['uuid'].
                ' status '.$_POST['status'].
                ' motivo '.$_POST['motivo'].
                ' nfe: '.$_POST['nfe'].
                ' serie '.$_POST['serie'];
                $nt = new Notificacao();
                $nt->insarteNotificacao($mensagem);
            }
        }
    }