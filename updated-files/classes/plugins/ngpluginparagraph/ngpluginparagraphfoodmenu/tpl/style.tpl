.ngparafoodmenu {
    width: 100%;
    border-spacing: 0;
}

.ngparafoodmenu td {
    padding: 0;
    vertical-align: top;
}

.ngparafoodmenu img {
    display: block;
    width: 100%;
    height: auto;
    margin: 10px 0;
}


.ngparafoodmenuheading {
{{if $settings->headingbold}}
    font-weight: bold;
{{/if}}
{{if $settings->headingitalic}}
    font-style: italic;
{{/if}}
{{if $settings->headinguppercase}}
    text-transform: uppercase;
{{/if}}
{{if $settings->headingspaced}}
    letter-spacing: 1px;
{{/if}}
{{if $settings->headingcolor!==''}}
    color:#{{$settings->headingcolor}};
{{/if}}
{{if $settings->headingsize!==100}}
    font-size:{{$settings->headingsize}}%;
{{/if}}
    margin: 10px 0 0 0;
}

.ngparafoodmenuprice {
{{if $settings->pricebold}}
    font-weight: bold;
{{/if}}
{{if $settings->priceitalic}}
    font-style: italic;
{{/if}}
{{if $settings->priceuppercase}}
    text-transform: uppercase;
{{/if}}
{{if $settings->pricespaced}}
    letter-spacing: 1px;
{{/if}}
{{if $settings->pricecolor!==''}}
    color:#{{$settings->pricecolor}};
{{/if}}
{{if $settings->pricesize!==100}}
    font-size:{{$settings->pricesize}}%;
{{/if}}
    margin: 10px 0 0 10px;
    text-align: right;
    white-space: nowrap;
}
