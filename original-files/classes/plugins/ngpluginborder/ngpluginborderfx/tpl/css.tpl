.paragraphbordertop_{{$uid}}
{
	width: {{$width+$fx->leftInside+$fx->rightInside}}px;
	height: {{$fx->top}}px;
	background: url({{$image}}?m=t&w={{$totalwidth}}&f={{$fx->styleFile}}) no-repeat;
	margin: 0;
}

.paragraphbordermiddle_{{$uid}}
{
	width: {{$width}}px;
	padding: 1px {{$fx->rightInside}}px 1px {{$fx->leftInside}}px;
	background: url({{$image}}?m=m&w={{$totalwidth}}&f={{$fx->styleFile}}) repeat-y;
	margin: 0;
}

.paragraphborderbottom_{{$uid}}
{
	clear: left;
	width: {{$width+$fx->leftInside+$fx->rightInside}}px;
	height: {{$fx->bottom}}px;
	background: url({{$image}}?m=b&w={{$totalwidth}}&f={{$fx->styleFile}}) no-repeat;
	margin: 0;
}