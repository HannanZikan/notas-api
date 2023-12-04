## Notas Api

Este projeto foi desenvolvido para o processo seletivo de Desenvolvedor Back-end na Azapfy.
Consiste em rotas api para a criação de notas fiscais, utilizando autenticação Sanctum, filas de processamento e envio de notificação por e-mail.


## Como executar o projeto:

Certifique-se de estar com o Docker Desktop e o WSL2 instalados em sua máquina. Recomendo utilizar a distribuição Ubuntu 22.04 LTS.<br>
Certifique-se também se estar com as chaves ssh e conta github configuradas.

Clone o repositório em um diretório de sua escolha na distribuição linux: <br>
`` git@github.com:HannanZikan/notas-api.git ``

Copie o arquivo ``.env.example`` e cole com o nome ``.env`` para criar as variáveis de ambiente.

Execute as imagens do Docker: <br>
`` ./vendor/bin/sail up -d ``

Acesse o container do laravel:
`` docker exec -it notas-api-latavel.test1 bash``

Execute o comando `` composer install `` para instalar todas as dependências do projeto.

Execute o comando ``php artisan maigrate --seed`` para executar as migrations e criar as tabelas do banco de dados e popular o banco com dados de exemplo.

Para testar o envio de e-mail, utilize a ferramenta https://mailtrap.io/. Na aba Email Testing, acesse Inboxes e acesse a inbox já criada.<br>
Na aba MYInbox, selecione a aba SMTP Settings e em Integrations, selecione Laravel 9+ e copie os valores informados.
Exemplo:
MAIL_MAILER=smtp<br>
MAIL_HOST=sandbox.smtp.mailtrap.io<br>
MAIL_PORT=2525<br>
MAIL_USERNAME=************** <br>
MAIL_PASSWORD=************** <br>

Agora o projeto está instalado e rodando em sua máquina!

## Rotas API

No diretório raiz do projeto, existe o arquivo notas-api.postman_collection.json, nele está todo o workslace criado no Postman para o envio de requisições para as rotas api do projeto.
Neste ecopo, existe uma variável global que é utilizada em todas as rotas que necessitam de autenticação, chamada ``bearer_token``. Após realizar login com algum usuário, certifique-se atribui-la o valor do token retornado na rota /login para que as demais rotas funcionem corretamente

## Login

Por padrão, ao executar as migrations será gerado o usuário Azapfy, que pode ser utilizado para testar as rotas sem a necessidade de criar um novo. Mas também pode ser criado um novo usuário pela rota /signup.
Dados desse usuário:
    - e-mail: azapfy@emai.com
    - senha: password

São gerados mais 10 usuários, possuindo notas fiscais aleatoriamente. Todos são gerados através de Factories, então é necessário verificar o email fake atribuído. Porém todos são gerados com a senha password.

## Meu contato

Qualquer dúvida ou feedback fique a vontade para entrar em contato comigo, através do e-mail hannanczikan@gmail.com ou no whatsapp informado no cadastro da candidatura.
