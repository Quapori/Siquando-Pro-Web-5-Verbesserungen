.paragraphcalendar table {
	float: left;
	border-collapse: collapse;
	border: 1px solid #{{$settings->calendarbordercolor}};
 	-moz-user-select: none;
   	-khtml-user-select: none;
   	-webkit-user-select: none;
   	-ms-user-select: none;
   	user-select: none;
}

.paragraphcalendar th {
	background-color: #{{$settings->backcolorday}};
	color: #{{$settings->fontcolorday}};
	font-weight: normal;
	margin: 0;
	padding: 2%;
	text-align: center;
}


.paragraphcalendar td {
	background-color: #{{$settings->backcolorday}};
	color: #{{$settings->fontcolorday}};
	border: 1px solid #{{$settings->calendarbordercolor}};
	margin: 0;
	padding: 2%;
	text-align: center;
	cursor: default;	
}

.paragraphcalendar td.paragraphcalendartoday {
	font-weight: bold;
}


.paragraphcalendar td.calendarevent {
	background-color: #{{$settings->backcolorevent}};
	color: #{{$settings->fontcolorevent}};
}

.paragraphcalendar td.calendareventred {
	background-color: #{{$settings->backcolorred}};
	color: #{{$settings->fontcolorred}};
}

.paragraphcalendar td.calendareventorange {
	background-color: #{{$settings->backcolororange}};
	color: #{{$settings->fontcolororange}};
}

.paragraphcalendar td.calendareventgreen {
	background-color: #{{$settings->backcolorgreen}};
	color: #{{$settings->fontcolorgreen}};
}

.paragraphcalendar td.calendareventselected {
	background-color: #{{$settings->backcolorselected}};
	color: #{{$settings->fontcolorselected}};
}


.calendarclickable {
	cursor: pointer !important;
}

.paragraphcalendar td.emptycalendercell {
	background-color: #{{$settings->colorinactive}};
}

.paragraphcalendareventinfo {
	display: none;
}

.paragraphcalendar img {
	display: block;
	margin: 0 0 10px 0;
	border: 0;
}

.paragraphcalendar img.paragraphcalendarsidepicture {
	float: right;
	margin: 0 0 10px 15px;
}

.sqr .paragraphcalendar img {
	width: 100%;
	height: auto;
}

.sqr img.paragraphcalendarsidepicture {
	width: 40%;
}

@media screen and (max-width: 767px) {
	.sqr img.paragraphcalendarsidepicture {
		margin: 0 0 10px 0;
		float: none;
		width: 100%;
	}
}

.paragraphcalenderevents {
	margin-bottom: 20px;
}

.paragraphcalendermarquee {
	background-color: #{{$settings->backcolorselected}};
	color: #{{$settings->fontcolorselected}};
	display: inline-block;
	padding: 6px;
	line-height: 1.2;
	text-align: center;
}

@media screen and (min-width: 768px) {
	.sqr .paragraphcalendar1cols>table {
		box-sizing: border-box;
		width: 100%;
		margin-bottom: 2%;
	}


	.sqr .paragraphcalendar2cols>table {
		box-sizing: border-box;
		width: 49%;
		margin-right: 2%;
		margin-bottom: 2%;
	}

	.sqr .paragraphcalendar3cols>table {
		box-sizing: border-box;
		width: 32%;
		margin-right: 2%;
		margin-bottom: 2%;
	}


	.sqr .paragraphcalendar1cols>table:last-of-type,
	.sqr .paragraphcalendar2cols>table:last-of-type,
	.sqr .paragraphcalendar3cols>table:last-of-type {
		margin-right: 0;
	}
}

@media screen and (max-width: 767px) {
	.sqr .paragraphcalendar1cols>table,
	.sqr .paragraphcalendar2cols>table,
	.sqr .paragraphcalendar3cols>table {
		float: none;
		margin-bottom: 2%;
		box-sizing: border-box;
		width: 100%;
	}
}