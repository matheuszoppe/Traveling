<?php
    $origem = $_POST['origem'];
    $ida = $_POST['ida'];
    $volta = $_POST['volta'];
    $vj = $_POST['vj'];
    

    $diferenca = strtotime($volta) - strtotime($ida);
    $dias = floor($diferenca / (60 * 60 * 24));
    $dados = json_decode(file_get_contents('./JSON/Pacote.Json'));

    // foreach($dados as $registro){
    //     $destino = $registro->destino;
    //     $img = $registro->img;
    //     $hospedagem = $registro->hospedagem;
    //     if($origem == "Rio de Janeiro"){
    //       $passagem = $registro->passagemRJ;
    //     } elseif ($origem == "Belo Horizonte"){
    //       $passagem = $registro->passagemBH;
    //     }else{
    //       $passagem = $registro->passagemSP;
    //     }
    //     echo $passagem."<br>";
        
    // };
  
    // foreach($dados as $registro){
    //     echo "<b>Produto:</b>".$registro->titulo.'</br>';
    //     echo "<b>Valor: R$ </b>".$registro->valor.'</br>';
    //     echo "<img src='".$registro->imagem."'>";
    //     echo "</br></br>";
    // };
   // Como vou pegar o arquivo de JSON
   // fazer um teste id pra saber qual a cidade, dependendo do valor, coloca para buscar o valor referente aquela cidade
   //Exemplo 
   //if city==sp
   // vusca alem dos dados o valorpassagemSP

  

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Travel.ing - Pacotes</title>

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
    <link rel="stylesheet" href="./CSS/Pacotes.css" />
  </head>
  <body>
    <header>
      <div class="city">
        <p><?php echo $origem; ?></p>
      </div>

      <div class="logo">
        <img id="logo" src="./img/Logo.svg" alt="Logo dev finaces" />
      </div>
    </header>

    <main class="container">
      <!-- <div class="card">
        <div class="pacote">
          <div class="img"><img src="./img/Natal.png" alt="" /></div>
          <div class="description">
            <div class="text">
              <h1 class="tittle">NATAL</h1>
              <h2>5 NOITES</h2>
              <h3>HOTEL + AÉREO</h3>
              <p>- Café da Manhâ <br />- Translado <br />- Passeios</p>
              <h1 class="price">R$ 500,00</h1>
            </div>
          </div>
        </div>

        <button class="buy" href="#" onclick="Fundo.open()" >Quero esse!</button>
      </div> -->

      
      <?php foreach ($dados as $registro): ?>
        <?php 
        $destino = $registro->destino;
        $img = $registro->img;
        $hospedagem = $registro->hospedagem;
        if($origem == "Rio de Janeiro"){
          $passagem = $registro->passagemRJ;
        } elseif ($origem == "Belo Horizonte"){
          $passagem = $registro->passagemBH;
        }else{
          $passagem = $registro->passagemSP;
        }
        $valor_passagem = $passagem*$vj;
          $valor = $valor_passagem + ($dias*$hospedagem);

        if($vj>3){
          $hospedagem = $hospedagem*2;
        }
        ?>
      <form action="./finalizarPedido.php" method="POST">
        <div class="dados-form">
          <input type="hidden" name="Cidade_escolhida" value="<?php echo $destino; ?>">
          <input type="hidden" name="Qnt_viajantes" value="<?php echo $vj; ?>">
          <input type="hidden" name="Dt_ida" value="<?php echo $ida; ?>">
          <input type="hidden" name="Dt_volta" value="<?php echo $volta; ?>">
          <input type="hidden" name="Qnt_Dias" value="<?php echo $dias; ?>">
          <input type="hidden" name="Valor_total" value="<?php echo $valor; ?>">

        </div>
        <div class="card">
        <div class="pacote">
          <div class="img"><img src="<?php echo $img?>" alt="" /></div>
          <div class="description">
            <div class="text">
              <h1 class="tittle"><?php echo $destino; ?></h1>
              <h2><?php echo $dias ?> NOITES</h2>
              <h3>HOTEL + AÉREO</h3>
              <p>- Café da Manhâ <br />- Translado <br />- Passeios</p>
              <h1 class="price">R$ <?php echo $valor; ?></h1>
              
            </div>
          </div>
        </div>
        
        
          <button type="submit" class="buy" >Quero esse!</button>

        

        
        </div>
      </form>
      <?php endforeach; ?>

             
                    
         
      
      
      <div class="fundo">
        <div class="box">
          <div class="form">
            <form action="">
              <a class="close-button" href="#" onclick="Fundo.close()">x</a>
              <div class="info">
              
                <h3>Informações de compra</h3>
                <div class="b1">
                  <div class="nome">
                    <p>Nome</p>
                    <input type="text" name="name" id="name" placeholder="Nome">                
                  </div>
                  <div class="last-name">
                    <p>Sobrenome</p>
                    <input type="text" name="last-name" id="last-name" placeholder="Sobrenome">
                  </div>
                </div>
                
  
                <div class="email">
                  <p>Email</p>
                  <input type="email" name="email" id="email" placeholder="nome@exemplo.com">
                </div>
  
                <div class="b2">
                  <p>Endereço</p>
                  <input type="text" id="end" name="end" placeholder="Rua Exemplo, Nº 2">
                  <p>Complemento</p>
                  <input type="text" name="comp" id="comp" placeholder="Casa 1">
                </div>
                <div class="b3">
                  
                  <div class="State">
                    <p>Estado</p>
                    <select name="State" id="State">
                      <option value="">Escolha..</option>
                      <option value="MG">Minas Gerais</option>
                      <option value="RJ">Rio de Janeiro</option>
                      <option value="SP">São Paulo</option>
                    </select>
                  </div>
                  <div class="cidade">
                    <p>Cidade</p>
                    <input type="text" name="city" id="city" placeholder="Cidade">
                  </div>
                  <div class="cep">
                    <p>CEP</p>
                    <input type="text" name="cep" id="cep" placeholder="XXXXX-XXX">
                  </div>
                </div>
              </div>
              
              <input type="checkbox" class="check">
              <label class="form-check-label" for="exampleCheck1">Lembrar desta informação, na próxima vez.</label>
              
              <h3>Dados dos viajantes</h3>

              <?php for($i=1; $i<=$vj; $i++):?>
              <div class="viajante">
                <h4>Viajante <?php echo $i ?></h4>
                <p>Nome</p>
                  <input type="text" name="name" id="name" placeholder="Nome Complemento"> 
                  <p>CPF</p>
                  <input type="number" name="cpf" id="cpf" placeholder="Apenas numeros"> 
                  <p>Data de nascimento</p>
                  <input type="date" name="born" id="born"> 
              </div>
              <?php endfor ?>
              <div class="info">
              <p>Cupom de Desconto:</p>
              <input type="text" name="desconto" id="desconto" placeholder="EX: FIRSTTRAVEL">
              </div>
              
              <button type="submit" onclick="Fundo.close()" class="Finalizar">Finalizar</button>

            </form>      
          </div>
        </div>
      </div>s
      
    </main>

    <footer><img src="./img/Logo.svg" alt=""></footer>

    <script>
      function test(name){
        alert(name);
      }
      const Fundo ={
          open(){
              document
              .querySelector('.fundo')
              .classList
              .add('active')

          },
          close(){
              document
              .querySelector('.fundo')
              .classList
              .remove('active')
  
          }
      }
  </script>
  </body>
</html>