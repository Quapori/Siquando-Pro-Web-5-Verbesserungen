#{{$id}}>div {
	width: {{$width}}px;
	height: {{$height}}px;
	position: relative;
	overflow: hidden;
}

#{{$id}} ul {
	margin: 0;
	padding: 0;
	list-style: none;
	position: absolute;
	left: 0;
	transition: left 0.5s;
}

#{{$id}} li {
	display: block;
	position: absolute;
	width: {{$width}}px;
	height: {{$height}}px;
}

#{{$id}} img {
	display: block;
	border: none;
	width: {{$width}}px;
	height: {{$height}}px;
}

#eyecatcherbullets {
	position: absolute;
	bottom: 10px;
	{{$bulletsposition}}: 5px;
	z-index: 2;
}

#eyecatcherbullets>div {
	width: 20px;
	height: 20px;
	background-color: #{{$color}};
	float: left;
	margin: 0 5px;
	cursor: pointer;
	box-shadow: 1px 1px 1px rgba(0,0,0,0.2);
}

#eyecatcherbullets>div:hover {
	background-color: #{{$colorhover}};
}

#eyecatcherbullets>div.selected {
	background-color: #{{$colorselected}};
}

#eyecatchernext, #eyecatcherprev {
	width: 32px;
	height: 32px;
	background: url(../img/prevnext.png) no-repeat;
	position: absolute;
	top: 50%;
	margin-top: -16px;
	cursor: pointer;
	z-index: 2;
}

#eyecatchernext {
	background-position: 0 0;
	right: 10px;
}

#eyecatcherprev {
	background-position: -32px 0;
	left: 10px;
}