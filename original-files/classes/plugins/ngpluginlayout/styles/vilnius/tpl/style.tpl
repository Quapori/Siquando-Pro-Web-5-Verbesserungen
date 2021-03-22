body {
	background-color: #{{$config['palette.background']}};
	margin: 0;
	padding: 0;
}

#maincontainer {
	background-color: #{{$config['palette.background']}};
	margin: 0 auto;
	background-color: #{{$config['palette.background.content']}};
	max-width: {{$config['options.width']}}px;
}

#sidebarleft,
#content,
#sidebarright {
	min-height: 1px;
	padding-top: 10px;
	padding-bottom: 10px;
}

#sidebarleft {
	background-color: #{{$config['palette.background.left']}};
}

#sidebarright {
	background-color: #{{$config['palette.background.right']}};
}


#header {
	padding: 10px 0;
	background-color: #{{$config['palette.background.header']}};
	border-bottom: 1px solid #{{$config['palette.border']}};
}

#footer {
	padding: 10px 0;
	background-color: #{{$config['palette.background.footer']}};
	border-top: 1px solid #{{$config['palette.border']}};
}

.sqrnav {
  display: block;
  margin: 0;
  padding: 0;
  background-color: #{{$config['palette.nav.dark']}};
  z-index: 1000;
  -webkit-user-select: none;
  user-select: none;
}

.sqrnav a {
  display: block;
  margin: 0;
  padding: 18px 22px;
  color: #{{$config['palette.nav.bright']}};
  text-decoration: none;
  -webkit-tap-highlight-color: transparent;
  line-height: 22px;
}

.sqrnav li.active>a {
	font-weight: bold;
}

.sqrnav>ul li {
  display: block;
  margin: 0;
  padding: 0;
  position: relative;
}

.sqrnav>ul li em.ngshopcartindicator {
    display: none;
    background-color: #{{$config['palette.nav.bright']}};
    color: #{{$config['palette.nav.dark']}};
    font-style: normal;
    padding-right: 8px;
    padding-left: 8px;
    border-radius: 8px;
    margin-left: 10px;
    font-weight: normal;
}

.sqrnav>ul li em.ngshopcartindicatoractive {
    display: inline-block;
}

.sqrnav .sqrnavsearch form {
  box-sizing: border-box;
  display: block;
  margin: 0;
  padding: 18px;
  display: block;
  width: 100%;
}

.sqrnav .sqrnavsearch input {
  box-sizing: border-box;
  display: block;
  padding: 0;
  width: 100%;
  border: 0;
  padding: 8px 12px 8px 30px;
  margin: 0;
  color: #{{$config['palette.nav.bright']}};
  border-color: rgba(255, 255, 255, 0.075);
  -webkit-appearance: none;
  border-radius: 0;
  background: #{{$config['palette.nav.dark']}} url(./../../styles/vilnius/img/?f=search&c={{$config['palette.nav.bright']}}) 8px 50% no-repeat;
}

@media screen and (max-width: 1023px) {
  .sqrnav>ul>li.sqrnavlogo {
	display: none;
  }	
  .sqrnav a, .sqrnav form {
    border-bottom: 1px solid rgba(255, 255, 255, 0.075);
  }
  .sqrnav a.sqrnavshow, .sqrnav a.sqrnavhide {
    background: url(./../../styles/vilnius/img/?f=menu&c={{$config['palette.nav.bright']}}) right center no-repeat;
  }
  .sqrnav a.sqrnavshow>img, .sqrnav a.sqrnavhide>img {
    display: block;
  }
  .sqrnav li.sqrnavmore>a {
    background: url(./../../styles/vilnius/img/?f=moreright&c={{$config['palette.nav.bright']}}) right center no-repeat;
  }
  .sqrnav li.sqrnavopen>a {
    background-image: url(./../../styles/vilnius/img/?f=moredown&c={{$config['palette.nav.bright']}});
  }
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
  .sqrnav li.sqrnavopen>ul {
    display: block;
  }
  .sqrnav ul {
    display: none;
    margin: 0 auto;
    padding: 0;
    list-style: none;
  }
  .sqrnav ul ul {
    display: none;
  }
  .sqrnav ul li li>a {
    padding-left: 44px;
  }
  .sqrnav ul li li li>a {
    padding-left: 66px;
  }
  .sqrnavopen>ul {
    display: block;
  }
}

@media screen and (min-width: 1024px) {
		
  .sqrnav>a {
    display: none;
  }
  .sqrnav>ul {
    box-sizing: border-box;
    display: block;
    margin: 0 auto;
    padding: 0;
    list-style: none;
    width: 100%;
    max-width: {{$config['options.width']}}px;
  }
  .sqrnav>ul:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
  }
  .sqrnav>ul>li {
    float: left;
  }
  .sqrnav>ul li>ul {
    position: absolute;
    background-color: #{{$config['palette.nav.medium']}};
    width: 30vw;
    max-width: 320px;
    display: block;
    left: -9999px;
    margin: 0;
    padding: 0;
    list-style: none;
    z-index: 1000;
    transform: translateY(-5px);
    opacity: 0;
    transition: transform 0.2s, opacity 0.2s;
  }
  .sqrnav>ul>li li {
    border-bottom: 1px solid rgba(255, 255, 255, 0.075);
  }
  .sqrnav>ul>li.sqrnavmore>a {
    background-image: url(./../../styles/vilnius/img/?f=moredown&c={{$config['palette.nav.bright']}});
    background-position: right center;
    background-repeat: no-repeat;
    padding-right: 44px;
  }
  .sqrnav>ul>li li.sqrnavmore>a {
    background-image: url(./../../styles/vilnius/img/?f=moreright&c={{$config['palette.nav.bright']}});
    background-position: right center;
    background-repeat: no-repeat;
    padding-right: 44px;
  }
  .sqrnav>ul>li.sqrnavopen>ul {
    left: 0;
    transform: translate(0);
    opacity: 1;
  }
  .sqrnav>ul>li ul li.sqrnavopen>ul {
    left: 100%;
    top: 0;
    transform: none;
    opacity: 1;
  }
  .sqrnav>ul>li.sqrnavopen {
    background-color: #{{$config['palette.nav.medium']}};
  }
  
  .sqrnav>ul>li.sqrnavhome>a>span, .sqrnav>ul>li.sqrnavsearch>a>span {
    display: none;
  }
  .sqrnav>ul>li.sqrnavhome>a {
    background-image: url(./../../styles/vilnius/img/?f=home&c={{$config['palette.nav.bright']}});
    background-repeat: no-repeat;
    background-position: center center;
    width: 16px;
    height: 22px;
    padding: 18px;
  }
  .sqrnav>ul>li.sqrnavlogo>a {
  	padding: 18px 20px;
  }
  .sqrnav>ul>li.sqrnavlogo>a>img {
  	display: block;
  }
  .sqrnav>ul>li.sqrnavsearch {
    float: right;
  }
  .sqrnav>ul>li.sqrnavsearch>a {
    background-image: url(./../../styles/vilnius/img/?f=search&c={{$config['palette.nav.bright']}});
    background-repeat: no-repeat;
    background-position: center center;
    width: 16px;
    height: 22px;
    padding: 18px;
  }

  .sqrnav>ul>li.sqrnavopen.sqrnavsearch>ul {
    left: auto;
    right: 0;
    opacity: 1;
  }
  
  .sqrnav>ul a:hover {
    background-color: #{{$config['palette.nav.hover']}};
  }
  
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

@media screen and (max-width: 1023px) {
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

.sqrcommon {
  margin: 0 auto;
  padding: 20px 0 0 0;
  background-color: #{{$config['palette.common.background']}};
  max-width: {{$config['options.width']}}px;
}

.sqrcommonnavhierarchical,
.sqrcommonnav,
.sqrfootertext {
  margin: 0 auto;
  padding: 0 30px 30px 30px;
  box-sizing: border-box;
}
.sqrfootertext {
  color: #{{$config['palette.common.font']}};
}


.sqrcommonnavhierarchical a,
.sqrcommonnav a,
.sqrfootertext a
 {
  text-decoration: none;
  color: #{{$config['palette.common.link']}};
  transition: color 0.3s;
  text-decoration: none;
  font-weight: normal;
}
.sqrcommonnavhierarchical a:hover,
.sqrcommonnav a:hover,
.sqrfootertext a:hover
 {
  color: #{{$config['palette.common.hover']}};
  text-decoration: none;
  font-weight: normal;
}
.sqrcommonnavhierarchical,
.sqrcommonnav
 {
	display: block;
	list-style: none;
}

.sqrcommonnavhierarchical>li,
.sqrcommonnav>li
 {
	display: block;
	box-sizing: border-box;
	list-style: none;
	padding: 0 0 5px 0;
}

.sqrcommonnavhierarchical>li>em {
	font-style: normal;
	color: #{{$config['palette.common.bright']}};
}

.sqrcommonnavhierarchical>li>ul {
	display: block;
	margin: 0;
	padding: 5px 0 15px 0;
}

.sqrcommonnavhierarchical>li>ul>li {
	list-style: none;
	margin: 0;
	padding: 0 0 2px 0;
}

.sqrcommonnavhierarchical:after,
.sqrcommonnav:after
 {
  	visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}

@media screen and (min-width: 1024px) {
	.sqrcommonnavhierarchical>li {
		float: left;
		padding-right: 5%;
	}
	
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
	
	.sqrcommonnav>li {
		float: left;
		padding-right: 20px;
	}
	
	 .sqrdesktophidden {
	 	display: none;
	 }
	
}

.sqreyecatcher {
	background-color: #{{$config['palette.background']}};
	position: relative;
}

.sqreyecatcher img, .sqreyecatcher video {
	display: block;
	width: 100%;
	height: auto;
}

.sqreyecatcher>video,
.sqreyecatcher>img {
	border-bottom: 1px solid #{{$config['palette.border']}}; 
}

.sqreyecatcherstage img {
	position: absolute;
}

.sqreyecatcherstage {
	overflow: hidden;
	position: relative;
	background-color: #{{$config['palette.nav.dark']}};
	height: 0;
	padding-bottom: 56.25%;
	border-bottom: 1px solid #{{$config['palette.border']}}; 
}

.sqreyecatchernav a {
	width: 20px;
	height: 20px;
	display: block;
	float: left;
	background: url(./../../styles/riga/img/?f={{$config['options.navstyle']}}&c={{$config['palette.bullets']}}) 0 0 no-repeat;	
}

.sqreyecatchernav a.sqreyecatchernavselected {
	background-position: 0 -20px;	
}

.sqreyecatchernav {
	height: 20px;
	position: absolute;
	z-index: 10;
	right: 10px;
	bottom: 10px;
}