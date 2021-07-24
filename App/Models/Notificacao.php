<?php 
    namespace App\Notificacao;

    class Notificacao {

        /**
        *   Esta classe é responsavel por salvar e listar 
        *   As notificações recebidas pela API
        *
        *
        *   @author Rômulo F. Farias <romuloff23@gmail.com>
        *   @access private
        */

        private static $tabela = 'notificacao';

        /** 
        * Metodo para salvar mensagem recebida da API
        * @access private 
        * @param string $mensagem
        * @return array 
        */

        public static function insarteNotificacao($mensagem){
            $connPdo = new \PDO(DBDRIVE.':host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
            $sql = "INSERT INTO ".self::$tabela." (mensagem) VALUE( :mensagem)";
            $stmt = $connPdo->prepare($sql);
            $stmt->bindParam(':mensagem',$mensagem);
            if($stmt->execute()){
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }else{
                throw new \Exception("Erro ao salvar dados!");
            }
        }

        /** 
        * Metodo para listar as mensagens recebidas da API
        * @access private 
        * @return array 
        */

        public static function selectAll(){
            $connPdo = new \PDO(DBDRIVE.':host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
            $sql = 'SELECT * FROM '.self::$tabela;
            $stmt = $connPdo->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount() > 0 ){
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }else{
                throw new \Exception("Sem usuario no banco");
            }
        }

    }