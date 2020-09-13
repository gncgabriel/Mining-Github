# Mining-Github
# Linguagens Utilizadas:
- PHP

## Como Executar
O comando abaixo irá buscar 100 páginas, cada uma com 100 repositórios, e os dados desses repositórios serão salvos em uma planilha .csv no diretório do projeto.

```bash
php index.php
```

Para alterar a quantidade de páginas basta informar a quantidade desejada, o comando abaixo irá buscar 25 páginas:

```bash
php index.php 25
```

Para alterar o diretório onde será armazenada a planilha, basta informar o diretório após a quantidade de páginas:

```bash
php index.php 25 'C:\Users\Goku\Desktop'
```

## Também é possível executar o programa pelo navegador de internet

O parâmetro _pages_ irá definir a quantidade de páginas que serão buscadas e o parâmetro _dir_ irá definir o diretório onde será armazenada a planilha
