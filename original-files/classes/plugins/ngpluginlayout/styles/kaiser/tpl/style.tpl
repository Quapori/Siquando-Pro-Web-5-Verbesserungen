.sqrcontent {
    margin: 0;
    padding: 10px 0;
}

body {
    background-color: #{{$config['palette.background']}};
    margin: 0;
    padding: 0;
}

#contact {
    text-align: right;
    max-width: {{$config['options.width']}}px;
    margin: 0 auto;
    padding: 5px 8px;
    box-sizing: border-box;
    font-size: 14px;
    -webkit-text-size-adjust:none;
}

#contact a, #contact span {
    color: #{{$config['palette.contact']}};
    text-decoration: none;
    -webkit-text-size-adjust:none;
    margin-right: 6px;
    text-transform: uppercase;
    display: inline-block;
    margin: 5px 2px;
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

#maincontainer {
    padding: 40px 0;
}
#sidebarleft, #content, #sidebarright {
    min-height: 1px;
}
#header {
    padding: 20px 0 0 0;
}
#footer {
    padding: 0 0 20px 0;
}
#main {
    padding: 20px 0;
}

.sqrbreadcrumbs>a {
    font-weight: normal;
    text-decoration: none;
}

.sqrbreadcrumbs>a:hover {
    font-weight: normal;
    text-decoration: none;
}

.sqrbreadcrumbs {
    font-size: 90%;
}

footer {
    margin: 0;
    padding: 30px 0 0 0;
}

.sqrlogo {
    display: block;
    margin: 20px auto 0 auto;
}

.sqrnav {
    z-index: 1000;
    padding-top: 20px;
    font-size: 14px;
}

.sqrnav > ul {
    display: block;
    margin: 0;
    padding: 0;
    max-width: {{$config['options.width']}}px;
    margin: 0 auto;
}

.sqrnav > ul:after {
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

.sqrnav > ul > li em.ngshopcartindicator {
    display: none;
    background-color: #{{$config['palette.nav.hover']}};
    color: #ffffff;
    font-style: normal;
    padding-right: 8px;
    padding-left: 8px;
    border-radius: 8px;
    margin-left: 8px;
    font-weight: normal;
}

.sqrnav > ul > li em.ngshopcartindicatoractive {
    display: inline-block;
}

.sqrnav > ul > li.sqrnavopen {
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
}

.sqrnav > ul > li.sqrnavopen > a {
    background-color: #{{$config['palette.nav.background']}};
    margin-bottom: -1px;
}

.sqrnav > ul > li.sqrnavopen > div {
    display: block;
}

.sqrnav > ul > li a {
    display: block;
    padding: 10px 20px;
    box-sizing: border-box;
    text-decoration: none;
    color: #{{$config['palette.nav.text']}};
    transition: color 0.2s;
    line-height: 19px;
}

.sqrnav > ul > li.sqrnavhome > a,
.sqrnav > ul > li.sqrnavsearch > a,
.sqrnav > ul > li.sqrnavcart > a {
    background-repeat: no-repeat;
    background-position: center center;
    height: 39px;
}

.sqrnav > ul > li.sqrnavhome > a {
    background-image: url(./../../styles/kaiser/img/?f=home&c={{$config['palette.nav.text']}});
}

.sqrnav > ul > li.sqrnavsearch > a {
    background-image: url(./../../styles/kaiser/img/?f=search&c={{$config['palette.nav.text']}});
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
    color: #{{$config['palette.nav.text']}};
    background-color: #{{$config['palette.nav.background']}};
}

.sqrnav > ul > li a:hover {
    color: #{{$config['palette.nav.hover']}};
}

.sqrnav > ul > li > a {
    position: relative;
    z-index: 1002;
    text-transform: uppercase;
    font-weight: bold;
    letter-spacing: 1px;
}

.sqrnav > ul > li > div {
    display: none;
    position: absolute;
    left: 0;
    right: 0;
    background-color: #{{$config['palette.nav.background']}};
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
    z-index: 1001;
    padding: 10px 0;
}

.sqrnav > ul > li > div > div {
    max-width: {{$config['options.width']}}px;
    margin: 0 auto;
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
    color: #{{$config['palette.nav.text']}};
    font-weight: bold;
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

.sqreyectacher {
    display: block;
    width: 100%;
    height: auto;
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
    padding-top: 10px;
}

#headersliderbullets > div {
    margin: 0 auto;
}

#headersliderbullets::after {
    content: '';
    clear: both;
    display: block;
}

#headersliderbullets a {
    width: 20px;
    height: 20px;
    background: url(./../../styles/kaiser/img/?f=bullet&c={{$config['palette.bullets']}}) no-repeat left top;
    float: left;
}

#headersliderbullets a.active {
    background-position: left bottom;
}

@media (max-width: 767px) {

    .sqrnav > ul > li.sqrnavmore > a {
        background: url(./../../styles/kaiser/img/?f=plus&c={{$config['palette.nav.text']}}) no-repeat right center;
    }

    .sqrnav > ul > li.sqrnavopen > a {
        background: url(./../../styles/kaiser/img/?f=minus&c={{$config['palette.nav.text']}}) no-repeat right center;
        background-color: #{{$config['palette.nav.background']}};
    }

    .sqrnav > ul > li {
        float: none;
    }

    .sqrnav > ul > li > div {
        position: relative;
        box-shadow: none;
        padding: 10px 0 15px 0;
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
        text-transform: uppercase;
        color: #{{$config['palette.nav.text']}};
    }

    .sqrnav > a.sqrnavshow {
        background: url(./../../styles/kaiser/img/?f=menu&c={{$config['palette.nav.text']}}) no-repeat right center;
    }

    .sqrnav > a.sqrnavhide {
        background: url(./../../styles/kaiser/img/?f=closenav&c={{$config['palette.nav.text']}}) no-repeat right center;
        display: none;
        margin-bottom: 10px;
    }

    .sqrnav > ul > li.sqrnavcart > a.sqrcartfull {
        background-image: none;
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

    .sqrnav > ul > li.sqrnavsearch,
    .sqrnav > ul > li.sqrnavcart {
        float: none;
    }
}


@media (min-width: 1024px) {
    .sqrallwaysboxed,
    .sqrmobilefullwidth,
    .sqrdesktopboxed {
        box-sizing: border-box;
        padding-left: 20px;
        padding-right: 20px;
        max-width: {{$config['options.width']}}px;
        margin-left: auto;
        margin-right: auto;
    }
    .sqrallwaysboxed .sqrallwaysboxed,
    .sqrdesktopboxed .sqrdesktopboxed,
    .sqrmobilefullwidth .sqrallwaysboxed,
    .sqrdesktopboxed .sqrallwaysboxed,
    .sqrdesktopboxed .sqrmobilefullwidth,
    .sqrdesktopremovebox .sqrallwaysboxed,
    .sqrdesktopremovebox .sqrmobilefullwidth {
        padding-left: 0;
        padding-right: 0;
        margin-left: 0;
        margin-right: 0;
    }
    .sqrmain2col>div {
        box-sizing: border-box;
        width: 48%;
        float: left;
        margin-right: 4%;
    }
    .sqrmain2col>div:last-child {
        margin-right: 0;
    }
    .sqrmain3col>div {
        box-sizing: border-box;
        width: 30.6666666666%;
        float: left;
        margin-right: 4%;
    }
    .sqrmain3col>div:last-child {
        margin-right: 0;
    }
    .sqrmain3collr>div {
        box-sizing: border-box;
        width: 50%;
        float: left;
    }
    .sqrmain3collr>div:first-child {
        width: 21%;
        margin-right: 4%;
    }
    .sqrmain3collr>div:last-child {
        width: 21%;
        margin-left: 4%;
    }
    .sqrmain2coll>div {
        box-sizing: border-box;
        width: 75%;
        float: left;
    }
    .sqrmain2coll>div:first-child {
        width: 21%;
        margin-right: 4%;
    }
    .sqrmain2colr>div {
        box-sizing: border-box;
        width: 75%;
        float: left;
    }
    .sqrmain2colr>div:last-child {
        width: 21%;
        margin-left: 4%;
    }
    .sqrmain3col:after,
    .sqrmain2col:after,
    .sqrmain3collr:after,
    .sqrmain2coll:after,
    .sqrmain2colr:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
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
        padding-left: 20px;
        padding-right: 20px;
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
        padding-left: 20px !important;
        padding-right: 20px !important;
    }
    .sqrmobilehidden {
        display: none;
    }

    .sqrallwaysfullwidth .sqrsuppressborders {
        border-left: 0 !important;
        border-right: 0 !important;
    }
}

.sqrcommon {
    margin: 0;
    padding: 0 0 30px 0;
}
.sqrcommonnavhierarchical,
.sqrcommonnav,
.sqrcommon>div {
    max-width: {{$config['options.width']}}px;
    margin: 0 auto;
    padding: 20px 20px 0 20px;
    box-sizing: border-box;
}
.sqrcommon>div {
    color: #{{$config['palette.common']}};
    text-align: center;
}
.sqrcommonnavhierarchical a,
.sqrcommonnav a,
.sqrcommon>div a {
    text-decoration: none;
    color: #{{$config['palette.common']}};
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
    color: #{{$config['palette.common.hover']}};
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
    color: #{{$config['palette.common']}};
    display: block;
    padding-bottom: 4px;
    text-transform: uppercase;
    font-weight: bold;
    letter-spacing: 1px;
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
@media (min-width: 768px) {
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