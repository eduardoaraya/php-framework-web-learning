# Introdução
O projeto consiste na arquitetura MVC (Model View Controller) e busquei utilziar a mesma
estrutura que o Laravel/Lumen utilizam em seus projetos.
Algumas soluções para o desenvolvimento do sistema foram encontradas, assim como:
- Roteamento;
- Validações de Input;
- Uploade de aquivos;
- Implementação de views;

### Bibliotecas
- backend: utilizada apenas a biblioteca "vlucas/phpdotenv": "^4.1" para gerenciamento das variáveis de ambiente.
- frontend: Jquery e Bootstrap,

# Iniciando projeto
Abra a pasta ./src e execute o comando
```composer install```

# Configurações do ambiente
Abra o arquivo ```.env.example``` dentro da pasta src e edite as informações de acordo com o seu ambiente de desenvolvimento.
Após ter feito isso renomeie para somente```.env```.
```
HOST="http://localhost"
PORT=8000
APP_NAME="GoJump"

DB_DRIVER="mysql"
DB_HOST="localhost"
DB_PORT=3306
DB_USERNAME="root"
DB_PASSWORD=""
DB_NAME="assessmentbackendxp"
``` 

# Criando tabelas
Crie o banco com seu respectivo nome e execute o sql que se encontra na pasta ```./src/database/assessmentbackendxp.sql```

# Iniciando servidor 
Dentro da pasta ./src execeute o comando
```php -S localhost -t public/```
Ou
```composer run serve```


