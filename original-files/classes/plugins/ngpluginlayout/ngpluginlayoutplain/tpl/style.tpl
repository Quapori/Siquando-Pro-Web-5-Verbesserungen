HTML {
	background: #{{$settings->background}};
}

BODY {
	margin: 0;
	padding: 20px 0;	
}

#content {
	padding: 20px 0;
}

.sqrallwaysboxed, 
.sqrmobilefullwidth,
.sqrdesktopboxed
{
	box-sizing: border-box;
	padding-left: 20px;
	padding-right: 20px;
	max-width: 840px;
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
	 		
.sqrallwaysfullwidth .sqrsuppressborders {
	border-left: 0 !important;
	border-right: 0 !important;
}