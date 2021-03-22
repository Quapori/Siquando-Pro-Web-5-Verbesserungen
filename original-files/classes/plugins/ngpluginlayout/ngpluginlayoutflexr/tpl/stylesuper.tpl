#nav a {
  display: block;
  margin: 0;
  padding: {{$settings->navpaddingpri|ngmargin}};
  font: {{$settings->navfontpri|ngfont}};
  line-height: {{$settings->navlineheightpri()}}px;
  color: #{{$settings->navfontpri|ngfontcolor}};
  text-transform: {{if $settings->navfontpri|ngfontisuppercase}}uppercase{{else}}none{{/if}};
  text-decoration: none;
  -webkit-tap-highlight-color: transparent;
}

#nav li.active>a {
	font-weight: bold;
}

#nav li em.ngshopcartindicator {
  display: none;
  background: {{$settings->navbackgroundbubble|ngbackground}};
  color: #{{$settings->navcolorbubble}};
  font-style: normal;
  padding-right: 8px;
  padding-left: 8px;
  border-radius: 5px;
  margin-left: 8px;
  font-weight: normal;
}

#nav li em.ngshopcartindicatoractive {
    display: inline-block;
}

#nav>ul li, #nav>div {
  display: block;
  margin: 0;
  padding: 0;
{{if $settings->navbackgroundpri !== ''}}
  background: {{$settings->navbackgroundpri|ngbackground}};
{{if $settings->navbackgroundpri|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
  box-sizing: border-box;
}

#nav > ul > li.sqrnavsearch > div > div {
    padding: {{$settings->navpaddingsearch|ngmargin}};
}

#nav .sqrnavsearch form {
  box-sizing: border-box;
  display: block;
  margin: 0;
  padding: 0;
  display: block;
  width: 100%;
{{if $settings->navbackgroundsearch !== ''}}
  background: {{$settings->navbackgroundsearch|ngbackground}};
{{if $settings->navbackgroundsearch|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
{{/if}}
}

#nav .sqrnavsearch input {
  box-sizing: border-box;
  display: block;
  padding: 0;
  width: 100%;
  border: 0;
  padding: 8px 12px 8px 30px;
  margin: 0;
  border-color: rgba(255, 255, 255, 0.075);
  -webkit-appearance: none;
  border-radius: 0;
  font: {{$settings->navfontsearch|ngfont}};
  color: #{{$settings->navfontsearch|ngfontcolor}};
  text-transform: {{if $settings->navfontsearch|ngfontisuppercase}}uppercase{{else}}none{{/if}};
  background: transparent url(../img/?f={{$settings->navstylesearch}}&ca={{$settings->navfontsearch|ngfontcolor}}) 8px center no-repeat;
}

{{if $settings->navfixed}}
.flexrfixed #navcontainer {
	position: fixed;
	top: 0;
}
.flexrfixed #navplaceholder {
	height: {{$settings->navheight ()}}px;
}
{{/if}}


#nav > ul > li > div {
    display: none;
    position: absolute;
    left: 0;
    right: 0;
    {{if $settings->navfillsec!==''}}
        background: {{$settings->navfillsec|ngbackground}};
        {{if $settings->navfillsec|ngisstretchpicture}}
        background-size: 100%;
        {{/if}}
    {{/if}}
    z-index: 1001;
}

#nav > ul > li > div > div {
    max-width: {{$settings->width}}px;
    margin: 0 auto;
    {{if $settings->navbackgroundsec!==''}}
        background: {{$settings->navbackgroundsec|ngbackground}};
        {{if $settings->navbackgroundsec|ngisstretchpicture}}
        background-size: 100%;
        {{/if}}
    {{/if}}
    padding: 0 {{$settings->navpaddingsec|ngmarginright}} {{$settings->navpaddingsec|ngmarginbottom}} 0;
    box-sizing: border-box;
}

#nav > ul > li.sqrnavopen > div {
    display: block;
}

#nav > ul > li > div > div > ul {
    display: block;
    margin: 0;
    padding: 0;
    list-style: none;
}

#nav > ul > li > div > div > ul:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}

#nav > ul > li > div > div > ul > li {
    display: block;
    margin: 0;
    padding: 0;
    float: left;
}

#nav > ul > li > div > div > ul > li > a {
  padding: {{$settings->navpaddingsec|ngmargintop}} 0 0 {{$settings->navpaddingsec|ngmarginleft}};
  font: {{$settings->navfontsec|ngfont}};
  color: #{{$settings->navfontsec|ngfontcolor}};
  text-transform: {{if $settings->navfontsec|ngfontisuppercase}}uppercase{{else}}none{{/if}};
  text-decoration: none;
  -webkit-tap-highlight-color: transparent;
}

#nav > ul > li > div > div > ul > li > ul {
    display: block;
    list-style: none;
    margin: 0;
    padding: 0;
}

#nav > ul > li > div > div > ul > li > ul > li {
    display: block;
    margin: 0;
    padding: 0;
}

#nav > ul > li > div > div > ul > li > ul > li > a {
  padding: {{$settings->navpaddingter|ngmargintop}} 0 0 {{$settings->navpaddingter|ngmarginleft}};
  font: {{$settings->navfontter|ngfont}};
  color: #{{$settings->navfontter|ngfontcolor}};
  text-transform: {{if $settings->navfontter|ngfontisuppercase}}uppercase{{else}}none{{/if}};
  text-decoration: none;
  -webkit-tap-highlight-color: transparent;
}

{{if $settings->navhovercolor!==''}}
#nav > ul > li > div > div > ul > li > a:hover,
#nav  ul > li > div > div > ul > li > ul > li > a:hover {
    color: #{{$settings->navhovercolor}};
}
{{/if}}

#nav > ul > li > div > div > ul > li > a > figure,
#nav > ul > li > div > div > ul > li > ul > li > a > figure {
    display: block;
    margin: 0;
    padding: 0;
}

#nav > ul > li > div > div > ul > li > a > figure > img,
#nav > ul > li > div > div > ul > li > ul > li > a > figure > img {
    display: block;
    width: 100%;
    height: auto;
    transition: opacity 0.2s;
    padding-bottom: {{$settings->navpaddingter|ngmarginbottom}};
}

{{if $settings->navhover}}
#nav > ul > li > div > div > ul > li > a:hover > figure > img,
#nav > ul > li > div > div > ul > li > ul > li > a:hover > figure > img {
    opacity: 0.8;
}
{{/if}}

#nav > ul > li > div > div > ul > li > a > figure > figcaption {
    display: block;
    margin: 0;
    padding: 0 0 {{$settings->navpaddingsec|ngmarginbottom}} 0;
}

#nav > ul > li > div > div > ul > li > ul > li > a > figure > figcaption {
    display: block;
    margin: 0;
    padding: 0 0 {{$settings->navpaddingter|ngmarginbottom}} 0;
}

@media screen and (max-width: {{$settings->mobilewidth-1}}px) {
  #nav>ul>li.sqrnavlogo {
	display: none;
  }

{{if $settings->navdivider}}
  #nav a.sqrnavshow {
  	border-bottom: none;
  }
{{/if}}
  #nav a.sqrnavshow, #nav a.sqrnavhide {
    background: url(../img/?f={{$settings->navstylemenu}}&ca={{$settings->navfontpri|ngfontcolor}}) right center no-repeat;
  }
  #nav a.sqrnavshow>img, .sqrnav a.sqrnavhide>img {
    display: block;
  }
  {{if $settings->navstylemore!=='none'}}
  #nav li.sqrnavmore>a {
    background: url(../img/?f={{$settings->navstylemore}}right&ca={{$settings->navfontpri|ngfontcolor}}) right center no-repeat;
  }
  #nav li.sqrnavopen>a {
    background-image: url(../img/?f={{$settings->navstylemore}}down&ca={{$settings->navfontpri|ngfontcolor}});
  }
  {{/if}}

  #nav .sqrnavshow {
    display: block;
  }

  #nav .sqrnavhide {
    display: none;
  }
  #nav.sqrnavopen>div>a.sqrnavshow {
    display: none;
  }
  #nav.sqrnavopen>div>a.sqrnavhide {
    display: block;
  }

  #nav li.sqrnavopen>ul {
    display: block;
  }
  #nav ul {
    display: none;
    margin: 0 auto;
    padding: 0;
    list-style: none;
  }
  #nav ul ul {
    display: none;
  }
  #nav ul li li>a {
    padding-left: 44px;
  }
  #nav ul li li li>a {
    padding-left: 66px;
  }
  #nav.sqrnavopen>ul {
    display: block;
  }
  {{if $settings->navfixed}}
  .flexrfixed #nav.sqrnavopen {
  	max-height: 100vh;
  	overflow-y: auto;
  }
  {{/if}}

    #nav > ul > li > div > div > ul > li {
        width: 50%;
    }

    #nav > ul > li > div > div > ul > li:nth-child(2n+1) {
        clear: both;
    }

    #nav > ul > li > div {
        position: static;
    }


}

@media print, screen and (min-width: {{$settings->mobilewidth}}px) {

{{if $settings->navhover}}
	#nav>ul>li>a:hover {
		{{if $settings->navbackgroundbrightpri()}}
		background-color: rgba(0, 0, 0, 0.035);
		{{else}}
		background-color: rgba(255, 255, 255, 0.075);
		{{/if}}
	}
{{/if}}


  #nav>div {
    display: none;
  }

  #nav>ul {
    box-sizing: border-box;
    display: block;
    margin: 0;
    padding: 0;
    list-style: none;
    width: 100%;
  }


  #nav>ul:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
  }
  #nav>ul>li {
    float: left;
  }

{{if $settings->navstylemore!=='none'}}
  #nav>ul>li.sqrnavmore>a {
    background-image: url(../img/?f={{$settings->navstylemore}}down&ca={{$settings->navfontpri|ngfontcolor}});
    background-position: right center;
    background-repeat: no-repeat;
    padding-right: {{$settings->navextrapaddingrightpri()}}px;
  }
  #nav>ul>li.sqrnavopen>a {
    background-image: url(../img/?f={{$settings->navstylemore}}down&ca={{$settings->navcolorpriopen}});
  }
{{/if}}
{{if $settings->navbackgroundpriopen !== ''}}
  #nav>ul>li.sqrnavopen {
   	background: {{$settings->navbackgroundpriopen|ngbackground}};
{{if $settings->navbackgroundpriopen|ngisstretchpicture}}
	background-size: 100%;
{{/if}}
  }
{{/if}}
  #nav>ul>li.sqrnavopen>a {
   	color: #{{$settings->navcolorpriopen}};
  }

  #nav>ul>li.sqrnavhome>a>span,
  #nav>ul>li.sqrnavsearch>a>span,
  #nav>ul>li.sqrnavaccount>a>span,
  #nav>ul>li.sqrnavcart>a>span
  {
    display: none;
  }
  #nav>ul>li.sqrnavhome>a {
    background-image: url(../img/?f={{$settings->navstylehome}}&ca={{$settings->navfontpri|ngfontcolor}});
    background-repeat: no-repeat;
    background-position: center center;
    width: 16px;
    height: {{$settings->navheightpri()}}px;
    padding: 0 {{$settings->navpaddingpri|ngmarginright}} 0 {{$settings->navpaddingpri|ngmarginleft}};
  }
  #nav>ul>li.sqrnavlogo>a {
  	padding: 0;
  }
  #nav>ul>li.sqrnavlogo>a>img {
  	display: block;
  }
  #nav>ul>li.sqrnavsearch,
  #nav>ul>li.sqrnavcart,
  #nav>ul>li.sqrnavaccount
  {
    float: right;
  }
  #nav>ul>li.sqrnavsearch>a {
    background-image: url(../img/?f={{$settings->navstylesearch}}&ca={{$settings->navfontpri|ngfontcolor}});
    background-repeat: no-repeat;
    background-position: center center;
    width: 16px;
    height: {{$settings->navheightpri()}}px;
    padding: 0 {{$settings->navpaddingpri|ngmarginright}} 0 {{$settings->navpaddingpri|ngmarginleft}};
  }
  #nav>ul>li.sqrnavsearch.sqrnavopen>a {
    background-image: url(../img/?f={{$settings->navstylesearch}}&ca={{$settings->navcolorpriopen}});
  }
{{if $settings->navstylecart!=='none'}}
  #nav>ul>li.sqrnavcart>a {
    background-image: url(../img/?f={{$settings->navstylecart}}&ca={{$settings->navfontpri|ngfontcolor}});
    background-repeat: no-repeat;
    background-position: center center;
    width: 16px;
    height: {{$settings->navheightpri()}}px;
    padding: 0 {{$settings->navpaddingpri|ngmarginright}} 0 {{$settings->navpaddingpri|ngmarginleft}};
  }
  #nav>ul>li.sqrnavcart.ngshopcartindicatorsimpleactive>a {
    background-image: url(../img/?f={{$settings->navstylecart}}full&ca={{$settings->navfontpri|ngfontcolor}}&cb={{$settings->navbackgroundbubble|ngbackgroundcolor:f79646}});
  }
{{/if}}
{{if $settings->navstyleaccount!=='none'}}
  #nav>ul>li.sqrnavaccount>a {
    background-image: url(../img/?f={{$settings->navstyleaccount}}&ca={{$settings->navfontpri|ngfontcolor}});
    background-repeat: no-repeat;
    background-position: center center;
    width: 16px;
    height: {{$settings->navheightpri()}}px;
    padding: 0 {{$settings->navpaddingpri|ngmarginright}} 0 {{$settings->navpaddingpri|ngmarginleft}};
  }
{{/if}}
  #nav>ul>li.sqrnavopen.sqrnavsearch>ul {
    left: auto;
    right: 0;
    opacity: 1;
  }

    #nav > ul > li > div > div > ul > li {
        width: {{floor(100/$settings->navcolumns)}}%;
    }

    {{if $settings->navshadow}}
    {{if $settings->navfillsec === ''}}
        #nav > ul > li > div > div {
            box-shadow: 0 3px 3px rgba(0,0,0,0.2);
        }
    {{else}}
        #nav > ul > li > div {
            box-shadow: 0 3px 3px rgba(0,0,0,0.2);
        }
    {{/if}}
    {{/if}}

    #nav > ul > li > div > div > ul > li:nth-child({{$settings->navcolumns}}n+1) {
        clear: both;
    }
}