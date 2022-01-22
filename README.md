##  Backup de switches e roteadores Huawei (linha enterprise)

### Definindo definindo parametros:
#### Servidor FTP
Modo FTP que os arquivos serão transferidos (recomendo não alterar)
```php
define("DEFAULT_FTP_TRANSFER_MODE",     FTP_BINARY);
```

Informações do servidor FTP que será armazenado o backup
```php
define("DEFAULT_FTPSERVER_ADDRESS",     "192.168.0.1"); // endereço do nosso servidor ftp
define("DEFAULT_FTPSERVER_USERNAME",    "admin"); // usuario ftp do servidor ftp 
define("DEFAULT_FTPSERVER_PASSWD",      "admin"); // senha do ftp do servidor ftp
```

Parâmetros adicionais do servidor FTP como porta, tempo de tentativa de conexão
```php
define("DEFAULT_FTPSERVER_PORT",        21); // porta default do servidor ftp
define("DEFAULT_FTPTIMEOUTCONNECT",     5); // tempo que tentará fazer uma conexão
```

#### Dispositivo huawei
Porta padrão de acesso FTP nos dispositivos huawei, altere caso necessário
```php
define("DEFAULT_FTPHUAWEIPORT",         21); // porta padrão do FTP huawei
```

#### Adicionando adicionando dispositivo que irá fazer backup
Deixei alguns exemplos de como deve ser seguido
```php
$Huawei = array (
    array("192.168.0.20",    "glaubert",     "brasil123@", "vrpcfg.zip", "Switch_Rodovia"),
    array("192.168.0.32",    "glaubert",     "brasil123@", "vrpcfg.zip", "Switch_Centro"),
    array("192.168.0.45",    "glaubert",     "brasil123@", "vrpcfg.zip", "Switch_Escola")
);
```


