<!-- START-NGCON-MSG [googlemaps] -->
<script>
/* <![CDATA[ */
  google.maps.event.addDomListener(window, 'load', function() {
		var pos = new google.maps.LatLng({$latitude}, {$longitude});
	    var mapOptions = {
	          zoom: {$zoom},
			  center: pos,
	          mapTypeId: google.maps.MapTypeId.{$maptype}{if !$showcontrols},		  
				disableDefaultUI:true{/if}		  
	    };	
		var map = new google.maps.Map(document.getElementById('gmapcanvas{$id}'), mapOptions);	
		{if $nopopup}
		var mrk = new google.maps.Marker({
		  map:map,
		  draggable:false,
		  position: pos
		});
		{/if}
		{if $popup}
		var iw = new google.maps.InfoWindow({
		  map:map,
		  content: '{$popup|escape:"javascript"}',
		  draggable:false,
		  position: pos
		});
		{/if}		
  });
/* ]]> */
</script>
{if $responsive}
<div style="width:100%;position:relative;height:0;padding-bottom:{$heightpercent}%">
<div id="gmapcanvas{$id}" style="position:absolute;top:0;left:0;width:100%;height:100%"></div>
</div>
{else}
<div id="gmapcanvas{$id}" style="width:{$width}px;height:{$height}px;"></div>
{/if}
<!-- END-NGCON -->