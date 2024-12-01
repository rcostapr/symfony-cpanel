# Symfony 6 CPANEL

## Start Development

```bash
cd cpanel
```

### Start Web Server

```bash
symfony server:start
```

### Change PHP Version to 8.3

```bash
sudo update-alternatives --config php
There are 4 choices for the alternative php (providing /usr/bin/php).

  Selection    Path             Priority   Status
------------------------------------------------------------
  0            /usr/bin/php8.4   84        auto mode
* 1            /usr/bin/php7.4   74        manual mode
  2            /usr/bin/php8.2   82        manual mode
  3            /usr/bin/php8.3   83        manual mode
  4            /usr/bin/php8.4   84        manual mode

Press <enter> to keep the current choice[*], or type selection number: 0
update-alternatives: using /usr/bin/php8.4 to provide /usr/bin/php (php) in auto mode
```


### Start Webpack Watch

```bash
yarn add
yarn watch
```

## Process of Create Symfony Project

```bash
composer create-project symfony/skeleton:"6.3.*" cpanel
cd cpanel
```

## Install Symfony Cli

```bash
sudo apt install libnss3-tools
curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | sudo -E bash
sudo apt install symfony-cli
symfony server:ca:install
```

## Install Node.js Ubuntu

```
sudo apt update
sudo apt upgrade
sudo apt install -y curl
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
node --version
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.35.3/install.sh | bash
nvm install node
nvm install 20
```

## Installing Packages

### Debugger

```bash
composer require symfony/debug-bundle --dev
```

### Profiler

```bash
composer require --dev symfony/profiler-pack
```

### Logger

```bash
composer require logger
```

### Mailer

```bash
composer require symfony/mailer
```

### Security

```bash
composer require symfony/security-bundle
```

### Twig

```bash
composer require symfony/twig-bundle 
```

### DoctrineMigrations

[DoctrineMigrationsBundle](https://symfony.com/bundles/DoctrineMigrationsBundle/current/index.html)

```bash
composer require doctrine/doctrine-migrations-bundle
```

```php
// config/bundles.php
return [
    // ...
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
];
```

## MySql [🔝](#menu)

### Create User

```bash
create database cpanel;
create user cpanel@localhost identified by "PASSWORD";
grant all privileges on cpanel.* to cpanel@localhost;
```

### Doctrine

```bash
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
```
#### Cr

#### Create New Migration

```bash
php bin/console doctrine:migrations:generate
php bin/console doctrine:migrations:status
php bin/console doctrine:migrations:migrate
```

### Webpack Encore

```bash
composer require symfony/webpack-encore-bundle
yarn add
```

#### Config

- Auto Provide jQuery

```javascript
# webpack.config.js
  Encore
      // ...
    .autoProvidejQuery()
  ;
```

```javascript
# config/packages/webpack_encore.yaml
webpack_encore:
    # ...
    script_attributes:
        defer: false
```

- Enable sass loader

```javascript
# webpack.config.js
  Encore
    // ...
    // enables Sass/SCSS support
    .enableSassLoader()
  ;
```

```bash
yarn add sass-loader@^13.0.0 sass --dev
```

- Add jQuery to project

```bash
yarn add jquery
```

##### Compile

---

```bash
yarn dev
```

### Base Template Update

```html
{# templates/base.html.twig #}
<!DOCTYPE html>
<html>
    <head>
        <!-- ... -->

        {% block stylesheets %}
            {# 'app' must match the first argument to addEntry() in webpack.config.js #}
            {{ encore_entry_link_tags('app') }}

            <!-- Renders a link tag (if your module requires any CSS)
                 <link rel="stylesheet" href="/build/app.css"> -->
        {% endblock %}

        {% block javascripts %}
            {{ encore_entry_script_tags('app') }}

            <!-- Renders app.js & a webpack runtime.js file
                <script src="/build/runtime.js" defer></script>
                <script src="/build/app.js" defer></script>
                See note below about the "defer" attribute -->
        {% endblock %}
    </head>

    <!-- ... -->
</html>
```

### Profiler

```bash
composer require --dev symfony/profiler-pack
```

## Controllers

```bash
composer require symfony/maker-bundle --dev
```

### Home Controller

```bash
symfony console make:controller HomeController
```

## Add Bootstrap to Project

- https://getbootstrap.com

### Version 5.3

```bash
yarn add bootstrap --dev
yarn add jquery @popperjs/core --dev
```

```scss
// assets/styles/global.scss

// customize some Bootstrap variables
$primary: darken(#428bca, 20%);

// the ~ allows you to reference things in node_modules
@import "~bootstrap/scss/bootstrap";
```

```javascript
# assets/app.js
// ...
import './styles/global.scss';

require("bootstrap");
// ...
```

## Add FontAwesome to Project

- https://fontawesome.com

### Version 6.4.2

```bash
yarn add @fortawesome/fontawesome-free
```

```scss
// assets/styles/global.scss

// customize some Bootstrap variables
$primary: darken(#428bca, 20%);

// the ~ allows you to reference things in node_modules
@import "~@fortawesome/fontawesome-free/scss/fontawesome";
@import "~@fortawesome/fontawesome-free/scss/solid";
@import "~@fortawesome/fontawesome-free/scss/regular";
@import "~@fortawesome/fontawesome-free/scss/brands";
```

```javascript
# assets/app.js
// ...
require("@fortawesome/fontawesome-free");
// ...
```

## Add toastr to Project
- https://github.com/CodeSeven/toastr
- https://codeseven.github.io/toastr/demo.html

```bash
yarn add toastr
```

### SCSS
```scss
// assets/styles/global.scss
// ...
@import "~toastr/toastr";
// ...
```

### Javascript
```javascript
# assets/app.js
// ...
import toastr from 'toastr'
window.toastr = toastr
// ...
```

## Add SweetAlert2 to Project
- https://sweetalert2.github.io

```bash
yarn add sweetalert2
```

### Install Themes

```bash
yarn add @sweetalert2/themes
```

### SCSS
```scss
// assets/styles/global.scss
// ...
@import "sweetalert2";
// ...
```

### Javascript
```javascript
# assets/app.js
// ...
import Swal from 'sweetalert2/src/sweetalert2.js'
window.Swal = Swal
// ...
```

## Add jqueryui to Project
- https://jqueryui.com

```bash
yarn add jquery-ui
```

### SCSS
```scss
// assets/styles/global.scss
// ...
@import '~jquery-ui/themes/base/all.css';
// ...
```

### Javascript
```javascript
# assets/app.js
// ...
require("jquery-ui");
require("jquery-ui/ui/widgets/datepicker");s
// ...
```

## Add select2 to Project
```bash
yarn add select2-ui
```

### SCSS
```scss
// assets/styles/global.scss
// ...
@import '~select2/src/scss/theme/default/layout.scss';
// ...
```

### Javascript
```javascript
# assets/app.js
// ...
require("select2");
// ...
```

## Add Dropzone v6 to Project
```bash
yarn add select2-ui
```

### SCSS
```scss
// assets/styles/global.scss
// ...
@import '~select2/src/scss/theme/default/layout.scss';
// ...
```

### Javascript
```javascript
# assets/app.js
// ...
import Dropzone from "dropzone";
// ...
```

## Add Perfect Scrollbar 1.5.5 to Project
```bash
yarn add perfect-scrollbar
```

### SCSS
```scss
// assets/styles/global.scss
// ...
@import '~perfect-scrollbar/css/perfect-scrollbar.css';
// ...
```

### Javascript
```javascript
# assets/app.js
// ...
require("perfect-scrollbar");
// ...
```

## Add Datatables bootstrap 5 to project
```bash
# DataTables core *
yarn add datatables.net-bs5
 
# AutoFill *
yarn add datatables.net-autofill-bs5
 
# Buttons *
yarn add datatables.net-buttons-bs5
 
# ColReorder *
yarn add datatables.net-colreorder-bs5
 
# FixedColumns
yarn add datatables.net-fixedcolumns-bs5
 
# FixedHeader
yarn add datatables.net-fixedheader-bs5
 
# KeyTable
yarn add datatables.net-keytable-bs5
 
# RowGroup
yarn add datatables.net-rowgroup-bs5
 
# RowReorder
yarn add datatables.net-rowreorder-bs5
 
# Responsive *
yarn add datatables.net-responsive-bs5
 
# Scroller *
yarn add datatables.net-scroller-bs5
 
# SearchBuilder
yarn add datatables.net-searchbuilder-bs5
 
# SearchPanes
yarn add datatables.net-searchpanes-bs5
 
# Select
yarn add datatables.net-select-bs5
 
# StateRestore
yarn add datatables.net-staterestore-bs5
```
```bash
"./js/vendor/datatables/jquery.dataTables.js",
"./js/vendor/datatables/dataTables.bootstrap4.js",
"./js/vendor/datatables/dataTables.buttons.js",
//"./js/vendor/datatables/buttons.colVis.js",
//"./js/vendor/datatables/buttons.flash.js",
"./js/vendor/datatables/jszip.js",
"./js/vendor/datatables/pdfmake.js",
"./js/vendor/datatables/vfs_fonts.js",
"./js/vendor/datatables/buttons.html5.js",
"./js/vendor/datatables/buttons.print.js",
```
### For the Buttons
```
yarn add jszip
yarn add pdfmake
```

### SCSS
```scss
// assets/styles/global.scss
// ...
@import '~datatables.net-bs5/css/dataTables.bootstrap5.css';
@import '~datatables.net-buttons-bs5/css/buttons.bootstrap5.css';
// ...
```

### Javascript
Working on this add buttons
```javascript
# assets/app.js
// ...
import DataTable from "datatables.net-bs5";
window.DataTable = DataTable;
// ...
```

## TODO: NEXT

- datatables

- chartJS
- apexchartJS
- nouisliderJS
- dragulaJS
- quilljs
- highlightjs
- katexjs
- feathericons
- node-waves
