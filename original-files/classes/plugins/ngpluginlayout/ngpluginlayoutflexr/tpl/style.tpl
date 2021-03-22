HTML {
	background: {{$settings->background|ngbackground}};
{{if $settings->background|ngisstretchpicture}}
	background-size: 100%;
{{/if}}	
}

BODY {
	margin: 0;
	padding: 0;	
	-webkit-text-size-adjust: 100%;
}


{{if $settings->filltop!==''}}
#filltop {
	background: {{$settings->filltop|ngbackground}};
{{if $settings->filltop|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
}
{{/if}}

{{if $settings->fillbottom!==''}}
#fillbottom {
	background: {{$settings->fillbottom|ngbackground}};
{{if $settings->fillbottom|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
}
{{/if}}


{{if $settings->commontopvisible}}

#commontopcontainer {
	box-sizing: border-box;
{{if $settings->commontopfill!==''}}
	background: {{$settings->commontopfill|ngbackground}};
{{if $settings->commontopfill|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
{{if ($settings->commontoppanorama)}}
	padding: {{$settings->commontopmargin|ngmargintop}} 0 {{$settings->commontopmargin|ngmarginbottom}} 0;
	
{{else}}
	padding: {{$settings->commontopmargin|ngmargin}};
{{/if}}
}

{{if $settings->commontophidemobile}}
@media screen and (max-width: {{$settings->mobilewidth-1}}px) {
	#commontopcontainer {
		display: none;
	}
}
{{/if}}


#commontop {
	box-sizing: border-box;
{{if $settings->commontopbackground!==''}}
	background: {{$settings->commontopbackground|ngbackground}};
{{if $settings->commontopbackground|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
	padding: {{$settings->commontoppadding|ngmargin}};
{{if !$settings->commontoppanorama}}
	max-width: {{$settings->width}}px;
	margin: 0 auto;
{{/if}}
    text-align: {{$settings->commontopalignment}};
}

#commontop a {
	font: {{$settings->commontoppages|ngfont}};
	color: #{{$settings->commontoppages|ngfontcolor}};
	text-transform: {{if $settings->commontoppages|ngfontisuppercase}}uppercase{{else}}none{{/if}};
	text-decoration: none;
	-webkit-text-size-adjust:none;
	margin-right: 10px;
}

#commontop a:last-child {
	margin-right: 0;
}

#commontop a:hover {
	font-weight: {{if $settings->commontoppageshover|ngfontstyleisbold}}bold{{else}}normal{{/if}};
	font-style: {{if $settings->commontoppageshover|ngfontstyleisitalic}}italic{{else}}normal{{/if}};
	text-transform: {{if $settings->commontoppageshover|ngfontstyleisuppercase}}uppercase{{else}}none{{/if}};
	color: #{{$settings->commontoppageshover|ngfontstylecolor}};
	text-decoration: none;
}
{{/if}}




{{if $settings->contactvisible}}

#contactcontainer {
	box-sizing: border-box;
{{if $settings->contactfill!==''}}
	background: {{$settings->contactfill|ngbackground}};
{{if $settings->contactfill|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
{{if ($settings->contactpanorama)}}
	padding: {{$settings->contactmargin|ngmargintop}} 0 {{$settings->contactmargin|ngmarginbottom}} 0;
	
{{else}}
	padding: {{$settings->contactmargin|ngmargin}};
{{/if}}
}

{{if $settings->contacthidemobile}}
@media screen and (max-width: {{$settings->mobilewidth-1}}px) {
	#contactcontainer {
		display: none;
	}
}
{{/if}}


#contact {
	box-sizing: border-box;
{{if $settings->contactbackground!==''}}
	background: {{$settings->contactbackground|ngbackground}};
{{if $settings->contactbackground|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
	padding: {{$settings->contactpadding|ngmargin}};
{{if !$settings->contactpanorama}}
	max-width: {{$settings->width}}px;
	margin: 0 auto;
{{/if}}
	text-align: {{$settings->contactalignment}};
}

#contact a, #contact span {
	font: {{$settings->contacttext|ngfont}};
	color: #{{$settings->contacttext|ngfontcolor}};
	text-transform: {{if $settings->contacttext|ngfontisuppercase}}uppercase{{else}}none{{/if}};
	text-decoration: none;
	-webkit-text-size-adjust:none;
	margin-right: 6px;
}

#contact svg {
    width: 1.2em;
    height: 1.2em;
    display: inline-block;
    vertical-align: -0.2em;
    margin-right: 0.1em;
    margin-left: 0.1em;
    border: 0;
    padding: 0;
}

#contact a:last-child {
	margin-right: 0;
}

#contact a:hover {
	font-weight: {{if $settings->contacttexthover|ngfontstyleisbold}}bold{{else}}normal{{/if}};
	font-style: {{if $settings->contacttexthover|ngfontstyleisitalic}}italic{{else}}normal{{/if}};
	text-transform: {{if $settings->contacttexthover|ngfontstyleisuppercase}}uppercase{{else}}none{{/if}};
	color: #{{$settings->contacttexthover|ngfontstylecolor}};
	text-decoration: none;
}


{{/if}}




{{if $settings->logovisible}}

#logocontainer {
	box-sizing: border-box;
{{if $settings->logofill!==''}}
	background: {{$settings->logofill|ngbackground}};
{{if $settings->logofill|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
{{if ($settings->logopanorama)}}
	padding: {{$settings->logomargin|ngmargintop}} 0 {{$settings->logomargin|ngmarginbottom}} 0;
	
{{else}}
	padding: {{$settings->logomargin|ngmargin}};
{{/if}}
}


#logo {
	box-sizing: border-box;
{{if $settings->logobackground!==''}}
	background: {{$settings->logobackground|ngbackground}};
{{if $settings->logobackground|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
	padding: {{$settings->logopadding|ngmargin}};
{{if !$settings->logopanorama}}
	max-width: {{$settings->width}}px;
	margin: 0 auto;
{{/if}}
}

#logo img {
	display: block;
	border: 0;
	width: 100%;
	height: auto;
	max-width: {{$settings->logowidth}}px;
	{{if ($settings->logoalignment=='center')}}
	margin: 0 auto;
	{{/if}}
	{{if ($settings->logoalignment=='right')}}
	float: right;
	{{/if}}
}

{{if ($settings->logoalignment=='right')}}
#logo:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}
{{/if}}

{{/if}}


{{if $settings->navvisible}}

#navcontainer {
	box-sizing: border-box;
{{if $settings->navfill!==''}}
	background: {{$settings->navfill|ngbackground}};
{{if $settings->navfill|ngisstretchpicture}}
	background-size: 100%;
{{/if}}	
{{/if}}
{{if ($settings->navpanorama)}}
	padding: {{$settings->navmargin|ngmargintop}} 0 {{$settings->navmargin|ngmarginbottom}} 0;
	
{{else}}
	padding: {{$settings->navmargin|ngmargin}};
{{/if}}
	width: 100%;
	z-index: 1000;
}

#nav {
	box-sizing: border-box;
{{if $settings->navbackground!==''}}
	background: {{$settings->navbackground|ngbackground}};
{{if $settings->navbackground|ngisstretchpicture}}
	background-size: 100%;
{{/if}}	
{{/if}}
	padding: {{$settings->navpadding|ngmargin}};
{{if !$settings->navpanorama}}
	max-width: {{$settings->width}}px;
	margin: 0 auto;
{{/if}}
}
{{/if}}

{{if $settings->eyecatchervisible}}

#eyecatchercontainer {
	box-sizing: border-box;
{{if $settings->eyecatcherfill!==''}}
	background: {{$settings->eyecatcherfill|ngbackground}};
{{if $settings->eyecatcherfill|ngisstretchpicture}}
	background-size: 100%;
{{/if}}	
{{/if}}
{{if ($settings->eyecatcherpanorama)}}
	padding: {{$settings->eyecatchermargin|ngmargintop}} 0 {{$settings->eyecatchermargin|ngmarginbottom}} 0;
{{else}}
	padding: {{$settings->eyecatchermargin|ngmargin}};
{{/if}}
}


#eyecatcher {
	box-sizing: border-box;
{{if $settings->eyecatcherbackground!==''}}
	background: {{$settings->eyecatcherbackground|ngbackground}};
{{if $settings->eyecatcherbackground|ngisstretchpicture}}
	background-size: 100%;
{{/if}}	
{{/if}}
	padding: {{$settings->eyecatcherpadding|ngmargin}};
{{if !$settings->eyecatcherpanorama}}
	max-width: {{$settings->width}}px;
	margin: 0 auto;
{{/if}}
}
{{/if}}


#headercontainer {
	box-sizing: border-box;
{{if $settings->headerfill!==''}}
	background: {{$settings->headerfill|ngbackground}};
{{if $settings->headerfill|ngisstretchpicture}}
	background-size: 100%;
{{/if}}	
{{/if}}
{{if ($settings->headerpanorama)}}
	padding: {{$settings->headermargin|ngmargintop}} 0 {{$settings->headermargin|ngmarginbottom}} 0;
	
{{else}}
	padding: {{$settings->headermargin|ngmargin}};
{{/if}}
}


#header {
	box-sizing: border-box;
{{if $settings->headerbackground!==''}}
	background: {{$settings->headerbackground|ngbackground}};
{{if $settings->headerbackground|ngisstretchpicture}}
	background-size: 100%;
{{/if}}	
{{/if}}
	padding-top: {{$settings->headerpadding|ngmargintop}};
	padding-bottom: {{$settings->headerpadding|ngmarginbottom}};
{{if !$settings->headerpanorama}}
	max-width: {{$settings->width}}px;
	margin: 0 auto;
{{/if}}
}

#maincontainer {
	box-sizing: border-box;
{{if $settings->mainfill!==''}}
	background: {{$settings->mainfill|ngbackground}};
{{if $settings->mainfill|ngisstretchpicture}}
	background-size: 100%;
{{/if}}	
{{/if}}
{{if ($settings->mainpanorama)}}
	padding: {{$settings->mainmargin|ngmargintop}} 0 {{$settings->mainmargin|ngmarginbottom}} 0;
	
{{else}}
	padding: {{$settings->mainmargin|ngmargin}};
{{/if}}
}


#main {
	box-sizing: border-box;
{{if $settings->mainbackground!==''}}
	background: {{$settings->mainbackground|ngbackground}};
{{if $settings->mainbackground|ngisstretchpicture}}
	background-size: 100%;
{{/if}}	
{{/if}}
{{if !$settings->mainpanorama}}
	max-width: {{$settings->width}}px;
	margin: 0 auto;
{{/if}}
}

#sidebarleft {
	box-sizing: border-box;
{{if $settings->leftbackground!==''}}
	background: {{$settings->leftbackground|ngbackground}};
{{if $settings->leftbackground|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
	padding-top: {{$settings->leftpadding|ngmargintop}};
	padding-bottom: {{$settings->leftpadding|ngmarginbottom}};
}

#content {
	box-sizing: border-box;
{{if $settings->contentbackground!==''}}
	background: {{$settings->contentbackground|ngbackground}};
{{if $settings->contentbackground|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
	padding-top: {{$settings->contentpadding|ngmargintop}};
	padding-bottom: {{$settings->contentpadding|ngmarginbottom}};
}

#sidebarright {
	box-sizing: border-box;
{{if $settings->rightbackground!==''}}
	background: {{$settings->rightbackground|ngbackground}};
{{if $settings->rightbackground|ngisstretchpicture}}
	background-size: 100%;
{{/if}}	
{{/if}}
	padding-top: {{$settings->rightpadding|ngmargintop}};
	padding-bottom: {{$settings->rightpadding|ngmarginbottom}};
}

#footercontainer {
	box-sizing: border-box;
{{if $settings->footerfill!==''}}
	background: {{$settings->footerfill|ngbackground}};
{{if $settings->footerfill|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
{{if ($settings->footerpanorama)}}
	padding: {{$settings->footermargin|ngmargintop}} 0 {{$settings->footermargin|ngmarginbottom}} 0;
	
{{else}}
	padding: {{$settings->footermargin|ngmargin}};
{{/if}}
}


#footer {
	box-sizing: border-box;
{{if $settings->footerbackground!==''}}
	background: {{$settings->footerbackground|ngbackground}};
{{if $settings->footerbackground|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
	padding-top: {{$settings->footerpadding|ngmargintop}};
	padding-bottom: {{$settings->footerpadding|ngmarginbottom}};
{{if !$settings->footerpanorama}}
	max-width: {{$settings->width}}px;
	margin: 0 auto;
{{/if}}
}


{{if $settings->commonvisible}}
#commoncontainer {
	box-sizing: border-box;
{{if $settings->commonfill!==''}}
	background: {{$settings->commonfill|ngbackground}};
{{if $settings->commonfill|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
{{if ($settings->commonpanorama)}}
	padding: {{$settings->commonmargin|ngmargintop}} 0 {{$settings->commonmargin|ngmarginbottom}} 0;
	
{{else}}
	padding: {{$settings->commonmargin|ngmargin}};
{{/if}}
}


#common {
	box-sizing: border-box;
{{if $settings->commonbackground!==''}}
	background: {{$settings->commonbackground|ngbackground}};
{{if $settings->commonbackground|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
	padding: {{$settings->commonpadding|ngmargin}};
{{if !$settings->commonpanorama}}
	max-width: {{$settings->width}}px;
	margin: 0 auto;
{{/if}}
}
{{/if}}


@media print, screen and (min-width: {{$settings->mobilewidth}}px) {
	#header .sqrallwaysboxed, 
	#header .sqrmobilefullwidth,
	#header .sqrdesktopboxed
	{
		box-sizing: border-box;
		max-width: {{$settings->width}}px;
		margin-left: auto;
		margin-right: auto;
		padding-left: {{$settings->headerpadding|ngmarginleft}};
		padding-right: {{$settings->headerpadding|ngmarginright}};
	}
		
	#header .sqrallwaysboxed .sqrallwaysboxed,
	#header .sqrdesktopboxed .sqrdesktopboxed,
	#header .sqrmobilefullwidth .sqrallwaysboxed,
	#header .sqrdesktopboxed .sqrallwaysboxed,
	#header .sqrdesktopboxed .sqrmobilefullwidth,
	#header .sqrdesktopremovebox .sqrallwaysboxed,
	#header .sqrdesktopremovebox .sqrmobilefullwidth
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 		  	
  	#header .sqrallwaysfullwidth .sqrsuppressborders {
  		border-left: 0 !important;
  		border-right: 0 !important;
  	}
  		
  	 .sqrmain3col,
  	 .sqrmain2col,	
	 .sqrmain3collr,
	 .sqrmain2coll,
	 .sqrmain2colr {
	 	display: table;
		box-sizing: border-box;
		table-layout: fixed;
		width: 100%;
	 }
	 .sqrmain3col>div {
    	box-sizing: border-box;
    	width: 33.333333333%;
    	display: table-cell;
    	vertical-align: top;    	
  	 }
	 .sqrmain2col>div {
    	box-sizing: border-box;
    	width: 50%;
    	display: table-cell;
    	vertical-align: top;    	
  	 }
	 		
  	.sqrmain3collr>div {
    	box-sizing: border-box;
{{if $settings->mainsidebarmode==='small'}}
    	width: 60%;
{{else if $settings->mainsidebarmode==='large'}}
		width: 40%;
{{else}}
    	width: 50%;
{{/if}}
    	display: table-cell;
    	vertical-align: top;    	
  	}
  	.sqrmain3collr>div:first-child,
  	.sqrmain3collr>div:last-child,
  	.sqrmain2coll>div:first-child,
  	.sqrmain2colr>div:last-child {
{{if $settings->mainsidebarmode==='small'}}
    	width: 20%;
{{else if $settings->mainsidebarmode==='large'}}
		width: 30%;
{{else}}
    	width: 25%;
{{/if}}
  	}
  	.sqrmain2coll>div,
  	.sqrmain2colr>div {
    	box-sizing: border-box;
{{if $settings->mainsidebarmode==='small'}}
    	width: 80%;
{{else if $settings->mainsidebarmode==='large'}}
		width: 70%;
{{else}}
    	width: 75%;
{{/if}}
    	display: table-cell;
    	vertical-align: top;
  	}
  	
	#sidebarleft .sqrallwaysboxed, 
	#sidebarleft .sqrmobilefullwidth,
	#sidebarleft .sqrdesktopboxed
	{
		box-sizing: border-box;
		max-width: {{$settings->width}}px;
		margin-left: auto;
		margin-right: auto;
		padding-left: {{$settings->leftpadding|ngmarginleft}};
		padding-right: {{$settings->leftpadding|ngmarginright}};
	}
		
	#sidebarleft .sqrallwaysboxed .sqrallwaysboxed,
	#sidebarleft .sqrdesktopboxed .sqrdesktopboxed,
	#sidebarleft .sqrmobilefullwidth .sqrallwaysboxed,
	#sidebarleft .sqrdesktopboxed .sqrallwaysboxed,
	#sidebarleft .sqrdesktopboxed .sqrmobilefullwidth,
	#sidebarleft .sqrdesktopremovebox .sqrallwaysboxed,
	#sidebarleft .sqrdesktopremovebox .sqrmobilefullwidth
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 		  	
  	#sidebarleft .sqrallwaysfullwidth .sqrsuppressborders {
  		border-left: 0 !important;
  		border-right: 0 !important;
  	}
  	
  	#main.sqrdesktopboxed {
		max-width: {{$settings->width}}px;
		margin-left: auto;
		margin-right: auto;	
	}
  	
  	  	
	#content .sqrallwaysboxed, 
	#content .sqrmobilefullwidth,
	#content .sqrdesktopboxed
	{
		box-sizing: border-box;
		max-width: {{$settings->width}}px;
		margin-left: auto;
		margin-right: auto;
		padding-left: {{$settings->contentpadding|ngmarginleft}};
		padding-right: {{$settings->contentpadding|ngmarginright}};
	}
		
	#content .sqrallwaysboxed .sqrallwaysboxed,
	#content .sqrdesktopboxed .sqrdesktopboxed,
	#content .sqrmobilefullwidth .sqrallwaysboxed,
	#content .sqrdesktopboxed .sqrallwaysboxed,
	#content .sqrdesktopboxed .sqrmobilefullwidth,
	#content .sqrdesktopremovebox .sqrallwaysboxed,
	#content .sqrdesktopremovebox .sqrmobilefullwidth
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 		  	
  	#content .sqrallwaysfullwidth .sqrsuppressborders {
  		border-left: 0 !important;
  		border-right: 0 !important;
  	}
  	
  	
	#sidebarright .sqrallwaysboxed, 
	#sidebarright .sqrmobilefullwidth,
	#sidebarright .sqrdesktopboxed
	{
		box-sizing: border-box;
		max-width: {{$settings->width}}px;
		margin-left: auto;
		margin-right: auto;
		padding-left: {{$settings->rightpadding|ngmarginleft}};
		padding-right: {{$settings->rightpadding|ngmarginright}};
	}
		
	#sidebarright .sqrallwaysboxed .sqrallwaysboxed,
	#sidebarright .sqrdesktopboxed .sqrdesktopboxed,
	#sidebarright .sqrmobilefullwidth .sqrallwaysboxed,
	#sidebarright .sqrdesktopboxed .sqrallwaysboxed,
	#sidebarright .sqrdesktopboxed .sqrmobilefullwidth,
	#sidebarright .sqrdesktopremovebox .sqrallwaysboxed,
	#sidebarright .sqrdesktopremovebox .sqrmobilefullwidth
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 		  	
  	#sidebarright .sqrallwaysfullwidth .sqrsuppressborders {
  		border-left: 0 !important;
  		border-right: 0 !important;
  	}
  	
  	#footer .sqrallwaysboxed, 
	#footer .sqrmobilefullwidth,
	#footer .sqrdesktopboxed
	{
		box-sizing: border-box;
		max-width: {{$settings->width}}px;
		margin-left: auto;
		margin-right: auto;
		padding-left: {{$settings->footerpadding|ngmarginleft}};
		padding-right: {{$settings->footerpadding|ngmarginright}};
	}
		
	#footer .sqrallwaysboxed .sqrallwaysboxed,
	#footer .sqrdesktopboxed .sqrdesktopboxed,
	#footer .sqrmobilefullwidth .sqrallwaysboxed,
	#footer .sqrdesktopboxed .sqrallwaysboxed,
	#footer .sqrdesktopboxed .sqrmobilefullwidth,
	#footer .sqrdesktopremovebox .sqrallwaysboxed,
	#footer .sqrdesktopremovebox .sqrmobilefullwidth
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 		  	
  	#footer .sqrallwaysfullwidth .sqrsuppressborders {
  		border-left: 0 !important;
  		border-right: 0 !important;
  	}  	
  	.sqrdesktophidden {
	 	display: none;
	}	  	  	
}

@media screen and (max-width: {{$settings->mobilewidth-1}}px) {
	#header .sqrallwaysboxed,
	#header .sqrmobileboxed 
	{
		box-sizing: border-box;
		padding-left: {{$settings->headerpadding|ngmarginleft}};
		padding-right: {{$settings->headerpadding|ngmarginright}};
	}
	#header .sqrallwaysboxed>.sqrallwaysboxed,
	#header .sqrallwaysboxed>.nguiparagraphcontainer>.sqrallwaysboxed
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 #header .sqrmobileboxedimportant {
		padding-left: {{$settings->headerpadding|ngmarginleft}} !important;
		padding-right: {{$settings->headerpadding|ngmarginright}} !important;
	 }	
	 
	 #header .sqrallwaysfullwidth .sqrsuppressborders,
	 #header .sqrmobilefullwidth .sqrsuppressborders
  	 {
  		border-left: 0 !important;
  		border-right: 0 !important;
  	 }  	 
  	 
 	#sidebarleft .sqrallwaysboxed,
	#sidebarleft .sqrmobileboxed 
	{
		box-sizing: border-box;
		padding-left: {{$settings->leftpadding|ngmarginleft}};
		padding-right: {{$settings->leftpadding|ngmarginright}};
	}
	#sidebarleft .sqrallwaysboxed>.sqrallwaysboxed,
	#sidebarleft .sqrallwaysboxed>.nguiparagraphcontainer>.sqrallwaysboxed
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 #sidebarleft .sqrmobileboxedimportant {
		padding-left: {{$settings->leftpadding|ngmarginleft}} !important;
		padding-right: {{$settings->leftpadding|ngmarginright}} !important;
	 }	
	 
	 #sidebarleft .sqrallwaysfullwidth .sqrsuppressborders,
	 #sidebarleft .sqrmobilefullwidth .sqrsuppressborders
  	 {
  		border-left: 0 !important;
  		border-right: 0 !important;
  	 }
  	   	 
 	#content .sqrallwaysboxed,
	#content .sqrmobileboxed 
	{
		box-sizing: border-box;
		padding-left: {{$settings->contentpadding|ngmarginleft}};
		padding-right: {{$settings->contentpadding|ngmarginright}};
	}
	#content .sqrallwaysboxed>.sqrallwaysboxed,
	#content .sqrallwaysboxed>.nguiparagraphcontainer>.sqrallwaysboxed
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 #content .sqrmobileboxedimportant {
		padding-left: {{$settings->contentpadding|ngmarginleft}} !important;
		padding-right: {{$settings->contentpadding|ngmarginright}} !important;
	 }	
	 
	 #content .sqrallwaysfullwidth .sqrsuppressborders,
	 #content .sqrmobilefullwidth .sqrsuppressborders
  	 {
  		border-left: 0 !important;
  		border-right: 0 !important;
  	 }
  	 
  	 
 	#sidebarright .sqrallwaysboxed,
	#sidebarright .sqrmobileboxed 
	{
		box-sizing: border-box;
		padding-left: {{$settings->rightpadding|ngmarginleft}};
		padding-right: {{$settings->rightpadding|ngmarginright}};
	}
	#sidebarright .sqrallwaysboxed>.sqrallwaysboxed,
	#sidebarright .sqrallwaysboxed>.nguiparagraphcontainer>.sqrallwaysboxed
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 #sidebarright .sqrmobileboxedimportant {
		padding-left: {{$settings->rightpadding|ngmarginleft}} !important;
		padding-right: {{$settings->rightpadding|ngmarginright}} !important;
	 }	
	 
	 #sidebarright .sqrallwaysfullwidth .sqrsuppressborders,
	 #sidebarright .sqrmobilefullwidth .sqrsuppressborders
  	 {
  		border-left: 0 !important;
  		border-right: 0 !important;
  	 }
  	 
 	#footer .sqrallwaysboxed,
	#footer .sqrmobileboxed 
	{
		box-sizing: border-box;
		padding-left: {{$settings->footerpadding|ngmarginleft}};
		padding-right: {{$settings->footerpadding|ngmarginright}};
	}
	#footer .sqrallwaysboxed>.sqrallwaysboxed,
	#footer .sqrallwaysboxed>.nguiparagraphcontainer>.sqrallwaysboxed
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 #footer .sqrmobileboxedimportant {
		padding-left: {{$settings->footerpadding|ngmarginleft}} !important;
		padding-right: {{$settings->footerpadding|ngmarginright}} !important;
	 }	
	 
	 #footer .sqrallwaysfullwidth .sqrsuppressborders,
	 #footer .sqrmobilefullwidth .sqrsuppressborders
  	 {
  		border-left: 0 !important;
  		border-right: 0 !important;
  	 } 
  	 
  	 #navcontainer,
  	 #eyecatchercontainer,
  	 #headercontainer,
  	 #maincontainer,
  	 #footercontainer,
     #commoncontainer {
     	padding-left: 0;
     	padding-right: 0;
     }
     
     #outercontainer > :first-child {
     	padding-top: 0;
     }
     
     #outercontainer > :last-child {
     	padding-bottom: 0;
     }
     
     
  	 .sqrmobilehidden {
	 	display: none;
	 }	
}


#eyecatcher {
	position: relative;
	overflow: hidden;
	padding: 0;
}
#eyecatcher #eyecatcherstage img, #eyecatcher #eyecatcherstage video {
	width: 100%;
	display: block;
	border: 0;
	position: absolute;
	height: 100%;
}
#eyecatcher #eyecatcherstage img.headersliderpri {
	z-index: 1;
	transition: none;
	-webkit-transition: none;
	opacity: 1;
}
#eyecatcher #eyecatcherstage img.headerslidersec {
	z-index: 2;
	transition: none;
	opacity: 0;
}
#eyecatcher #eyecatcherstage img.headerslidersecout {
	transition: opacity 0.5s, transform 0.5s;
	opacity: 1;
}
#eyecatcherstage {
	position: absolute;
}
#eyecatcherbullets {
	box-sizing: border-box;
	padding: 20px;
	position: absolute;
	bottom: 0;
	right: 0;
	z-index: 3;
}
#eyecatcherbullets:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}
#eyecatcherbullets a {
	width: 24px;
	height: 24px;
	float: left;
	background: url(../img/?f={{$settings->eyecatcherbulletstyle}}&ca={{$settings->eyecatcherbulletcolora}}&cb={{$settings->eyecatcherbulletcolorb}}) no-repeat left top;
}
#eyecatcherbullets a.active {
	background-position: left bottom;
}

#common>div {
  	font: {{$settings->commontext|ngfont}};
  	color: #{{$settings->commontext|ngfontcolor}};
	text-transform: {{if $settings->commontext|ngfontisuppercase}}uppercase{{else}}none{{/if}};
}
#common>div a {
	font-weight: {{if $settings->commonlink|ngfontstyleisbold}}bold{{else}}normal{{/if}};
	font-style: {{if $settings->commonlink|ngfontstyleisitalic}}italic{{else}}normal{{/if}};
	text-transform: {{if $settings->commonlink|ngfontstyleisuppercase}}uppercase{{else}}none{{/if}};
	color: #{{$settings->commonlink|ngfontstylecolor}};
	text-decoration: none;
}
#common>div a:hover {
	font-weight: {{if $settings->commonhover|ngfontstyleisbold}}bold{{else}}normal{{/if}};
	font-style: {{if $settings->commonhover|ngfontstyleisitalic}}italic{{else}}normal{{/if}};
	text-transform: {{if $settings->commonhover|ngfontstyleisuppercase}}uppercase{{else}}none{{/if}};
	color: #{{$settings->commonhover|ngfontstylecolor}};
	text-decoration: none;
}


#common>ul.sqrcommonnavhierarchical a,
#common>ul.sqrcommonnav a {
	font: {{$settings->commonpages|ngfont}};
	color: #{{$settings->commonpages|ngfontcolor}};
	text-transform: {{if $settings->commonpages|ngfontisuppercase}}uppercase{{else}}none{{/if}};
	text-decoration: none;
	-webkit-text-size-adjust:none;
}

#common>ul.sqrcommonnavhierarchical a:hover,
#common>ul.sqrcommonnav a:hover {
	font-weight: {{if $settings->commonpageshover|ngfontstyleisbold}}bold{{else}}normal{{/if}};
	font-style: {{if $settings->commonpageshover|ngfontstyleisitalic}}italic{{else}}normal{{/if}};
	text-transform: {{if $settings->commonpageshover|ngfontstyleisuppercase}}uppercase{{else}}none{{/if}};
	color: #{{$settings->commonpageshover|ngfontstylecolor}};
	text-decoration: none;
}

#common ul.sqrcommonnavhierarchical,
#common ul.sqrcommonnav {
	display: block;
	list-style: none;
	margin: 0;
	padding: 0;
}

#common ul.sqrcommonnavhierarchical>li,
#common ul.sqrcommonnav>li
 {
	display: block;
	box-sizing: border-box;
	padding: 0 0 5px 0;
}

#common ul.sqrcommonnavhierarchical>li>em {
	font: {{$settings->commonfolders|ngfont}};
	color: #{{$settings->commonfolders|ngfontcolor}};
	text-transform: {{if $settings->commonfolders|ngfontisuppercase}}uppercase{{else}}none{{/if}};
	font-style: normal;
	display: block;
	padding-bottom: 4px;
}

#common ul.sqrcommonnavhierarchical>li>ul {
	display: block;
	margin: 0;
	padding: 15px 0 15px 0;
	list-style: none;
}

#common ul.sqrcommonnavhierarchical>li>ul>li {
	margin: 0;
	padding: 0 0 2px 0;
}

#common ul.sqrcommonnavhierarchical:after,
#common ul.sqrcommonnav:after
{
  	visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}

#commoncontact svg {
    width: 1.1em;
    height: 1.1em;
    display: inline-block;
    vertical-align: -0.2em;
    margin-right: 0.1em;
    margin-left: 0.1em;
    border: 0;
    padding: 0;
}

#commoncontact {
    margin: 15px 0 0 0;
    text-align:{{$settings->commoncontactalignment}};
}

#commoncontact a {
{{if $settings->commoncontactalignment==='left'}}
	margin-right: 6px;
{{/if}}
{{if $settings->commoncontactalignment==='right'}}
	margin-left: 6px;
{{/if}}
{{if $settings->commoncontactalignment==='center'}}
	margin-left: 3px;
	margin-right: 3px;
{{/if}}
}


#commoncontact a:last-child {
	margin-right: 0;
}

@media print, screen and (min-width: {{$settings->mobilewidth}}px) {
	#common ul.sqrcommonnavhierarchical>li {
		float: left;
		padding-right: 20px;
	}
	#common ul.sqrcommonnavhierarchical2col>li {
		width: 50%;
	}
	#common ul.sqrcommonnavhierarchical3col>li {
		width: 33.3333333%;
	}
	#common ul.sqrcommonnavhierarchical4col>li {
		width: 25%;
	}
	#common ul.sqrcommonnavhierarchical5col>li {
		width: 20%;
	}

    #common ul.sqrcommonnav {
        display: flex;
        flexwrap: wrap;
    }

	{{if $settings->commonpagesalignment==='left'}}
    #common ul.sqrcommonnav {
       justify-content: flex-start;
    }
    #common ul.sqrcommonnav>li {
       padding-right: 20px;
    }
	{{/if}}

    {{if $settings->commonpagesalignment==='right'}}
    #common ul.sqrcommonnav {
       justify-content: flex-end;
    }
    #common ul.sqrcommonnav>li {
       padding-left: 20px;
    }
	{{/if}}

    {{if $settings->commonpagesalignment==='center'}}
    #common ul.sqrcommonnav {
       justify-content: center;
    }
    #common ul.sqrcommonnav>li {
       padding-left: 10px;
       padding-right: 10px;
    }
	{{/if}}

}

{{if $settings->navsuper}}
{{include file="./stylesuper.tpl"}}
{{else}}
{{include file="./styledropdown.tpl"}}
{{/if}}