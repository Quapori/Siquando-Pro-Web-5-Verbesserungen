<!-- START-NGCON-MSG [googlemaps] -->
<img src="https://maps.googleapis.com/maps/api/staticmap?center={$latitude},{$longitude}&amp;zoom={$zoom}&amp;size={$width}x{$height}&amp;maptype={$maptypestatic}&amp;markers=color:red%7C{$latitude},{$longitude}&amp;sensor=false{$scale}&amp;key={$apikey}" alt="" {if $responsive}style="width:100%;height:auto;display:block"{/if} />
<!-- END-NGCON -->