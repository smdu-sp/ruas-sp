# Projeto Ruas SP
![Screenshot - Logo Ruas SP](./public/img/logo_ruassp.png?raw=true)


Página de pré-cadastro de bares e restaurantes que participarão do projeto Ruas SP.

---

## Instalação / Setup

1. Clone o repositório

```
git clone https://github.com/smdu-sp/ruas-sp.git
```
<br>

2. Copie o arquivo `.env.example` para `.env` e altere as variáveis de ambiente (`local`/`staging`/`prod`) conforme as especificações do seu servidor (crie um banco de dados exclusivo para a aplicação)

<br>

3. Na pasta do projeto, instale as dependências do Composer
```
composer install
```
<br>

3. Instale as dependências do NPM
```
npm install
```
<br>

4. Gere uma chave de encriptação
```
php artisan key:generate
```
<br>

5. Migre o banco de dados
```
php artisan migrate
```


Pronto! Para executar a aplicação no servidor local (desenvolvimento), execute os comandos 
```
php artisan serve
npm run watch
```
---
## Testes

### Testes unitários e de integração
```
php artisan test
```

### Testes e2e
```
npm run test
```




![Screenshot - Logo da Secretaria Municipal de Urbanismo e Licenciamento da Cidade de São Paulo](./public/img/logo_smul.png?raw=true)

SMUL - Secretaria Municipal de Urbanismo e Licenciamento