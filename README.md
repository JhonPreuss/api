## Instalação

A arquitetura é desenvolvida utilizando o framework Laravel.
Para utilizar o sistema, é preciso ter instalado o ambiente com as seguintes configurações:

```sh
php: "^7.3|^8.0",
laravel/framework: "^8.12",
MySQL Server: "^5.7",
Apache: "^2.4.46",
Composer version: "^2.0.8"
cURL: "^7.70.0",
```
Ao clonar o diretório, utilizae o comando  composer para instalar as dependencias dos diretórios
```sh
composer:install
artisan migrate
```
Para instanciar as configurações do banco de dados, primeiramente é editar o arquivo ".env" alterando os campos de DB_DATABASE, DB_USERNAME, DB_PASSWORD. 

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=*base*
DB_USERNAME=root
DB_PASSWORD=
```
Em sequencia execute o comando artisan para criar as tabelas referenciadas pelas migrations 
```sh
artisan migrate
```

## Execução

O sistema funciona com base nos dados da tabela cities,  aonde será consultado na api OpenWeathers, passando por parâmetro as coordenadas de latitude e longitude.
Para consumir o serviço OpenWeather via arquitetura desenvolvida, é preciso utilizar a ferramenta curl e passar uma url previamente definida.
Entre as opões de url é possivel passar por parâmetro um id que referencia a cidade que se deseja consultar os dados metereoógicos ou consultar todas as cidades que possuem as coordenadas gravadas no banco.

## Exemplo de utilização

Consultar todas cidades cadastradas:

```sh
curl http://127.0.0.1:8000/api/cities
```
Resposta
```sh
StatusCode        : 200
StatusDescription : OK
Content           : [{"id":1,"name":"Santa Maria","latitude":"-29.6841666667","longitude":"-53.8069444444","gmt":-3,"created_at":null,"updated_at":null},{"id":2,"name":"Campo
                    Grande","latitude":"-20.4427777778","longitud...
RawContent        : HTTP/1.1 200 OK
                    Connection: close
                    Cache-Control: no-cache, private
                    Date: Tue, 27 Apr 2021 09:33:03 GMT,Tue, 27 Apr 2021 09:33:03 GMT
                    X-Powered-By: PHP/7.4.13
                    Content-Type: a...
Forms             : {}
Headers           : {[Host, 127.0.0.1:8000], [Connection, close], [Cache-Control, no-cache, private], [Date, Tue, 27 Apr 2021 09:33:03 GMT,Tue, 27 Apr 2021 09:33:03 GMT]...}
Images            : {}
InputFields       : {}
Links             : {}
ParsedHtml        : System.__ComObject
RawContentLength  : 515
```
:
Busca na api todas as cidade do banco e grava no banco os dados selecionados
```sh
PS C:\xampp\htdocs\openweather\api> curl http://127.0.0.1:8000/api/getweater/
```
Resposta
```sh
StatusCode        : 200
StatusDescription : OK
Content           : [{"id":1,"name":"Santa Maria","latitude":"-29.6841666667","longitude":"-53.8069444444","gmt":-3,"created_at":null,"updated_at":null},{"id":2,"name":"Campo 
                    Grande","latitude":"-20.4427777778","longitud...
RawContent        : HTTP/1.1 200 OK
                    Host: 127.0.0.1:8000
                    Connection: close
                    Cache-Control: no-cache, private
                    Date: Tue, 27 Apr 2021 12:24:50 GMT,Tue, 27 Apr 2021 12:24:50 GMT
                    X-Powered-By: PHP/7.4.13
                    Content-Type: a...
Forms             : {}
Headers           : {[Host, 127.0.0.1:8000], [Connection, close], [Cache-Control, no-cache, private], [Date, Tue, 27 Apr 2021 12:24:50 GMT,Tue, 27 Apr 2021 12:24:50 GMT]...}
Images            : {}
InputFields       : {}
Links             : {}
ParsedHtml        : System.__ComObject
RawContentLength  : 515
```

Busca na api a cidade referida pelo id do banco e grava no banco os dados selecionados
```sh
PS C:\xampp\htdocs\openweather\api> curl http://127.0.0.1:8000/api/getweater/1
```
Resposta
```sh
StatusCode        : 200
StatusDescription : OK
Content           : [{"id":1,"name":"Santa Maria","latitude":"-29.6841666667","longitude":"-53.8069444444","gmt":-3,"created_at":null,"updated_at":null},{"id":2,"name":"Campo 
                    Grande","latitude":"-20.4427777778","longitud...
RawContent        : HTTP/1.1 200 OK
                    Host: 127.0.0.1:8000
                    Connection: close
                    Cache-Control: no-cache, private
                    Date: Tue, 27 Apr 2021 12:24:50 GMT,Tue, 27 Apr 2021 12:24:50 GMT
                    X-Powered-By: PHP/7.4.13
                    Content-Type: a...
Forms             : {}
Headers           : {[Host, 127.0.0.1:8000], [Connection, close], [Cache-Control, no-cache, private], [Date, Tue, 27 Apr 2021 12:24:50 GMT,Tue, 27 Apr 2021 12:24:50 GMT]...}
Images            : {}
InputFields       : {}
Links             : {}
ParsedHtml        : System.__ComObject
RawContentLength  : 515
```

Busca uma unica cidade pelo id
```sh
PS C:\xampp\htdocs\openweather\api> curl http://127.0.0.1:8000/api/cities/1
```
Resposta
```sh
StatusCode        : 200
StatusDescription : OK
Content           : {"id":1,"name":"Santa Maria","latitude":"-29.6841666667","longitude":"-53.8069444444","gmt":-3,"created_at":null,"updated_at":null}
RawContent        : HTTP/1.1 200 OK
                    Host: 127.0.0.1:8000
                    Connection: close
                    Cache-Control: no-cache, private
                    Date: Tue, 27 Apr 2021 12:26:27 GMT,Tue, 27 Apr 2021 12:26:27 GMT
                    X-Powered-By: PHP/7.4.13
                    Content-Type: a...
Forms             : {}
Headers           : {[Host, 127.0.0.1:8000], [Connection, close], [Cache-Control, no-cache, private], [Date, Tue, 27 Apr 2021 12:26:27 GMT,Tue, 27 Apr 2021 12:26:27 GMT]...}
Images            : {}
InputFields       : {}
Links             : {}
ParsedHtml        : System.__ComObject
RawContentLength  : 131
```

#### Outras funções da API

Além de consulta é possivel realizar o cadastro, update e delete de cidades pela api. a conversão do corpo da requisição pode variar de acordo com o sistema de conversão de strings usado pelo terminal.


Cadastro exemplo.
```sh
curl -X POST http://127.0.0.1:8000/api/cities -H "Content-Type: application/json" -d '{"name":"São Pedro do Sul","latitude":"-29.6841666667","longitude":"-53.8069444444","gmt":-3}'

```

Update de dados

```sh
curl -X PUT http://127.0.0.1:8000/api/cities/6 -H "Content-Type: application/json" -d '{"name":"São Pedro do Sul","latitude":"-29.6841666667","longitude":"-53.8069444444","gmt":-3}'
```

Delete
```sh
curl -X DELETE http://127.0.0.1:8000/api/cities/5
```





<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
