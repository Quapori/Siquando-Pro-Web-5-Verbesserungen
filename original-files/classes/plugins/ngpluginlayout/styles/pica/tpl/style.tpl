body {
    background-color: #{{$config['palette.background']}};
    margin: 0;
    padding: 0;
}

.sqroutercontainer {
    background-color: #{{$config['palette.content']}};
    min-height: 100vh;
    margin: 0;
}

@media (min-width: {{intval($config['options.width'])*1.3+40}}px) {
    .sqroutercontainer {
        max-width: {{intval($config['options.width'])*1.3}}px;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2);
        margin: 0 auto;
    }
}

.sqrtopcontainer {
    background-color: #{{$config['palette.header']}};
    max-width: {{intval($config['options.width'])*1.3}}px;
    margin: 0 auto;
}

.sqrtopcontainer > div {
    max-width: {{intval($config['options.width'])}}px;
    margin: 0 auto;
    padding: 30px;
    box-sizing: border-box;
}

.sqrpicascrolled > div {
    padding: 20px 30px 10px 30px;
}

.sqrtopcontainer > div > .sqrsearch form {
    box-sizing: border-box;
    background-color: #{{$config['palette.content']}};
    width: 100%;
    border: 1px solid #{{$config['palette.border']}};
    padding: 0;
    margin: 0;
    outline: none;
    border-radius: 0;
    -webkit-appearance: none;
    box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1);
}

.sqrtopcontainer > div > .sqrsearch form input[type=text] {
    font: 15px 'Open Sans', Tahoma, Helvetica, sans-serif;
    line-height: 20px;
    height: 32px;
    width: calc(100% - 32px);
    float: left;
    box-sizing: border-box;
    padding: 6px;
    margin: 0;
    border: 0;
    -webkit-appearance: none;
    color: #{{$config['palette.header.font.dark']}};
}

.sqrtopcontainer > div > .sqrsearch form input[type=submit] {
    border: none;
    width: 32px;
    height: 32px;
    float: right;
    box-sizing: border-box;
    padding: 6px;
    cursor: pointer;
    outline: none;
    border-radius: 0;
    margin: 0;
    -webkit-appearance: none;
    background: #{{$config['palette.header.accent']}} url(./../../styles/pica/img/?f=search&ca={{$config['palette.content']}}) no-repeat center center;
}

.sqrtopcontainer > div > .sqrsearch form input[type=submit]:hover {
    background-color: #{{$config['palette.header.font']}};
}

.sqrtopcontainer > div > .sqrsearch form:after {
    content: "";
    display: table;
    clear: both;
}

.sqrtopcontainer > div > .sqrcontact {
    text-align: right;
    font-size: 14px;
}

.sqrtopcontainer > div > .sqrcontact a {
    text-decoration: none;
    -webkit-text-size-adjust: none;
    display: inline-block;
    color: #{{$config['palette.header.font']}};
    transition: color 0.2s;
}

.sqrtopcontainer > div > .sqrcontact a:hover {
    color: #{{$config['palette.header.accent']}};
}

.sqrtopcontainer > div > .sqrcontact svg {
    width: 1.2em;
    height: 1.2em;
    display: inline-block;
    vertical-align: -0.2em;
    margin-right: 0.1em;
    margin-left: 0.1em;
    border: 0;
    padding: 0;
}

@media (min-width: 1024px) {

    .sqrtopcontainer {
        border-bottom: 1px solid #{{$config['palette.border']}};
    }

    .sqrtopcontainer > div {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    .sqrtopcontainer > div > .sqrlogo {
        display: table-cell;
        vertical-align: middle;
        box-sizing: border-box;
        width: 25%;
    }

    .sqrtopcontainer > div > .sqrsearch {
        width: 50%;
        display: table-cell;
        padding: 0 30px;
        vertical-align: middle;
    }

    .sqrtopcontainer > div > .sqrcontact {
        width: 25%;
        display: table-cell;
        vertical-align: middle;
    }

    .sqrtopcontainer > div > .sqrlogo img {
        display: block;
        border: 0;
        max-height: 34px;
        max-width: 75%;
    }
}

@media (max-width: 1023px) {

    .sqrtopcontainer > div > .sqrsearch {
        padding: 20px 0;
    }

    .sqrtopcontainer > div > .sqrlogo img {
        display: block;
        border: 0;
        max-height: 24px;
        max-width: 100%;
    }

    .sqrtopcontainer > div {
        padding-bottom: 10px;
    }

}

.sqrnav {
    display: block;
    margin: 0;
    padding: 0;
    position: relative;
}

@media (min-width: 1024px) {

    .sqroutercontainer {
        padding-top: 138px;
    }

    .sqrtopcontainer > div {
       transition: padding 0.2s ease;
    }

    .sqrfixedcontainer {
        position: fixed;
        z-index: 1000;
        width: 100%;
    }

    .sqrnav .sqrnavshow,
    .sqrnav .sqrnavhide {
        display: none;
    }

    .sqrnav > ul {
        display: block;
        list-style: none;
        margin: 0 auto;
        padding: 0 30px;
        max-width: {{intval($config['options.width'])}}px;
        box-sizing: border-box;
    }

    .sqrnav > ul:after {
        content: "";
        display: table;
        clear: both;
    }

    .sqrnav > ul > li {
        display: block;
        margin: 0;
        float: left;
        padding: 0 20px 0 0;
    }

    .sqrnav > ul > li > a {
        display: block;
        color: #{{$config['palette.header.font']}};
        text-decoration: none;
        padding: 10px 0;
        border-bottom: 3px solid transparent;
        transition: border-bottom-color 0.5s;
    }

    .sqrnav > ul > li.active > a {
        border-bottom: 3px solid #{{$config['palette.header.font']}};
    }

    .sqrnav > ul > li:hover > a {
        border-bottom: 3px solid rgba({{$config['palette.header.accent']|ngrgb}}, 0.2);
    }

    .sqrnav > ul > li.sqrnavopen > a {
        border-bottom: 3px solid #{{$config['palette.header.accent']}};
    }

    .sqrnav > ul > li.sqrnavhome > a > span {
        display: none;
    }

    .sqrnav > ul > li.sqrnavhome > a {
        background-image: url(./../../styles/pica/img/?f=home&ca={{$config['palette.header.font']}});
        background-repeat: no-repeat;
        background-position: center center;
        width: 20px;
        height: 20px;
    }

    .sqrnav > ul > li > div {
        display: block;
        position: absolute;
        width: 100%;
        left: -99999px;
        background-color: #{{$config['palette.background.nav']}};
        border-bottom: 1px solid #{{$config['palette.border']}};
        border-top: 1px solid #{{$config['palette.border']}};
        margin: 0;
        padding: 0;
        line-height: 20px;
        z-index: 1000;
        box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.2);
    }

    .sqrnav > ul > li.sqrnavopen > div {
        left: 0;
    }

    .sqrnav > ul > li > div > div {
        display: block;
        margin: 0 auto;
        max-width: {{intval($config['options.width'])}}px;
        box-sizing: border-box;
        padding: 0 30px;
    }

    .sqrnav > ul > li > div > div > ul {
        display: block;
        list-style: none;
        padding: 0;
        margin: 0;
        background-color: #{{$config['palette.background.nav']}};
        min-height: 261px;
        position: relative;
        box-sizing: border-box;
        transform: translate3d(-20px, 0, 0);
        transition: transform 0.3s ease;
    }

    .sqrnav > ul > li.sqrnavopen > div > div > ul {
        transform: translate3d(0, 0, 0);
    }

    .sqrnav > ul > li > div > div > ul > li {
        display: block;
        margin: 0;
        padding: 5px 15px;
        box-sizing: border-box;
        width: 30%;
        transition: background-color 0.2s;
    }

    .sqrnav > ul > li > div > div > ul > li > a {
        display: block;
        padding: 5px 0;
        text-decoration: none;
        color: #{{$config['palette.header.font']}};
        transition: color 0.2s;
    }

    .sqrnav > ul > li > div > div > ul > li:hover > a {
        color: #{{$config['palette.header.accent']}};
    }

    .sqrnav > ul > li > div > div > ul > li:first-child {
        padding-bottom: 15px;
        padding-top: 15px;
    }

    .sqrnav > ul > li > div > div > ul > li:first-child > a {
        color: #{{$config['palette.header.font.dark']}};
        padding-left: 0;
        border-bottom: solid 1px #{{$config['palette.border']}};
    }

    .sqrnav > ul > li > div > div > ul > li.sqrnavmore > a {
        background: url(./../../styles/pica/img/?f=more&ca={{$config['palette.header.font']}}) no-repeat right center;
    }

    .sqrnav > ul > li > div > div > ul > li.sqrnavmore:hover {
        background-color: rgba({{$config['palette.background.nav.bright']|ngrgb}}, 0.4);
    }

    .sqrnav > ul > li > div > div > ul > li.sqrnavopen,
    .sqrnav > ul > li > div > div > ul > li.sqrnavopen:hover {
        background-color: #{{$config['palette.background.nav.bright']}};
    }

    .sqrnav > ul > li > div > div > ul > li > ul {
        position: absolute;
        right: 0;
        top: -99999px;
        width: 70%;
        height: 100%;
        background-color: #{{$config['palette.background.nav.bright']}};
        display: block;
        padding: 0 15px;
        margin: 0;
        list-style: none;
        box-sizing: border-box;
    }

    .sqrnav > ul > li > div > div > ul > li.sqrnavopen > ul {
        top: 0;
    }

    .sqrnav > ul > li > div > div > ul > li > ul > li {
        display: block;
        margin: 0;
        width: 50%;
        float: left;
        padding: 5px 15px;
        box-sizing: border-box;
        transform: translate3d(-20px, 0, 0);
        transition: transform 0.2s ease;
    }

    .sqrnav > ul > li > div > div > ul > li.sqrnavopen > ul > li {
        transform: translate3d(0, 0, 0);
    }

    .sqrnav > ul > li > div > div > ul > li > ul:after {
        content: "";
        display: table;
        clear: both;
    }

    .sqrnav > ul > li > div > div > ul > li > ul > li > a {
        display: block;
        text-decoration: none;
        color: #{{$config['palette.header.font']}};
        padding: 5px 0;
        transition: color 0.3s;
    }

    .sqrnav > ul > li > div > div > ul > li > ul > li:hover > a {
        color: #{{$config['palette.header.accent']}};
    }

    .sqrnav > ul > li > div > div > ul > li > ul > li:first-child {
        width: 100%;
        padding-bottom: 15px;
        padding-top: 15px;
    }

    .sqrnav > ul > li > div > div > ul > li > ul > li:first-child > a {
        width: 100%;
        color: #{{$config['palette.header.font.dark']}};
        border-bottom: solid 1px #{{$config['palette.border']}};
    }

}

@media (max-width: 1023px) {

    .sqrnav .sqrnavshow {
        display: block;
        background: url(./../../styles/pica/img/?f=menu&ca={{$config['palette.header.font']}}) no-repeat right center;
        padding-right: 40px;

    }

    .sqrnav a {
        display: block;
        padding: 8px 30px;
        color: #{{$config['palette.header.font']}};
        text-decoration: none;
        border-bottom: solid 1px #{{$config['palette.border']}};
    }

    .sqrnav li {
        display: block;
        margin: 0;
        padding: 0;
    }

    .sqrnav .sqrnavhide {
        display: none;
        background: url(./../../styles/pica/img/?f=close&ca={{$config['palette.header.font']}}) no-repeat right center;
        padding-right: 40px;
    }

    .sqrnavopen > a.sqrnavshow {
        display: none;
    }

    .sqrnavopen > a.sqrnavhide {
        display: block;
    }

    .sqrnav li.sqrnavopen > ul {
        display: block;
    }

    .sqrnav ul {
        display: none;
        margin: 0 auto;
        padding: 0;
        list-style: none;
    }

    .sqrnav ul ul {
        display: none;
        background-color: #{{$config['palette.background.nav.bright']}};
    }

    .sqrnav ul ul ul {
        background-color: #{{$config['palette.header']}};
    }

    .sqrnav li li a {
        padding-left: 45px;
    }

    .sqrnav li li li a {
        padding-left: 60px;
    }

    .sqrnav li.sqrnavmore > a {
        background: url(./../../styles/pica/img/?f=moremobile&ca={{$config['palette.header.font']}}) no-repeat right center;
        padding-right: 40px;
    }

    .sqrnav li.sqrnavopen > a {
        background: url(./../../styles/pica/img/?f=openmobile&ca={{$config['palette.header.font']}}) no-repeat right center;
        padding-right: 40px;
    }

    .sqrnavopen > ul,
    .sqrnavopen > div > div > ul {
        display: block;
    }
}

.sqrnav li em.ngshopcartindicator {
    display: none;
    background-color: #{{$config['palette.header.accent']}};
    color: #{{$config['palette.content']}};
    font-style: normal;
    padding-right: 6px;
    padding-left: 6px;
    border-radius: 4px;
    margin-left: 8px;
    font-weight: normal;
}

.sqrnav > ul li em.ngshopcartindicatoractive {
    display: inline-block;
}

.sqreyecatcher {
    position: relative;
    overflow: hidden;
    margin: 0;
    height: 0;
    width: 100%;
    border-bottom: 1px solid #{{$config['palette.border']}};
}

.sqreyecatcher > .sqreyecatcherimagecontainer > img {
    width: 100%;
    display: block;
    border: 0;
    position: absolute;
    height: 100%;
}

.sqreyecatcher > .sqreyecatcherimagecontainer > img.headersliderpri {
    z-index: 1;
    transition: none;
    -webkit-transition: none;
    opacity: 1;
}

.sqreyecatcher > .sqreyecatcherimagecontainer > img.headerslidersec {
    z-index: 2;
    transition: none;
    opacity: 0;
{{if $config['options.fade']==='left'}}transform: translate3d(-50px,0,0);{{/if}}
{{if $config['options.fade']==='right'}}transform: translate3d(50px,0,0);{{/if}}
{{if $config['options.fade']==='top'}}transform: translate3d(0,-50px,0);{{/if}}
{{if $config['options.fade']==='bottom'}}transform: translate3d(0,50px,0);{{/if}}
{{if $config['options.fade']==='zoomin'}}transform: scale3d(1.1,1.1,0);{{/if}}
{{if $config['options.fade']==='zoomout'}}transform: scale3d(0.9,0.9,0);{{/if}}
{{if $config['options.fade']==='fliphorizontal'}}transform: perspective(1000px) translate3d(0,0,0px) rotateX(-25deg);{{/if}}
{{if $config['options.fade']==='flipvertical'}}transform: perspective(1000px) translate3d(0,0,0px) rotateY(-25deg);{{/if}}
}

.sqreyecatcher > .sqreyecatcherimagecontainer > img.headerslidersecout {
	transition: opacity 0.3s linear, transform 0.3s ease;
	opacity: 1;
{{if $config['options.fade']==='left'}}transform: translate3d(0,0,0);{{/if}}
{{if $config['options.fade']==='right'}}transform: translate3d(0,0,0);{{/if}}
{{if $config['options.fade']==='top'}}transform: translate3d(0,0,0);{{/if}}
{{if $config['options.fade']==='bottom'}}transform: translate3d(0,0,0);{{/if}}
{{if $config['options.fade']==='zoomin'}}transform: scale3d(1,1,1);{{/if}}
{{if $config['options.fade']==='zoomout'}}transform: scale3d(1,1,1);{{/if}}
{{if $config['options.fade']==='fliphorizontal'}}transform: perspective(1000px) translate3d(0,0,1px) rotateX(0);{{/if}}
{{if $config['options.fade']==='flipvertical'}}transform: perspective(1000px) translate3d(0,0,1px) rotateY(0);{{/if}}
}

.sqreyecatcher > .sqreyecatcherbulletcontainer {
    z-index: 3;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 40px;
    line-height: 40px;
    text-align: center;
}

.sqreyecatcher > .sqreyecatcherbulletcontainer > a {
    width: 40px;
    height: 40px;
    display: inline-block;
    color: #{{$config['palette.bullet']}};
    transition: color 1s;
}

.sqreyecatcher > .sqreyecatcherbulletcontainer > a.active {
    color: #{{$config['palette.bullet.active']}};
}

#sidebarleft,
#content,
#sidebarright {
    min-height: 1px;
}

#header {
    padding: 30px 0 0 0;
}

#footer {
    padding: 0 0 30px 0;
}

#main {
    padding: 30px 0;
}

@media (min-width: 1024px) {
    .sqrallwaysboxed,
    .sqrmobilefullwidth,
    .sqrdesktopboxed {
        box-sizing: border-box;
        padding-left: 30px;
        padding-right: 30px;
        max-width: {{intval($config['options.width'])}}px;
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

    .sqrmain2col > div {
        box-sizing: border-box;
        width: 48%;
        float: left;
        margin-right: 4%;
    }

    .sqrmain2col > div:last-child {
        margin-right: 0;
    }

    .sqrmain3col > div {
        box-sizing: border-box;
        width: 30.6666666666%;
        float: left;
        margin-right: 4%;
    }

    .sqrmain3col > div:last-child {
        margin-right: 0;
    }

    .sqrmain3collr > div {
        box-sizing: border-box;
        width: 50%;
        float: left;
    }

    .sqrmain3collr > div:first-child {
        width: 21%;
        margin-right: 4%;
    }

    .sqrmain3collr > div:last-child {
        width: 21%;
        margin-left: 4%;
    }

    .sqrmain2coll > div {
        box-sizing: border-box;
        width: 75%;
        float: left;
    }

    .sqrmain2coll > div:first-child {
        width: 21%;
        margin-right: 4%;
    }

    .sqrmain2colr > div {
        box-sizing: border-box;
        width: 75%;
        float: left;
    }

    .sqrmain2colr > div:last-child {
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

    .sqrdesktophidden {
        display: none;
    }

}

@media (max-width: 1023px) {
    .sqrallwaysboxed,
    .sqrmobileboxed {
        box-sizing: border-box;
        padding-left: 30px;
        padding-right: 30px;
    }

    .sqrallwaysboxed > .sqrallwaysboxed,
    .sqrallwaysboxed > .nguiparagraphcontainer > .sqrallwaysboxed {
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
    .sqrmobilefullwidth .sqrsuppressborders {
        border-left: 0 !important;
        border-right: 0 !important;
    }
}

.sqrcommon {
    max-width: {{intval($config['options.width'])}}px;
    padding: 30px;
    margin: 0 auto;
    box-sizing: border-box;
    font-size: 14px;
    font-size-adjust: none;
}

ul.sqrcommonnavhierarchical {
    display: block;
    list-style: none;
    margin: 0;
    padding: 0 0 15px 0;
}

ul.sqrcommonnavhierarchical > li {
    display: block;
    margin: 0;
    padding: 0 15px 15px 0;
    box-sizing: border-box;
}

ul.sqrcommonnavhierarchical:after {
    content: "";
    display: table;
    clear: both;
}

@media (min-width: 768px) {
    ul.sqrcommonnavhierarchical > li {
        float: left;
    }
}

@media (min-width: 768px) and (max-width: 1023px) {
    ul.sqrcommonnavhierarchical > li {
        width: 50%;
    }

    ul.sqrcommonnavhierarchical > li:nth-child(2n+1) {
        clear: both;
    }
}

@media (min-width: 1024px) {
    ul.sqrcommonnavhierarchical > li {
        float: left;
    }

    ul.sqrcommonnavhierarchical2col > li {
        width: 50%;
    }

    ul.sqrcommonnavhierarchical3col > li {
        width: 33.33%;
    }

    ul.sqrcommonnavhierarchical4col > li {
        width: 25%;
    }

    ul.sqrcommonnavhierarchical5col > li {
        width: 20%;
    }
}

ul.sqrcommonnavhierarchical em {
    display: block;
    font-style: normal;
    text-transform: uppercase;
    color: #{{$config['palette.common.dark']}};
    padding-bottom: 8px;
}

ul.sqrcommonnavhierarchical > li > ul {
    display: block;
    margin: 0;
    padding: 0;
    list-style: none;
}

ul.sqrcommonnavhierarchical > li > ul > li {
    display: block;
    margin: 0;
    padding: 0;
}

ul.sqrcommonnavhierarchical > li > ul > li > a {
    display: block;
    text-decoration: none;
    color: #{{$config['palette.common']}};
    padding: 2px 0;
    transition: color 0.2s;
}

ul.sqrcommonnavhierarchical > li > ul > li > a:hover {
    color: #{{$config['palette.header.accent']}};
}

ul.sqrcommonnav {
    display: block;
    list-style: none;
    text-align: center;
    margin: 0;
    padding: 0 0 30px 0;
}

ul.sqrcommonnav > li {
    display: inline-block;
    list-style: none;
    text-align: center;
}

ul.sqrcommonnav > li > a {
    display: block;
    text-decoration: none;
    color: #{{$config['palette.common']}};
    padding: 0 5px;
    transition: color 0.2s;
}

ul.sqrcommonnav > li > a:hover {
    color: #{{$config['palette.header.accent']}};
}

.sqrcommonfooter {
    text-align: center;
}

.sqrbreadcrumbs {
    padding: 0;
    margin: 0;
    font-size: 13px;
    font-size-adjust: none;
    color: #{{$config['palette.breadcrumbs']}};
}

.sqrbreadcrumbs > a {
    color: #{{$config['palette.header.accent']}};
    text-decoration: none;
    font-weight: normal;
}

.sqrbreadcrumbs > a:hover {
    color: #{{$config['palette.header.accent']}};
    text-decoration: underline;
    font-weight: normal;
}