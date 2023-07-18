# Installation

Getting Stared With Laravel on macOS.  
There are Two ways you can start your development:

+ Laravel Valet
+ Docker Desktop

## Laravel Valet

Requirements
+ PHP: 8.1 or greater
+ Composer: 2.5 greater
+ My SQL
+ git

### How you can install php and composer via brew ?

To get started, you first need to ensure that Homebrew is up-to-date using the `update` command:

```bash
brew update
```

Next, you should use Homebrew to install PHP, composer and mysql:

```bash
brew install php composer mysql
```
![](/docs/screenshots/install-php-composer-mysql.png)
### Installing Laravel Valet

After installing PHP, you are ready to install the [Composer package manager](https://getcomposer.org/). In addition, you should make sure the `$HOME/.composer/vendor/bin` directory is in your system's "PATH".

Example:

open your `~/.zshrc` or `~/.bashrc` depending on your terminal and place this line anywhere.

```bash
...
export PATH=$PATH:~/.composer/vendor/bin
...
```

Screen Shot of where to find this file:

![](/docs/screenshots/zshrc-file-path.png)
![](/docs/screenshots/zshrc-file.png)
After Composer has been installed, you may install Laravel Valet as a global Composer package:

```
composer global require laravel/valet
```

Finally, you may execute Valet's `install` command. This will configure and install Valet and Dns Masq. In addition, the daemons Valet depends on will be configured to launch when your system starts:

```
valet install
```

Valet will automatically start its required services each time your machine boots.

### Project Installation

Clone the project

```bash
cd ~/Documents && git clone https://github.com/mumar1052/secure-transfer.git
```

Change dir to project

```bash
cd secure-transfer
```

Install Dependencies

```bash
composer install
```
![](/docs/screenshots/composer-install.png)
Environment Setup:

```bash
cp .env.example .env
```

you will have `.env` file and make sure to make it look like following.

![](/docs/screenshots/.env-file.png)
at this point we are assuming that your mysql instance is running at port `3306` and have username of `root` with blank password.

you can check out by:

```bash
mysql -u root
```

![](/docs/screenshots/mysql-login.png)
if terminal turn into mysql console then we are ready to connect our project to mysql database. `exit;` mysql

Generate Application encryption Key

```bash
php artisan key:generate
```

![](/docs/screenshots/key-generate.png)
Migrate tables into database

```bash
php artisan migrate
```

You will be prompted with:

WARN  The database 'secure-transfer' does not exist on the 'mysql' connection.  
 **Would you like to create it?** (yes/no) [yes]

Reply with `yes` or `y` to create database as if it has not been created.
![](/docs/screenshots/migration.png)
Generate Fake Data to login

```bash
php artisan db:seed
```

![](/docs/screenshots/db:seed.png)
Now link you project with valet to served over the test domain

```
valet link
```
![](/docs/screenshots/valet:link.png)
Now you can access your project in the browser at `{{your-project-name}}.test`
which will be `secure-transfer.test` and admin will be at `secure-transfer.test/admin`

You can log in to admin via these credentials

Email : admin@gmail.com
Pass: password
