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

@media screen and (min-width: {{$config['options.width']+80}}px) {
    #sqrouterbox {
        margin: 40px auto;
		max-width: {{$config['options.width']}}px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }
}

#maincontainer {
	background-color: #{{$config['palette.background']}};
}

#maincontainer {
	padding: 0.001px 0;
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
    padding: 0;
    line-height: 19px;
    text-transform: uppercase;
    box-sizing: border-box;
    background-color: #{{$config['palette.nav.background']}};
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

.sqrnav li li,
.sqrnav li li li li,
.sqrnav li li li li li li
 {
    background-color: #{{$config['palette.nav.background.alt']}};
}

.sqrnav li li li,
.sqrnav li li li li li
{
    background-color: #{{$config['palette.nav.background']}};
}

.sqrnav a {
    padding: 12px 48px 12px 16px;
    text-decoration: none;
    color: #{{$config['palette.nav.foreground']}};
    border-bottom: 1px solid #{{$config['palette.border']}};
    display: block;
}

.sqrnav li em.ngshopcartindicator {
    display: none;
    background-color: #{{$config['palette.nav.foreground']}};
    color: #{{$config['palette.nav.background']}};
    font-style: normal;
    padding-right: 8px;
    padding-left: 8px;
    border-radius: 8px;
    margin-left: 8px;
    font-weight: normal;
}

.sqrnav li em.ngshopcartindicatoractive {
    display: inline-block;
}

.sqrnav .active>a {
  font-weight: bold;
  color: #{{$config['palette.nav.foreground']}};
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
    background: url(./../../styles/nyc/img/?f=sprites&ca={{$config['palette.nav.foreground']}}) -2px -146px no-repeat;
    cursor: pointer;
    transition: transform 0.5s;
}

.sqrnav .sqrnavmore>div:hover {
  background-position: -50px -146px;
}

.sqrnav .sqrnavopen>div {
    transform: rotate(90deg);
}

.sqrhome {
  width: 37px;
  height: 43px;
  display: block;
  background: url(./../../styles/nyc/img/?f=sprites&ca={{$config['palette.nav.foreground']}}) -5px -242px no-repeat;
  float: right;
}

.sqrsearch {
  width: 37px;
  height: 43px;
  display: block;
  background: url(./../../styles/nyc/img/?f=sprites&ca={{$config['palette.nav.foreground']}}) -5px -98px no-repeat;
  float: right;
}

.sqrsearchbar {
  display: none;
}

.sqrmodesearch .sqrsearchbar {
  display: block;
}

.sqrmodesearch .sqrsearch {
  background-position: -53px -98px;
}

.sqrsearchbar form {
  display: block;
  margin: 0;
  padding: 0;
  background-color: #ffffff;
  border: 0;
  box-sizing: border-box;
  border-bottom: 1px solid #{{$config['palette.border']}};
}

.sqrsearchbar input {
  display: block;
  margin: 0;
  padding: 0;
  background: #ffffff url(./../../styles/nyc/img/?f=sprites&ca={{$config['palette.nav.foreground']}}) -50px -242px no-repeat;
  border: 0;
  padding: 12px 16px 12px 48px;
  box-sizing: border-box;
  width: 100%;
  line-height: 19px;
  color: #{{$config['palette.nav.foreground']}};
  font: 15px 'Open Sans',Verdana,Helvetica,sans-serif;
  outline: none;
}


@media screen and (min-width: 1200px) {
    #navcontainer {
  	 	display: table;
		box-sizing: border-box;
		table-layout: fixed;
		width: 100%;
  	}
  	
  	.sqrnav {
    	box-sizing: border-box;
    	width: 25%;
    	display: table-cell;
    	vertical-align: top;	
        border-right: 1px solid #{{$config['palette.border']}};
	}
	
	#maincontainer {
    	box-sizing: border-box;
    	width: 75%;
    	display: table-cell;
    	vertical-align: top;	
	}
    
    
    .sqrlogow {
        display: none;
    }
    .sqrshownav {
        display: none;
    }
    .sqrlogoq {
        width: 100%;
        height: auto;
        display: block;
        border: 0;
    }
}

@media screen and (max-width: 1199px) {
    .sqrnav {
        display: none;
    }
    .sqrmodenav .sqrnav {
        display: block;
    }
    .sqrlogoq {
        display: none;
    }
    .sqrlogow {
        width: 100%;
        height: auto;
        display: block;
        border: 0;
        border-bottom: 1px solid #{{$config['palette.border']}};
    }
    .sqrshownav {
        width: 37px;
        height: 43px;
        display: block;
        background: url(./../../styles/nyc/img/?f=sprites&ca={{$config['palette.nav.foreground']}}) -5px -194px no-repeat;
        float: right;
    }
    .sqrmodenav .sqrshownav {
        background-position: -53px -194px;
    }
}

@media screen and (min-width: 1024px) {
	
	{{if $config['options.shadow']==='true'}}
	#sqrouterbox {
		box-shadow: 0 0 30px rgba(0,0,0,0.3);
	}
	{{/if}}
	
	
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