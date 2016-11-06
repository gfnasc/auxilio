# Auxilio v1.0a #
=======

Software destinado a farmácias para controle de estoque.

## Instalação ##

* Clonar repositório

```
git@bitbucket.org:fishweb/auxilio.git

```

* Baixar dependências do Composer

```
composer install

```

* Baixar dependências do Bower

```
bower install

```

* Importar o arquivo do banco de dados no MySQL: app/config/bd_auxilio.sql


* Configurar parâmetros do Symfony em **parameter.yml**

```
#!yml

parameters:
    database_host: 127.0.0.1
    database_port: null
    database_name: bd_auxilio
    database_user: root
    database_password: adm456
```

* Executar a aplicação


```
php bin/console server:run

```