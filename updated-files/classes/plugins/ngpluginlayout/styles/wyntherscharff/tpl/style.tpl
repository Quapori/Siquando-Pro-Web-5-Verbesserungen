body {
	background-color: #{{$config['palette.background']}};
	margin: 0;
	padding: 0;
}

#sqrtopbox {
	margin: 20px auto;
	padding: 1px 20px;
	max-width: {{$config['options.width']}}px;
}

#sqrtopbox::after {
	content: "";
	clear: both;
	display: table;
}

#sqrtopbox img {
	display: block;
	float: left;
}

#sqrtopbox form {
	display: block;
	margin: 0;
	padding: 0;
	background-color: #ffffff;
	border: 0;
	box-sizing: border-box;
	width: 320px;
	float: right;
}

#sqrtopbox input {
	display: block;
	margin: 0;
	padding: 0;
	background: url(./../../styles/wyntherscharff/img/?f=sprites&ca={{$config['palette.nav.foreground.1']}}) -9px -9px no-repeat;
	border: 0;
	padding: 10px 20px 10px 40px;
	box-sizing: border-box;
	width: 100%;
	line-height: 19px;
	color: #{{$config['palette.nav.foreground.3']}};
	font: 15px 'Open Sans',Verdana,Helvetica,sans-serif;
	outline: none;
	border: 1px solid #{{$config['palette.border']}};
	border-radius: 0;
}

#sqrouterbox {
	box-sizing: border-box;
	border-top: 1px solid #{{$config['palette.border']}};
	border-bottom: 1px solid #{{$config['palette.border']}};
}

@media screen and (min-width: {{$config['options.width']+40}}px) {
    #sqrouterbox {
        margin: 0 auto;
		max-width: {{$config['options.width']}}px;
        border-left: 1px solid #{{$config['palette.border']}};
		border-right: 1px solid #{{$config['palette.border']}};
    }
}

header {
	position: relative;
	overflow: hidden;
	margin: 0;
	padding: 0;
	border-bottom: 1px solid #{{$config['palette.border']}};
}

header img {
	width: 100%;
	display: block;
	border: 0;
	position: absolute;
	height: 100%;
}

header img.headersliderpri {
	z-index: 1;
	transition: none;
	-webkit-transition: none;
	opacity: 1;
}

header img.headerslidersec {
	z-index: 2;
	transition: none;
	-webkit-transition: none;
	opacity: 0;
}

header img.headerslidersecout {
	transition: opacity 0.5s;
	-webkit-transition: opacity 0.5s;
	opacity: 1;
}

#headersliderbullets {
	z-index: 3;
	position: absolute;
	bottom: 15px;
	left: 30px;
}

#headersliderbullets::after {
	content: '';
	clear: both;
	display: block;
}

#headersliderbullets a {
	width: 24px;
	height: 24px;
	background: url(./../../styles/wyntherscharff/img/?f=bullet&ca={{$config['palette.nav.foreground.1']}}) no-repeat left top;
	float: left;
	outline: none;
}

#headersliderbullets a.active {
	background-position: left bottom;
}


#maincontainer {
	box-sizing: border-box;
}

#sidebarleft,
#content,
#sidebarright {
	min-height: 1px;
	padding-top: 10px;
	padding-bottom: 10px;
}

#header {
	padding: 10px 0;
	border-bottom: 1px solid #{{$config['palette.border']}};
}

#footer {
	padding: 10px 0;
	border-top: 1px solid #{{$config['palette.border']}};
}

.sqrnav {
    padding: 0;
    line-height: 19px;
    box-sizing: border-box;
}

.sqrnav ul {
    display: block;
    margin: 0;
    padding: 0;
    list-style: none;
}

.sqrnav li {
    margin: 0;
    padding: 0;
    display: block;
    position: relative;
}

.sqrnav>ul>li {
    border-bottom: 1px solid #{{$config['palette.border']}};
}

.sqrnav>ul>li>a>span>svg {
	position: absolute;
	width: 24px;
	height: 24px;
	border: 0;
	padding: 0;
	top: 18px;
	left: 18px;
}

.sqrnav a {
    padding: 20px 20px 20px 64px;
    text-decoration: none;
    color: #{{$config['palette.nav.foreground.1']}};
    display: block;
}

.sqrnav a:hover {
	text-decoration: underline;
}

.sqrnav > ul > li em.ngshopcartindicator {
	display: none;
	background: #{{$config['palette.nav.cartindicator']}};
	color: #ffffff;
	font-style: normal;
	padding-right: 8px;
	padding-left: 8px;
	border-radius: 6px;
	margin-left: 16px;
	font-weight: normal;
	font-size-adjust: none;
}

.sqrnav > ul > li em.ngshopcartindicatoractive {
	display: inline-block;
}


.sqrnav .sqrnavhome a
{
	background: url(./../../styles/wyntherscharff/img/?f=sprites&ca={{$config['palette.nav.foreground.1']}}) 0 -180px no-repeat;
}

.sqrnav .sqrnavshow
{
	border-bottom: 1px solid #{{$config['palette.border']}};
	background: url(./../../styles/wyntherscharff/img/?f=sprites&ca={{$config['palette.nav.foreground.1']}}) 0 -60px no-repeat;
}

.sqrnav .sqrnavhide
{
	border-bottom: 1px solid #{{$config['palette.border']}};
	background: url(./../../styles/wyntherscharff/img/?f=sprites&ca={{$config['palette.nav.foreground.1']}}) 0 -120px no-repeat;
}


.sqrnav .sqrnavmore ul {
    height: 0;
    overflow: hidden;
    transition: opacity 0.7s;
    opacity: 0;
	padding-bottom: 0;
}

.sqrnav li.sqrnavopen>ul {
    height: inherit;
    opacity: 1;
	padding-bottom: 16px;
}

.sqrnav li li.sqrnavopen>ul {
	padding-bottom: 0px;
}

.sqrnav span {
    display: block;
}

.sqrnav li.active>a {
	border-right: 4px solid #{{$config['palette.nav.foreground.1']}};
	font-weight: bold;
}

.sqrnav li li a {
    padding-top: 8px;
	padding-bottom: 8px;
	color: #{{$config['palette.nav.foreground.2']}};
}

.sqrnav li li.active>a {
	border-right: 4px solid #{{$config['palette.nav.foreground.2']}};
	font-weight: bold;
}

.sqrnav li li li a {
	padding-left: 90px;
	color: #{{$config['palette.nav.foreground.3']}};
}

.sqrnav li li li.active>a {
	border-right: 4px solid #{{$config['palette.nav.foreground.3']}};
	font-weight: bold;
}

@media screen and (min-width: 1200px) {
    #navcontainer {
  	 	display: table;
		box-sizing: border-box;
		table-layout: fixed;
		width: 100%;
  	}
  	
  	.sqrnav {
    	width: 25%;
    	display: table-cell;
    	vertical-align: top;	
        border-right: 1px solid #{{$config['palette.border']}};
		padding-bottom: 60px;
	}
	
	#maincontainer {
    	width: 75%;
    	display: table-cell;
    	vertical-align: top;	
	}
{{if $config['options.sticky']==='true'}}
	.sqrnav>ul {
		position: sticky;
		top: 0;
	}
{{/if}}
}

@media screen and (min-width: 1024px) {
	.sqrallwaysboxed, 
	.sqrmobilefullwidth,
	.sqrdesktopboxed
	{
		box-sizing: border-box;
		padding-left: 30px;
		padding-right: 30px;
		margin-left: auto;
		margin-right: auto;
	}
	
	.sqrallwaysboxed .sqrallwaysboxed,
	.sqrdesktopboxed .sqrdesktopboxed,
	.sqrmobilefullwidth .sqrallwaysboxed,
	.sqrdesktopboxed .sqrallwaysboxed,
	.sqrdesktopboxed .sqrmobilefullwidth,
	.sqrdesktopremovebox .sqrallwaysboxed,
	.sqrdesktopremovebox .sqrmobilefullwidth
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 
	 
	 .sqrmain3collr,
	 .sqrmain2coll,
	 .sqrmain2colr {
	 	display: table;
		box-sizing: border-box;
		table-layout: fixed;
		width: 100%;
	 }
	 		
  	.sqrmain3collr>div {
    	box-sizing: border-box;
    	width: 50%;
    	display: table-cell;
    	vertical-align: top;    	
  	}
  	.sqrmain3collr>div:first-child {
    	width: 25%;
    	border-right: 1px solid #{{$config['palette.border']}};
  	}
  	.sqrmain3collr>div:last-child {
    	width: 25%;
    	border-left: 1px solid #{{$config['palette.border']}};
  	}
  	.sqrmain2coll>div {
    	box-sizing: border-box;
    	width: 75%;
    	display: table-cell;
    	vertical-align: top;
  	}
  	.sqrmain2coll>div:first-child {
    	width: 25%;
    	border-right: 1px solid #{{$config['palette.border']}};
  	}
  	.sqrmain2colr>div {
    	box-sizing: border-box;
    	width: 75%;
    	display: table-cell;
    	vertical-align: top;
  	}
  	.sqrmain2colr>div:last-child {
    	width: 25%;
    	border-left: 1px solid #{{$config['palette.border']}};
  	}
  	
  	.sqrallwaysfullwidth .sqrsuppressborders {
  		border-left: 0 !important;
  		border-right: 0 !important;
  	}
  	
  	
}

@media (max-width: 1023px) {
	.sqrallwaysboxed,
	.sqrmobileboxed 
	{
		box-sizing: border-box;
		padding-left: 30px;
		padding-right: 30px;
	}
	.sqrallwaysboxed>.sqrallwaysboxed,
	.sqrallwaysboxed>.nguiparagraphcontainer>.sqrallwaysboxed
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 .sqrmobileboxedimportant {
		padding-left: 30px !important;
		padding-right: 30px !important;
	 }	
	 .sqrmobilehidden {
	 	display: none;
	 }
	 
	 .sqrallwaysfullwidth .sqrsuppressborders,
	 .sqrmobilefullwidth .sqrsuppressborders
  	{
  		border-left: 0 !important;
  		border-right: 0 !important;
  	}
  	
  	#sidebarleft {
		border-bottom: 1px solid #{{$config['palette.border']}};
	}

	#sidebarright {
		border-top: 1px solid #{{$config['palette.border']}};
	}
}

footer {
	margin: 0 auto;
	padding: 30px 0 10px 0;
	max-width: {{$config['options.width']+40}}px;
}

footer a {
	color: #{{$config['palette.common.link']}};
	text-decoration: none;
	font-weight: normal;
}

footer a:hover {
	color: #{{$config['palette.common.link']}};
	text-decoration: underline;
	font-weight: normal;
}

.sqrfooter {
	text-align: center;
	color: #{{$config['palette.common.font']}};
	padding: 0 20px 10px 20px;
}

.sqrfooter a {
	color: #{{$config['palette.common.link']}};
	text-decoration: none;

}

.sqrcommonnavhierarchical {
	display: flex;
	flex-wrap: wrap;
	list-style: none;
	margin: 0;
	padding: 0 10px 10px 10px;
}

.sqrcommonnavhierarchical>li {
	display: block;
	margin: 0;
	padding: 0 10px 10px 10px;
	width: 100%;
	box-sizing: border-box;
}

@media (min-width: 768px) {
	.sqrcommonnavhierarchical>li {
		width: 50%;
	}
}

@media (min-width: 1024px) {
	.sqrcommonnavhierarchical2col>li {
		width: 50%;
	}
	.sqrcommonnavhierarchical3col>li {
		width: 33.3333333%;
	}
	.sqrcommonnavhierarchical4col>li {
		width: 25%;
	}
	.sqrcommonnavhierarchical5col>li {
		width: 20%;
	}
}

.sqrcommonnavhierarchical>li>span {
	display: block;
	padding: 0 0 10px 0;
	color: #{{$config['palette.common.font']}};
}

.sqrcommonnavhierarchical>li>ul {
	display: block;
	margin: 0;
	padding: 0;
}

.sqrcommonnavhierarchical>li>ul>li {
	display: block;
	margin: 0;
	padding: 0 0 8px 0;
}

.sqrcommonnav {
	display: block;
	list-style: none;
	margin: 0;
	padding: 0 10px 10px 10px;
	text-align: center;
}

.sqrcommonnav>li {
	display: inline-block;
	margin: 0;
	padding: 0 10px 10px 10px;
}

.sqrcontact {
	padding: 0 20px 10px 20px;
	text-align: center;
}

.sqrcontact svg {
	width: 16px;
	height: 16px;
	border: 0;
	padding: 0;
	margin: 4px;
}

@media (max-width: 1023px) {
	.sqrnav .sqrnavshow {
		display: block;
	}
	.sqrnav .sqrnavhide {
		display: none;
	}
	.sqrnavopen>a.sqrnavshow {
		display: none;
	}
	.sqrnavopen>a.sqrnavhide {
		display: block;
	}
	.sqrnav>ul {
		display: none;
	}
	.sqrnavopen>ul {
		display: block;
	}

	#sqrtopbox {
		margin: 0;
		padding: 1px 0;
		max-width: {{$config['options.width']}}px;
	}


	#sqrtopbox img {
		float: none;
		margin: 20px auto;
	}

	#sqrtopbox form {
		float: none;
		width: 100%;
	}

	#sqrtopbox input {
		border-left: none;
		border-right: none;
		border-bottom: none;
		background-position: 0 0;
		padding: 20px 20px 20px 64px;
	}
}

@media (min-width: 1024px) {

	.sqrnav .sqrnavshow,
	.sqrnav .sqrnavhide {
		display: none;
	}

	 .sqrdesktophidden {
	 	display: none;
	 }
	
}