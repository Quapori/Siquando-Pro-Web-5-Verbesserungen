.accordion_{{$uid}} .accordionarea
{
	margin-left: 20px;
}

.accordion_{{$uid}} .accordionareaclosed
{
	display: none;
}

.accordion_{{$uid}} a.accordionlink 
{
	background: url({{$open}}) no-repeat left center;
	font-weight: bold;
	display: block;
	padding: 8px 0 8px 20px;
	outline: none;
	text-decoration: none;
{{if $linewidth>0}}
	border-top: {{$linewidth}}px solid #{{$linecolor}};
{{/if}}
}

{{if $linewidth>0}}
.accordion_{{$uid}}:after
{
	border-bottom: {{$linewidth}}px solid #{{$linecolor}};
	content:" ";
	display: block;
}
{{/if}}

.accordion_{{$uid}} a.accordionlinkclosed 
{
	background-image: url({{$closed}});
}