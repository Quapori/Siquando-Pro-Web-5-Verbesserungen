body {
	background-color: #{{$config['palette.background']}};
	margin: 0;
	padding: 0;
}

#eyecatcher {
	width: 100%;
	background-color: #000000;
	position: relative;
}

#eyecatcher>.eyecatcherfill {
	height: 300px;
	background-color: #{{$config['palette.eyecatcher.background']}};
}

#eyecatcher>img {
	opacity: {{round(floatval($config['options.eyecatcher'])/100,2)}};
	width: 100%;
	height: auto;
}

#eyecatcherl {
	display: block;
}

#eyecatcherp {
	display: none;
}

@media (max-width: 767px) {
	#eyecatcherl {
		display: none;
	}

	#eyecatcherp {
		display: block;
	}
}

#eyecatchercaption {
	position: absolute;
	left: 0;
	bottom: 0;
	width: 100%;
}

.sqreyecatchernav {
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 0 40px;
	box-sizing: border-box;
	height: 85px;
}

.sqreyecatchernav a {
	display: inline-block;
	color: #{{$config['palette.eyecatcher']}};
	text-decoration: none;
	border-top: 2px solid transparent;
	border-bottom: 2px solid transparent;
	padding: 5px 0;
	margin-right: 10px;
	transition: border-bottom-color 0.3s, color 0.3s;
	vertical-align: middle;
}

.sqreyecatchernav a:hover {
	color: #{{$config['palette.eyecatcher.hover']}};
}

.sqrmodenav .sqreyecatchernav a[href="#sqrmodenav"] {
	border-bottom-color: #{{$config['palette.eyecatcher']}};
}

.sqrmodesearch .sqreyecatchernav a[href="#sqrmodesearch"] {
	border-bottom-color: #{{$config['palette.eyecatcher']}};
}

.sqreyecatchernav svg {
	display: inline;
	vertical-align: middle;
}

.sqreyecatchernav span {
	display: inline;
	vertical-align: middle;
	font-size: 13px;
	text-transform: uppercase;
	margin-left: 8px;
}

.sqreyecatchernav em.ngshopcartindicator {
	display: none;
	color: #{{$config['palette.eyecatcher']}};
	font-style: normal;
	border-radius: 12px;
	margin-left: 4px;
	font-weight: bold;
}

.sqreyecatchernav em.ngshopcartindicatoractive {
	display: inline-block;
}


@media (max-width: 767px) {
	.sqreyecatchernav a span {
		display: none;
	}
}


.sqreyecatchernav img {
	display: block;
	width: 180px;
	height: auto;
	margin: 0 auto;
}


#eyecatchercaption h1 {
	display: block;
	max-width: {{$config['options.width.content']}}px;
	margin: 0 auto;
	color: #{{$config['palette.eyecatcher']}};
	padding: 20px 20px 40px 20px;
	box-sizing: border-box;
}

#maincontainer {
   max-width: {{$config['options.width']}}px;
    margin: 0 auto;
}

#main {
	background-color: #{{$config['palette.background.content']}};
	padding: 40px 0;
}

#sidebarleft,
#content,
#sidebarright {
	min-height: 1px;
}

#header {
	padding: 20px 0;
    background-color: #{{$config['palette.background.header']}};
}

#footer {
	padding: 20px 0;
    background-color: #{{$config['palette.background.footer']}};
}

.sqrnav {
	position: absolute;
	top: 85px;
	left: -99999px;
	z-index: 1000;
	transform: translate3d(0,-15px,0);
	opacity: 0;
	transition: transform 0.2s ease-out, opacity 0.2s ease-out;
	width: 100%;
}

.sqrbreadcrumbs {
	padding: 30px 40px 0 40px;
	font-size: 13px;
	text-transform: uppercase;
	background-color: #{{$config['palette.nav.background']}};
	color: #{{$config['palette.nav.color']}};
}

.sqrbreadcrumbs>a {
	color: #{{$config['palette.nav.color.hover']}};
	text-decoration: none;
}

.sqrnav>ul {
	display: flex;
	flex-wrap: wrap;
	list-style: none;
	margin: 0;
	padding: 0 20px;
	width: 100%;
	box-sizing: border-box;
	background-color: #{{$config['palette.nav.background']}};
}

.sqrnavfader {
	width:100%;
	height:80px;
	background-image: linear-gradient(180deg, rgba({{$config['palette.nav.background']|ngrgb}},255), rgba({{$config['palette.nav.background']|ngrgb}},0));
}

.sqrmodenav .sqrnav {
	left: 0;
	transform: translate3d(0,0,0);
	opacity: 1;
}

.sqrnav>ul>li {
	display: block;
	margin: 0;
	padding: 20px 10px;
	width: 25%;
	box-sizing: border-box;
}

@media (max-width: 1023px) {
	.sqrnav>ul>li {
		width: 50%;
	}
}

@media (max-width: 767px) {
	.sqrnav>ul>li {
		width: 100%;
	}
}


.sqrnav>ul a {
	color: #{{$config['palette.nav.color']}};
	text-decoration: none;
	font-size: 13px;
	text-transform: uppercase;
	display: block;
	padding: 10px;
	transition: background-color 0.2s, color 0.2s;
}

.sqrnav>ul>li>a {
	font-weight: bold;
}

.sqrnav>ul a span {
	display: block;
}

.sqrnav > ul > li em.ngshopcartindicator {
	display: none;
	background-color: #{{$config['palette.nav.color.hover']}};
	color: #ffffff;
	font-style: normal;
	padding-right: 8px;
	padding-left: 8px;
	border-radius: 8px;
	margin-left: 8px;
	font-weight: normal;
}

.sqrnav > ul > li em.ngshopcartindicatoractive {
	display: inline-block;
}



.sqrnav>ul a:hover {
	background-color: #{{$config['palette.nav.background.hover']}};
	color: #{{$config['palette.nav.color.hover']}};
}


.sqrnav>ul a img {
	display: block;
	width: 100%;
	height: auto;
	margin-top: 10px;
	transition: opacity 0.2s;
}

.sqrnav>ul a:hover img {
	opacity: 0.8;
}

.sqrnav>ul>li>ul {
	display: block;
	margin: 0;
	padding: 0;
	list-style: none;
}

.sqrsearch {
	position: absolute;
	top: 85px;
	margin: 0;
	padding: 30px;
	background-color: #{{$config['palette.nav.background']}};
	width: 100%;
	box-sizing: border-box;
	left: -99999px;
	z-index: 1000;
	transform: translate3d(0,-15px,0);
	opacity: 0;
	transition: transform 0.2s ease-out, opacity 0.2s ease-out;
}

.sqrmodesearch .sqrsearch {
	left: 0;
	transform: translate3d(0,0,0);
	opacity: 1;
}

.sqrsearch form {
	display: flex;
	padding: 0;
	margin: 0;
	border: 1px solid #{{$config['palette.background']}};
	box-sizing: border-box;
	background-color: #{{$config['palette.nav.background']}};
}

.sqrsearch form input {
	margin: 0;
	padding: 0;
	border: none;
	outline: none;
	flex-grow: 1;
	padding: 14px 30px;
	font: 16px Montserrat,Verdana,Helvetica,sans-serif;
	line-height: 22px;
	color: #{{$config['palette.nav.color']}};
	background-color: #{{$config['palette.nav.background']}};
}

.sqrsearch form button
{
	border-style: none;
	display: block;
	float: right;
	cursor: pointer;
	outline: none;
	-webkit-appearance: none;
	background-color: transparent;
	margin: 0;
	padding: 0;
	color: #{{$config['palette.nav.color']}};
}



@media (min-width: 1024px) {
	.sqrallwaysboxed, 
	.sqrmobilefullwidth,
	.sqrdesktopboxed
	{
		box-sizing: border-box;
		padding-left: 20px;
		padding-right: 20px;
        max-width: {{$config['options.width.content']}}px;
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
	 		
	.sqrmain2col>div {
    	box-sizing: border-box;
    	width: 48%;
    	float: left;
    	margin-right: 4%;
  	}
  	.sqrmain2col>div:last-child {
    	margin-right: 0;
  	}
  	.sqrmain3col>div {
    	box-sizing: border-box;
    	width: 30.6666666666%;
    	float: left;
    	margin-right: 4%;
  	}
  	.sqrmain3col>div:last-child {
    	margin-right: 0;
  	}
  	.sqrmain3collr>div {
    	box-sizing: border-box;
    	width: 50%;
    	float: left;
  	}
  	.sqrmain3collr>div:first-child {
    	width: 21%;
    	margin-right: 4%;
  	}
  	.sqrmain3collr>div:last-child {
    	width: 21%;
    	margin-left: 4%;
  	}
  	.sqrmain2coll>div {
    	box-sizing: border-box;
    	width: 75%;
    	float: left;
  	}
  	.sqrmain2coll>div:first-child {
    	width: 21%;
    	margin-right: 4%;
  	}
  	.sqrmain2colr>div {
    	box-sizing: border-box;
    	width: 75%;
    	float: left;
  	}
  	.sqrmain2colr>div:last-child {
    	width: 21%;
    	margin-left: 4%;
  	}
  	
  	
	.sqrmain3col:after, 
	.sqrmain2col:after,
	.sqrmain3collr:after,
	.sqrmain2coll:after,
	.sqrmain2colr:after
	 {
    	visibility: hidden;
    	display: block;
    	font-size: 0;
    	content: " ";
    	clear: both;
    	height: 0;
  	}

	.sqrdesktophidden {
		display: none;
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
		padding-left: 20px;
		padding-right: 20px;
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
		padding-left: 20px !important;
		padding-right: 20px !important;
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
}

footer {
	background-color: #{{$config['palette.footer.background']}};
	margin: 0;
	padding: 10px 30px;
	font-size: 13px;
	text-transform: uppercase;
	color: #ffffff;
}

footer a {
	color: #{{$config['palette.footer.weak']}};
	text-decoration: none;
	transition: color 0.2s;
}

footer a:hover {
	color: #{{$config['palette.footer.color']}};
}

.sqrfooter {
	margin: 10px 0;
	text-align: center;
	color: #{{$config['palette.footer.weak']}};
}

.sqrcommonnavhierarchical {
	display: flex;
	flex-wrap: wrap;
	list-style: none;
	margin: 0;
	padding: 10px 0;
}

.sqrcommonnavhierarchical>li {
	display: block;
	margin: 0;
	padding: 10px;
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
	padding: 5px 0;
}

.sqrcommonnavhierarchical>li>ul {
	display: block;
	margin: 0;
	padding: 0;
}

.sqrcommonnavhierarchical>li>ul>li {
	display: block;
	margin: 0;
	padding: 5px 0;
}

.sqrcommonnav {
	display: block;
	list-style: none;
	margin: 0;
	padding: 10px 0;
	text-align: center;
}

.sqrcommonnav>li {
	display: inline-block;
	margin: 0;
	padding: 0 10px;
}

.sqrcontact {
	padding: 0 10px;
	text-align: center;
}

.sqrcontact {
	padding: 10px;
	text-align: center;
}

.sqrcontact svg {
	width: 16px;
	height: 16px;
	border: 0;
	padding: 0;
	margin: 4px;
}

@media (max-width: 768px) {
	.sqreyecatchernav {
		padding: 0 20px;
	}
	.sqrnav>ul {
		padding: 0;
	}
	.sqrbreadcrumbs {
		padding: 30px 20px 0 20px;
	}
	footer {
		padding: 10px 10px;
	}
	.sqrfooter {
		margin: 10px 10px;
	}
}

@media (max-width: 480px) {

	.sqreyecatchernav img {
		width: 120px;
	}
}