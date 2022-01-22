<?php

    /*
        *
        *
        *   @Author: Glaubert Suyan Dacio
        *   @Description:
        *   Backup automático de switches e roteadores Huawei pelo protocolo FTP. Para o script funcioanr perfeitamente 
        *   é necessário que esteja ativo o protocolo FTP no servidor que rodará ele e também no switch.
        *
        *
    */


    header("Content-type: text/html; charset=utf-8");

    // Configurações do servidor de FTP
    define("DEFAULT_FTP_TRANSFER_MODE",     FTP_BINARY); // modo que os arquivos serão enviados / baixados
    define("DEFAULT_FTPSERVER_ADDRESS",     "192.168.0.1"); // endereço do nosso servidor ftp
    define("DEFAULT_FTPSERVER_USERNAME",    "admin"); // usuario ftp do servidor ftp 
    define("DEFAULT_FTPSERVER_PASSWD",      "admin"); // senha do ftp do servidor ftp
    define("DEFAULT_FTPSERVER_PORT",        21); // porta default do servidor ftp
    define("DEFAULT_FTPTIMEOUTCONNECT",     5); // tempo que tentará fazer uma conexão
    define("DEFAULT_FTPHUAWEIPORT",         21); // porta padrão do FTP huawei
    

    $Huawei = array (
        array("IP_SW_HUAWEI",    "USUARIO_FTP",     "SENHA_FTP", "vrpcfg.zip", "Switch_WHATEAVER") // Uru

    );


    for($i = 0; $i < sizeof($Huawei); $i++){
    
        if(!($sessao_ftp = @ftp_connect($Huawei[$i][0], DEFAULT_FTPHUAWEIPORT, DEFAULT_FTPTIMEOUTCONNECT))){
            echo "Não foi possível iniciar uma sessão com o IP: ". $Huawei[$i][0]. "\n";
            //ftp_close($sessao_ftp);
            continue;
        }

        if(!@ftp_login($sessao_ftp, $Huawei[$i][1], $Huawei[$i][2])){
            echo "Não foi possível logar ao ip ". $Huawei[$i][0].", usuario e senha incorretos. \n";
            continue;
        }

        $arquivo =  $Huawei[$i][4]."-".$Huawei[$i][0]."-".date("MdY").(strpos($Huawei[$i][3], ".zip") ? (".zip") : (".cfg"));
        if(!@ftp_get($sessao_ftp, $arquivo,  $Huawei[$i][3], DEFAULT_FTP_TRANSFER_MODE))
        {
            echo "Não foi possível baixar o arquivo de configuração do ip ". $Huawei[$i][0]. "\n";
        } 

        echo "Sessão FTP com ".$Huawei[$i][0]. (ftp_close($sessao_ftp) ? (" foi") : (" não foi"))." finalizada. \n";

        if(!($sessao_ftp = ftp_connect(DEFAULT_FTPSERVER_ADDRESS, DEFAULT_FTPSERVER_PORT))){
            echo "Não possível iniciar uma sessão com o IP: ". DEFAULT_FTPSERVER_ADDRESS. "\n";
            ftp_close($sessao_ftp);
            continue;
        }

        if(!@ftp_login($sessao_ftp, DEFAULT_FTPSERVER_USERNAME, DEFAULT_FTPSERVER_PASSWD)){
            echo "Não foi possível logar no servidor ". DEFAULT_FTPSERVER_ADDRESS. "\n";
        }

        if(!@ftp_put($sessao_ftp, $arquivo, $arquivo, DEFAULT_FTP_TRANSFER_MODE)){
            echo "Não foi possível enviar o backup para o servidor. ". DEFAULT_FTPSERVER_ADDRESS. "\n";
        }

        echo "Sessão FTP com ".DEFAULT_FTPSERVER_ADDRESS. (ftp_close($sessao_ftp) ? (" foi") : (" não foi"))." finalizada. \n";
        echo "O arquivo de configuração <b>".$arquivo."</b>". (unlink($arquivo) ? (" foi") : (" não foi"))." deletado. \n\n\n";
    }
?>
