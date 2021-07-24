<?php 
    namespace App\Notificacao;

    class Notificacao {
        private static $tabela = 'notificacao';

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