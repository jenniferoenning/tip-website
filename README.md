# Tip - Transforming your idea into post
-----------------------
## Como instalar o ambiente Laravel com Laradock

- Para este projeto, estou considerando que você já instalou o Docker, o Docker Compose, Php, Git, e também o Laradock.

### Instale o Laradock

Clone o projeto laradock na sua máquina. Minha pasta raiz é ~/Projetos:
```
$ cd ~/Projetos
$ git clone https://github.com/Laradock/laradock.git
```

Entre na pasta laradock e renomeie o arquivo env-example para .env:
```
$ cd laradock/
$ cp env-example .env
```
Logo, iremos iniciar os containers que vamos utilizar:

```
docker-compose up -d nginx phpmyadmin mariadb workspace
```
Vamos criar agora nosso projeto laravel, antes iremos ver os containers:

```
docker container ls
```
Logo, iremos agora utilizar este container:

```
docker container exec -it laradock_workspace_1 bash
```

Ainda no dentro do container "workspace" iremos criar nosso projeto:
```
# composer create-project laravel/laravel tip-website
```

Depois de criado o projeto, iremos dar permissão para nosso arquivo para conseguir mexer com nosso usuário normalmente:

```
# cd tip-website
# chmod -R 777 storage bootstrap/cache
```

Saia do bash e configure o dono da pasta do projeto. No exemplo a seguir, jenni é o nome do meu usuário na máquina host:
```
$ sudo chown -R jenni:www-data tip-website/
```

## Projeto criado!
--------------------------

## Agora precisamos configurar o DNS local para o projeto

```
// na máquina host
$ cd ~/Projetos/laradock/nginx/sites/
$ cp laravel.conf.example tip-website.conf
```

Edite o arquivo .conf:
```
$ sudo nano tip-website.conf
```

O que precisamos mudar é o server_name e root apenas - veja que  o root mostra o caminho que estávamos dentro do container! :)

```
// tip-website.conf
server {
    listen 80;
    listen [::]:80;
    
    server_name tip-website.test;
    root /var/www/tip-website/public;
    index index.php index.html index.htm;
...
```

Na máquina, reinicie os containers do laradock para que a mudança faça efeito:

```
$ cd ~/Projetos/laradock/
$ docker-compose restart
```

Adicione uma linha com o server_name no arquivo hosts da máquina host e salve o arquivo:

```
$ sudo nano /etc/hosts
// arquivo /etc/hosts
...
127.0.0.1       tip-website.test
```

Pronto, a parte do site está na sua máquina perfeitamente.

---------------

### Configurações extras pro website

Estaremos usando Jetstream para ter um sistema CRUD

Como instalar Jetstream:
https://jetstream.laravel.com/2.x/installation.html

Em ``` /resources/views/layouts/ ``` nos arquivos ``` app.blade.php ``` e ``` guest.blade.php ``` em ``` scripts ``` você irá substituir as seguintes linhas nos dois arquivos:

```
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
```

Agora em ``` /public/ ``` em ``` mix-manifest.json ``` substitua tudo por:
```
{
    "/js/app.js": "/js/app.js",
    "/css/app.css": "/css/app.css"
}
```
