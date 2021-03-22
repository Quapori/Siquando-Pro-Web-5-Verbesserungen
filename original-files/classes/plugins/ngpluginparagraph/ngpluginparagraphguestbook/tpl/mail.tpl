<!DOCTYPE html>

<html lang="de">
<head>
<title></title>
<meta charset="UTF-8" />

<style type="text/css">
body,table {
	font-family: Corbel, "Lucida Grande", "Lucida Sans Unicode",
		"Lucida Sans", "DejaVu Sans", Verdana, sans serif;;
	font-size: 13px;
	color: #333333;
}

a {
	color: #4682b4;
	text-decoration: none;
}

a:hover {
	text-decoration: underline;
}

html {
	background-color: #faf8f6;
}

table {
	background-color: #ffffff;
	border: 1px solid #d9d9d8;
	border-collapse: collapse;
	width: 100%;
}

td {
	border: 1px solid #d9d9d8;
	padding: 8px;
	text-align: left;
}
</style>

</head>


<body>

<p>
{$lang['mailpreamble']->value|escape}
{if isset($link)}
<a href="{$link|escape}">{$lang['mailview']->value|escape}</a>
{/if}
{if $mod}
{$lang['mailpreamblemod']->value|escape}
{/if}
</p>


<table>
	<tbody>
		<tr>
			<td>{$lang['mailname']->value|escape}:</td>
			<td>{$name|escape}</td>
		</tr>
		{if isset($email)}
		<tr>
			<td>{$lang['mailemail']->value|escape}:</td>
			<td><a href="mailto:{$email|escape}">{$email|escape}</a></td>
		</tr>
		{/if} {if isset($location)}
		<tr>
			<td>{$lang['maillocation']->value|escape}:</td>
			<td>{$location|escape}</td>
		</tr>
		{/if}
		<tr>
			<td>{$lang['mailcaption']->value|escape}:</td>
			<td>{$caption|escape}</td>
		</tr>
		{if isset($stars)}
		<tr>
			<td>{$lang['mailstars']->value|escape}:</td>
			<td>{$stars|escape}</td>
		</tr>
		{/if}
		<tr>
			<td>{$lang['mailmessage']->value|escape}:</td>
			<td>{$message|escape|nl2br}</td>
		</tr>
	</tbody>
</table>

</body>
</html>