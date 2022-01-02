<?php
#################  DADOS FORM ###############
$Cidade_escolhida = $_POST['Cidade_escolhida'];
$Qnt_viajantes = $_POST['Qnt_viajantes'];
$Dt_ida = $_POST['Dt_ida'];
$Dt_volta = $_POST['Dt_volta'];
$Qnt_Dias = $_POST['Qnt_Dias'];
$Valor_total = $_POST['Valor_total'];
$Cidade_origem = $_POST['Cidade_origem'];

###########  INVERTER DATA ############
function inverteData($data){
  if(count(explode("/",$data)) > 1){
      return implode("-",array_reverse(explode("/",$data)));
  }elseif(count(explode("-",$data)) > 1){
      return implode("/",array_reverse(explode("-",$data)));
  }
}

$Dt_ida = inverteData($Dt_ida);
$Dt_volta = inverteData($Dt_volta);

############## CALCULO DESCONTO #######################
$cupons = json_decode(file_get_contents('./JSON/Cupons.json'));

$desconto = 10;
$Valor_desconto = (double)$Valor_total*($desconto/100);
$Valor_final = (double)$Valor_total - $Valor_desconto;

$Valor_desconto = number_format($Valor_desconto, 2, ",", ".");
$Valor_final = number_format($Valor_final, 2, ",", ".");

################## PEGAR IMAGENS ########################

$dados = json_decode(file_get_contents('./JSON/Pacote.Json'));
foreach($dados as $registro){
  $destino = $registro->destino;
  $imagem = $registro->img;
  if($destino==$Cidade_escolhida){
    $img = $imagem;
  }

}




?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pedido</title>

    <link rel="icon" href="./img/Icon.png" />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap"
      rel="stylesheet"
    />

    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./CSS/finalizarPedidor.css" />

    <script type="text/javascript" src="./JS/buttons.js"></script>
    <script type="text/javascript" src="./JS/validacao.js"></script>
   

</head>
<body>
  

    <div id="container">
        <aside>
           
            <header>
            
            <img class="logo" src="./img/Logo.svg" alt="Travel.ing">
            
            
            </header>
            <main>
              
              <img class="foto-destino" src="<?php echo $img;?>" alt="">
              <hr>
              <div class="destiny">
                <p><?php echo $Cidade_origem;?></p>
                <img class="icone" src="./img/seta-esquerda.png" alt="">
                <p><?php echo $Cidade_escolhida;?></p>             
  
              </div>
              <div class="date">
                <div>
                  <small>Data de ida:</small>
                  <p><?php echo $Dt_ida;?></p>
                </div>
                <div>
                  <small>Data de volta:</small>
                  <p><?php echo $Dt_volta;?></p>
                </div>
                
              </div>  
              <hr>
            
            </main>
           
            <footer>
              <a class="back" onclick="history.go(-1)"><img src="./img/voltar.png" alt=""></a>
            </footer>
            
          
        </aside>

        
        <div class="main">       
          
            <div class="form">
              <form name="formu" action="./comprovante.php" method="POST">
                
                <div class="box">
                  <h3>Passageiros</h3>
                  <?php for($i=1; $i<=$Qnt_viajantes; $i++):?>  
                    <div class="card"  >
                      <div class="top">
                        <p>Passageiro <?php echo $i ?></p>
                        
                        <button type="button" onclick="minimizar('<?php echo $i ?>', 'expandir<?php echo $i ?>', 'contrair<?php echo $i ?>')">
                          <img src="./img/seta baixo.png" class="expandir" alt="expandir" id="expandir<?php echo $i ?>">
                          <img src="./img/seta alto.png" alt="contrair" class="contrair" id="contrair<?php echo $i ?>">
                        </button>
                      </div>
                      <div class="line-box" id="<?php echo $i ?>">
                        <div class="line">
                          <label class="sr-only" for="name">Nome</label>
                          <input type="text" name="name<?php echo $i ?>" id="name" placeholder="Nome(s)">
                          <label class="sr-only" for="last-name">Sobrenome</label>
                          <input type="text" name="last-name<?php echo $i ?>" id="last-name" placeholder="Sobrenome(s)">
                          </div>
                          <div class="line">  
                            <div>
                              <small class="title">Data de nascimento <br></small>                   
                            <input type="date" name="born<?php echo $i ?>" id="data" >
                            </div>                 
                            
                            <label class="sr-only" for="nacionalidade">Nacionalidade</label>
                            <input type="text" name="nacionalidade<?php echo $i ?>" placeholder="Nacionalidade">                  
                          </div>
                          <div class="line">
                            <div>
                              <label class="sr-only" for="doc">Numero do documento de identidate</label>
                              <input type="number" name="doc<?php echo $i ?>" placeholder="Nº documento de identidade">
                              
                            </div>
                            <div>
                              <small class="title">Sexo <br></small>
                            <input type="text" name="sexo<?php echo $i ?>" placeholder="Ex: Masculino">
                            </div>                  
                            
                            
                          </div>
                          <div id="fim">
                            <small><br> *Apenas números</small>
                          </div>
                          <div class="button" id="save">
                            <button type="button" class="salvar" onclick="minimizar('<?php echo $i ?>', 'expandir<?php echo $i ?>', 'contrair<?php echo $i ?>')"> Salvar</button>
                          </div>
                      </div>
                    </div>
                  <?php endfor ?>

                

               

                <h3>Informações de contato</h3>
                <div class="line-box">
                  <div class="line2 endereco">
                    <label class="sr-only" for="end">Endereço completo</label>
                    <input type="text" id="end" name="end" placeholder="Endereço" >                  
                                       
                  </div> 
                  <div class="line2">
                    <div>
                      <label class="sr-only" for="city">Cidade</label>
                    <input type="text" id="city" name="city" placeholder="Cidade" >
                    </div>
                    
                    <div>
                      <label class="sr-only" for="cep">CEP</label>
                      <input type="number" id="cep" name="cep" placeholder="CEP" >
                      <div class="obs"><small > <br>*Apenas números</small></div>
                    </div>
                    
                  </div>                           
  
                  <div class="line2">
                    <div>
                      <label class="sr-only" for="email">Email</label>
                      <input type="email" id="email" name="email" placeholder="Email" >
                    </div>
                    
                    <div><label class="sr-only" for="fone">Telefone</label>
                      <input type="number" id="fone" name="fone" placeholder="Telefone">
                      <div class="obs"><small > <br>*Apenas números</small></div>
                    </div>                       
                  </div>
                  <div class="line2">
                    <div class="check">
                      <input type="checkbox" id="check">
                      <label class="form-check-label" for="exampleCheck1">Lembrar desta informação, na próxima vez.</label>
                    </div>                    
                                         
                  </div>
                  
                </div>


                <h3>Finalização do pedido</h3>
                <div class="line-box">
                  <div class="valores total">
                    <p>Valor Total</p>
                    <p>R$ <?php echo number_format($Valor_total, 2, ",", ".");?></p>
                    
                   
                  </div>
                  
                  <!-- <div class="valores desconto">
                    <p>Valor desconto</p>
                    <p>- R$ <?php echo $Valor_desconto;?></p>
                  </div> -->
                  <hr>
                  <!-- <div class="valores final">
                    <p>Valor final</p>
                    <p>R$ <?php echo $Valor_final;?></p>
                    
                  </div> -->
                  
                  <div class="line3">
                    
                      <label  for="cupom">Cupom de desconto</label>
                      <input type="text" id="test" name="Cupom_desconto"  placeholder="Cupom de desconto" value="">                     
                      
                                     
                                          
                  </div>
                  <div class="button">
                    <button type="reset" class="reset">Limpar</button>
                    <button type="submit"class="submit"> Finalizar</button>
                  </div>
                </div>
                

              </div>
                <input type="hidden" name="Valor_total" value="<?php echo $Valor_total;?>">
                <input type="hidden" name="Dt_ida" value="<?php echo $Dt_ida;?>">
                <input type="hidden" name="Dt_volta" value="<?php echo $Dt_volta;?>">
                <input type="hidden" name="Cidade_escolhida" value="<?php echo $Cidade_escolhida;?>">
                <input type="hidden" name="Cidade_origem" value="<?php echo $Cidade_origem;?>">
                <input type="hidden" name="Qnt_viajantes" value="<?php echo $Qnt_viajantes;?>">
                <input type="hidden" name="Qnt_Dias" value="<?php echo $Qnt_Dias;?>">
              </form>
            </div>
          
        
      </div>
    </div>

    
    
</body>
</html>