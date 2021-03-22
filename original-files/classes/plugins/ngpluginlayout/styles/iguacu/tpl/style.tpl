body {
	background-color: #{{$config['palette.background']}};
	margin: 0;
	padding: 0;
}

@media screen and (min-width: {{$config['options.width']+100}}px) {
    #sqrouterbox {
        margin: 40px auto;
		max-width: {{$config['options.width']}}px;
		border: 10px solid #{{$config['palette.mainborder']}};
    }
}

#maincontainer {
	background-color: #{{$config['palette.background.content']}};
}

#sqrbreadcrumbs {
    background: linear-gradient(3deg, #{{$config['palette.breadcrumbs.background']}}, #{{$config['palette.background.content']}});
    color: #{{$config['palette.breadcrumbs.color']}};
    padding: 16px 30px;
    font-size: 13px;
    font-size-adjust: none;
}

#sqrbreadcrumbs a {
    color: #{{$config['palette.breadcrumbs.link']}};
    text-decoration: none;
}

#sqrbreadcrumbs a:hover {
    color: #{{$config['palette.breadcrumbs.color']}};
}


#maincontainer {
	padding: 0.1px 0;
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
}

#sqreyecatcher img {
    width: 100%;
    height: auto;
    display: block;
}

#footer {
	padding: 10px 0;
}

.sqrnavbar::after {
    content: '';
    clear: both;
    display: block;
}

.sqrnavbar img {
    display: block;
    float: left;
    border: 0;
    margin: 12px 0 12px 12px;
}

.sqrnav {
    padding: 0;
    line-height: 18px;
    text-transform: uppercase;
	font-size: 14px;
	font-size-adjust: none;
	letter-spacing: 0.5px;
    box-sizing: border-box;
    background: linear-gradient(180deg, #{{$config['palette.nav.background']}}, #{{$config['palette.nav.background.alt']}});
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

.sqrnav a {
    padding: 16px 48px 16px 16px;
    text-decoration: none;
    color: #{{$config['palette.nav.foreground']}};
    display: block;
    background: linear-gradient(170deg, #{{$config['palette.nav.background']}}, #{{$config['palette.nav.background.alt']}});
}

.sqrnav .active>a {
  font-weight: bold;
  color: #{{$config['palette.nav.foreground']}};
}

.sqrnav a:hover {
  color: #{{$config['palette.nav.hover']}};
}

.sqrnav > ul > li em.ngshopcartindicator {
	display: none;
	background-color: #{{$config['palette.background']}};
	color: #{{$config['palette.nav.foreground']}};
	font-style: normal;
	padding-right: 8px;
	padding-left: 8px;
	border-radius: 6px;
	margin-left: 8px;
	font-weight: normal;
}

.sqrnav > ul > li em.ngshopcartindicatoractive {
	display: inline-block;
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
    width: 50px;
    height: 50px;
    background: url(./../../styles/iguacu/img/?f=sprites&ca={{$config['palette.nav.foreground']}}&cb={{$config['palette.nav.hover']}}) 0 0 no-repeat;
    cursor: pointer;
    transition: transform 0.5s;
}

.sqrnav .sqrnavmore>div:hover {
  background-position: -50px 0px;
}

.sqrnav .sqrnavopen>div {
    transform: rotate(90deg);
}

.sqrsearchbar {
  display: none;
}

.sqrmodesearch .sqrsearchbar {
  display: block;
}

.sqrsearchbar form {
  display: block;
  margin: 0;
  padding: 0;
  background: #{{$config['palette.nav.background.alt']}};
  border: 0;
  box-sizing: border-box;
}

.sqrsearchbar input {
  display: block;
  margin: 0;
  padding: 0;
  background: #{{$config['palette.nav.background.alt']}} url(./../../styles/iguacu/img/?f=sprites&ca={{$config['palette.nav.foreground']}}&cb={{$config['palette.nav.hover']}}) -50px -100px no-repeat;
  border: 0;
  padding: 15px 15px 15px 50px;
  box-sizing: border-box;
  width: 100%;
  line-height: 20px;
  color: #{{$config['palette.nav.foreground']}};
  font: 14px 'Noto Sans',Verdana,Helvetica,sans-serif;
  outline: none;
}

#sqrlogor img {
    transform: rotate(90deg) translateY(-100%);
    transform-origin: 0 0;
}

#sqrlogor {
    margin-bottom: 40px;
}

.sqrcartlink {
    position: relative;
}

.sqrcartlink span.ngshopcartindicator {
	display: none;
	background-color: #{{$config['palette.background']}};
	color: #{{$config['palette.nav.foreground']}};
	font-style: normal;
	font-size: 8px;
	font-size-adjust: none;
	border-radius: 2px;
	line-height: 10px;
	padding: 0 2px;
	font-weight: normal;
	position: absolute;
}

.sqrcartlink span.ngshopcartindicatoractive {
	display: inline-block;
}

@media screen and (min-width: 1200px) {
    #navcontainer {
  	 	display: flex;
		box-sizing: border-box;
		width: 100%;
  	}

  	.sqrnavbar {
    	box-sizing: border-box;
    	width: 50px;
    	vertical-align: top;
{{if $config['options.navpos']==='right'}}
		order: 1;
{{/if}}
		background: linear-gradient(270deg, #{{$config['palette.nav.background']}}, #{{$config['palette.nav.background.alt']}});
	}
  	
  	.sqrnav {
    	box-sizing: border-box;
    	width: {{$config['options.navwidth']}}px;
    	vertical-align: top;
{{if $config['options.navpos']==='right'}}
		order: 3;
{{/if}}
	}
	
	#maincontainer {
    	box-sizing: border-box;
    	flex-grow: 1;
    	width: 100px;
    	vertical-align: top;
{{if $config['options.navpos']==='right'}}
		order: 2;
{{/if}}
	}

    #sqrlogo {
        display: none;
    }

    .sqrshownav {
        display: none;
    }

	.sqrhome {
		width: 50px;
		height: 30px;
		display: block;
		background: url(./../../styles/iguacu/img/?f=sprites&ca={{$config['palette.nav.foreground']}}&cb={{$config['palette.nav.hover']}}) 0 -60px no-repeat;
	}

	.sqrhome:hover {
		background-position: -50px -60px;
	}

	.sqrsearch {
		width: 50px;
		height: 30px;
		display: block;
		background: url(./../../styles/iguacu/img/?f=sprites&ca={{$config['palette.nav.foreground']}}&cb={{$config['palette.nav.hover']}}) 0 -110px no-repeat;
	}

	.sqrsearch:hover,
	.sqrmodesearch .sqrsearch {
		background-position: -50px -110px;
	}

	.sqrcartlink {
		width: 50px;
		height: 30px;
		display: block;
		background: url(./../../styles/iguacu/img/?f=sprites&ca={{$config['palette.nav.foreground']}}&cb={{$config['palette.nav.hover']}}) 0 -210px no-repeat;
		position: relative;
	}

    .sqrcartlink span.ngshopcartindicator {
        right: 8px;
        bottom: 2px;
    }

	.sqrcartlink:hover {
		background-position: -50px -210px;
	}

	.sqraccountlink {
		width: 50px;
		height: 30px;
		display: block;
		background: url(./../../styles/iguacu/img/?f=sprites&ca={{$config['palette.nav.foreground']}}&cb={{$config['palette.nav.hover']}}) 0 -260px no-repeat;
	}

	.sqraccountlink:hover {
		background-position: -50px -260px;
	}


}

@media screen and (max-width: 1199px) {
    .sqrnav {
        display: none;
    }

	.sqrnavbar {
		background: linear-gradient(170deg, #{{$config['palette.nav.background']}}, #{{$config['palette.nav.background.alt']}});
	}



    .sqrmodenav .sqrnav {
        display: block;
    }
    .sqrshownav {
		width: 30px;
		height: 50px;
		display: block;
		background: url(./../../styles/iguacu/img/?f=sprites&ca={{$config['palette.nav.foreground']}}&cb={{$config['palette.nav.hover']}}) -10px -150px no-repeat;
		float: right;
    }

	.sqrshownav:hover,
    .sqrmodenav .sqrshownav {
        background-position: -60px -150px;
    }

	.sqrhome {
		width: 30px;
		height: 50px;
		display: block;
		background: url(./../../styles/iguacu/img/?f=sprites&ca={{$config['palette.nav.foreground']}}&cb={{$config['palette.nav.hover']}}) -10px -50px no-repeat;
		float: right;
	}

	.sqrhome:hover {
		background-position: -60px -50px;
	}

	.sqrsearch {
		width: 30px;
		height: 50px;
		display: block;
		background: url(./../../styles/iguacu/img/?f=sprites&ca={{$config['palette.nav.foreground']}}&cb={{$config['palette.nav.hover']}}) -10px -100px no-repeat;
		float: right;
	}

	.sqrsearch:hover,
	.sqrmodesearch .sqrsearch {
		background-position: -60px -100px;
	}

	.sqrcartlink {
		width: 30px;
		height: 50px;
		display: block;
		background: url(./../../styles/iguacu/img/?f=sprites&ca={{$config['palette.nav.foreground']}}&cb={{$config['palette.nav.hover']}}) -10px -200px no-repeat;
		float: right;
	}

	.sqrcartlink:hover {
		background-position: -60px -200px;
	}

    .sqrcartlink span.ngshopcartindicator {
        right: 0px;
        bottom: 12px;
    }

	.sqraccountlink {
		width: 30px;
		height: 50px;
		display: block;
		background: url(./../../styles/iguacu/img/?f=sprites&ca={{$config['palette.nav.foreground']}}&cb={{$config['palette.nav.hover']}}) -10px -250px no-repeat;
		float: right;
	}

	.sqraccountlink:hover {
		background-position: -60px -250px;
	}



    #sqrlogor {
        display: none;
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
    padding: 20px 30px 0 30px;
    margin: 0;
    background: linear-gradient(170deg, #{{$config['palette.common.background']}}, #{{$config['palette.background.content']}});
    font-size: 13px;
    font-size-adjust: none;
}

.sqrcommonnavhierarchical,
.sqrcommonnav,
.sqrfootertext {
    padding: 10px 0;
    margin: 0;
    box-sizing: border-box;
}

.sqrcommonnavhierarchical {
  padding-bottom: 1px;
}
 
.sqrfootertext {
  color: #{{$config['palette.common.font']}};
  padding-bottom: 20px;
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


.sqrcommonnavhierarchical a,
.sqrcommonnav a,
.sqrfootertext a,
.sqrcontact a
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
.sqrfootertext a:hover,
.sqrcontact a:hover
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
    text-transform: uppercase;
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
	color: #{{$config['palette.common.font']}};
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

    .sqrcommonnavhierarchical {
        display: flex;
        flex-wrap: wrap;
    }

	.sqrcommonnavhierarchical>li {
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

	.sqrcommonnav {
	    display: flex;
	    flex-wrap: wrap;
	    justify-content: center;
	}

	.sqrcommonnav>li {
		padding: 0 10px;
	}
	
	 .sqrdesktophidden {
	 	display: none;
	 }
	
}