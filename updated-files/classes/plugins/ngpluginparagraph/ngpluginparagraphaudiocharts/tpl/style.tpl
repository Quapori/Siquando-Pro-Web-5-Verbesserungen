.ngpluginaudiocharts ul
{
	list-style: none;
	margin: 0;
	padding: 0;
}

.ngpluginaudiocharts a
{
	text-decoration: none;
	color: #{{$settings->defaultfont|ngfontcolor}};
}

.ngpluginaudiocharts li
{
	display: block;
	margin: 0 0 4px 0;
	padding: 0;
	height: 32px;
	position: relative;
	overflow: hidden;
}

.ngpluginaudiocharts span
{
	line-height: 32px;
	display: block;
	position: absolute;
	top: 0;
	left: 40px;
}

.ngpluginaudiocharts .ngpluginaudiochartsbutton
{
	position: absolute;
	width: 32px;
	height: 32px;
	top: 0;
	left: 0;
	background-repeat: no-repeat; 
	background-position: 0 -32px;
}

.ngpluginaudiocurrent .ngpluginaudiochartsbutton {
	background-position: 0 0;
}


 .ngpluginaudiochartstimea, 
 .ngpluginaudiochartstimeb {
	position: absolute;
	width: 16px;
	height: 32px;
	top: 0;
	opacity: 0;
	transition: opacity 1s;
	overflow: hidden;
}

.ngpluginaudiocurrent .ngpluginaudiochartstimea, 
.ngpluginaudiocurrent .ngpluginaudiochartstimeb {
	opacity: 1;
} 


.ngpluginaudiochartstimea
{
	left: 16px;
}

.ngpluginaudiochartsspinner,
.ngpluginaudiochartsbowa,
.ngpluginaudiochartsbowb {
	width: 32px;
	height: 32px;
	position: absolute;
	top: 0;
	left: 0;
	background-repeat: no-repeat;
} 
.ngpluginaudiochartsbowa {
	left: -16px;
	background-position: 0 -64px;
}

.ngpluginaudiochartsbowb {
	transform: rotate(180deg);
	background-position: 0 -64px;
}



.ngpluginaudiochartsspinner
{
	background-position: 0 -96px;
	opacity: 0;
	transition: opacity 1s;
	animation:spin 6s linear infinite;
	-webkit-animation:spin 6s linear infinite;
	-moz-animation:spin 6s linear infinite;	
}

@-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
@-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
@keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }

.ngpluginaudiocurrent .ngpluginaudiochartsspinner
{
	opacity: 1;
}


.ngpluginaudiocurrent {
	font-weight: bold;
}