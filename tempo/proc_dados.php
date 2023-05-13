<?php
if (!isset($_COOKIE["c_usuario"])) {
	echo "<h1>Faça login para continuar</h1>";
	echo "<a href=index.html>Login</a>";
	exit;
}

if (isset($_GET["nome"])) {
	$v_usuario = $_GET["nome"];
	$v_time = time();
	setcookie("c_usuario", $v_usuario, time() + (2 * 60 * 60));
	setcookie("c_time_login", $v_time, time() + 7200);
	echo "Ola $v_usuario";
	
	echo "<a href=proc_dados.php>Testar tempo após login</a>";

} else {
	$agora = time();
	$ult_acesso = isset($_COOKIE["c_ultimo_acesso"]) ? $_COOKIE["c_ultimo_acesso"] : $agora;
	$passou = $agora - $ult_acesso;
	
	if ($passou > 30) {
		echo "<h1>Faça login novamente</h1>";
		echo "<p>Passaram $passou segundos desde o último acesso.</p>";
		echo "<a href=index.html>Login</a>";
	} else {
		echo "<p>Passaram $passou segundos desde o último acesso.</p>";
		echo "<p>Após 30 segundos de inatividade será exibida mensagem solicitando novo login.</p>";
	}
	
	setcookie("c_ultimo_acesso", $agora, time() + 7200);
	echo "<a href=proc_dados.php>Testar tempo após login</a>";
}
?>
