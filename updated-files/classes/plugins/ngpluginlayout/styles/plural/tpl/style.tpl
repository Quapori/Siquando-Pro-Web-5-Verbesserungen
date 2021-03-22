.sqrmainarea {
    max-width: {{$config['options.width']}}px;
    margin: 0 auto;
}

header {
    position: relative;
    overflow: hidden;
    margin: 0;
    padding: 0;
    border-bottom: 1px solid #{{$config['palette.border']}};
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
    left: 25px;
}

#headersliderbullets::after {
    content: '';
    clear: both;
    display: block;
}

#headersliderbullets a {
    width: 20px;
    height: 20px;
    background: url(./../../styles/plural/img/?f=bullet) no-repeat left top;
    float: left;
    outline: none;
}

#headersliderbullets a.active {
    background-position: left bottom;
}

nav {
    padding: 0;
    margin: 0;
}

.sqrnavheader {
    background-color: #{{$config['palette.header.background']}};
    padding: 0 30px;
}

.sqrlogo {
    display: block;
    float: left;
}

.sqrnavheader > ul {
    margin: 0;
    padding: 0;
    display: block;
    float: right;
    list-style: none;
}

.sqrnavheader > ul:after {
    content: "";
    display: table;
    clear: both;
}

.sqrnavheader > ul > li {
    float: left;
}

.sqrnavheader > ul > li > a {
    display: block;
    width: 32px;
    height: 80px;
    background-position: center center;
    background-repeat: no-repeat;
    border-top: 3px solid transparent;
    border-bottom: 3px solid transparent;
    box-sizing: border-box;
    outline: none;
}

.sqrnavheader > ul > li > a:hover {
    border-bottom-color: #{{$config['palette.mainnav.hover']}};
}

.sqrnavheader > ul > li.sqrnavhome > a {
    background-image: url(./../../styles/plural/img/?f=home&c={{$config['palette.header.foreground']}});
}

.sqrnavheader > ul > li.sqropensearch > a {
    background-image: url(./../../styles/plural/img/?f=search&c={{$config['palette.header.foreground']}});
}

body.sqrnavmodesearch .sqrnavheader > ul > li.sqropensearch > a {
    border-bottom-color: #{{$config['palette.header.current']}};
}

form.sqrnavsearch {
    background-color: #{{$config['palette.search.background']}};
    margin: 0;
    padding: 0;
    list-style: none;
    display: none;
    box-sizing: border-box;
}

body.sqrnavmodesearch form.sqrnavsearch {
    display: block;
}

form.sqrnavsearch > input {
    border: 0;
    padding: 15px 30px 15px 54px;
    display: block;
    width: 100%;
    box-sizing: border-box;
    background: #{{$config['palette.search.background']}} url(./../../styles/plural/img/?f=searchalt&c={{$config['palette.search.foreground']}}) 30px center no-repeat;
    color: #{{$config['palette.search.foreground']}};
    outline: none;
    font: 14px 'Open Sans',Verdana,Helvetica,sans-serif;
}

.sqrnavheader > ul > li > a > span {
    display: none;
}

.sqrnavheader:after {
    content: "";
    display: table;
    clear: both;
}

.sqrnav {
    background-color: #{{$config['palette.mainnav.background']}};
    padding: 0 30px;
}

.sqrnav:after {
    content: "";
    display: table;
    clear: both;
}

.sqrnav > ul.sqrnavmain {
    margin: 0;
    padding: 0;
    list-style: none;
    float: left;
}

.sqrnav > ul.sqrnavmain:after {
    content: "";
    display: table;
    clear: both;
}

.sqrnav > ul.sqrnavmain > li {
    margin: 0;
    padding: 0 16px 0 0;
    float: left;
}

.sqrnav > ul.sqrnavmain > li > a {
    display: block;
    color: #{{$config['palette.mainnav.foreground']}};
    text-decoration: none;
    font-size: 14px;
    padding: 7px 0;
    font-weight: bold;
    text-transform: uppercase;
    border-top: 3px solid transparent;
    border-bottom: 3px solid transparent;
    outline: none;
}

.sqrnav > ul.sqrnavmain > li > a:hover {
    border-bottom-color: #{{$config['palette.mainnav.hover']}};
}

.sqrnav > ul.sqrnavmain > li.sqrnavactive > a {
    border-bottom-color: #{{$config['palette.mainnav.current']}};
}

.sqrnav > ul.sqrnavmain > li  em.ngshopcartindicator {
    display: none;
    background-color: #{{$config['palette.mainnav.foreground']}};
    color: #{{$config['palette.mainnav.background']}};
    font-style: normal;
    padding-right: 6px;
    padding-left: 6px;
    border-radius: 4px;
    margin-left: 8px;
    font-weight: normal;
}

.sqrnav > ul.sqrnavmain > li  em.ngshopcartindicatoractive {
    display: inline-block;
}


.sqrnav > ul.sqrnavmore {
    margin: 0;
    padding: 0;
    list-style: none;
    float: right;
}

.sqrnav > ul.sqrnavmore > li > a {
    display: block;
    color: #{{$config['palette.mainnav.foreground']}};
    text-decoration: none;
    font-size: 14px;
    padding: 7px 32px 7px 0;
    font-weight: bold;
    text-transform: uppercase;
    background: url(./../../styles/plural/img/?f=menu&c={{$config['palette.mainnav.foreground']}}) right center no-repeat;
    border-top: 3px solid transparent;
    border-bottom: 3px solid transparent;
    outline: none;
}

.sqrnav > ul.sqrnavmore > li > a:hover {
    border-bottom-color: #{{$config['palette.mainnav.hover']}};
}

body.sqrnavmodefull .sqrnav > ul.sqrnavmore > li > a {
    border-bottom-color: #{{$config['palette.mainnav.current']}};
    background-image: url(./../../styles/plural/img/?f=closenav&c={{$config['palette.mainnav.foreground']}});
}

ul.sqrnavfull {
    background-color: #{{$config['palette.fullnav.background']}};
    margin: 0;
    padding: 5px 15px 0 15px;
    list-style: none;
    display: none;
    box-sizing: border-box;
}

body.sqrnavmodefull ul.sqrnavfull {
    display: block;
}

ul.sqrnavfull:after {
    content: "";
    display: table;
    clear: both;
}

ul.sqrnavfull > li {
    display: block;
    float: left;
    margin: 0;
    padding: 0;
    width: 25%;
}

ul.sqrnavfull > li em.ngshopcartindicator {
    display: none;
    font-weight: normal;
    margin-left: 6px;
}

ul.sqrnavfull > li em.ngshopcartindicator::before {
    content: '(';
}

ul.sqrnavfull > li em.ngshopcartindicator::after {
    content: ')';
}


ul.sqrnavfull > li em.ngshopcartindicatoractive {
    display: inline-block;
}

ul.sqrnavfull > li:nth-child(4n+1) {
    content: "";
    display: table;
    clear: both;
}

ul.sqrnavfull > li > a {
    display: block;
    padding: 5px 15px;
    text-decoration: none;
    color: #{{$config['palette.fullnav.foreground.1']}};
    text-transform: uppercase;
    font-size: 14px;
    font-weight: bold;
    outline: none;
}

ul.sqrnavfull > li > a:hover {
    color: #{{$config['palette.fullnav.hover.1']}};
}

ul.sqrnavfull > li > ul {
    display: block;
    margin: 0;
    padding: 0 15px 0 0;
    list-style: none;
}

ul.sqrnavfull > li > ul > li {
    display: block;
    margin: 0;
    padding: 0;
}

ul.sqrnavfull > li > ul > li:last-child {
    padding-bottom: 15px;
}

ul.sqrnavfull > li > ul > li > a {
    display: block;
    padding: 5px 15px;
    text-decoration: none;
    color: #{{$config['palette.fullnav.foreground.2']}};
    font-size: 14px;
    outline: none;
}

ul.sqrnavfull > li > ul > li > a:hover {
    color: #{{$config['palette.fullnav.hover.2']}};
}

ul.sqrnavtopics,
ul.sqrnavsubtopics {
    background-color: #{{$config['palette.secnav.background']}};
    margin: 0;
    padding: 0 30px;
    list-style: none;
    display: block;
    border-bottom: 1px solid #{{$config['palette.border']}};
}

ul.sqrnavtopics:after,
ul.sqrnavsubtopics:after {
    content: "";
    display: table;
    clear: both;
}

ul.sqrnavtopics > li,
ul.sqrnavsubtopics > li {
    margin: 0;
    padding: 0 15px 0 0;
    display: block;
    float: left;
}

ul.sqrnavtopics > li > a,
ul.sqrnavsubtopics > li > a {
    color: #{{$config['palette.secnav.foreground']}};
    text-decoration: none;
    font-size: 14px;
    text-transform: uppercase;
    padding: 10px 0;
    display: block;
}

ul.sqrnavtopics > li.sqrnavactive > a,
ul.sqrnavsubtopics > li.sqrnavactive > a {
    font-weight: bold;
    color: #{{$config['palette.secnav.hover']}};
}

ul.sqrnavtopics > li > a:hover,
ul.sqrnavsubtopics > li > a:hover {
    color: #{{$config['palette.secnav.hover']}};
}

.sqrbreadcrumbs {
    background-color: #{{$config['palette.breadcrumbs.background']}};
    margin: 0;
    padding: 10px 30px;
    list-style: none;
    display: block;
    color: #{{$config['palette.breadcrumbs.text']}};
    border-bottom: 1px solid #{{$config['palette.border']}};
    font-size: 14px;
}

.sqrbreadcrumbs > a {
    color: #{{$config['palette.breadcrumbs.links']}};
    text-decoration: none;
}

.sqrbreadcrumbs > a:hover {
    color: #{{$config['palette.breadcrumbs.hover']}};
}

.sqrmaincontainer {
    width: 100%;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body {
    background-color: #{{$config['palette.background']}};
    margin: 0;
    padding: 0;
}

@media (max-width: 1023px) {
    ul.sqrnavfull > li {
        width: 50%;
    }

    ul.sqrnavfull > li:nth-child(2n+1) {
        content: "";
        display: table;
        clear: both;
    }

    ul.sqrnavmain {
        display: none;
    }
}

@media (max-width: 767px) {
    ul.sqrnavfull > li {
        float: none;
        width: 100%;
    }

    ul.sqrnavtopics {
        display: none;
    }
}

.sqrcommon {
    margin: 0;
    padding: 10px 0 20px 0;
    background-color: #{{$config['palette.common.background']}};
    color: #{{$config['palette.common.text']}};
    font-size: 14px;
    -webkit-text-size-adjust:none;
}
.sqrcommonnavhierarchical,
.sqrcommonnav,
.sqrcommon>div {
    margin: 0 auto;
    padding: 10px 30px 0 30px;
    box-sizing: border-box;
}
.sqrcommonnavhierarchical a,
.sqrcommonnav a,
.sqrcommon>div a {
    text-decoration: none;
    color: #{{$config['palette.common.links']}};
    transition: color 0.3s;
    text-decoration: none;
    font-weight: normal;
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

#maincontainer {
    background-color: #{{$config['palette.content']}};
    padding: 0.1px 0;
}

#sidebarleft,
#content,
#sidebarright {
    min-height: 1px;
    padding-top: 10px;
    padding-bottom: 20px;
}

#header {
    padding: 10px 0 20px 0;
    border-bottom: 1px solid #{{$config['palette.border']}};
}

#footer {
    padding: 10px 0 20px 0;
    border-top: 1px solid #{{$config['palette.border']}};
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
        border-bottom: 1px solid #{{$config['palette.border']}};
    }

    #sidebarright {
        border-top: 1px solid #{{$config['palette.border']}};
    }
}

#contact {
    padding: 10px 0;
    text-align: right;
    font-size: 14px;
    -webkit-text-size-adjust:none;
    color: #{{$config['palette.contact.text']}};
}

#contact a, #contact span {
    text-decoration: none;
    -webkit-text-size-adjust:none;
    text-transform: uppercase;
    display: inline-block;
    margin: 5px 3px;
}

#contact a {
    color: #{{$config['palette.contact.links']}};
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
