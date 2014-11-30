<?php
        session_start();
        
        require_once('lib/constantes.php');
	    require_once('lib/funcoes.php');    
	    require_once('lib/acesso.php');

        if(!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array();
        }
        
    //adiciona produtos no carrinho

    if(isset($_GET['acao'])){
        //ADICIONAR CARRINHO
        
        if($_GET['acao'] == 'add'){
            $id = intval($_GET['id']); //  <--verifica se o valor vindo é um numero inteiro
            if(!isset($_SESSION['carrinho'][$id])){
                $_SESSION['carrinho'][$id] = 1;
            
            }else{
                $_SESSION['carrinho'][$id] += 1; 
            
            }
        
        }
        
        //remove do carrinho
        if($_GET['acao'] == 'del'){
             $id = intval($_GET['id']); //  <--verifica se o valor vindo é um numero inteiro
            if(isset($_SESSION['carrinho'][$id])){
                unset($_SESSION['carrinho'][$id]);
            }
        
        }
        
        //Alterar a quantidade
        if($_GET['acao'] == 'up'){
            if(is_array($_POST['prod'])){
                foreach($_POST['prod'] as $id => $qtd){
                    $id = intval($id);
                    $qtd = intval($qtd);
                    if(!empty($qtd) || $qtd <> 0){
                        $_SESSION['carrinho'][$id] = $qtd;
                  }else{
                        unset($_SESSION['carrinho'][$id]);
                    }
                }
            }
            
        }
    
    } 
             
?>

<!DOCTYPE html>
<html lang="pt-br">    
<head>
    <title>Loja virtual - Carrinho de Compras</title>
		<meta charset="utf-8">
		<style type="text/css">
			@import "<?php echo URL_BASE; ?>css/estilos.css";
		</style>    
    </head>
    
<body>
    
    <div class="container">
    <h1>Carrinho de Compras</h1>
<table>
    <thead>
            <tr>
                <th width="244">Produto</th>
                <th width="79">Quantidade</th>
                <th width="89">Pre&ccedil;o</th>
                <th width="100">Subtotal</th>
                <th width="64">Remover</th>
            </tr>
    </thead>
        <form action="?acao=up" method="post">          
        
            
            <tbody>
                <?php
                    if(count($_SESSION['carrinho']) == 0) {
                        echo '<tr><td colspan="5"> Não a produto no carrinho.</td></tr>';
                    
                    }else{                       
                        
                        require_once('lib/database.php');	
                        
                        foreach($_SESSION['carrinho'] as $id => $qtd) {
                            $sql     = "SELECT * FROM produtos WHERE id= '$id'";
                            $executa = mysql_query($sql) or die(mysql_error());
                            $ln      = mysql_fetch_assoc($executa);
                            
                            $nome  = $ln['nome'];
                            $preco = number_format($ln['preco'], 2, ',', '.');
                            $sub   = number_format($ln['preco'] * $qtd, 2, ',', '.');
                            
                            $total += $sub; 
                            
                            echo '<tr>
                                    <td>'.$nome.'</td>
                                    <td><input type="text" size="3" name="prod['.$id.']" value="'.$qtd.'" /></td>
                                    <td>R$ '.$preco.'</td>
                                    <td>R$ '.$sub.'</td>
                                    <td><a href="?acao=del&id='.$id.'"><img title="Comprar" src="img/exc.png"></a></td>               
                                  </tr>';                            
                        }
                        $total = number_format($total, 2, ',', '.');
                        echo '<tr>
                                <td colspan="4">Total</td>
                                <td>R$ '.$total.'</td>
                            </tr>';        
                    
                    }
                    
                
                ?>
                
                
                <!--
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                -->
            </tbody>
            
            <tfooter>
            <tr>
            <p>    
                <td colspan="5"><input type="submit" value="Atualizar Carrinho" /></tr></p>          
                <td colspan="5"><a href="pedido.php"><img title="Comprar" src="img/bt_continuar_comprando.png"></a>
            </tr>
            </tfooter>
    </form>
</table>    
</div>
</body>    
    
</html>