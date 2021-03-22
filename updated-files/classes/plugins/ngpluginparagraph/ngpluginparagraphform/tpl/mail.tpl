<!DOCTYPE html>

<html lang="de"> 
	<head>
		<title></title>
		<meta charset="UTF-8" />
		
		<style type="text/css">

			body, table {
				font-family: Corbel, "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans serif;;
				font-size: 13px;
				color: #333333;
			}
			
			html {
				background-color: #faf8f6;
			}

			table {
				background-color: #ffffff;
				border: 1px solid #d9d9d8;
				border-collapse:collapse;
				width:100%;
			}
			th, td {
				border: 1px solid #d9d9d8;
				padding: 8px;
				text-align: left;
			}
			
			th {
				background-color: #ebeff6;
				color: #385d89;
				font-style: italic;
			}
			
			td.first {
				font-weight: bold;
				font-style: italic;
			}
			
			a {
				color: #333333;
			}
			
			a:hover {
				color: #385d89;
			}
}

		</style>
				
	</head>
	

	<body>
	
		<p>{$preamble|escape}</p>
		
	
		<table>
			<tr>
				<th>{$lang['field']->value|escape}</th>
				<th>{$lang['value']->value|escape}</th>
			</tr>

{foreach $items as $item}
{if $item->view() && ( ($item->caption!==null && $item->caption!=='') || ($item->result()!==null && $item->result()!=='') ) }

			<tr>
				<td class="first">{$item->caption}</td>
{if $item->type==='Email' && $item->result()!==''}
	<td><a href="mailto:{$item->result()|escape}">{$item->result()|escape}</a></td>
{else}
				<td>{$item->result()|escape}</td>
{/if}
			</tr>
{/if}
{/foreach}			

		</table>		
	</body>
</html>