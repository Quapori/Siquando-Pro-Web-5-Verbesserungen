#sqrmaincontainer {
    max-width: {{$config['options.width']}}px;
    margin: 30px auto;
    background-color: #{{$config['palette.contentbackground']}};
    border: 1px solid #{{$config['palette.boxborder']}};
}

#maincontainer {
    border-top: 1px solid #{{$config['palette.boxborder']}};
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
    border-bottom: 1px solid #{{$config['palette.boxborder']}};
}

#contact {
    border-top: 1px solid #{{$config['palette.boxborder']}};
    padding: 10px 27px;
    text-align: center;
}

#contact a, #contact span {
	color: #{{$config['palette.contact']}};
	text-decoration: none;
	-webkit-text-size-adjust:none;
	margin-right: 6px;
    text-transform: uppercase;
    display: inline-block;
    margin: 5px 3px;
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

#contact a:hover {
    color: #{{$config['palette.contact.hover']}};
	text-decoration: none;
}

#footer {
    padding: 10px 0;
    border-top: 1px solid #{{$config['palette.boxborder']}};
}

#sqrbreadcrumbs a {
    color: #{{$config['palette.breadcrumbs']}};
    text-decoration: none;
}

#sqrbreadcrumbs a:hover {
    color: #{{$config['palette.breadcrumbs.hover']}};
    text-decoration: none;
}

#sqrbreadcrumbs {
    padding: 10px 0 0 0;
    font-size: 90%;
}

.sqrnav > a.sqrnavshow,
.sqrnav > a.sqrnavhide {
    display: none;
}

header {
    position: relative;
    overflow: hidden;
    margin: 0;
    padding: 0;
    background-color: #ffffff;
    border-top: 1px solid #{{$config['palette.boxborder']}};
}

header img {
    width: 100%;
    display: block;
    border: 0;
    position: absolute;
    height: 100%;
}

header img.headersliderpri {
    z-index: 1;
    transition: none;
    -webkit-transition: none;
    opacity: 1;
}

header img.headerslidersec {
    z-index: 2;
    transition: none;
    -webkit-transition: none;
    opacity: 0;
}

header img.headerslidersecout {
    transition: opacity 0.5s;
    -webkit-transition: opacity 0.5s;
    opacity: 1;
}

#headersliderbullets {
    z-index: 3;
    position: absolute;
    bottom: 10px;
    left: 50%;
}

#headersliderbullets::after {
    content: '';
    clear: both;
    display: block;
}

#headersliderbullets a {
    width: 20px;
    height: 20px;
    background: url(./../../styles/cetera/img/?f=bullet&c={{$config['palette.bullets']}}) no-repeat left top;
    float: left;
}

#headersliderbullets a.active {
    background-position: left bottom;
}

body {
    background-color: #{{$config['palette.background']}};
    margin: 0;
    padding: 0;
}

footer {
    margin: 0;
    padding: 20px 0 0 0;
    border-top: 1px solid #{{$config['palette.boxborder']}};
    font-size: 14px;
}

.sqrcommonlinks, .sqrfootertext {
    margin: 0 auto;
    padding: 0 30px 20px 30px;
    box-sizing: border-box;
    text-align: center;
}

.sqrfootertext {
    color: #{{$config['palette.footertext']}};
}

.sqrcommonlinks a {
    text-decoration: none;
    text-transform: uppercase;
    color: #{{$config['palette.footerlinks']}};
    padding: 0 8px;
    transition: color 0.3s;
}

.sqrcommonlinks a:hover {
    color: #{{$config['palette.footerhover']}};
}

.sqrnav {
    z-index: 1000;
    font-size: 14px;
    padding: 0;
    margin: 0;
}

.sqrnav .sqrlogo {
    height: 60px;
    width: auto;
    display: block;
    float: left;
}

.sqrnav > ul {
    display: block;
    margin: 0;
    padding: 0;
    float: right;
}

.sqrnav > ul:after,
.sqrnav:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}

.sqrnav > ul > li {
    display: block;
    float: left;
}

.sqrnav > ul > li.active > a {
    border-bottom-color: #{{$config['palette.nav.active']}};
}

.sqrnav > ul > li.sqrnavopen > a {
    border-bottom-color: #{{$config['palette.nav.open']}};
}

.sqrnav > ul > li.sqrnavopen > div {
    display: block;
}

.sqrnav > ul > li a {
    display: block;
    padding: 20px;
    box-sizing: border-box;
    text-decoration: none;
    color: #{{$config['palette.navtext']}};
    transition: color 0.2s;
    line-height: 20px;
}

.sqrnav > ul > li.sqrnavhome > a,
.sqrnav > ul > li.sqrnavsearch > a,
.sqrnav > ul > li.sqrnavcart > a {
    background-repeat: no-repeat;
    background-position: center center;
    height: 60px;
}

.sqrnav > ul > li.sqrnavhome > a {
    background-image: url(./../../styles/cetera/img/?f=home&c={{$config['palette.navtext']}});
}

.sqrnav > ul > li.sqrnavsearch > a {
    background-image: url(./../../styles/cetera/img/?f=search&c={{$config['palette.navtext']}});
}

.sqrnav > ul > li.sqrnavhome > a > span,
.sqrnav > ul > li.sqrnavsearch > a > span,
.sqrnav > ul > li.sqrnavcart > a > span {
    display: none;
}

.sqrnav > ul > li.sqrnavsearch,
.sqrnav > ul > li.sqrnavcart {
    float: right;
}

.sqrnav > ul > li.sqrnavsearch > div > div > form {
    width: 100%;
    margin: 0;
    padding: 5px 15px;
    box-sizing: border-box;
}

.sqrnav > ul > li.sqrnavsearch > div > div > form > input {
    width: 100%;
    margin: 0;
    padding: 0;
    border: none;
    box-sizing: border-box;
    outline: none;
    font: 16px 'Open Sans';
    color: #{{$config['palette.searchtext']}};
    background-color: #{{$config['palette.contentbackground']}};
}

.sqrnav > ul > li a:hover {
    color: #{{$config['palette.navhover']}};
}

.sqrnav > ul > li > a {
    position: relative;
    z-index: 1002;
    text-transform: uppercase;
    font-weight: bold;
    letter-spacing: 1px;
    border-bottom: 4px solid transparent;
    padding-bottom: 16px;
    transition: border-bottom-color 1s;
}

.sqrnav > ul > li > a > span > em.ngshopcartindicator {
    display: none;
    background: #{{$config['palette.navhover']}};
    color: #{{$config['palette.contentbackground']}};
    font-style: normal;
    padding-right: 8px;
    padding-left: 8px;
    border-radius: 5px;
    margin-left: 8px;
    font-weight: normal;
}

.sqrnav > ul > li > a > span > em.ngshopcartindicatoractive {
    display: inline-block;
}

.sqrnav > ul > li > div {
    display: none;
    position: absolute;
    left: 0;
    right: 0;
    z-index: 1001;
}

.sqrnav > ul > li > div > div {
    max-width: {{$config['options.width']}}px;
    margin: 0 auto;
    background-color: #ffffff;
    border: 1px solid #{{$config['palette.boxborder']}};
    padding: 10px 0;
}

.sqrnav > ul > li > div > div > ul {
    display: block;
    margin: 0;
    padding: 0;
    list-style: none;
}

.sqrnav > ul > li > div > div > ul:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}

.sqrnav > ul > li > div > div > ul > li {
    display: block;
    margin: 0;
    padding: 0;
    width: 25%;
    float: left;
}

.sqrnav > ul > li > div > div > ul > li:nth-child(4n+1) {
    clear: both;
}

.sqrnav > ul > li > div > div > ul > li > a {
    padding: 5px 20px;
    color: #{{$config['palette.navtext']}};
    font-weight: bold;
    text-transform: uppercase;
}

.sqrnav > ul > li > div > div > ul > li > ul {
    display: block;
    list-style: none;
    margin: 0;
    padding: 0;
}

.sqrnav > ul > li > div > div > ul > li > ul > li {
    display: block;
    margin: 0;
    padding: 0;
}

.sqrnav > ul > li > div > div > ul > li > ul > li:last-child {
    margin-bottom: 10px;
}

.sqrnav > ul > li > div > div > ul > li > ul > li > a {
    padding: 5px 20px;
}

.sqrnav > ul > li > div > div > ul > li > a > figure,
.sqrnav > ul > li > div > div > ul > li > ul > li > a > figure {
    display: block;
    margin: 0;
    padding: 0;
}

.sqrnav > ul > li > div > div > ul > li > a > figure > img,
.sqrnav > ul > li > div > div > ul > li > ul > li > a > figure > img {
    display: block;
    width: 100%;
    height: auto;
    transition: opacity 0.2s;
    padding-bottom: 5px;
}

.sqrnav > ul > li > div > div > ul > li > a:hover > figure > img,
.sqrnav > ul > li > div > div > ul > li > ul > li > a:hover > figure > img {
    opacity: 0.8;
}

.sqrnav > ul > li > div > div > ul > li > a > figure > figcaption,
.sqrnav > ul > li > div > div > ul > li > ul > li > a > figure > figcaption {
    display: block;
    margin: 0;
    padding: 5px 0;
}

@media (max-width: {{$config['options.width']+60}}px) {
    #sqrmaincontainer {
        margin: 0;
        border: 0;
        max-width: none;
    }

    .sqrnav > ul > li > div {
        border-left: 0;
        border-right: 0;
        max-width: none;
        margin: 0 auto;
    }

}

@media (max-width: 1023px) {

    .sqrnav .sqrlogo {
        height: 60px;
        width: auto;
        display: block;
        float: none;
        margin: 0 auto
    }

    .sqrnav > ul > li.sqrnavhome > a,
    .sqrnav > ul > li.sqrnavsearch > a,
    .sqrnav > ul > li.sqrnavcart > a {
        height: auto;
    }

    .sqrnav > ul {
        display: block;
        margin: 0;
        padding: 0;
        float: none;
    }

    .sqrnav > ul > li.sqrnavopen > a {
        border-bottom-color: transparent;
        margin-bottom: 0;
    }

    .sqrnav > ul > li.sqrnavmore > a {
        background: url(./../../styles/cetera/img/?f=plus&c={{$config['palette.navtext']}}) no-repeat right center;
    }

    .sqrnav > ul > li.sqrnavopen > a {
        background: url(./../../styles/cetera/img/?f=minus&c={{$config['palette.navtext']}}) no-repeat right center;
    }

    .sqrnav > ul > li {
        float: none;
    }

    .sqrnav > ul > li > div {
        position: relative;
        padding: 10px 0 15px 0;
    }

    .sqrnav > ul > li > div > div {
        box-shadow: none;
        border-left: none;
        border-right: none;
    }

    .sqrnav > ul > li > div > div > ul > li {
        width: 50%;
    }

    .sqrnav > ul > li > div > div > ul > li:nth-child(2n+1) {
        clear: both;
    }

    .sqrnav > ul > li a {
        padding: 10px 15px;
    }

    .sqrnav > ul > li > a {
        padding: 10px 30px 10px 15px;
    }

    .sqrnav > ul > li > div > div > ul > li > a {
        padding: 20px 15px 10px 15px;
    }

    .sqrnav > ul > li > div > div > ul > li > ul > li > a {
        padding: 5px 15px;
    }

    .sqrnav > a.sqrnavshow,
    .sqrnav > a.sqrnavhide {
        display: block;
        padding: 10px 35px 10px 15px;
        box-sizing: border-box;
        text-decoration: none;
        font-weight: bold;
        text-transform: uppercase;
        color: #{{$config['palette.navtext']}};
    }

    .sqrnav > a.sqrnavshow {
        background: url(./../../styles/cetera/img/?f=menu&c={{$config['palette.navtext']}}) no-repeat right center;
    }

    .sqrnav > a.sqrnavhide {
        background: url(./../../styles/cetera/img/?f=closenav&c={{$config['palette.navtext']}}) no-repeat right center;
        display: none;
        margin-bottom: 10px;
    }

    .sqrnav > ul {
        display: none;
    }

    .sqrnavopen > ul {
        display: block;
        padding-bottom: 20px;
    }

    .sqrnavopen > a.sqrnavshow {
        display: none;
    }

    .sqrnavopen > a.sqrnavhide {
        display: block;
    }

    .sqrlogo {
        max-width: 75%;
        height: auto;
    }

    .sqrnav > ul > li.sqrnavhome > a {
        background-image: none;
    }

    .sqrnav > ul > li.sqrnavhome > a > span,
    .sqrnav > ul > li.sqrnavsearch > a > span,
    .sqrnav > ul > li.sqrnavcart > a > span {
        display: inline;
    }

    .sqrnav > ul > li.sqrnavcart > a.sqrcartfull {
        background-image: none;
    }

    .sqrnav > ul > li.sqrnavsearch,
    .sqrnav > ul > li.sqrnavcart {
        float: none;
    }
}

@media (min-width: 1024px) {
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
        border-right: 1px solid #{{$config['palette.boxborder']}};
    }
    .sqrmain3collr>div:last-child {
        width: 25%;
        border-left: 1px solid #{{$config['palette.boxborder']}};
    }
    .sqrmain2coll>div {
        box-sizing: border-box;
        width: 75%;
        display: table-cell;
        vertical-align: top;
    }
    .sqrmain2coll>div:first-child {
        width: 25%;
        border-right: 1px solid #{{$config['palette.boxborder']}};
    }
    .sqrmain2colr>div {
        box-sizing: border-box;
        width: 75%;
        display: table-cell;
        vertical-align: top;
    }
    .sqrmain2colr>div:last-child {
        width: 25%;
        border-left: 1px solid #{{$config['palette.boxborder']}};
    }

    .sqrallwaysfullwidth .sqrsuppressborders {
        border-left: 0 !important;
        border-right: 0 !important;
    }

}

@media (max-width: 1023px) {
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
        border-bottom: 1px solid #{{$config['palette.boxborder']}};
    }

    #sidebarright {
        border-top: 1px solid #{{$config['palette.boxborder']}};
    }
}

.sqrcommon {
    margin: 0;
    padding: 10px 0 20px 0;
}
.sqrcommonnavhierarchical,
.sqrcommonnav,
.sqrcommon>div {
    max-width: {{$config['options.width']}}px;
    margin: 0 auto;
    padding: 20px 30px 0 30px;
    box-sizing: border-box;
}
.sqrcommon>div {
    color: #{{$config['palette.footertext']}};
}
.sqrcommonnavhierarchical a,
.sqrcommonnav a,
.sqrcommon>div a {
    text-decoration: none;
    color: #{{$config['palette.footerlinks']}};
    transition: color 0.3s;
    text-decoration: none;
    font-weight: normal;
}

.sqrcommonnavhierarchical a {
    font-size: 14px;
    -webkit-text-size-adjust:none;
}


.sqrcommonnavhierarchical a:hover,
.sqrcommonnav a:hover,
.sqrfootertext a:hover {
    color: #{{$config['palette.footerhover']}};
    text-decoration: none;
    font-weight: normal;
}
.sqrcommonnavhierarchical,
.sqrcommonnav {
    display: block;
    list-style: none;
}
.sqrcommonnavhierarchical>li,
.sqrcommonnav>li
{
    display: block;
    box-sizing: border-box;
    padding: 0 0 5px 0;
}
.sqrcommonnavhierarchical>li>em {
    font-style: normal;
    color: #{{$config['palette.footertext']}};
    display: block;
    padding-bottom: 4px;
    text-transform: uppercase;
}
.sqrcommonnavhierarchical>li>ul {
    display: block;
    margin: 0;
    padding: 15px 0 15px 0;
    list-style: none;
}
.sqrcommonnavhierarchical>li>ul>li {
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
@media (min-width: 1024px) {
    .sqrcommonnavhierarchical>li {
        float: left;
        padding-right: 20px;
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