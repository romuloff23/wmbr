<?php
    namespace App\NotasGeradas;
    class NotasGeradas{


        /**
        *   Esta classe para CRUD das notas fiscais
        *   emitidas
        *
        *
        *   @author Rômulo F. Farias <romuloff23@gmail.com>
        *   @access private
        */

        private static $tabela = 'notasGeradas';


        /** 
        * Metodo para salvar nota emitida
        * @access private 
        * @param string $uuid
        * @param string $chave
        * @param string $status
        * @return array 
        */

        public static function insarteNota($uuid,$chave,$status){
            $connPdo = new \PDO(DBDRIVE.':host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
            $sql = "INSERT INTO ".self::$tabela." (uuid, chave, status) VALUES( :uuid, :chave, :status )";
            $stmt = $connPdo->prepare($sql);
            $stmt->bindParam(':uuid',$uuid);
            $stmt->bindParam(':chave',$chave);
            $stmt->bindParam(':status',$status);
            if($stmt->execute()){
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }else{
                throw new \Exception("Erro ao salvar dados!");
            }
        }
       
        /** 
        * Metodo para atualizar o status da nota
        * @access private 
        * @param string $id
        * @param string $status
        * @return array 
        */

        public static function updateStatus($id,$status){
            $connPdo = new \PDO(DBDRIVE.':host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
            $sql = "UPDATE ".self::$tabela." SET status= :status WHERE id=:id ";
            $stmt = $connPdo->prepare($sql);
            $stmt->bindParam(':status',$status);
            $stmt->bindParam(':id',$id);
            if($stmt->execute()){
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }else{
                throw new \Exception("Erro ao atualizar Status!");
            }
        }
         

        /** 
        * Metodo para consultar uma chave na tabela
        * @access private 
        * @param string $chave
        * @return array 
        */

        public static function consultarChave($chave){
            $connPdo = new \PDO(DBDRIVE.':host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
            $sql = "SELECT id FROM ".self::$tabela." WHERE chave LIKE :chave ";
            $stmt = $connPdo->prepare($sql);
            $stmt->bindParam(':chave',$chave);
           
            if($stmt->execute()){
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }else{
                throw new \Exception("Erro ao consultar chave");
            }
        }

        /** 
        * Metodo para listar todos os dados da tabela
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