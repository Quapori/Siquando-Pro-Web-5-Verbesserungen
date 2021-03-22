.sqrcontent {
    margin: 0;
    padding: 10px 0;
    background-color: #{{$config['palette.background']}};
}

html {
    background-color: #{{$config['palette.background']}};
    margin: 0;
    padding: 0;
}

#maincontainer {
    background-color: #{{$config['palette.background']}};
    padding: 0 30px;
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


footer {
    margin: 0;
    padding: 30px 0 15px 0;
}

.sqrcommonlinks,
.sqrfootertext {
    padding: 0 30px 15px 30px;
    box-sizing: border-box;
    font-size: 14px;
}

.sqrfootertext {
    color: #333333;
}

.sqrcommonlinks a {
    text-decoration: none;
    color: #333333;
    padding: 0 15px 15px 0;
    transition: color 0.3s;
    text-transform: uppercase;
}

.sqrcommonlinks a:hover {
    color: #ccad18;
}

.sqrnav {
    display: block;
    margin: 0;
    padding: 0;
    z-index: 1000;
    -webkit-user-select: none;
    user-select: none;
    line-height: 21px;
    width: 100%;
    box-sizing: border-box;
    background-color: #{{$config['palette.background']}};
}

.sqrnav a {
    display: block;
    margin: 0;
    color: #{{$config['palette.nav.foreground']}};
    text-decoration: none;
    -webkit-tap-highlight-color: transparent;
}

.sqrnav > ul li {
    display: block;
    margin: 0;
    padding: 0;
    position: relative;
}

.sqrnav > ul > li em.ngshopcartindicator {
    display: none;
}

.sqrnav > ul > li em.ngshopcartindicatoractive {
    display: inline-block;
    margin-left: 5px;
}

.sqrnav > ul > li em.ngshopcartindicatoractive::before {
    content: '(';
}

.sqrnav > ul > li em.ngshopcartindicatoractive::after {
    content: ')';
}


.sqrnav .sqrnavsearch form {
    box-sizing: border-box;
    display: block;
    margin: 0;
    padding: 15px 30px;
    width: 100%;
}

.sqrnav .sqrnavsearch input {
    box-sizing: border-box;
    display: block;
    width: 100%;
    border: 0;
    padding: 8px 12px 8px 33px;
    margin: 0;
    color: #{{$config['palette.nav.foreground']}};
    font: 15px 'Open Sans',Tahoma,Helvetica,sans-serif;
    outline: none;
    border: none;
    -webkit-appearance: none;
    border-radius: 0;
    background: #{{$config['palette.nav.background']}} url(./../../styles/leonidas/img/?f=search&c={{$config['palette.nav.foreground']}}) 8px 50% no-repeat;
}

@media (max-width: 767px) {
    .sqrlogo {
        max-width: 75%;
        height: auto;
        display: block;
        margin: 0 auto;
    }

    .sqrnav a {
        font-size: 14px;
        padding: 10px 30px;
    }

    .sqrnav > ul > li > a,
    .sqrnav > a {
        text-transform: uppercase;
    }

    .sqrnav a.sqrnavshow {
        background: url(./../../styles/leonidas/img/?f=menu&c={{$config['palette.nav.foreground']}}) right center no-repeat;
    }

    .sqrnav a.sqrnavhide {
        background: url(./../../styles/leonidas/img/?f=closenav&c={{$config['palette.nav.foreground']}}) right center no-repeat;
    }

    .sqrnav li.sqrnavmore > a {
        background: url(./../../styles/leonidas/img/?f=plus&c={{$config['palette.nav.foreground']}}) right center no-repeat;
    }

    .sqrnav li.sqrnavopen > a {
        background-image: url(./../../styles/leonidas/img/?f=minus&c={{$config['palette.nav.foreground']}});
    }

    .sqrnav .sqrnavshow {
        display: block;
    }

    .sqrnav .sqrnavhide {
        display: none;
    }

    .sqrnavopen > a.sqrnavshow {
        display: none;
    }

    .sqrnavopen > a.sqrnavhide {
        display: block;
    }

    .sqrnav li.sqrnavopen > div {
        display: block;
    }

    .sqrnav ul {
        display: block;
        margin: 0 auto;
        padding: 0;
        list-style: none;
    }

    .sqrnav > ul {
        display: none;
        padding-bottom: 30px;
    }

    .sqrnav > ul > li > div {
        display: none;
        background-color: #{{$config['palette.nav.background']}};
    }

    .sqrnav > ul > li > div > ul {
        margin: 0 auto;
        list-style: none;
        padding: 15px 30px;
    }

    .sqrnav > ul > li > div > ul > li {
        display: block;
        width: 50%;
        float: left;
        margin: 0;
        padding: 0 15px 0 0;
        box-sizing: border-box;
    }

    .sqrnav > ul > li > div > ul:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }

    .sqrnav > ul > li > div > ul > li:nth-child(2n+1) {
        clear: both;
    }

    .sqrnav > ul > li > div > ul > li > a {
        padding: 10px 0;
        text-transform: uppercase;
    }

    .sqrnav > ul > li > div > ul > li > ul {
        display: block;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .sqrnav > ul > li > div > ul > li > ul > li {
        display: block;
        margin: 0;
        padding: 0;
    }

    .sqrnav > ul > li > div > ul > li > ul > li > a {
        font-size: 14px;
        padding: 10px 0;
    }

    .sqrnavopen > ul {
        display: block;
    }
}

@media (min-width: 768px) {

    .sqrtopspacer {
        height: 100px;
    }

    .sqrnav {
        padding: 0 30px;
        position: fixed;
        top: 0;
        left: 0;
    }

    .sqrnav .sqrlogo {
        height: 40px;
        width: auto;
        display: block;
        float: left;
        margin-top: 29px;
        transition: margin-top 0.2s;
    }

    .sqrfixedmenu .sqrnav .sqrlogo {
        margin-top: 6px;
    }

    .sqrnav > .sqrnavshow,
    .sqrnav > .sqrnavhide {
        display: none;
    }

    .sqrnav > ul {
        box-sizing: border-box;
        display: block;
        margin: 0 auto;
        padding: 0;
        list-style: none;
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
        float: left;
        padding: 0 12px;
    }

    .sqrnav > ul > li > a {
        text-transform: uppercase;
        font-size: 14px;
        line-height: 92px;
        height: 92px;
        transition: line-height 0.2s, height 0.2s, border-bottom-color 0.5s;
        border-bottom: 4px solid transparent;
        border-top: 4px solid transparent;
    }

    .sqrfixedmenu .sqrnav > ul > li > a {
        line-height: 46px;
        height: 46px;
    }

    .sqrnav > ul > li > div {
        position: fixed;
        display: block;
        left: -9999px;
        z-index: 1000;
        width: 100%;
        box-sizing: border-box;
        background-color: #{{$config['palette.nav.background']}};
        opacity: 0;
        transition: opacity 0.2s;
    }

    .sqrnav > ul > li > div > ul {
        margin: 0 auto;
        list-style: none;
        max-width: {{$config['options.width']}}px;
        transform: translate3d(0, -30px, 0);
        transition: transform 0.2s;
        padding: 0 30px 15px 30px;
        box-sizing: border-box;
    }

    .sqrnav > ul > li > div > ul:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }


    .sqrnav > ul > li > div > ul > li {
        display: block;
        width: 25%;
        float: left;
        margin: 0;
        padding: 15px 15px 0 0;
        box-sizing: border-box;
    }

    .sqrnav > ul > li > div > ul > li:nth-child(4n+1) {
        clear: both;
    }

    .sqrnav > ul > li > div > ul > li > a {
        padding: 12px 0;
        text-transform: uppercase;
        font-size: 16px;
    }

    .sqrnav > ul > li > div > ul > li > ul {
        display: block;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .sqrnav > ul > li > div > ul > li > ul > li {
        display: block;
        margin: 0;
        padding: 0;
    }

    .sqrnav > ul > li > div > ul > li > ul > li > a {
        font-size: 14px;
        padding: 6px 0;
    }

    .sqrnav > ul > li > div > ul > li > a:hover,
    .sqrnav > ul > li > div > ul > li > ul > li > a:hover {
        color: #{{$config['palette.nav.hover']}};
    }

    .sqrnav > ul > li > a:hover,
    .sqrnav > ul > li.sqrnavopen > a {
        border-bottom-color: #{{$config['palette.nav.lines']}};
    }

    .sqrnav > ul > li.sqrnavopen > div {
        left: 0;
        opacity: 1;
    }

    .sqrnav > ul > li.sqrnavopen > div > ul {
        transform: translate3d(0, 0, 0);
    }

    .sqrnav > ul > li.sqrnavhome > a > span,
    .sqrnav > ul > li.sqrnavsearch > a > span {
        display: none;
    }

    .sqrnav > ul > li.sqrnavhome > a {
        background: transparent url(./../../styles/leonidas/img/?f=home&c={{$config['palette.nav.foreground']}}) no-repeat center center;
        width: 16px;
    }

    .sqrnav > ul > li.sqrnavsearch > a {
        background: transparent url(./../../styles/leonidas/img/?f=search&c={{$config['palette.nav.foreground']}}) no-repeat center center;
        width: 16px;
    }


    .sqrnav > ul > li.sqrnavopen.sqrnavsearch > ul {
        left: auto;
        right: 0;
        opacity: 1;
    }

    .sqrnav a {
        transition: background-color 0.2s;
    }

    .sqrnav > div {
        display: none;
    }
}

#sqrheader {
    position: relative;
    overflow: hidden;
    padding: 0 0;
    background-color: #{{$config['palette.background']}};
    margin: 0 30px 30px 30px;
}

#sqrheader #headercontainer img, #sqrheader #headercontainer video {
    width: 100%;
    display: block;
    border: 0;
    position: absolute;
    height: 100%;
}

#sqrheader #headercontainer img.headersliderpri {
    z-index: 1;
    transition: none;
    -webkit-transition: none;
    opacity: 1;
}

#sqrheader #headercontainer img.headerslidersec {
    z-index: 2;
    transition: none;
    opacity: 0;
}

#sqrheader #headercontainer img.headerslidersecout {
    transition: opacity 0.5s;
    opacity: 1;
}

#headercontainer {
    position: absolute;
}

#headersliderbullets {
    box-sizing: border-box;
    padding: 20px;
    position: absolute;
    bottom: 0;
    right: 0;
    z-index: 3;
}

#headersliderbullets:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}

#headersliderbullets a {
    width: 24px;
    height: 24px;
    background: url(./../../styles/leonidas/img/?f=bullet) no-repeat left top;
    float: left;
}

#headersliderbullets a.active {
    background-position: left bottom;
}

@media (min-width: 1024px) {
    .sqrallwaysboxed,
    .sqrmobilefullwidth,
    .sqrdesktopboxed {
        box-sizing: border-box;
        max-width: {{$config['options.width']-60}}px;
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

.sqrcommon {
    margin: 0;
    padding: 10px 0 30px 0;
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
    color: #{{$config['palette.common.text']}};
}
.sqrcommonnavhierarchical a,
.sqrcommonnav a,
.sqrcommon>div a {
    text-decoration: none;
    color: #{{$config['palette.common.text']}};
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
    color: #{{$config['palette.common.captions']}};
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