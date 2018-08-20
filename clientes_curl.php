<?php
$nome = $_POST['nome'];
$ch = curl_init();
// informar URL e outras funções ao CURL
curl_setopt($ch, CURLOPT_URL, "http://localhost/teste/clientes_db.php");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FILETIME, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,'nome='.$nome);

$output = curl_exec($ch);
$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);// Pegar o código de resposta
if ($response_code == '404') {
	echo 'Página não existente';
} else {
	//echo $output;
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$doc->loadHTML($output);
	$xpath = new DOMXpath($doc);
	$elemento = $xpath->query("*")->item(0)->nodeValue;
	echo $elemento;
}//end else
curl_close($ch);
?>