<?php
    require_once('lib/constantes.php');
	require_once('lib/funcoes.php');
	require_once('lib/acesso.php');

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
            <h1>Produtos Pedido</h1>
			<table>
				<thead>
					<tr>
						<th>Nome</th><th>Detalhes</th><th>Preço</th><th>Ações</th>
					</tr>
				</thead>
				<tbody>
    
<?php
    session_start();
	
    require_once('lib/database.php');

    $sql = "SELECT * FROM produtos";
    $executa = mysql_query($sql) or die(mysql_error());
        while ($ln = mysql_fetch_assoc($executa)) {
            echo "<tr><td>".$ln['nome']."</td>
                 <td>".$ln['detalhes']."</td>
                 <td>R$ ".number_format($ln['preco'], 2, ',', '.')."</td>
                 <td><a href='carrinho.php?acao=add&id=".$ln['id']."'><img title='Comprar' src='img/car.png'></a></td>
                 </tr>";
            
            
        };




?>
                
                </tbody>
            </table>
        </div>
    </body>
</html>