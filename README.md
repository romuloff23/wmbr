# Desafio WMBR

### Desafiado: Rômulo F. Farias

 desafio da API:

- [x] Emitir Nota Fiscal 
- [x] Consultar Nota Fiscal 
- [x] Cancelar Nota Fiscal 
- [x] Validade Certificado A1
- [x] Status Sefaz
- [x] Impostos na API 
- [x] Recepcionar Notificações 

##### Funcionamento do sistema

O sistema é navegavel, no menu pode-se escolher qual ação o sistema deve execultar. A primeira opção **“Gerar nota fiscal”** envia um dado estático pré definido na classe Wmbr_api para a API, o retorno deste dado é tratado, e seu **uuid**, **chave**, **status** são salvos no banco e listados na tela. Uma mensagem notifica ao usuário que tudo ocorreu da maneira correta.

A segunda opção **"Ver nota"** consulta a tabela no banco de dados e lista todos das as notas emitidas, exibindo o seu **uuid**, **chave** e seu **status**

A terceira opção **”Status Sefaz”** faz uma chamada na API e retorna se a Sefaz está online ou offline, esta informação é exibida através de um alerta.

A última opção é **”Validade Certificado A1”**, ela consulta a API enviando as credenciais e o dado de quanto tempo as mesmas ainda vale em dias, este dado é informado em um alerta.

Tabela, na tabela temos dois links para ação, o primeiro link **”consultar”** é responsável por fazer a consulta na API e verificar seu status diretamente na API, essa informação é exibida na tela através de um alerta.

O segundo link **”cancelar”** tem como ação o cancelamento da nota fiscal, os dados são enviados para a API sua resposta é tratada e exibida na tela através de um alerta.

##### Configuração basica

###### Tecnologia de Desenvolvimento:

​				Linguagem: **PHP**

​				Front-end: **Bootstrap**

​				Gerenciador de pacotes: **Composer**

###### Configuração do Sistema:

Diretorios do sistema

* App
*  App/Models
*  App/Services
* App/View

O diretório Models contém o arquivo **Notificacao.php** , com a classe responsável por inserir e listar as notificações recebidas pela API. Contém **NotasGeradas.php** classe responsável pelo CRUD das notas fiscais usando **PDO** e o arquivo **Wmbr_api.php** que contém a classe responsável por integrar com a API e retornar os dados para os Services.

O diretório Service contém os arquivos **Home.php** , **NotificacaoService.php** e **WmbrServices.php** . A classe  **Home** é responsável por renderizar a interface inicial do sistema (arquivo HTML no diretório View), exibindo o menu de navegação. A classe **NotificacaoService** é responsável por receber o POST da notificação e salvar os dados recebidos no banco de dados. A classe **WmbrServices** faz a comunicação com a Wmbr_api trata os dados e renderizar seus componentes no arquivo HTML **wmbr**.

O diretório View contém os arquivos HTML servindo como front-end da aplicação.

Arquivos do sistema

* index.php

* config.php

* .htaccess

* composer.json

* composer.lock

  O arquivo **index.php** é responsável por gerenciar o funcionamento da aplicação com base na URL.

  O arquivo **config.php** possui as credenciais da API e configurações do banco de dados

  O arquivo **.htaccess** captura a URL e bloqueia o acesso de arquivos não permitidos.

  Os arquivos **composer.json** e **composer.lock** são arquivos padrões do composer.

