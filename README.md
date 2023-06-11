## Blog Symfony

Projeto feito em Symfony Framework para fins de aprendizado e treinamento.

### Instalação: 

* Você precisará do PHP instalado em seu computador, [BAIXE AQUI](https://www.php.net/downloads). 
* Na raiz do projeto use o comando `composer install && npm install`. 
* No arquivo `.env` ou `.env.local`:
```
DATABASE_URL="mysql://USUARIO:SENHA@127.0.0.1:3306/symfony?serverVersion=5.7"

MAILER_DSN=RECOMENDO USAR O MAILTRAP
```
**OBS:** Não esqueça de alterar o email na função `resgiter` do `RegistrationController.php`

### Propagar o banco
Existem duas formas, você pode usar os comandos:
```
php bin/console app:add-categories
php bin/console app:add-news
```
ou
```
php bin/console doctrine:fixtures:load
```
O primeiro cria os dados através dos `commands` e o segundo através das `factory/fixtures`.