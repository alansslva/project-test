# Documentação

## Instalação

1. É necessario possuir docker.io e docker-compose instalados
* `docker network create project-network`
* `docker compose up -d`
* `docker exec -it project-php cp .env.example .env`
* `docker exec -it project-php composer install`
* `docker exec -it project-php php artisan key:generate`
* `docker exec -it project-php php artisan migrate`

## Pontos de atenção

1. Como não sera avaliado nenhum tipo de auteticação foi implementada
2. Todas as rotas estão com o controle CSRF desligado
3. Como foi apontado, apesar de usar o framework Laravel, algumas das tarefas estão feitas sem ajuda do framework para demonstração do código (Por exemplo a ausencia de FormRquests)
4. Como não foi solicitado não foi realizado um tratamento para salvar as tentativas falhas de criação de usuario ou de transações

## Arquitetura

1. A solução parte de uma arquitetura hexagonal utilizando DDD
2. A camada da aplicação fica separada dentro da pasta app, e possuí todas as classes necessarias para interagir com o mundo externo (Controllers / Requests / Middlewares)
3. Na camada de infra temos os modulos comuns e reaproveitaveis ao sistema (Usuarios)
4. Na camada de dominio temos as operaçòes mais sensíveis ao dominio do projeto (Transações)
5. Todos os modulos contam com Creators, Builders, Dtos, Repositories, Entities, Services
6. Cada serviço tem apenas uma responsabilide
7. As integrações externas podem ser encontradas na pasta Infra/common

## Proposta de melhoria arquitetura

1. Repensar a separaçào do Creator de transações com o Serviço de movimentação, por ser uma responsabilidade da movimentação checar o saldo do usuario antes de efetivar a transação de fato, estamos demorando muito para disparar essa Exception que poderia ser validada ja na criação da transação
2. Uma tabela de contas ajudaria a controlar melhor esse fluxo, mas não cabia no escopo da proposta
3. Repensar a posição do modulo de usuarios, dentro ou fora do dominio 

## Testes

1. Foram realizados testes basicos com o objetivo de garantir a integridade da aplicação e demonstrar conhecimento como forma de exemplo, não há 100% de cobertura
2. Os testes podem ser encontrados na pasta /tests na raiz do projeto
3. Para executa-los utilizar o comando `docker exec -it project-php ./vendor/bin/phpunit`


## Utilização

### Há um seeder pronto para inserção de 10 usuarios para teste através do comando `docker exec -it project-php php artisan db:seed`

Caso queira inserir seus proprios usuarios utilizar fluxos da api


| Tipo | Rota         | Descricão                            | Payload                                                                                                                            | Respostas                                             |
|------|--------------|--------------------------------------|------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------|
| POST | /user        | Cadastra Novo Usuario                | `{ "name": "example", "document": "example", "email" : "example", "password" : "example", "value": "example", "type": "example" }` | 204 Created / 400 Bad Request / 409 Usuario ja existe |
| GET  | /user        | Lista de usuarios                    |                                                                                                                                    | 200 Sucess / 500 error                                |
| POST | /transaction | Realiza uma transação entre usuarios | `{ "value" : 50.00, "payer" : 1, "payee" : 3}`                                                                                     | 200 Success / 400 Bad Request / 401 Unauthorized      | 


A listagem de usuarios traz no formato Hateoas as relações transacionais daquele usuario assim como saldo inicial e final

