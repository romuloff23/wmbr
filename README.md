# Desafio WMBR

### Desafiado: Rômulo F. Farias

 desafio da API:

- [x] Emitir Nota Fiscal 

- [x] Consultar Nota Fiscal 

- [x] Cancelar Nota Fiscal 

- [x] Validade Certificado A1
- [x]  Status Sefaz
- [x]  Impostos na API 
- [x]  Recepcionar Notificações 

##### Configuração basica

###### Tecnologia de Desenvolvimento:

​				Linguagem: **PHP**

​				Gerenciador de pacotes: **Composer**

###### Configuração do Sistema:

Diretorios do sistema

* App
*  App/Models
*  App/Services
* App/View

O diretorio Models contem o arquivo **Notificacao.php** , com a classe responsavle por inserir e listar as notificações recebidas pela API.

 O diretorio Service contem os arquivos **Wmbr_api.php** e **NotificacaoService**. A classe   **Wmbr_api** é responsavel por acomunicar com a API e realizar as operações. A classe **NotificacaoService** é responsavel por receber o POST da notificação e salvar os dados recebido no banco de dados.

O diretorio View contem os arquis HTML servindo como front-end da aplicação.

Arquivos do sistema

* index.php

* config.php

* .htaccess

* composer.json

* composer.lock

  O arquivo **index.php** é responsavel por gerenciar o funcionamento da aplicação com base na URL.

  O arquivo **config.php** possui as credenciais da API e configurações do banco de dados

  O arquivo **.htaccess** capitura a URL e bloquei o acesso de arquivos não permitidos.

  Os arquivos **composer.json** e **composer.lock** são arquivos padrões do composer. 

