body {
	background-color: #{{$config['palette.background.page']}};
	margin: 0;
	padding: 0;
}

.sqreyecatcher {
    position: relative;
    overflow: hidden;
    height: 0;
    background-color: #{{$config['palette.nav.dark']}};
}

.sqrvideoeyecatcher {
	width: 100%;
	height: auto;
}

.sqrvideoeyecatcher>video {
	width: 100%;
	height: auto;
	display: block;
	margin: 0;
	padding: 0;
}


.sqreyecatcherbulletcontainer {
    width: 24px;
    position: absolute;
    right: 16px;
    top: 50%;
}

.sqreyecatcherbulletcontainer a {
    display: block;
    height: 24px;
    width: 24px;
    background: url(./../../styles/centum/img/?f={{$config['options.navstyle']}}&ca={{$config['palette.bullets.bright']}}&cb={{$config['palette.bullets.dark']}}) 0 0 no-repeat;
}

.sqreyecatcherbulletcontainer a.sqreyecatcherbulletactive {
    background-position: 0 -24px;
}

.sqreyecatchershifter {
    position: absolute;
}

.sqreyecatcher img {
    display: block;
    transition: opacity 1s;
}

.sqrlogo {
    background-color: #{{$config['palette.background.top']}};
    padding: 20px 0;
}

.sqrlogo img {
    display: block;
    height: auto;
    margin: 0 auto;
}


#maincenterbox {
	margin: 0 auto;
	max-width: {{$config['options.width']}}px;
	position: relative;
	padding-bottom: 48px;
}

#toplinebox {
	background-color: #{{$config['palette.nav.dark']}};
	height: 3px;
}


#footer {
	padding-bottom: 48px;
}


#main {
	position: relative;
}

.sqrmain3collr {
	position: relative;
}

#sidebarleft,
#content,
#sidebarright {
	min-height: 1px;
	padding-top: 10px;
	padding-bottom: 10px;
	position: relative;
}


#header {
	padding: 10px 0;
}


.sqrnav {
    display: block;
    margin: 0;
    padding: 0;
    background-color: #{{$config['palette.background.top']}};
    z-index: 1000;
    -webkit-user-select: none;
    user-select: none;
}

.sqrnav a {
    display: block;
    margin: 0;
    padding: 12px 22px;
    color: #{{$config['palette.nav.dark']}};
    text-decoration: none;
    text-transform: uppercase;
    -webkit-tap-highlight-color: transparent;
    line-height: 22px;
}

.sqrnav>ul li {
    display: block;
    margin: 0;
    padding: 0;
    position: relative;
}

.sqrnav>ul li em.ngshopcartindicator {
  display: none;
  background-color: #{{$config['palette.nav.hover']}};
  color: #{{$config['palette.nav.bright']}};
  font-style: normal;
  padding-right: 8px;
  padding-left: 8px;
  border-radius: 5px;
  margin-left: 8px;
  font-weight: normal;
}

.sqrnav>ul li em.ngshopcartindicatoractive {
    display: inline-block;
}


.sqrnav .sqrnavsearch form {
    box-sizing: border-box;
    display: block;
    margin: 0;
    padding: 12px;
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
    font: 15px 'Open Sans',Verdana,Helvetica,sans-serif;
    color: #{{$config['palette.nav.bright']}};
    -webkit-appearance: none;
    border-radius: 0;
    background: #{{$config['palette.nav.hover']}} url(./../../styles/centum/img/?f=sprites&ca={{$config['palette.nav.dark']}}&cb={{$config['palette.nav.bright']}}) -8px -195px no-repeat;
    line-height: 22px;
}

@media screen and (max-width: 1023px) {
	
  .sqrlogo img {
      max-width: 160px;
  }	
    .sqrnav a.sqrnavshow, .sqrnav a.sqrnavhide {
        background: url(./../../styles/centum/img/?f=sprites&ca={{$config['palette.nav.dark']}}&cb={{$config['palette.nav.bright']}}) right -434px no-repeat;
    }
    .sqrnav li.sqrnavmore>a {
        background: url(./../../styles/centum/img/?f=sprites&ca={{$config['palette.nav.dark']}}&cb={{$config['palette.nav.bright']}}) right -482px no-repeat;
    }
    .sqrnav li.sqrnavopen>a {
        background-position: right -530px;
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
		
		
  .sqrlogo img {
      max-width: 240px;
  }
		
		
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
        background-color: #{{$config['palette.nav.dark']}};
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
    .sqrnav>ul>li li.sqrnavmore>a {
        background: url(./../../styles/centum/img/?f=sprites&ca={{$config['palette.nav.dark']}}&cb={{$config['palette.nav.bright']}}) right -577px no-repeat;
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
        background-color: #{{$config['palette.nav.dark']}};
    }
    .sqrnav>ul>li.sqrnavopen a {
        color: #ffffff;
    }
    .sqrnav>ul>li.sqrnavopen li a:hover {
        background-color: #{{$config['palette.nav.hover']}};
    }
    .sqrnav>ul>li.sqrnavhome>a>span, .sqrnav>ul>li.sqrnavsearch>a>span {
        display: none;
    }
    .sqrnav>ul>li.sqrnavhome>a {
        background: url(./../../styles/centum/img/?f=sprites&ca={{$config['palette.nav.dark']}}&cb={{$config['palette.nav.bright']}}) no-repeat -4px -97px;
        width: 16px;
        height: 22px;
        padding: 12px;
    }
    .sqrnav>ul>li.sqrnavsearch {
        float: right;
    }
    .sqrnav>ul>li.sqrnavsearch>a {
        background: url(./../../styles/centum/img/?f=sprites&ca={{$config['palette.nav.dark']}}&cb={{$config['palette.nav.bright']}}) no-repeat -4px -146px;
        width: 16px;
        height: 22px;
        padding: 12px;
    }
    .sqrnav>ul>li.sqrnavsearch.sqrnavopen>a {
        background-position: -4px -194px;
    }
    .sqrnav>ul>li.sqrnavopen.sqrnavsearch>ul {
        left: auto;
        right: 0;
        opacity: 1;
    }  
}

#content {
	background-color: #{{$config['palette.background.content']}};
}	


@media screen and (min-width: 1024px) {
	
	
	
	#content.sqrcontentpushup {
		margin-top: -48px;
		{{if $config['options.roundedcorners']==='true'}}
		border-radius: 20px 20px 0 0;
		{{/if}}
	}
	
	.sqrallwaysboxed, 
	.sqrmobilefullwidth,
	.sqrdesktopboxed
	{
		box-sizing: border-box;
		padding-left: 30px;
		padding-right: 30px;
		margin-left: auto;
		margin-right: auto;
		max-width: {{$config['options.width']}}px;
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
		box-sizing: border-box;
		width: 100%;
	 }
	 
   	 .sqrmain3collr:after,
	 .sqrmain2coll:after,
	 .sqrmain2colr:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }
	 
	 		
  	.sqrmain3collr>div {
    	box-sizing: border-box;
    	width: 50%;
    	float: left;
  	}
  	.sqrmain3collr>div:first-child {
    	width: 25%;
  	}
  	.sqrmain3collr>div:last-child {
    	width: 25%;
  	}
  	.sqrmain2coll>div {
    	box-sizing: border-box;
    	width: 75%;
    	float: left;
  	}
  	.sqrmain2coll>div:first-child {
    	width: 25%;
  	}
  	.sqrmain2colr>div {
    	box-sizing: border-box;
    	width: 75%;
    	float: left;
  	}
  	.sqrmain2colr>div:last-child {
    	width: 25%;
  	}
  	
    	
  	.sqrallwaysfullwidth .sqrsuppressborders {
  		border-left: 0 !important;
  		border-right: 0 !important;
  	}
  	
  	 .sqrnav>ul {
        max-width: {{$config['options.width']}}px;
		padding-left: 30px;
		padding-right: 30px;
		box-sizing: border-box;
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
  	
}

.sqrcommon {
  margin: 0;
  padding: 20px 0 0 0;
  background-color: #{{$config['palette.common.background']}};
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
	
	.sqrcommonnavhierarchical,
	.sqrcommonnav,
	.sqrfootertext {
		max-width: {{$config['options.width']}}px;
		margin: 0 auto;
	}
	
	
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