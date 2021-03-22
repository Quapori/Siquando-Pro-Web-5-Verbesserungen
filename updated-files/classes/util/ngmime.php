<?php

class NGMime {
	
	public static function getMimeType($filename) {
		$extension = strtolower(pathinfo ( $filename, PATHINFO_EXTENSION ));
		
		$mimetypes = self::getTypes();
						
		if (array_key_exists ( $extension, $mimetypes )) {
			return $mimetypes [$extension];
		} else {
			return 'application/octet-stream';
		}
	} 

	/**
	 * 
	 * Get all types
	 */
	public static function getTypes()
	{
		return array(
			'3g2'=>'video/3gpp2',
			'3gp'=>'video/3gpp',
			'7z'=>'application/x-7z-compressed',
			'aac'=>'audio/x-aac',
			'acc'=>'application/vnd.americandynamics.acc',
			'ai'=>'application/postscript',
			'aif'=>'audio/x-aiff',
			'aifc'=>'audio/x-aiff',
			'aiff'=>'audio/x-aiff',
			'air'=>'application/vnd.adobe.air-application-installer-package+zip',
			'ait'=>'application/vnd.dvb.ait',
			'apk'=>'application/vnd.android.package-archive',
			'appcache'=>'text/cache-manifest',
			'application'=>'application/x-ms-application',
			'asc'=>'application/pgp-signature',
			'asf'=>'video/x-ms-asf',
			'asm'=>'text/x-asm',
			'asx'=>'video/x-ms-asf',
			'atom'=>'application/atom+xml',
			'atomcat'=>'application/atomcat+xml',
			'atomsvc'=>'application/atomsvc+xml',
			'atx'=>'application/vnd.antix.game-component',
			'au'=>'audio/basic',
			'avi'=>'video/x-msvideo',
			'azw'=>'application/vnd.amazon.ebook',
			'bat'=>'application/x-msdownload',
			'bmp'=>'image/bmp',
			'book'=>'application/vnd.framemaker',
			'c'=>'text/x-c',
			'cab'=>'application/vnd.ms-cab-compressed',
			'caf'=>'audio/x-caf',
			'cc'=>'text/x-c',
			'cgm'=>'image/cgm',
			'chm'=>'application/vnd.ms-htmlhelp',
			'chrt'=>'application/vnd.kde.kchart',
			'class'=>'application/java-vm',
			'cmx'=>'image/x-cmx',
			'conf'=>'text/plain',
			'cpp'=>'text/x-c',
			'crt'=>'application/x-x509-ca-cert',
			'csml'=>'chemical/x-csml',
			'css'=>'text/css',
			'csv'=>'text/csv',
			'cu'=>'application/cu-seeme',
			'curl'=>'text/vnd.curl',
			'der'=>'application/x-x509-ca-cert',
			'dll'=>'application/x-msdownload',
			'dmg'=>'application/x-apple-diskimage',
			'doc'=>'application/msword',
			'docm'=>'application/vnd.ms-word.document.macroenabled.12',
			'docx'=>'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'dot'=>'application/msword',
			'dotm'=>'application/vnd.ms-word.template.macroenabled.12',
			'dotx'=>'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
			'dtb'=>'application/x-dtbook+xml',
			'dtd'=>'application/xml-dtd',
			'dts'=>'audio/vnd.dts',
			'dtshd'=>'audio/vnd.dts.hd',
			'dvb'=>'video/vnd.dvb.file',
			'dvi'=>'application/x-dvi',
			'dwf'=>'model/vnd.dwf',
			'dwg'=>'image/vnd.dwg',
			'dxf'=>'image/vnd.dxf',
			'ecma'=>'application/ecmascript',
			'efif'=>'application/vnd.picsel',
			'emf'=>'application/x-msmetafile',
			'eml'=>'message/rfc822',
			'eps'=>'application/postscript',
			'epub'=>'application/epub+zip',
			'f4v'=>'video/x-f4v',
			'fh'=>'image/x-freehand',
			'fh4'=>'image/x-freehand',
			'fh5'=>'image/x-freehand',
			'fh7'=>'image/x-freehand',
			'fhc'=>'image/x-freehand',
			'flac'=>'audio/x-flac',
			'fli'=>'video/x-fli',
			'flv'=>'video/x-flv',
			'gif'=>'image/gif',
			'h'=>'text/x-c',
			'h261'=>'video/h261',
			'h263'=>'video/h263',
			'h264'=>'video/h264',
			'hh'=>'text/x-c',
			'hlp'=>'application/winhlp',
			'hqx'=>'application/mac-binhex40',
			'htm'=>'text/html',
			'html'=>'text/html',
			'icm'=>'application/vnd.iccprofile',
			'ico'=>'image/x-icon',
			'ics'=>'text/calendar',
			'ifb'=>'text/calendar',
			'ims'=>'application/vnd.ms-ims',
			'iso'=>'application/x-iso9660-image',
			'jar'=>'application/java-archive',
			'java'=>'text/x-java-source',
			'jpe'=>'image/jpeg',
			'jpeg'=>'image/jpeg',
			'jpg'=>'image/jpeg',
			'jpgv'=>'video/jpeg',
			'js'=>'application/javascript',
			'json'=>'application/json',
			'jsonml'=>'application/jsonml+json',
			'kml'=>'application/vnd.google-earth.kml+xml',
			'kmz'=>'application/vnd.google-earth.kmz',
			'latex'=>'application/x-latex',
			'lha'=>'application/x-lzh-compressed',
			'log'=>'text/plain',
			'lzh'=>'application/x-lzh-compressed',
			'm1v'=>'video/mpeg',
			'm21'=>'application/mp21',
			'm2a'=>'audio/mpeg',
			'm2v'=>'video/mpeg',
			'm3a'=>'audio/mpeg',
			'm3u'=>'audio/x-mpegurl',
			'm3u8'=>'application/vnd.apple.mpegurl',
			'm4u'=>'video/vnd.mpegurl',
			'm4v'=>'video/x-m4v',
			'mbox'=>'application/mbox',
			'mid'=>'audio/midi',
			'midi'=>'audio/midi',
			'mk3d'=>'video/x-matroska',
			'mka'=>'audio/x-matroska',
			'mks'=>'video/x-matroska',
			'mkv'=>'video/x-matroska',
			'mny'=>'application/x-msmoney',
			'mobi'=>'application/x-mobipocket-ebook',
			'mov'=>'video/quicktime',
			'mp2'=>'audio/mpeg',
			'mp21'=>'application/mp21',
			'mp2a'=>'audio/mpeg',
			'mp3'=>'audio/mpeg',
			'mp4'=>'video/mp4',
			'mp4a'=>'audio/mp4',
			'mp4s'=>'application/mp4',
			'mp4v'=>'video/mp4',
			'mpc'=>'application/vnd.mophun.certificate',
			'mpe'=>'video/mpeg',
			'mpeg'=>'video/mpeg',
			'mpg'=>'video/mpeg',
			'mpg4'=>'video/mp4',
			'mpga'=>'audio/mpeg',
			'mpkg'=>'application/vnd.apple.installer+xml',
			'nfo'=>'text/x-nfo',
			'odb'=>'application/vnd.oasis.opendocument.database',
			'odc'=>'application/vnd.oasis.opendocument.chart',
			'odf'=>'application/vnd.oasis.opendocument.formula',
			'odft'=>'application/vnd.oasis.opendocument.formula-template',
			'odg'=>'application/vnd.oasis.opendocument.graphics',
			'odi'=>'application/vnd.oasis.opendocument.image',
			'odm'=>'application/vnd.oasis.opendocument.text-master',
			'odp'=>'application/vnd.oasis.opendocument.presentation',
			'ods'=>'application/vnd.oasis.opendocument.spreadsheet',
			'odt'=>'application/vnd.oasis.opendocument.text',
			'oga'=>'audio/ogg',
			'ogg'=>'audio/ogg',
			'ogv'=>'video/ogg',
			'ogx'=>'application/ogg',
			'onepkg'=>'application/onenote',
			'onetmp'=>'application/onenote',
			'onetoc'=>'application/onenote',
			'onetoc2'=>'application/onenote',
			'opml'=>'text/x-opml',
			'otf'=>'application/x-font-otf',
			'otg'=>'application/vnd.oasis.opendocument.graphics-template',
			'oth'=>'application/vnd.oasis.opendocument.text-web',
			'oti'=>'application/vnd.oasis.opendocument.image-template',
			'otp'=>'application/vnd.oasis.opendocument.presentation-template',
			'ots'=>'application/vnd.oasis.opendocument.spreadsheet-template',
			'ott'=>'application/vnd.oasis.opendocument.text-template',
			'oxt'=>'application/vnd.openofficeorg.extension',
			'p10'=>'application/pkcs10',
			'p12'=>'application/x-pkcs12',
			'p7b'=>'application/x-pkcs7-certificates',
			'p7c'=>'application/pkcs7-mime',
			'p7m'=>'application/pkcs7-mime',
			'p7r'=>'application/x-pkcs7-certreqresp',
			'p7s'=>'application/pkcs7-signature',
			'p8'=>'application/pkcs8',
			'pas'=>'text/x-pascal',
			'pbm'=>'image/x-portable-bitmap',
			'pcap'=>'application/vnd.tcpdump.pcap',
			'pcf'=>'application/x-font-pcf',
			'pcx'=>'image/x-pcx',
			'pdf'=>'application/pdf',
			'pfa'=>'application/x-font-type1',
			'pfb'=>'application/x-font-type1',
			'pfm'=>'application/x-font-type1',
			'pfr'=>'application/font-tdpfr',
			'pfx'=>'application/x-pkcs12',
			'pgm'=>'image/x-portable-graymap',
			'pgp'=>'application/pgp-encrypted',
			'pic'=>'image/x-pict',
			'pki'=>'application/pkixcmp',
			'pkipath'=>'application/pkix-pkipath',
			'png'=>'image/png',
			'pnm'=>'image/x-portable-anymap',
			'pot'=>'application/vnd.ms-powerpoint',
			'potm'=>'application/vnd.ms-powerpoint.template.macroenabled.12',
			'potx'=>'application/vnd.openxmlformats-officedocument.presentationml.template',
			'ppam'=>'application/vnd.ms-powerpoint.addin.macroenabled.12',
			'ppm'=>'image/x-portable-pixmap',
			'pps'=>'application/vnd.ms-powerpoint',
			'ppsm'=>'application/vnd.ms-powerpoint.slideshow.macroenabled.12',
			'ppsx'=>'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
			'ppt'=>'application/vnd.ms-powerpoint',
			'pptm'=>'application/vnd.ms-powerpoint.presentation.macroenabled.12',
			'pptx'=>'application/vnd.openxmlformats-officedocument.presentationml.presentation',
			'prc'=>'application/x-mobipocket-ebook',
			'pre'=>'application/vnd.lotus-freelance',
			'ps'=>'application/postscript',
			'psd'=>'image/vnd.adobe.photoshop',
			'ptid'=>'application/vnd.pvi.ptid1',
			'pub'=>'application/x-mspublisher',
			'qam'=>'application/vnd.epson.quickanime',
			'qt'=>'video/quicktime',
			'qwd'=>'application/vnd.quark.quarkxpress',
			'qwt'=>'application/vnd.quark.quarkxpress',
			'qxb'=>'application/vnd.quark.quarkxpress',
			'qxd'=>'application/vnd.quark.quarkxpress',
			'qxl'=>'application/vnd.quark.quarkxpress',
			'qxt'=>'application/vnd.quark.quarkxpress',
			'ra'=>'audio/x-pn-realaudio',
			'ram'=>'audio/x-pn-realaudio',
			'rar'=>'application/x-rar-compressed',
			'rdf'=>'application/rdf+xml',
			'res'=>'application/x-dtbresource+xml',
			'rgb'=>'image/x-rgb',
			'rif'=>'application/reginfo+xml',
			'rip'=>'audio/vnd.rip',
			'ris'=>'application/x-research-info-systems',
			'rm'=>'application/vnd.rn-realmedia',
			'rmi'=>'audio/midi',
			'rmp'=>'audio/x-pn-realaudio-plugin',
			'rsd'=>'application/rsd+xml',
			'rss'=>'application/rss+xml',
			'rtf'=>'application/rtf',
			'rtx'=>'text/richtext',
			'sgl'=>'application/vnd.stardivision.writer-global',
			'sgm'=>'text/sgml',
			'sgml'=>'text/sgml',
			'sit'=>'application/x-stuffit',
			'sitx'=>'application/x-stuffitx',
			'sldm'=>'application/vnd.ms-powerpoint.slide.macroenabled.12',
			'sldx'=>'application/vnd.openxmlformats-officedocument.presentationml.slide',
			'slt'=>'application/vnd.epson.salt',
			'smi'=>'application/smil+xml',
			'smil'=>'application/smil+xml',
			'smv'=>'video/x-smv',
			'snd'=>'audio/basic',
			'spx'=>'audio/ogg',
			'sql'=>'application/x-sql',
			'src'=>'application/x-wais-source',
			'svg'=>'image/svg+xml',
			'svgz'=>'image/svg+xml',
			'sxc'=>'application/vnd.sun.xml.calc',
			'sxd'=>'application/vnd.sun.xml.draw',
			'sxg'=>'application/vnd.sun.xml.writer.global',
			'sxi'=>'application/vnd.sun.xml.impress',
			'sxm'=>'application/vnd.sun.xml.math',
			'sxw'=>'application/vnd.sun.xml.writer',
			'tex'=>'application/x-tex',
			'text'=>'text/plain',
			'tga'=>'image/x-tga',
			'tif'=>'image/tiff',
			'tiff'=>'image/tiff',
			'torrent'=>'application/x-bittorrent',
			'tpl'=>'application/vnd.groove-tool-template',
			'tpt'=>'application/vnd.trid.tpt',
			'tr'=>'text/troff',
			'ttc'=>'application/x-font-ttf',
			'ttf'=>'application/x-font-ttf',
			'txt'=>'text/plain',
			'uri'=>'text/uri-list',
			'uris'=>'text/uri-list',
			'urls'=>'text/uri-list',
			'vcard'=>'text/vcard',
			'vcf'=>'text/x-vcard',
			'vcs'=>'text/x-vcalendar',
			'vob'=>'video/x-ms-vob',
			'vrml'=>'model/vrml',
			'vsd'=>'application/vnd.visio',
			'vsf'=>'application/vnd.vsf',
			'vss'=>'application/vnd.visio',
			'vst'=>'application/vnd.visio',
			'vsw'=>'application/vnd.visio',
			'vtu'=>'model/vnd.vtu',
			'vxml'=>'application/voicexml+xml',
			'wav'=>'audio/x-wav',
			'wax'=>'audio/x-ms-wax',
			'wcm'=>'application/vnd.ms-works',
			'wdb'=>'application/vnd.ms-works',
			'wdp'=>'image/vnd.ms-photo',
			'weba'=>'audio/webm',
			'webm'=>'video/webm',
			'webp'=>'image/webp',
			'wks'=>'application/vnd.ms-works',
			'wm'=>'video/x-ms-wm',
			'wma'=>'audio/x-ms-wma',
			'wmd'=>'application/x-ms-wmd',
			'wmf'=>'application/x-msmetafile',
			'wml'=>'text/vnd.wap.wml',
			'wmlc'=>'application/vnd.wap.wmlc',
			'wmls'=>'text/vnd.wap.wmlscript',
			'wmlsc'=>'application/vnd.wap.wmlscriptc',
			'wmv'=>'video/x-ms-wmv',
			'wmx'=>'video/x-ms-wmx',
			'wmz'=>'application/x-msmetafile',
			'woff'=>'application/font-woff',
			'wpd'=>'application/vnd.wordperfect',
			'wpl'=>'application/vnd.ms-wpl',
			'wps'=>'application/vnd.ms-works',
			'wri'=>'application/x-mswrite',
			'wrl'=>'model/vrml',
			'wsdl'=>'application/wsdl+xml',
			'xaml'=>'application/xaml+xml',
			'xap'=>'application/x-silverlight-app',
			'xar'=>'application/vnd.xara',
			'xbap'=>'application/x-ms-xbap',
			'xbd'=>'application/vnd.fujixerox.docuworks.binder',
			'xhtml'=>'application/xhtml+xml',
			'xhvml'=>'application/xv+xml',
			'xla'=>'application/vnd.ms-excel',
			'xlam'=>'application/vnd.ms-excel.addin.macroenabled.12',
			'xlc'=>'application/vnd.ms-excel',
			'xlm'=>'application/vnd.ms-excel',
			'xls'=>'application/vnd.ms-excel',
			'xlsb'=>'application/vnd.ms-excel.sheet.binary.macroenabled.12',
			'xlsm'=>'application/vnd.ms-excel.sheet.macroenabled.12',
			'xlsx'=>'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			'xlt'=>'application/vnd.ms-excel',
			'xltm'=>'application/vnd.ms-excel.template.macroenabled.12',
			'xltx'=>'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
			'xlw'=>'application/vnd.ms-excel',
			'xml'=>'application/xml',
			'xps'=>'application/vnd.ms-xpsdocument',
			'xsl'=>'application/xml',
			'xslt'=>'application/xslt+xml',
			'xsm'=>'application/vnd.syncml+xml',
			'xul'=>'application/vnd.mozilla.xul+xml',
			'zip'=>'application/zip'
		);
	}
}