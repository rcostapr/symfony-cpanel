# Symfony 6 CPANEL

## Create Symfony Project

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
symfony server:start
```

## Installing Packages

### Debugger

```bash
composer require symfony/debug-bundle --dev
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

- https://getbootstrap.com/

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
// ...
```

## TODO: NEXT

- datatables
- sweetalert2
- jqueryui
- fontAwesomeCSS
- chartJS
- toastrJS
- select2JS
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
