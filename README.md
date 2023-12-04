## Notas Api

Este projeto foi desenvolvido para o processo seletivo de Desenvolvedor Back-end na Azapfy.
Consiste em rotas api para a criação de notas fiscais, utilizando autenticação Sanctum, filas de processamento e envio de notificação por e-mail.


## Como executar o projeto:

Certifique-se de estar com o Docker Desktop e o WSL2 instalados em sua máquina. Recomendo utilizar a distribuição Ubuntu 22.04 LTS.<br>
Certifique-se também se estar com as chaves ssh e conta github configuradas.

Clone o repositório em um diretório de sua escolha na distribuição linux: <br>
`` git@github.com:HannanZikan/notas-api.git ``

Execute as imagens do Docker: <br>
`` ./vendor/bin/sail up -d ``

Acesse o container do laravel:
`` docker exec -it notas-api-latavel.test1 bash``

Execute o comando `` composer install `` para instalar todas as dependências do projeto.

Execute o comando ``php artisan maigrate --seed`` para executar as migrations e criar as tabelas do banco de dados e popular o banco com dados de exemplo.

Agora o projeto está instalado e rodando em sua máquina!

## Rotas API

No diretório raiz do projeto, existe o arquivo notas-api.postman_collection.json, nele está todo o workslace criado no Postman para o envio de requisições para as rotas api do projeto.
Neste ecopo, existe uma variável global que é utilizada em todas as rotas que necessitam de autenticação, chamada ``bearer_token``. Após realizar login com algum usuário, certifique-se atribui-la o valor do token retornado na rota /login para que as demais rotas funcionem corretamente

## Login



### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
