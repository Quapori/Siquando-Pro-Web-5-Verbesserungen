{config_load file='ui.lang'}

{foreach $items as $item}

{if $item->containerType=='paragraph' && $item->paragraph->isVisible()}

{if $responsive}
<div class="sqr{$item->paragraph->renderMode} {$item->paragraph->getVisibleClass()}" {if $item->paragraph->isanchor}data-sqranchor="{$item->paragraph->DisplayAnchorText()|escape}" id="nga{$item->paragraph->objectUID}"{/if}>
{/if}

{if $preview}
<div class="nguiparagraphcontainer">
{/if}

{if $item->paragraph->caption!==''}<h{$item->paragraph->level}{if $responsive} class="sqrallwaysboxed"{/if}{if !$responsive && $item->paragraph->isanchor} id="nga{$item->paragraph->objectUID}"{/if}>{$item->paragraph->caption|escape}</h{$item->paragraph->level}>{/if}
<div class="paragraph" style="{if $item->paragraph->marginbottom!=10}margin-bottom:{$item->paragraph->marginbottom}px;{/if}{if $item->paragraph->paragraphmaxwidth!==-1}max-width:{$item->paragraph->paragraphmaxwidth}px;{/if}{if $item->paragraph->paragraphwidth!==100}width:{$item->paragraph->paragraphwidth}%;{/if}{if $item->paragraph->paragraphalign==='Center' && ($item->paragraph->paragraphmaxwidth!==-1 || $item->paragraph->paragraphwidth!==100)}margin-left:auto;margin-right:auto;{/if}{if $item->paragraph->paragraphalign==='Right' && ($item->paragraph->paragraphmaxwidth!==-1 || $item->paragraph->paragraphwidth!==100)}margin-left:auto;margin-right:0;{/if}">{$item->paragraph->output}</div>

{if $preview}
<div class="nguieditparagraph">
<a title="{#edit#|escape}" href="ng://paragraph/{$item->paragraph->objectUID}"><img src="{$imageedit}" alt="{#edit#|escape}" /></a>
<a title="{#delete#|escape}" href="ng://deleteparagraph/{$item->paragraph->objectUID}"><img src="{$imagedelete}" alt="{#delete#|escape}" /></a>
</div>
</div>
{/if}

{if $responsive}
</div>
{/if}

{/if}

{if $item->containerType=='column'}

{if ($item->caption!=='')}
<h{$item->level}{if $responsive} class="sqrallwaysboxed"{/if}>{$item->caption|escape}</h{$item->level}>
{/if}

{if !$mobile}<div class="columncontainer{if $responsive} sqrdesktopboxed sqrcolumncontainer{count($item->containers)}{/if}"{if $item->columnimage!=''} style="background-image: url({$item->columnimage|escape})"{/if}>{/if}

{foreach $item->containers as $container}
	{if !$mobile}<div class="column" {if !$responsive}style="width:{$item->renderWidth}px;{if !$container@last} margin-right: {$item->gutter}px;{/if}"{/if}>{/if}
		{foreach $container->paragraphs as $paragraph}
			{if $paragraph->isVisible()}
			
				{if $responsive}
				<div class="sqr{$paragraph->renderMode} {$paragraph->getVisibleClass()}" {if $paragraph->isanchor}data-sqranchor="{$paragraph->DisplayAnchorText()|escape}" id="nga{$paragraph->objectUID}"{/if}>
				{/if}
			
				{if $preview}
				<div class="nguiparagraphcontainer">
				{/if}
			
				{if $paragraph->caption!==''}<h{$paragraph->level}{if $responsive} class="sqrallwaysboxed"{/if}{if !$responsive && $paragraph->isanchor} id="nga{$paragraph->objectUID}"{/if}>{$paragraph->caption|escape}</h{$paragraph->level}>{/if}
				<div class="paragraph" style="{if $paragraph->marginbottom!=10}margin-bottom:{$paragraph->marginbottom}px;{/if}{if $paragraph->paragraphmaxwidth!==-1}max-width:{$paragraph->paragraphmaxwidth}px;{/if}{if $paragraph->paragraphwidth!==100}width:{$paragraph->paragraphwidth}%;{/if}{if $paragraph->paragraphalign==='Center' && ($paragraph->paragraphmaxwidth!==-1 || $paragraph->paragraphwidth!==100)}margin-left:auto;margin-right:auto;{/if}{if $paragraph->paragraphalign==='Right' && ($paragraph->paragraphmaxwidth!==-1 || $paragraph->paragraphwidth!==100)}margin-left:auto;margin-right:0;{/if}">{$paragraph->output}</div>
				
				{if $preview}
				<div class="nguieditparagraph">
				<a title="{#edit#|escape}" href="ng://paragraph/{$paragraph->objectUID}"><img src="{$imageedit}" alt="{#edit#|escape}" /></a>
				<a title="{#delete#|escape}" href="ng://deleteparagraph/{$paragraph->objectUID}"><img src="{$imagedelete}" alt="{#delete#|escape}" /></a>
				</div>
				</div>
				{/if}
				
				{if $responsive}
				</div>
				{/if}
			{/if}
			
		{/foreach}
	{if !$mobile}</div>{/if}
{/foreach}

{if !$mobile }
{if !$responsive}<div class="clearfix"></div>{/if}
</div>
{/if}

{/if}

{if $item->containerType=='tab'}

{if ($item->caption!=='')}
<h{$item->level}{if $responsive} class="sqrallwaysboxed"{/if}>{$item->caption|escape}</h{$item->level}>
{/if}

<div class="tabs_{if $item->overrideStyle}{$item->uid}{else}default{/if} {if $responsive} sqrmobilefullwidth{/if}">

<ul class="{if $responsive}sqrmobileboxedimportant {/if}tab">
{foreach $item->containers as $container}
<li><a href="#{$container->uid}"{if $container@first} class="tabselected"{/if}>{$container->caption|escape}</a></li>
{/foreach}
</ul>

<div class="tabcontainer sqrdesktopremovebox">

{foreach $item->containers as $container}
	<div class="tabarea{if !$container@first} tabareaclosed{/if}" id="{$container->uid}">
		{foreach $container->paragraphs as $paragraph}
			{if $paragraph->isVisible()}
				{if $responsive}
				<div class="sqr{$paragraph->renderMode} {$paragraph->getVisibleClass()}" {if $paragraph->isanchor}data-sqranchor="{$paragraph->DisplayAnchorText()|escape}" id="nga{$paragraph->objectUID}"{/if}>
				{/if}				
				{if $preview}
				<div class="nguiparagraphcontainer">
				{/if}
				{if $paragraph->caption!==''}<h{$paragraph->level}{if $responsive} class="sqrallwaysboxed"{/if}{if !$responsive && $paragraph->isanchor} id="nga{$paragraph->objectUID}"{/if}>{$paragraph->caption|escape}</h{$paragraph->level}>{/if}
				<div class="paragraph" style="{if $paragraph->marginbottom!=10}margin-bottom:{$paragraph->marginbottom}px;{/if}{if $paragraph->paragraphmaxwidth!==-1}max-width:{$paragraph->paragraphmaxwidth}px;{/if}{if $paragraph->paragraphwidth!==100}width:{$paragraph->paragraphwidth}%;{/if}{if $paragraph->paragraphalign==='Center' && ($paragraph->paragraphmaxwidth!==-1 || $paragraph->paragraphwidth!==100)}margin-left:auto;margin-right:auto;{/if}{if $paragraph->paragraphalign==='Right' && ($paragraph->paragraphmaxwidth!==-1 || $paragraph->paragraphwidth!==100)}margin-left:auto;margin-right:0;{/if}">{$paragraph->output}</div>
				
				{if $preview}
				<div class="nguieditparagraph">
				<a title="{#edit#|escape}" href="ng://paragraph/{$paragraph->objectUID}"><img src="{$imageedit}" alt="{#edit#|escape}" /></a>
				<a title="{#delete#|escape}" href="ng://deleteparagraph/{$paragraph->objectUID}"><img src="{$imagedelete}" alt="{#delete#|escape}" /></a>
				</div>
				</div>
				{/if}
				{if $responsive}
				</div>
				{/if}
				{/if}
			
		{/foreach}
	</div>
{/foreach}

</div>

</div>

{/if}

{if $item->containerType=='faq'}

	{if ($item->caption!=='')}
		<h{$item->level}{if $responsive} class="sqrallwaysboxed"{/if}>{$item->caption|escape}</h{$item->level}>
	{/if}

	<div class="faq_{if $item->overrideStyle}{$item->uid}{else}default{/if} {if $responsive} sqrdesktopboxed{/if}">

		<div class="sqrmobileboxed faq">
			<ul>
				{foreach $item->containers as $container}
					<li><a href="#{$container->uid}"{if $container@first} class="faqselected"{/if}>{$container->caption|escape}</a></li>
				{/foreach}
			</ul>
		</div>

		<div class="faqcontainer">

			{foreach $item->containers as $container}
				<div class="faqarea{if !$container@first} faqareaclosed{/if}" id="{$container->uid}">
					{foreach $container->paragraphs as $paragraph}
						{if $paragraph->isVisible()}
							{if $responsive}
								<div class="sqr{$paragraph->renderMode} {$paragraph->getVisibleClass()}" {if $paragraph->isanchor}data-sqranchor="{$paragraph->DisplayAnchorText()|escape}" id="nga{$paragraph->objectUID}"{/if}>
							{/if}
						{if $preview}
							<div class="nguiparagraphcontainer">
						{/if}
							{if $paragraph->caption!==''}<h{$paragraph->level}{if $responsive} class="sqrallwaysboxed"{/if}{if !$responsive && $paragraph->isanchor} id="nga{$paragraph->objectUID}"{/if}>{$paragraph->caption|escape}</h{$paragraph->level}>{/if}
							<div class="paragraph" style="{if $paragraph->marginbottom!=10}margin-bottom:{$paragraph->marginbottom}px;{/if}{if $paragraph->paragraphmaxwidth!==-1}max-width:{$paragraph->paragraphmaxwidth}px;{/if}{if $paragraph->paragraphwidth!==100}width:{$paragraph->paragraphwidth}%;{/if}{if $paragraph->paragraphalign==='Center' && ($paragraph->paragraphmaxwidth!==-1 || $paragraph->paragraphwidth!==100)}margin-left:auto;margin-right:auto;{/if}{if $paragraph->paragraphalign==='Right' && ($paragraph->paragraphmaxwidth!==-1 || $paragraph->paragraphwidth!==100)}margin-left:auto;margin-right:0;{/if}">{$paragraph->output}</div>

						{if $preview}
							<div class="nguieditparagraph">
								<a title="{#edit#|escape}" href="ng://paragraph/{$paragraph->objectUID}"><img src="{$imageedit}" alt="{#edit#|escape}" /></a>
								<a title="{#delete#|escape}" href="ng://deleteparagraph/{$paragraph->objectUID}"><img src="{$imagedelete}" alt="{#delete#|escape}" /></a>
							</div>
							</div>
						{/if}
							{if $responsive}
								</div>
							{/if}
						{/if}

					{/foreach}
				</div>
			{/foreach}

		</div>

	</div>

{/if}


	{if $item->containerType=='accordion'}

{if ($item->caption!=='')}
<h{$item->level}{if $responsive} class="sqrallwaysboxed"{/if}>{$item->caption|escape}</h{$item->level}>
{/if}

<div class="accordion_{if $item->overrideStyle}{$item->uid}{else}default{/if} {if $responsive} sqrallwaysboxed{/if}">

{foreach $item->containers as $container}
<a href="#{$container->uid}" class="nglink accordionlink{if !$container->open} accordionlinkclosed{/if}{if $item->animate} accordionanimate{/if}">{$container->caption|escape}</a>
	<div class="accordionarea{if !$container->open} accordionareaclosed{/if}" id="{$container->uid}">
		{foreach $container->paragraphs as $paragraph}
			{if $paragraph->isVisible()}
				{if $responsive}
				<div class="{$paragraph->getVisibleClass()}" {if $paragraph->isanchor}data-sqranchor="{$paragraph->DisplayAnchorText()|escape}" id="nga{$paragraph->objectUID}"{/if}>
				{/if}
				{if $preview}
				<div class="nguiparagraphcontainer">
				{/if}
				{if $paragraph->caption!==''}<h{$paragraph->level}{if !$responsive && $paragraph->isanchor} id="nga{$paragraph->objectUID}"{/if}>{$paragraph->caption|escape}</h{$paragraph->level}>{/if}
				<div class="paragraph" style="{if $paragraph->marginbottom!=10}margin-bottom:{$paragraph->marginbottom}px;{/if}{if $paragraph->paragraphmaxwidth!==-1}max-width:{$paragraph->paragraphmaxwidth}px;{/if}{if $paragraph->paragraphwidth!==100}width:{$paragraph->paragraphwidth}%;{/if}{if $paragraph->paragraphalign==='Center' && ($paragraph->paragraphmaxwidth!==-1 || $paragraph->paragraphwidth!==100)}margin-left:auto;margin-right:auto;{/if}{if $paragraph->paragraphalign==='Right' && ($paragraph->paragraphmaxwidth!==-1 || $paragraph->paragraphwidth!==100)}margin-left:auto;margin-right:0;{/if}">{$paragraph->output}</div>
				
				{if $preview}
				<div class="nguieditparagraph">
				<a title="{#edit#|escape}" href="ng://paragraph/{$paragraph->objectUID}"><img src="{$imageedit}" alt="{#edit#|escape}" /></a>
				<a title="{#delete#|escape}" href="ng://deleteparagraph/{$paragraph->objectUID}"><img src="{$imagedelete}" alt="{#delete#|escape}" /></a>
				</div>
				</div>
				{/if}
				{if $responsive}
				</div>
				{/if}
			{/if}
			
		{/foreach}
	</div>
{/foreach}

</div>

{/if}


{/foreach}

{if $preview}

{if $responsive}
<div class="sqrallwaysboxed">
{/if}

{if count($items) eq 0}

<p class="nguinoparagaph">
{#emptyparagraphstream#}
</p>
<div class="nguiaddparagraph">
<a href="ng://addparagraph/{$streamuid}" title="{#addparagraph#|escape}"><img src="{$imageadd}" alt="{#addparagraph#|escape}" /></a>
<a href="ng://addparagraphtext/{$streamuid}" title="{#addtextparagraph#|escape}"><img src="{$imageaddtext}" alt="{#addtextparagraph#|escape}" /></a>
<a href="ng://addparagraphpicture/{$streamuid}" title="{#addpictureparagraph#|escape}"><img src="{$imageaddpicture}" alt="{#addpictureparagraph#|escape}" /></a>
</div>

{else}

<div class="nguiaddparagraph">
<a href="ng://addparagraph/{$streamuid}" title="{#addparagraph#|escape}"><img src="{$imageadd}" alt="{#addparagraph#|escape}" /></a>
<a href="ng://addparagraphtext/{$streamuid}" title="{#addtextparagraph#|escape}"><img src="{$imageaddtext}" alt="{#addtextparagraph#|escape}" /></a>
<a href="ng://addparagraphpicture/{$streamuid}" title="{#addpictureparagraph#|escape}"><img src="{$imageaddpicture}" alt="{#addpictureparagraph#|escape}" /></a>
</div>


{/if}

{if $responsive}
</div>
{/if}


{/if}