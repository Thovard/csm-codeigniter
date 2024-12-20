# **Guia de Instalação do Projeto**

Este guia explica como configurar e rodar o projeto em seu ambiente local.

---

## **1. Clonar o Repositório**

Clone o repositório do projeto para o seu ambiente local:

```bash
git clone https://github.com/Thovard/csm-codeigniter.git
cd csm-codeigniter
```

## **2. Configurar o Ambiente**
2.1. Configurar o Arquivo .env
Copie o arquivo .env.example para um novo arquivo chamado .env:

```bash
cp .env.example .env
```
Abra o arquivo .env e configure as variáveis de ambiente necessárias, como as credenciais do banco de dados:
```env
database.default.hostname = localhost
database.default.database = [NOME_DO_BANCO]
database.default.username = [USUARIO_DO_BANCO]
database.default.password = [SENHA_DO_BANCO]
database.default.DBDriver = MySQLi
```
Caso for usar o bando PostgreSQL, altere o driver para PostgreSQL e adicione esses campos:

```env
database.default.DBDriver = Postgre
database.tests.charset = utf8
```


---

## **3. Instalar Dependências**
Certifique-se de ter o Composer instalado. Em seguida, instale as dependências do projeto:

```bash
composer install
```

---

## **4. Executar as Migrations**
As migrations criam as tabelas necessárias no banco de dados. Execute o comando abaixo para rodar as migrations:

```bash
php spark migrate
```

---

## **5. Executar os Seeders**
Os seeders populam o banco de dados com dados iniciais. Execute o comando abaixo para rodar os seeders:

```bash
php spark db:seed DatabaseSeeder
```

Usuário Padrão do Sistema
Após rodar os seeders, o sistema criará um usuário padrão com as seguintes credenciais:

Email: admin@example.com
Senha: admin123

## **6. Subir o Servidor**
Inicie o servidor local do CodeIgniter com o comando abaixo:

```bash 
php spark serve
```
Por padrão, o servidor estará disponível em:

```bash
http://localhost:8080
```

---

## **7. Acessar o Sistema**
Abra o navegador e acesse:

```bash
http://localhost:8080
```
Use as credenciais do usuário padrão para fazer login no sistema.

---

## **8. Estrutura do Projeto**
Controllers: Contém os controladores da aplicação.

Models: Contém os modelos de dados.

Views: Contém as views da aplicação.

Database: Contém as migrations e seeders.

Public: Contém os arquivos públicos (CSS, JS, imagens).
