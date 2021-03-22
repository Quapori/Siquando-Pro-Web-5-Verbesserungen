#ngparachat{$uid}>ul.ngparachatoutput {
    height: {$height}px;
}

#ngparachat{$uid}>ul.ngparachatoutput>li {
    color: #{$foregroundothers};
    background-color: #{$backgroundothers};
}

#ngparachat{$uid}>ul.ngparachatoutput>li.ngparachatmy {
    color: #{$foregroundmy};
    background-color: #{$backgroundmy};
}

#ngparachat{$uid}>ul.ngparachatoutput>li:after {
    content: ' ';
    display: block;
    font-size: 1px;
    width: 20px;
    height: 20px;
    background: url({$fileothers}) no-repeat 0 0;
    position: absolute;
    right: -10px;
    bottom: 0;
}

#ngparachat{$uid}>ul.ngparachatoutput>li.ngparachatmy:after {
    content: ' ';
    display: block;
    font-size: 1px;
    width: 20px;
    height: 20px;
    background: url({$filemy}) no-repeat 0 0;
    position: absolute;
    left: -10px;
    bottom: 0;
}