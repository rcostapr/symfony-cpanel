# Symfony 6 CPANEL

## Start Development

```bash
cd cpanel
```

### Start Web Server

```bash
symfony server:start
```

### Start Webpack Watch

```bash
yarn install
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

### Webpack Encore

```bash
composer require symfony/webpack-encore-bundle
yarn install
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

## TODO: NEXT

- select2JS

- datatables

- jqueryui
- chartJS
- perfectScrollbarJS
- dropzoneJS
- apexchartJS
- nouisliderJS
- dragulaJS
- quilljs
- highlightjs
- katexjs
- feathericons
- node-waves
