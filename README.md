## Setup Local (Manual)

Para garantir a execução correta da API no ambiente local, siga as etapas:

### Crie o banco de dados usando docker

```bash
docker run --name academia -e POSTGRESQL_USERNAME=admin -e POSTGRESQL_PASSWORD=admin -e POSTGRESQL_DATABASE=academia_api -p 5432:5432 bitnami/postgresql
```

#### Conecte com o dbeaver para visualizar os dados - opcional

No DBeaver, vá para "Nova Conexão", escolha "PostgreSQL", avance para a próxima aba e insira as credenciais conforme definido no comando de criação do banco de dados. Teste a conexão e conclua o processo.

##

### Clone o projeto

```bash
cd "caminho/da/sua/pasta"
git clone https://github.com/DEVinHouse-Zucchetti/M3P-BackEnd
cd "M3P-BackEnd"
code ./ #Abrirá o Vscode na raiz do projeto
```

### Instale as dependências do projeto

```bash
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

## Executando os Testes Unitários

Para executar os testes, é necessário habilitar o SQLite em memória e executar o comando. Todas as configurações já estão feitas, incluindo o X-debug.

### Habilitação para utilização de sqlite em memoria

No arquivo phpunit.xml, habilite as seguintes linhas:

```xml
<env name="DB_CONNECTION" value="sqlite" />
<env name="DB_DATABASE" value=":memory:" />
```

### Execute o comando para rodar os testes

```bash
docker compose exec php php artisan test --coverage
```

### Desativação da Virtualização

Para interromper o processo e garantir que não continue em execução em segundo plano, é necessário desativar a virtualização. Isso pode ser feito utilizando o seguinte comando:

```sh
docker compose down
```

Atenção, se esse comando for executado, será necessário refazer o build do sistema.
