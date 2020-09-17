# Mining-Github
# Linguagens Utilizadas:
### [PHP](https://www.php.net/)
[![PHP version 7.2.28](https://img.shields.io/badge/Version-7.2.28-blue)](https://www.php.net/)

## Como Executar
O comando abaixo irá buscar 100 páginas, cada uma com o máximo de 10 repositórios por página (um total de 1000 repositórios), e os dados desses repositórios serão salvos em uma planilha .csv no diretório do projeto.

```bash
php index.php {YOUR_TOKEN}
```

```bash
php index.php 123456789
```

#### Também é possível executar o programa pelo navegador de internet

Basta abrir o index.php no navegador de internet. O parâmetro __token__ irá definir o token de acesso.

`localhost/index.php?token=123456789`
