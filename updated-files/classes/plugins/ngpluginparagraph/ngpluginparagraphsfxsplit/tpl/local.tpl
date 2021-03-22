#ngparasfxsplit{$uid} > li > div > div > a { border: 1px solid #{$foregroundcolor}; color: #{$foregroundcolor}; }
#ngparasfxsplit{$uid} > li > div > div > a:hover { color: #{$backgroundcolor}; background-color: #{$foregroundcolor}; }
@media (min-width: 1024px) {
#ngparasfxsplit{$uid} > li > div > p.ngparasfxsplitcaption { font-size: {floor($fontsize*1.5)}%; }
#ngparasfxsplit{$uid} > li > div > p, #ngparasfxsplit{$uid} > li > div > div > a { font-size: {$fontsize}%; }
}