body {
{{if $config['options.background']==='solid'}}
	background-color: #{{$config['palette.background']}};
{{/if}}
{{if $config['options.background']==='pinwheel'}}
    background: #{{$config['palette.background']}} url(./../../styles/nyc/img/?f=pinwheel&ca={{$config['palette.background.alt']}}) top center no-repeat;
{{/if}}
{{if $config['options.background']==='circles'}}
    background: #{{$config['palette.background']}} url(./../../styles/nyc/img/?f=circles&ca={{$config['palette.background.alt']}});
{{/if}}
{{if $config['options.background']==='dots'}}
    background: #{{$config['palette.background']}} url(./../../styles/nyc/img/?f=dots&ca={{$config['palette.background.alt']}});
{{/if}}
{{if $config['options.background']==='stars'}}
    background: #{{$config['palette.background']}} url(./../../styles/nyc/img/?f=stars&ca={{$config['palette.background.alt']}});
{{/if}}
{{if $config['options.background']==='stripes'}}
    background: #{{$config['palette.background']}} url(./../../styles/nyc/img/?f=stripes&ca={{$config['palette.background.alt']}});
{{/if}}
{{if $config['options.background']==='fade'}}
    background: #{{$config['palette.background.alt']}} url(./../../styles/nyc/img/?f=fade&ca={{$config['palette.background']}}) 0 0 repeat-x;
{{/if}}		
	margin: 0;
	padding: 0;
}

.sqrsearch {
  display: block;
  padding-top: 20px;
}

.sqrlogo {
	min-height: 16px;
}

.sqrsearch form {
  display: block;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  position: relative;
  border: 0;
}

.sqrsearch input[type="text"] {
  display: block;
  width: 100%;
  box-sizing: border-box;
  background-color: #{{$config['palette.topbar.foreground']}};
  border: none;
  padding:  8px;
  margin: 0 35px 0 0;
  line-height: 19px;
  border-radius: 8px;
  height: 35px;
}

.sqrsearch input[type="submit"] {
  position: absolute;
  top: 0;
  right: 0;
  background: #{{$config['palette.topbar.searchbutton']}} url(./../../styles/sunnyvale/img/?f=sprites&ca={{$config['palette.topbar.foreground']}}&cb={{$config['palette.nav.foreground']}}&cc={{$config['palette.nav.clearmode']}}) -6px -102px no-repeat;
  width: 35px;
  height: 35px;
  text-indent: -9999px;
  border: none;
  border-radius: 0 8px 8px 0;
  margin: 0;
  padding: 0;
}

.sqrheader {
  background-color: #{{$config['palette.topbar.background']}};
  color: #ffffff;
  box-sizing: border-box;
  padding: 20px;
  margin: 0;
  position: relative;
}

.sqrheader img {
  display: block;
  margin: 0 auto;
  border: none;
}

.sqrheader p {
  display: block;
  margin: 0;
  padding: 0;
  border: none;
  text-align: center;
}

.sqropennav {
  width: 40px;
  height: 40px;
  background: url(./../../styles/sunnyvale/img/?f=sprites&ca={{$config['palette.topbar.foreground']}}&cb={{$config['palette.nav.foreground']}}&cc={{$config['palette.nav.clearmode']}}) -4px -148px no-repeat;
  display: block;
  top: 10px;
  left: 10px;
  position: absolute;
}

.sqrhome {
  width: 40px;
  height: 40px;
  background: url(./../../styles/sunnyvale/img/?f=sprites&ca={{$config['palette.topbar.foreground']}}&cb={{$config['palette.nav.foreground']}}&cc={{$config['palette.nav.clearmode']}}) -4px -4px no-repeat;
  display: block;
  top: 10px;
  right: 10px;
  position: absolute;
}




@media screen and (min-width: {{$config['options.width']+80}}px) {
    #sqrouterbox {
        margin: 40px auto;
		max-width: {{$config['options.width']}}px;
    }
     .sqrcommon {
      border-radius: 0 0 10px 10px;
    }
    .sqrheader {
      border-radius: 10px 10px 0 0;
    }
}

#maincontainer {
	background-color: #{{$config['palette.background']}};
}

#maincontainer {
	padding: 1px 0;
	background-color: #{{$config['palette.background.content']}};
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

#content {
	background-color: #{{$config['palette.background.content']}};
}


#header {
	padding: 10px 0;
	background-color: #{{$config['palette.background.header']}};
}

#footer {
	padding: 10px 0;
	background-color: #{{$config['palette.background.footer']}};
}

.sqrtopbar {
    background-color: #{{$config['palette.topbar.background']}};
}

.sqrtopbar::after {
    content: '';
    clear: both;
    display: block;
}

.sqrtopbar img {
    display: block;
    float: left;
    border: 0;
    margin: 10px;
}

.sqrnav {
  display: block;
  position: absolute;
  z-index: 1000;
  background-color: #{{$config['palette.nav.background']}};
  top: 20px;
  left: -999px;
  width: 420px;
  border-radius: 10px;
  opacity: 0;
  transition: opacity 0.3s, transform 0.3s;
  line-height: 19px;
}

.sqrnavmain {
  transform: translateX(-20px);
}

.sqrnavcart {
  transform: translateX(20px);
}


.sqrmodenav .sqrnavmain {
  left: 20px;
  opacity: 1;
  transform: translateX(0);
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

.sqrnav li em.ngshopcartindicator {
    display: none;
    background-color: #{{$config['palette.nav.foreground']}};
    color: #{{$config['palette.nav.background']}};
    font-style: normal;
    padding-right: 6px;
    padding-left: 6px;
    border-radius: 32px;
    margin-left: 8px;
    font-weight: normal;
}

.sqrnav li em.ngshopcartindicatoractive {
    display: inline-block;
}

.sqrnav a {
    padding: 12px 48px 12px 16px;
    text-decoration: none;
    color: #{{$config['palette.nav.foreground']}};
    border-bottom: 1px dotted rgba(255,255,255,0.3);
    display: block;
    text-transform: uppercase;
}

.sqrnav>ul>li:last-child>a {
	border-bottom: none;
}

.sqrnav>ul>li.sqrnavopen:last-child>a {
	border-bottom: 1px dotted rgba(255,255,255,0.3);
}


.sqrnav .active>a {
  font-weight: bold;
}

.sqrnav a:hover {
  color: #{{$config['palette.nav.hover']}};
}


.sqrnav .sqrnavmore ul {
    height: 0;
    overflow: hidden;
    transition: opacity 0.7s;
    opacity: 0;
}

.sqrnav .sqrnavopen>ul {
    height: inherit;
    opacity: 1;
}

.sqrnav span {
    display: block;
}

.sqrnav li li a {
    padding-left: 32px;
}

.sqrnav li li li a {
    padding-left: 48px;
}

.sqrnav .sqrnavmore>div {
    position: absolute;
    top: 0;
    right: 0;
    width: 43px;
    height: 43px;
    background: url(./../../styles/sunnyvale/img/?f=sprites&ca={{$config['palette.topbar.foreground']}}&cb={{$config['palette.nav.foreground']}}&cc={{$config['palette.nav.clearmode']}}) -2px -242px no-repeat;
    cursor: pointer;
    transition: transform 0.5s;
}

.sqrnav .sqrclearmode {
  position: absolute;
  top: 0;
  right: 0;
  width: 43px;
  height: 43px;
  background: url(./../../styles/sunnyvale/img/?f=sprites&ca={{$config['palette.topbar.foreground']}}&cb={{$config['palette.nav.foreground']}}&cc={{$config['palette.nav.clearmode']}}) -2px -290px no-repeat;
  cursor: pointer;
  transition: transform 0.5s;
}


.sqrnav .sqrnavopen>div {
    transform: rotate(90deg);
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
  	}
  	.sqrmain3collr>div:last-child {
    	width: 25%;
  	}
  	.sqrmain2coll>div {
    	box-sizing: border-box;
    	width: 75%;
    	display: table-cell;
    	vertical-align: top;
  	}
  	.sqrmain2coll>div:first-child {
    	width: 25%;
  	}
  	.sqrmain2colr>div {
    	box-sizing: border-box;
    	width: 75%;
    	display: table-cell;
    	vertical-align: top;
  	}
  	.sqrmain2colr>div:last-child {
    	width: 25%;
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

.sqrcommonnavhierarchical {
  padding-bottom: 1px;
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

.sqrfootertext p {
	margin: 0;
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

@media screen and (max-width: 480px) {
  .sqrnav {
    width: 100%;
    border-radius: 0px;
  }
  
  .sqrheader img {
    max-width: 180px;
    height: auto;
  }

  .sqrmodenav .sqrnavmain {
    left: 0;
    top: 0;
  }
  .sqrmodecart .sqrnavcart {
    left: 0;
    top: 0;
  }
}