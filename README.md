# Mining-Github
# Linguagens Utilizadas:
### [PHP](https://www.php.net/)
[![PHP version 7.2.28](https://img.shields.io/badge/Version-7.2.28-blue)](https://www.php.net/)

## Como Executar
O comando abaixo irá buscar 100 páginas, cada uma com o máximo de 100 repositórios, e os dados desses repositórios serão salvos em uma planilha .csv no diretório do projeto.

```bash
php index.php default default {YOUR_TOKEN}
```

```bash
php index.php default default 123456789
```

Para alterar a quantidade de páginas basta informar a quantidade desejada, o comando abaixo irá buscar 25 páginas:

```bash
php index.php 25 default {YOUR_TOKEN}
```

Para alterar o diretório onde será armazenada a planilha, basta informar o diretório após a quantidade de páginas:

```bash
php index.php 25 'C:\Users\Goku\Desktop' {YOUR_TOKEN}
```

#### Também é possível executar o programa pelo navegador de internet

Basta abrir o index.php no navegador de internet. 

`localhost/index.php`

O parâmetro __pages__ irá definir a quantidade de páginas que serão buscadas, o parâmetro __dir__ irá definir o diretório onde será armazenada a planilha e o parâmetro __token__ irá definir o token de acesso.

`localhost/index.php?pages=25&dir="C:\Users\Goku\Desktop"&token=123456789`

O único parâmetro obrigatório é o token.
