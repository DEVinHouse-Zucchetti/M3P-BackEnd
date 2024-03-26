## Setup Local (Manual)

Para garantir a execução correta da API no ambiente local, siga as etapas:

### Crie o banco de dados usando docker

```sh
docker run --name academia -e POSTGRESQL_USERNAME=admin -e POSTGRESQL_PASSWORD=admin -e POSTGRESQL_DATABASE=academia_api -p 5432:5432 bitnami/postgresql
```

#### Conecte com o dbeaver para visualizar os dados - opcional

No DBeaver, vá para "Nova Conexão", escolha "PostgreSQL", avance para a próxima aba e insira as credenciais conforme definido no comando de criação do banco de dados. Teste a conexão e conclua o processo.

##

### Clone o projeto

```sh
cd "caminho/da/sua/pasta"
git clone https://github.com/DEVinHouse-Zucchetti/M3P-BackEnd
cd "M3P-BackEnd"
code ./ #Abrirá o Vscode na raiz do projeto
```

### Instale as dependências do projeto

```sh
composer install
```

##

### Configure o ambiente

Na raiz do projeto, localize o arquivo .env.example, duplique-o e altere seu nome para .env, inicialmente, nenhuma outra alteração é necessária.

### Execute o comando para criar as migrações do banco de dados

```sh
php artisan migrate
```

### Execute a seed para popular o banco de dados

```sh
php artisan db:seed
```

### Execute o comando para criação da APP KEY

```sh
php artisan key:generate
```

### Inicialize o servidor

```sh
php artisan serve
```

## Setup Docker (virtualização do ambiente)

### Clone o projeto

```bash
cd "caminho/da/sua/pasta"
git clone https://github.com/DEVinHouse-Zucchetti/M3P-BackEnd
cd "M3P-BackEnd"
code ./ #Abrirá o Vscode na raiz do projeto
```

### Configure o ambiente

Primeiro, é necessário construir as imagens e criar o banco de dados:

```sh
docker compose up -d --build
```

Em seguida, execute o setup, que inclui a instalação de dependências, criação do arquivo .env, geração da APP KEY, execução das migrações e das seeds:

```sh
docker compose exec php composer setup
```

### Inicialize o servidor

Neste projeto, foi configurado o seguinte comando para facilitar a inicialização:

```sh
composer serve
```

## Finalizando/Reiniciando o servidor e a virtualização

### Supondo que irá fechar o vscode

Utilize o comando abaixo que irá derrubar o servidor e parar o container no docker desktop. Evitando que fique rodando em segundo plano.

```sh
docker compose stop
```

### Supondo que está reabrindo o vscode

Utilize o comando para inicializar a virtualização:

```sh
docker compose up
```

Quando a seguinte frase aparecer: php-1 | [20-Mar-2024 16:56:52] NOTICE: ready to handle connections;

Feche o terminal, abra um novo e rode o comando para inicializar o servidor:

```sh
composer serve
```

##

### Comandos para migrações

Para executar uma nova migração:

```sh
composer migrate
```

Para reverter:

```sh
composer rollback
```

##

### Acessando o bash

Os comandos com composer foram configurados, isto é, são atalhos de comandos maiores. Porém, outro modo de se trabalhar seria acessando o terminal da maquina virtual:

```sh
docker compose exec php bash
```

Aparecerá algo como "root@docker-desktop:/var/www# ", dentro desse terminal você poderá rodar todos os comandos que estamos habituados (php artisan serve, php artisan migrate...).

## Executando os Testes Unitários

Para executar os testes, é necessário habilitar o SQLite em memória e executar o comando. Todas as configurações já estão feitas, incluindo o X-debug.

### Habilitação para utilização de sqlite em memoria

No arquivo phpunit.xml, habilite as seguintes linhas:

```xml
<env name="DB_CONNECTION" value="sqlite" />
<env name="DB_DATABASE" value=":memory:" />
```

### Execute o comando para rodar os testes

Se você fez uma migração nova será necessário atualizar o banco de testes com o seguinte comando:

```sh
php artisan migrate:fresh --seed --env=testing
```

Em seguida, rode o comando de testes:

```sh
docker compose exec php php artisan test --coverage --env=testing
```

##

### Desativação da Virtualização

Para desativar completamente a virtualização, rode o comando:

```sh
docker compose down
```

Atenção, se esse comando for executado, será necessário refazer todo o processo de configuração pois tudo será apagado.

## Erros Comuns

### Erro ao executar seed ou rodar teste - violação da regra de email como null:

Esse problema acontece por conta de cache, a máquina virtual não consegue localizar as credenciais presentes no .env.

Para resolver, comece acessando o bash da máquina virtual:

```sh
docker compose exec php bash
```

Em seguida rode esses 3 comandos na ordem:

```bash
php artisan config:clear
php artisan route:clear
php artisan route:cache
```

O problema será resolvido.

## Desisti de usar docker, como voltar e fazer o setup local?

A única mudança necessária é alterar o arquivo .env:

Altere a configuração atual do db host na linha 12 de :

```php
DB_HOST=db
```

Para:

```php
DB_HOST=127.0.0.1
```

Agora siga o passo a passo para configuração local, pulando a parte da duplicação do env.
