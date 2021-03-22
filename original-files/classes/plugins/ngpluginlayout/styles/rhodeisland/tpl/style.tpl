body {
	background-color: #{{$config['palette.common.background']}};
	margin: 0;
	padding: 0;
}

.sqrheader {
	display: block;
	position: relative;
	margin: 0;
	padding: 0;
	overflow: hidden;
	border-bottom: 1px solid #{{$config['palette.nav.border']}};
}

.sqrheader>img {
	display: block;
	position: absolute;
}

.sqrcontent {
	margin: 0;
	padding: 10px 0;
}
.sqrnavcontainer {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	padding: 20px;
	box-sizing: border-box;
	z-index: 999;
}

#sidebarleft,
#content,
#sidebarright {
	min-height: 1px;
}


#header {
	padding: 20px 0 1px 0;
	background-color: #{{$config['palette.background.header']}};
}

#footer {
	padding: 1px 0 20px 0;
	background-color: #{{$config['palette.background.footer']}};
}

#main {
	padding: 20px 0;
	background-color: #{{$config['palette.background']}};
}

.sqrnav {
  display: block;
  margin: 0 auto;
  padding: 0;
  background-color: #{{$config['palette.nav.bright']}};
  z-index: 1000;
  -webkit-user-select: none;
  user-select: none;
  max-width: {{$config['options.width']-40}}px;
{{if $config['options.shadow']==='true'}}
  box-shadow: 0 1px 2px rgba(0,0,0,0.2);
{{/if}}
  
}

.sqrnav a {
  display: block;
  margin: 0;
  padding: 18px 22px;
  color: #{{$config['palette.nav.dark']}};
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
    background-color: #{{$config['palette.nav.dark']}};
    color: #{{$config['palette.nav.bright']}};
    font-style: normal;
    padding-right: 8px;
    padding-left: 8px;
    border-radius: 5px;
    margin-left: 8px;
    font-weight: normal;
}

.sqrnav > ul li em.ngshopcartindicatoractive {
    display: inline-block;
}

.sqrnav .sqrnavsearch form {
  box-sizing: border-box;
  display: block;
  margin: 0;
  padding: 18px;
  display: block;
  width: 100%;
  border-color: #{{$config['palette.nav.border']}};
}

.sqrnav .sqrnavsearch input {
  box-sizing: border-box;
  display: block;
  padding: 0;
  width: 100%;
  border: 0;
  padding: 8px 12px 8px 30px;
  margin: 0;
  color: #{{$config['palette.nav.dark']}};
  border: 1px solid #{{$config['palette.nav.border']}};
  -webkit-appearance: none;
  border-radius: 0;
  background: #{{$config['palette.background']}} url(./../../styles/rhodeisland/img/?f=search&c={{$config['palette.nav.dark']}}) 8px 50% no-repeat;
}

@media screen and (max-width: 1023px) {
  .sqrnavpad {
	  margin: 0;
	  background-color: #{{$config['palette.background']}};
	  height: 60px;
  }
  .sqrnavcontainer {
	padding: 0;
  }
  .sqrnav {
  	border-bottom: 1px solid #{{$config['palette.nav.border']}};
  }		
	
  .sqrnav>ul>li.sqrnavlogo {
	display: none;
  }	
  .sqrnav a, .sqrnav form {
    border-bottom: 1px solid #{{$config['palette.nav.border']}};
  }
  .sqrnav a.sqrnavshow, .sqrnav a.sqrnavhide {
    background: url(./../../styles/rhodeisland/img/?f=menu&c={{$config['palette.nav.dark']}}) right center no-repeat;
  }
  .sqrnav a.sqrnavshow>img, .sqrnav a.sqrnavhide>img {
    display: block;
  }
  .sqrnav li.sqrnavmore>a {
    background: url(./../../styles/rhodeisland/img/?f=moreright&c={{$config['palette.nav.dark']}}) right center no-repeat;
  }
  .sqrnav li.sqrnavopen>a {
    background-image: url(./../../styles/rhodeisland/img/?f=moredown&c={{$config['palette.nav.dark']}});
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
  .sqrnavpad {
	  margin: 0;
	  background-color: #{{$config['palette.background']}};
	  height: 100px;
  }
  .sqrnav {
    border: 1px solid #{{$config['palette.nav.border']}};
  }
  
  .sqrnav>a {
    display: none;
  }
  .sqrnav>ul {
    box-sizing: border-box;
    display: block;
    max-width: {{$config['options.width']}}px;
    margin: 0 auto;
    padding: 0;
    list-style: none;
    width: 100%;
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
    background-color: #{{$config['palette.nav.bright']}};
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
    border-left: 1px solid #{{$config['palette.nav.border']}};
    border-top: 1px solid #{{$config['palette.nav.border']}};
    border-right: 1px solid #{{$config['palette.nav.border']}};
  }
  .sqrnav>ul>li li {
    border-bottom: 1px solid #{{$config['palette.nav.border']}};
  }
  .sqrnav>ul>li.sqrnavmore>a {
    background-image: url(./../../styles/rhodeisland/img/?f=moredown&c={{$config['palette.nav.dark']}});
    background-position: right center;
    background-repeat: no-repeat;
    padding-right: 44px;
  }
  .sqrnav>ul>li li.sqrnavmore>a {
    background-image: url(./../../styles/rhodeisland/img/?f=moreright&c={{$config['palette.nav.dark']}});
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
    top: -1px;
    transform: none;
    opacity: 1;
  }
  .sqrnav>ul>li.sqrnavopen {
    background-color: #{{$config['palette.nav.bright']}};
  }
  
  .sqrnav>ul>li.sqrnavhome>a>span, .sqrnav>ul>li.sqrnavsearch>a>span {
    display: none;
  }
  .sqrnav>ul>li.sqrnavhome>a {
    background-image: url(./../../styles/rhodeisland/img/?f=home&c={{$config['palette.nav.dark']}});
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
    background-image: url(./../../styles/rhodeisland/img/?f=search&c={{$config['palette.nav.dark']}});
    background-repeat: no-repeat;
    background-position: center center;
    width: 16px;
    height: 22px;
    padding: 18px;
  }

  .sqrnav>ul>li.sqrnavopen.sqrnavsearch>ul {
    left: auto;
    right: -1px;
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
		padding-left: 20px;
		padding-right: 20px;
		max-width: {{$config['options.width']}}px;
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

.sqrcommon {
  margin: 0;
  padding: 20px 0 0 0;
}

.sqrcommonnavhierarchical,
.sqrcommonnav,
.sqrfootertext {
  max-width: {{$config['options.width']}}px;
  margin: 0 auto;
  padding: 0 20px 20px 20px;
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