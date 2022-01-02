<?php
    #################  DADOS FORM ###############
    $Cidade_escolhida = $_POST['Cidade_escolhida'];
    $Qnt_viajantes = $_POST['Qnt_viajantes'];
    $Dt_ida = $_POST['Dt_ida'];
    $Dt_volta = $_POST['Dt_volta'];
    $Qnt_Dias = $_POST['Qnt_Dias'];
    $Valor_total = $_POST['Valor_total'];
    $Cidade_origem = $_POST['Cidade_origem'];
    $cidade = $_POST['city'];
    ############## CALCULO DESCONTO #######################
    $Cupom = $_POST['Cupom_desconto'];
    $desconto = 0;

    $cupons = json_decode(file_get_contents('./JSON/Cupons.Json'));
    foreach($cupons as $registro){
        $nome_cupom = $registro->cupom;
        $valor_cupom = $registro->valor_cupom;
        if($nome_cupom==$Cupom){
        $desconto = $valor_cupom;
        }
    
    }


    $Valor_desconto = (double)$Valor_total*($desconto/100);
    $Valor_final = (double)$Valor_total - $Valor_desconto;

    $Valor_total = number_format($Valor_total, 2, ",", ".");
    $Valor_desconto = number_format($Valor_desconto, 2, ",", ".");
    $Valor_final = number_format($Valor_final, 2, ",", ".");




###########  INVERTER DATA ############
    function inverteData($data){
        if(count(explode("/",$data)) > 1){
            return implode("-",array_reverse(explode("/",$data)));
        }elseif(count(explode("-",$data)) > 1){
            return implode("/",array_reverse(explode("-",$data)));
        }
    }

  ############  DATA ##############
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo'); 
    $data = strftime($cidade.' - %d de %B de %Y', strtotime('today'));

############# GERAR NUMERO COMPROVANTE #####################
    $dia = date('d');
    $mes = date('m');
    $ano = date('y');
    $doc = $_POST['doc1'];
    $comprovante = $ano.$mes.$doc.$dia;

    
############# CRIAR ARQUIVO TXT #########################
$arquivo = fopen((string)$comprovante.'.txt','w');
if ($arquivo == false) die('Não foi possível criar o arquivo.');
$dados = "COMPROVANTE DE COMPRA \n";
fwrite($arquivo,$dados);
$dados = "\nPacote: ".$Qnt_Dias.' dia(s) em '.$Cidade_escolhida.' para '.$Qnt_viajantes." pessoa(s).\nSaindo de: ".$Cidade_origem."\nSaida:".$Dt_ida."\nRetorno: ".$Dt_volta."\n";
fwrite($arquivo,$dados);

$dados="\nPASSAGEIROS";
fwrite($arquivo,$dados);
for($i=1; $i<=$Qnt_viajantes; $i++){
    $dados ="\nPassageiro ".$i."\nNome: ".$nome = $_POST['name'.(string)$i]."\nSobrenome: ".$sobrenome = $_POST['last-name'.(string)$i]."\nNascimento: ".$nome =inverteData($_POST['born'.(string)$i])."\nNacionalidade: ".$nacionalidade = $_POST['nacionalidade'.(string)$i]."\nNº identidade: ".$rg = $_POST['doc'.(string)$i]."\nSexo: ".$sexo = $_POST['sexo'.(string)$i]."\n";
    fwrite($arquivo,$dados);
}
$dados="\nCONTATO\n"."\nEndereço: ".$endereco = $_POST['end']."\nCidade: ".$cidade = $_POST['city']."\nCEP: ".$cep = $_POST['cep']."\nTelefone: ".$telefone = $_POST['fone']."\nEmail: ".$email = $_POST['email']."\n";
fwrite($arquivo,$dados);
$dados = "\nVALORES\n"."\nValor total: R$ ".$Valor_total."\nValor descont: R$ ".$Valor_desconto."\nValor fina: R$ ".$Valor_final."\n"; 
fwrite($arquivo,$dados);
 fclose($arquivo);
?>

<!DOCTYPE html>
<html lang="pt-br
">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante</title>
    <link rel="icon" href="./img/Icon.png" />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./CSS/comprovante.css" />
</head>
<body>
    <header>
        <a href="./index.html">home</a>
        <img src="./img/Logo.svg" alt="">
    </header>
    <main>
        <div class="container">
            <div class="check">
                <img src="./img/checklaranja.png" alt="check">
            </div>
            
            <h1>Compra completa!</h1>
            <div class="top">
                <h4>Nº pedido: <?php echo $comprovante?></h4>
                <p><?php echo $data?></p>      

            </div>
            <hr>
            <div class="main">
                <h2>Dados da compra</h2>
                <h3>Pacote</h3>
                <div class="pacote">
                    <p>Pacote: <?php echo $Qnt_Dias;?> dia(s) em <?php echo $Cidade_escolhida;?> para <?php echo $Qnt_viajantes;?> pessoa(s).</p>
                    <div class="info">
                        <p>Saida:<?php echo $Dt_ida;?></p>
                        <p>Retorno:<?php echo $Dt_volta;?></p>
                    </div>
                                        
                </div>

                <h3>Passageiro(s)</h3>
                <?php for($i=1; $i<=$Qnt_viajantes; $i++):?>  
                    
                <div class="card">
                    <h4>Passageiro 1</h4>
                    <div class="info">
                        <div class="left">
                            <p>Nome: <?php echo $nome = $_POST['name'.(string)$i]; ?></p>
                            <p>Data nascimento: <?php echo $nome =inverteData($_POST['born'.(string)$i]); ?></p>
                            <p>Nº Identidade: <?php echo $rg = $_POST['doc'.(string)$i]; ?></p>
                        </div>
                        <div class="right">
                            <p>Sobrenome: <?php echo $sobrenome = $_POST['last-name'.(string)$i]; ?></p>
                            <p>Nacionalidade: <?php echo $nacionalidade = $_POST['nacionalidade'.(string)$i]; ?></p>  
                            <p>Sexo: <?php echo $sexo = $_POST['sexo'.(string)$i]; ?></p>  
                        </div>
                    </div> 
                    <hr>                  
                </div>
                <?php endfor ?>
                
                <h3>Contato</h3>
                <div class="contato">
                    
                    <div class="info">
                        <div>
                            <p>End: <?php echo $endereco = $_POST['end']; ?></p>
                            <p>Cidade: <?php echo $cidade = $_POST['city']; ?></p> 
                            
                        </div>
                        <div>
                            <p>CEP: <?php echo $cep = $_POST['cep']; ?></p>
                            
                        </div>
                    </div>
                    <div class="info">
                        <div>
                            
                            <p>Telefone: <?php echo $telefone = $_POST['fone']; ?></p>
                        </div>
                        <div>
                            
                            <p>Email: <?php echo $email = $_POST['email']; ?></p>
                        </div>
                    </div>
                   
                </div>

                <h3>Valores</h3>
                <div class="valor">
                    <div class="valores total">
                        <p>Valor total:</p>
                        <P>R$ <?php echo $Valor_total ?></P>
                    </div>
                    <div class="valores desconto">
                        <p>Valor do desconto:</p>
                        <P>- R$ <?php echo $Valor_desconto ?></P>
                        
                    </div>
                    <hr>
                    <div class="valores final">
                        <p>Valor Final:</p>
                        <P>R$ <?php echo $Valor_final ?></P>
                    </div>
                </div>
                <footer>
                    <p> *Em breve você recebera em seu email este comprovante!</p>    
                    <a href="./index.html">Inicio</a>                
                </footer>
            </div>
        </div>

    </main>

</body>
</html>