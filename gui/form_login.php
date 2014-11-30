<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Loja virtual - Área Administrativa - Identificação do Usuário</title>
		<meta charset="utf-8">
		<style type="text/css">
			@import "<?php echo URL_BASE; ?>css/estilos.css";
		</style>
	</head>
	<body>
		<div class="container">
			<h1>Identificação do usuário</h1>
			<form method="post" action="<?php echo URL_BASE . 'login.php?acao=autenticar';?>">
				<fieldset>
					<legend>Dados do usuário</legend>
					<div class="form-group">
						<label for="login">Login:</label>
						<input type="text" name="login" id="login">
					</div>
					<div class="form-group">
						<label for="senha">Senha:</label>
						<input type="password" name="senha" id="senha">
					</div>
					<div class="form-group">
						<button type="submit">Enviar</button>
					</div>
				</fieldset>
			</form>
		</div>
        
        <div class="container">
			<h1>Identificação do Cliente</h1>
			<form method="post" action="<?php echo URL_BASE . 'login_clientes.php?acao=autenticar';?>">
				<fieldset>
					<legend>Dados do Clientes</legend>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="text" name="email" id="email">
					</div>
					<div class="form-group">
						<label for="senha_clientes">Senha:</label>
						<input type="password" name="senha_clientes" id="senha_clientes">
					</div>
					<div class="form-group">
						<button type="submit">Enviar</button>
					</div>
				</fieldset>
			</form>
		</div
	</body>
</html>