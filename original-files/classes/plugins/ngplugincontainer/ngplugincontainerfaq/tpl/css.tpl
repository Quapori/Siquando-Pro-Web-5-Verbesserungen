.faq_{{$uid}} {
    display: flex;
    justify-content: space-between;
    align-items: stretch;
}

.faq_{{$uid}} .faqcontainer {
    width: 75%;
	box-sizing: border-box;
	padding-left: {{$paddinghorizontal}}px;
}

.faq_{{$uid}} .faq {
    width: 25%;
}

.faq_{{$uid}} .faq ul {
	list-style: none;
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}


.faq_{{$uid}} .faq li {
	display: block;
	padding: 0;
	margin: 0;
}

.faq_{{$uid}} .faq li a { 
	color: {{$text}}; 
	display: block;
	padding: {{$paddingvertical}}px {{$paddinghorizontal}}px {{$paddingvertical}}px 0;
	text-decoration: none;
	outline: none;
    border-right: 1px solid {{$border}};
	line-height: {{$lineheight}};
}

.faq_{{$uid}} .faq li a:hover {
	border-right-color: {{$borderhover}};
	color: {{$texthover}};
}

.faq_{{$uid}} .faq li a.faqselected {
    border-right: 4px solid {{$borderactive}};
    color: {{$textactive}};
}


.faq_{{$uid}} .faqareaclosed {
	display: none;
}

@media (max-width: 1023px) {
	.faq_{{$uid}} {
		display: block;
	}

	.faq_{{$uid}} .faqcontainer {
		width: 100%;
		padding-left: 0;
	}

	.faq_{{$uid}} .faq {
		width: 100%;
	}
}