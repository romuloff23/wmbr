<?php
    namespace App\Wmbr_api;

    class WMBR_API {
        private $erro = false;
        private $resultado;

        public function request($endpoint='',$dado,$post,$put){
            $url = URL . $endpoint;
            //curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  'PUT');
            $ch = curl_init();
            $auth = array(
                'Cache-Control: no-cache',
                'Content-Type:application/json',
                'X-Consumer-Key: '.Consumer_Key,
                'X-Consumer-Secret: '.Consumer_Secret,
                'X-Access-Token: '.Access_Token,
                'X-Access-Token-Secret: '.Access_Token_Secret
            );
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, $post);
            curl_setopt($ch,CURLOPT_HTTPHEADER,$auth);
            if(is_array($dado)){
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dado));
            }
            if($put){
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  'PUT');
            }
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                $this->erro = true;
                $this->resultado = curl_error($ch);
            }else{
                $this->erro = false;
                $this->resultado = json_decode($response);
            }
        }

        public function StatusSefaz(){
            $this->request('1/nfe/sefaz/',null,false,false);
            if(!$this->erro){
                return $this->resultado;
            }else{
                return "erro inesperado";
            }
        }

        public function emitirNota(){
            $dado = array(
                "ID"=> 45456,
                "url_notificacao"=> "https://cov.sout.net.br/notificacaoService",
                "operacao"=> 1,
                "natureza_operacao"=> "Venda de produção do estabelecimento",
                "modelo"=> 1,
                "finalidade"=> 1,
                "ambiente"=> 1,
                "cliente" => array(
                    "cpf"=> "047.198.432-98",
                    "nome_completo"=> "Nome do Cliente",
                    "endereco"=> "Av. Brg. Faria Lima",
                    "complemento"=> "Escritório",
                    "numero"=> 1000,
                    "bairro"=> "Itaim Bibi",
                    "cidade"=> "São Paulo",
                    "uf"=> "SP",
                    "cep"=> "00000-000",
                    "telefone"=> "(00) 0000-0000",
                    "email"=> "nome@email.com"
                ),
                "produtos"=> array( 
                    array(              
                        "nome" => "Nome do produto",
                        "codigo"=> "nome-do-produto",
                        "ncm"=> "6109.10.00",
                        "cest"=> "28.038.00",
                        "quantidade"=> 3,
                        "unidade"=> "UN",
                        "peso"=> "0.800",
                        "origem"=> 0,
                        "subtotal"=> "44.90",
                        "total"=> "134.70",
                        "tributos_federais"=> "13.25",
                        "tributos_estaduais"=> "8.00",
                        "impostos" =>array(
                            "icms" => array (
                                "codigo_cfop"=> "5.102",
                                "situacao_tributaria"=> "102"
                            ),
                            "ipi" => array(
                                "situacao_tributaria"=> "99",
                                "codigo_enquadramento"=> 999,
                                "aliquota"=> "0.00"
                            ),
                            "pis"=> array(
                                "situacao_tributaria"=> "99",
                                "aliquota"=> "0.00"
                            ),
                            "cofins"=> array(
                                "situacao_tributaria"=> "99",
                                "aliquota"=> "0.00"
                            ),

                        ),
                    ),
                    array(
                        "nome"=> "Nome do produto",
                        "codigo"=> "nome-do-produto",
                        "ncm"=> "6109.10.00",
                        "cest"=> "28.038.00",
                        "quantidade"=> "1",
                        "unidade"=> "UN",
                        "peso"=> "0.200",
                        "origem"=> 0,
                        "subtotal"=> "29.90",
                        "total"=> "29.90",
                        "tributos_federais"=> "13.25",
                        "tributos_estaduais"=> "8.00",
                        "impostos" =>array(
                            "icms" => array (
                                "codigo_cfop"=> "5.102",
                                "situacao_tributaria"=> "102"
                            ),
                            "ipi" => array(
                                "situacao_tributaria"=> "99",
                                "codigo_enquadramento"=> 999,
                                "aliquota"=> "0.00"
                            ),
                            "pis"=> array(
                                "situacao_tributaria"=> "99",
                                "aliquota"=> "0.00"
                            ),
                            "cofins"=> array(
                                "situacao_tributaria"=> "99",
                                "aliquota"=> "0.00"
                            ),

                        ),
                    ),
                ),
                "pedido"=> array(
                    "pagamento"=> 0,
                    "presenca"=> 2,
                    "modalidade_frete"=> 0,
                    "frete"=> "12.56",
                    "desconto"=> "10.00",
                    "total"=> "174.60"
                )
            );
            $this->request('1/nfe/emissao/',$dado,true,false);
            if(!$this->erro){
                return $this->resultado;
            }else{
                return "erro inesperado";
            }
        }
        public function consultarNota(){
            $uuid = array('uuid'=> 'da74b795-fbe6-439e-b70b-d1b9d058b050');
            $this->request('1/nfe/consulta/',$uuid,false,false);
            if(!$this->erro){
                return $this->resultado;
            }else{
                return "erro inesperado";
            }
        }
        public function cancelarNota(){
            $dado =  array(
                "chave"=> "00000000000000000000000000000000000000000000", 
                "motivo"=> "Cancelamento por motivos administrativos."
            );
            $this->request('1/nfe/cancelar/',$dado,false,true);
            if(!$this->erro){
                return $this->resultado;
            }else{
                return "erro inesperado";
            }
        }

        public function validadeA1(){
            //1/nfe/certificado/
            $this->request('1/nfe/certificado/',null,false,false);
            if(!$this->erro){
                return $this->resultado;
            }else{
                return "erro inesperado";
            }
        }

    }