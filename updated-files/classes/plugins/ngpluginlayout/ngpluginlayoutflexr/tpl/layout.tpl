{include file='header.tpl'}

<div id="outercontainer">

<div id="filltop">

{if $settings->contactvisible}
<div id="contactcontainer">
<div id="contact">
{if $settings->contactphone!==''}<a href="tel:{$settings->contactphoneiso|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 5.42457,10.521C 7.18458,13.98 10.0199,16.8029 13.4789,18.5754L 16.168,15.8862C 16.4974,15.5568 16.9868,15.447 17.4141,15.5926C 18.7831,16.0461 20.262,16.2897 21.7778,16.2897C 22.4498,16.2897 23,16.8399 23,17.5119L 23,21.7777C 23,22.4497 22.4498,22.9999 21.7778,22.9999C 10.301,22.9999 1.00002,13.6995 1.00002,2.22212C 1.00002,1.55014 1.55026,0.999901 2.22224,0.999901L 6.50002,0.999901C 7.17201,0.999901 7.72225,1.55014 7.72225,2.22212C 7.72225,3.7499 7.96693,5.21681 8.41866,6.5852C 8.55361,7.0131 8.4557,7.49001 8.1131,7.8319L 5.42457,10.521 Z "/></svg>&nbsp;{$settings->contactphone|escape}</a>{/if}
{if $settings->contactaddress!=='' || $settings->contactnavigation!==''}{if $settings->contactnavigation!==''}<a href="{$settings->contactnavigation|escape}" target="_blank">{else}<span>{/if}<svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 12,1.00006C 7.74292,1.00006 4.30002,4.44296 4.30002,8.70006C 4.30002,14.4751 12,23.0001 12,23.0001C 12,23.0001 19.7,14.4751 19.7,8.70006C 19.7,4.44296 16.2571,1.00006 12,1.00006 Z M 12,11.4501C 10.4821,11.4501 9.25002,10.218 9.25002,8.70006C 9.25002,7.18215 10.4821,5.95006 12,5.95006C 13.5179,5.95006 14.75,7.18215 14.75,8.70006C 14.75,10.218 13.5179,11.4501 12,11.4501 Z "/></svg>{if $settings->contactaddress!==''}&nbsp;{$settings->contactaddress|escape}{/if}{if $settings->contactnavigation!==''}</a>{else}</span>{/if}{/if}
{if $settings->contactmail!==''}<a title="{$lang['mail']->value|escape}" href="mailto:{$settings->contactmail|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 20.8,3.19991L 3.19999,3.19991C 1.98988,3.19991 1.01076,4.18981 1.01076,5.39991L 0.999988,18.5999C 0.999988,19.8095 1.98988,20.7999 3.19999,20.7999L 20.8,20.7999C 22.0096,20.7999 23,19.8095 23,18.5999L 23,5.39991C 23,4.18981 22.0096,3.19991 20.8,3.19991 Z M 20.8,18.5999L 3.19999,18.5999L 3.19999,7.59991L 12,13.0999L 20.8,7.59991L 20.8,18.5999 Z M 12,10.8999L 3.19999,5.39991L 20.8,5.39991L 12,10.8999 Z "/></svg></a>{/if}
{if $settings->contactfacebook!==''}<a title="{$lang['facebook']->value|escape}" target="_blank" href="{$settings->contactfacebook|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 13.8333,8.33334L 13.8333,6.15052C 13.8333,5.16512 14.051,4.66667 15.5807,4.66667L 17.5,4.66667L 17.5,1L 14.2974,1C 10.3729,1 9.07813,2.79896 9.07813,5.88697L 9.07813,8.33334L 6.5,8.33334L 6.5,12L 9.07813,12L 9.07813,23L 13.8333,23L 13.8333,12L 17.0646,12L 17.5,8.33334L 13.8333,8.33334 Z "/></svg></a>{/if}
{if $settings->contacttwitter!==''}<a title="{$lang['twitter']->value|escape}" target="_blank" href="{$settings->contacttwitter|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 23,5.17015C 22.1888,5.52913 21.3217,5.77154 20.408,5.88343C 21.3404,5.32399 22.0583,4.43821 22.394,3.38461C 21.5221,3.90207 20.5571,4.2797 19.5268,4.48018C 18.7016,3.59904 17.5268,3.04894 16.2308,3.04894C 13.7366,3.04894 11.718,5.07224 11.718,7.56642C 11.718,7.92073 11.7552,8.26572 11.8345,8.59672C 8.0816,8.41024 4.75293,6.6107 2.52914,3.87412C 2.1422,4.54078 1.91841,5.31934 1.91841,6.1445C 1.91841,7.71094 2.72029,9.09557 3.93241,9.90675C 3.18649,9.88811 2.48719,9.68296 1.88113,9.34264C 1.88113,9.36129 1.88113,9.37993 1.88113,9.3986C 1.88113,11.5897 3.43823,13.4126 5.50352,13.8275C 5.12589,13.9301 4.72495,13.986 4.3147,13.986C 4.02565,13.986 3.74126,13.958 3.46621,13.9021C 4.03963,15.6969 5.70864,17.0023 7.68533,17.0396C 6.1422,18.2517 4.19349,18.9743 2.07694,18.9743C 1.71329,18.9743 1.35433,18.951 1.00001,18.9091C 2.99068,20.2051 5.36366,20.951 7.90909,20.951C 16.2214,20.951 20.7623,14.0652 20.7623,8.09324C 20.7623,7.89742 20.7576,7.70161 20.7483,7.51048C 21.6294,6.87178 22.394,6.07924 23,5.17015 Z "/></svg></a>{/if}
{if $settings->contactgoogleplus!==''}<a title="{$lang['googleplus']->value|escape}" target="_blank" href="{$settings->contactgoogleplus|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 15.786,13.1173L 14.7443,12.3353L 14.7407,12.3323C 14.407,12.0701 14.1707,11.8562 14.1707,11.4913C 14.1707,11.0916 14.4599,10.8141 14.7948,10.4927L 14.8215,10.467C 15.9684,9.59805 17.3831,8.50322 17.3831,6.19678C 17.3831,4.65414 16.7006,3.63495 16.0498,2.89038L 16.7925,2.89038L 20.2475,1.00032L 12.6042,1.00032C 11.1537,1.00032 9.01416,1.18504 7.18821,2.63701L 7.18088,2.65133C 5.93178,3.68861 5.18611,5.20485 5.18611,6.70012C 5.18611,7.91415 5.68475,9.11473 6.5541,9.99035C 7.78139,11.2263 9.32059,11.4868 10.3957,11.4868C 10.4795,11.4868 10.5651,11.4852 10.6518,11.4814C 10.6083,11.6515 10.5802,11.8435 10.5802,12.0726C 10.5802,12.6984 10.788,13.178 11.0431,13.5729C 9.67064,13.6835 7.71271,13.9439 6.1807,14.8488C 3.92778,16.1411 3.75247,18.0491 3.75247,18.6032C 3.75247,20.7915 5.79757,22.9997 10.3665,22.9997C 15.6134,22.9997 18.3587,20.148 18.3587,17.3308C 18.3587,15.2025 17.0508,14.1424 15.786,13.1173 Z M 8.60505,5.34717C 8.60505,4.58205 8.77802,4.00368 9.13515,3.57739C 9.50822,3.12767 10.1764,2.82544 10.7977,2.82544C 11.9363,2.82544 12.6842,3.68501 13.1109,4.40609C 13.6378,5.29608 13.965,6.47342 13.965,7.47847C 13.965,7.76151 13.965,8.62298 13.3815,9.18501C 12.9834,9.56795 12.3101,9.83525 11.744,9.83525C 10.5698,9.83525 9.82804,8.99303 9.41257,8.28649C 8.8172,7.27367 8.60505,6.10405 8.60505,5.34717 Z M 15.5418,18.4104C 15.5418,19.9822 14.0979,20.9586 11.7732,20.9586C 9.02077,20.9586 7.17143,19.7786 7.17143,18.0225C 7.17143,16.5254 8.40512,15.9154 9.33639,15.5871C 10.4214,15.2398 11.8735,15.1687 12.2037,15.1687C 12.4274,15.1687 12.5523,15.1687 12.701,15.1819C 14.803,16.6258 15.5418,17.251 15.5418,18.4104 Z "/></svg></a>{/if}
{if $settings->contactlinkedin!==''}<a title="{$lang['linkedin']->value|escape}" target="_blank" href="{$settings->contactlinkedin|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 21.2407,1L 2.87966,1C 1.8768,1 1.00002,1.72207 1.00002,2.71346L 1.00002,21.1146C 1.00002,22.1118 1.8768,23 2.87966,23L 21.2349,23C 22.2436,23 23,22.106 23,21.1146L 23,2.71346C 23.0057,1.72207 22.2436,1 21.2407,1 Z M 7.8195,19.3381L 4.66764,19.3381L 4.66764,9.53867L 7.8195,9.53867L 7.8195,19.3381 Z M 6.35245,8.04871L 6.32953,8.04871C 5.32093,8.04871 4.66764,7.29798 4.66764,6.35816C 4.66764,5.40113 5.33814,4.66762 6.36965,4.66762C 7.40117,4.66762 8.03154,5.39542 8.05446,6.35816C 8.05446,7.29798 7.40117,8.04871 6.35245,8.04871 Z M 19.3381,19.3381L 16.1863,19.3381L 16.1863,13.9799C 16.1863,12.6962 15.7278,11.8195 14.5874,11.8195C 13.7164,11.8195 13.2006,12.4097 12.9714,12.9828C 12.8854,13.1891 12.8625,13.4699 12.8625,13.7564L 12.8625,19.3381L 9.71061,19.3381L 9.71061,9.53867L 12.8625,9.53867L 12.8625,10.9026C 13.3209,10.2493 14.0373,9.30945 15.7049,9.30945C 17.7737,9.30945 19.3381,10.6733 19.3381,13.6131L 19.3381,19.3381 Z "/></svg></a>{/if}
{if $settings->contactxing!==''}<a title="{$lang['xing']->value|escape}" target="_blank" href="{$settings->contactxing|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 10.5734,9.73878C 10.4847,9.8984 9.34526,11.9202 7.15496,15.8042C 6.91553,16.2121 6.62733,16.4161 6.29037,16.4161L 3.11134,16.4161C 2.92512,16.4161 2.78767,16.3407 2.69899,16.19C 2.61032,16.0392 2.61032,15.8796 2.69899,15.7111L 6.06425,9.75208C 6.07312,9.75208 6.07312,9.74765 6.06425,9.73878L 3.92272,6.02769C 3.81631,5.83261 3.81188,5.66856 3.90942,5.53554C 3.98923,5.40253 4.13111,5.33602 4.33507,5.33602L 7.5141,5.33602C 7.8688,5.33602 8.16144,5.53554 8.39199,5.93458L 10.5734,9.73878 Z M 21.2943,1.19929C 21.3919,1.34117 21.3919,1.50522 21.2943,1.69144L 14.2712,14.1149L 14.2712,14.1282L 18.7405,22.3086C 18.838,22.4859 18.8425,22.65 18.7538,22.8007C 18.6651,22.9338 18.5232,23.0003 18.3281,23.0003L 15.1491,23.0003C 14.7767,23.0003 14.484,22.8007 14.2712,22.4017L 9.76203,14.1282C 9.92165,13.8445 12.276,9.66784 16.8251,1.59833C 17.0468,1.19929 17.3305,0.999769 17.6764,0.999769L 20.882,0.999769C 21.0771,0.999769 21.2145,1.06628 21.2943,1.19929 Z "/></svg></a>{/if}
{if $settings->contactinstagram!==''}<a title="{$lang['instagram']->value|escape}" target="_blank" href="{$settings->contactinstagram|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 11.9714,7.37845C 14.5026,7.37845 16.5547,9.43049 16.5547,11.9618C 16.5547,14.4931 14.5026,16.5451 11.9714,16.5451C 9.44006,16.5451 7.38802,14.4931 7.38802,11.9618C 7.38802,9.43049 9.44006,7.37845 11.9714,7.37845 Z M 7.49144,7.43882C 6.72245,8.20782 6.17309,9.13542 5.8739,10.1667L 1,10.1667L 1,3.69271C 1,2.17392 2.2885,1.00001 3.80729,1.00001L 20.3073,1.00001C 21.8261,1.00001 23,2.17392 23,3.69271L 23,10.1667L 18.1833,10.1667C 17.8842,9.13542 17.3348,8.21137 16.5659,7.4424C 15.3539,6.23044 13.7426,5.55228 12.0286,5.55228C 10.3147,5.55228 8.70338,6.22689 7.49144,7.43882 Z M 21.1667,5.76668L 21.1667,3.56666C 21.1667,3.16162 20.8383,2.83334 20.4333,2.83334L 18.2333,2.83334C 17.8283,2.83334 17.5,3.16167 17.5,3.56666L 17.5,5.76668C 17.5,6.17172 17.8284,6.5 18.2333,6.5L 20.4333,6.5C 20.8384,6.5 21.1667,6.17166 21.1667,5.76668 Z M 16.5659,16.5134C 17.7756,15.3037 18.4427,13.6615 18.4452,12L 23,12L 23,20.1927C 23,21.7115 21.8261,23 20.3073,23L 3.80729,23C 2.2885,23 1,21.7115 1,20.1927L 1,12L 5.61209,12C 5.61461,13.6615 6.28171,15.3073 7.49144,16.517C 8.70338,17.7289 10.3147,18.3856 12.0286,18.3856C 13.7426,18.3856 15.3539,17.7254 16.5659,16.5134 Z "/></svg></a>{/if}
{if $settings->contactyoutube!==''}<a title="{$lang['youtube']->value|escape}" target="_blank" href="{$settings->contactyoutube|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 22.8582,7.39283C 22.8582,5.45886 21.4356,3.9031 19.6779,3.9031C 17.2969,3.79136 14.8687,3.74838 12.389,3.74838C 12.26,3.74838 12.1311,3.74838 12.0022,3.74838C 11.8732,3.74838 11.7443,3.74838 11.6154,3.74838C 9.13988,3.74838 6.70737,3.79136 4.32645,3.9031C 2.57299,3.9031 1.15044,5.46746 1.15044,7.40143C 1.043,8.93142 0.995719,10.4614 1.00002,11.9914C 0.995719,13.5214 1.043,15.0514 1.14614,16.5856C 1.14614,18.5196 2.56869,20.0883 4.32214,20.0883C 6.82342,20.2043 9.38916,20.2559 11.9979,20.2516C 14.6109,20.2602 17.168,20.2086 19.6736,20.0883C 21.4314,20.0883 22.8539,18.5196 22.8539,16.5856C 22.957,15.0514 23.0043,13.5214 23,11.9871C 23.0086,10.4571 22.9613,8.92712 22.8582,7.39283 Z M 9.89628,16.2075L 9.89628,7.76244L 16.128,11.9828L 9.89628,16.2075 Z "/></svg></a>{/if}
{if $settings->contactpinterest!==''}<a title="{$lang['pinterest']->value|escape}" target="_blank" href="{$settings->contactpinterest|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 12.0024,1.00011C 5.92929,1.00011 1.005,5.9244 1.005,11.9976C 1.005,16.4996 3.71509,20.3684 7.58874,22.072C 7.55928,21.3061 7.58383,20.3831 7.78021,19.5485C 7.99131,18.6549 9.19416,13.5539 9.19416,13.5539C 9.19416,13.5539 8.84068,12.8518 8.84068,11.8159C 8.84068,10.1859 9.78331,8.96834 10.9616,8.96834C 11.9632,8.96834 12.4443,9.71952 12.4443,10.618C 12.4443,11.6244 11.8011,13.1268 11.4722,14.5211C 11.1973,15.6896 12.0564,16.6371 13.2102,16.6371C 15.2919,16.6371 16.696,13.9614 16.696,10.7898C 16.696,8.37919 15.0709,6.57739 12.1203,6.57739C 8.78667,6.57739 6.70502,9.06653 6.70502,11.8454C 6.70502,12.8027 6.98976,13.4803 7.43162,14.0007C 7.63292,14.2412 7.66238,14.3394 7.58874,14.6144C 7.53473,14.8157 7.4169,15.3017 7.36289,15.4981C 7.28925,15.7779 7.06341,15.8761 6.81301,15.773C 5.27633,15.1446 4.55952,13.4655 4.55952,11.5704C 4.55952,8.44794 7.19597,4.70193 12.4198,4.70193C 16.6174,4.70193 19.3815,7.74095 19.3815,11.0009C 19.3815,15.3164 16.9808,18.5371 13.4459,18.5371C 12.2577,18.5371 11.1433,17.8939 10.7603,17.1673C 10.7603,17.1673 10.1221,19.7007 9.9846,20.1917C 9.75387,21.041 9.29726,21.8855 8.87995,22.5483C 9.86678,22.8379 10.9125,22.9999 11.9975,22.9999C 18.0707,22.9999 22.995,18.0756 22.995,12.0025C 22.9999,5.9244 18.0756,1.00011 12.0024,1.00011 Z "/></svg></a>{/if}
</div>
</div>
{/if}


{if $settings->commontopvisible}
<div id="commontopcontainer">
<div id="commontop">

{if isset($commonnav)}
{foreach $commonnav as $item}
<a href="{$item->link|escape}">{$item->caption|escape}</a>
{/foreach}
{/if}
</div>		
</div>
{/if}

{if $settings->logovisible}
<div id="logocontainer">
<div id="logo">{if isset ($logologosource)}<a href="{$homelink|escape}"><img width="{$logologowidth}" height="{$logologoheight}" src="{$logologosource|escape}" alt="" {if isset ($logologosourcehd)} srcset="{$logologosource|escape} 1x, {$logologosourcehd|escape} 2x" {/if} /></a>{/if}</div>
</div>
{/if}

{if $settings->navfixed}
<div id="navplaceholder"></div>
{/if}

{if $settings->navvisible}
	{if $settings->navsuper}
		<div id="navcontainer">
		<div id="nav" data-animate="{$animate}">

			<div><a href="#" class="sqrnavhide">{$lang['hidenavigation']->value}</a></div>
			<div><a href="#" class="sqrnavshow">{$lang['shownavigation']->value}</a></div>
			<ul>
				{if isset ($navlogosource)}
					<li class="sqrnavlogo"><a href="{$homelink|escape}"><img width="{$navlogowidth}" height="{$navlogoheight}" class="sqrlogo" src="{$navlogosource|escape}" alt="" {if isset ($navlogosourcehd)} srcset="{$navlogosource|escape} 1x, {$navlogosourcehd|escape} 2x" {/if} /></a></li>
				{/if}

				{if $settings->navincludehome}
				<li class="sqrnavhome"><a href="{$home->fullURL($previewMode)|escape}"><span>{$home->caption|escape}</span></a></li>
				{/if}

				{foreach $home->children as $maintopic}
					<li{if $maintopic->objectUID===$topicuid} class="active"{/if}>
						<a href="{$maintopic->fullURL($previewMode)|escape}">
							<span>{$icon->getSvg($maintopic->icon)}{$maintopic->caption|escape}{if isset($cartindicator) && $cartindicator===$maintopic->objectUID}<em class="ngshopcartindicator"></em>{/if}</span>
						</a>

						{if count($maintopic->children)>0}
							<div class="sqrnavfill">
								<div>
									<ul>
										{if isset($cropratio1) && $maintopic->getPictureObject()!==null}
											<li>
												<a href="{$maintopic->fullURL($previewMode)|escape}">
													<figure>
														<img src="{$maintopic->pictureSource($picturewidth,-1,$cropratio1)|escape}" alt="" width="{$maintopic->pictureSize(384,-1,$cropratio1)->width}" height="{$maintopic->pictureSize(384,-1,$cropratio1)->height}" />
														<figcaption>
															<span>{$icon->getSvg($maintopic->icon)}{$maintopic->caption|escape}</span>
														</figcaption>
													</figure>
												</a>
											</li>
										{/if}

										{foreach $maintopic->children as $topic}
											<li>
												<a href="{$topic->fullURL($previewMode)|escape}">
													{if isset($cropratio2) && $topic->getPictureObject()!==null}
														<figure>
															<img src="{$topic->pictureSource($picturewidth,-1,$cropratio2)|escape}" alt="" width="{$topic->pictureSize(384,-1,$cropratio2)->width}" height="{$topic->pictureSize(384,-1,$cropratio2)->height}" />
															<figcaption>
																<span>{$icon->getSvg($topic->icon)}{$topic->caption|escape}</span>
															</figcaption>
														</figure>
													{else}
														<span>{$icon->getSvg($topic->icon)}{$topic->caption|escape}</span>
													{/if}
												</a>

												{if count($topic->children)>0}
													<ul>
														{foreach $topic->children as $subtopic}
															<li>
																<a href="{$subtopic->fullURL($previewMode)|escape}">
																	{if isset($cropratio3) && $subtopic->getPictureObject()!==null}
																		<figure>
																			<img src="{$subtopic->pictureSource($picturewidth,-1,$cropratio3)|escape}" alt="" width="{$subtopic->pictureSize(384,-1,$cropratio3)->width}" height="{$subtopic->pictureSize(384,-1,$cropratio3)->height}" />
																			<figcaption>
																				<span>{$icon->getSvg($subtopic->icon)}{$subtopic->caption|escape}</span>
																			</figcaption>
																		</figure>
																	{else}
																		<span>{$icon->getSvg($subtopic->icon)}{$subtopic->caption|escape}</span>
																	{/if}
																</a>
															</li>
														{/foreach}
													</ul>
												{/if}
											</li>
										{/foreach}
									</ul>
								</div>
							</div>
						{/if}
					</li>
				{/foreach}

				{if $search!==''}
					<li class="sqrnavsearch"><a href="#"><span>{$lang['search']->value}</span></a>
						<div>
							<div>
								<form action="{$search|escape}"  >
									<input type="text" name="criteria"  />
								</form>
							</div>
						</div>
					</li>
				{/if}
				{if isset($accountlink)}
					<li class="sqrnavaccount"><a href="{$accountlink|escape}"><span>{$accountcaption|escape}</span></a></li>
				{/if}
				{if isset($cartlink)}
					<li class="sqrnavcart ngshopcartindicatorsimple"><a href="{$cartlink|escape}"><span>{$cartcaption|escape}</span></a></li>
				{/if}

			</ul>
		</div>
		</div>

	{else}
		<div id="navcontainer">
		<div id="nav" class="sqrnav">

		<div><a href="#" class="sqrnavhide">{$lang['hidenavigation']->value}</a></div>
		<div><a href="#" class="sqrnavshow">{$lang['shownavigation']->value}</a></div>

		<ul>

		{if isset ($navlogosource)}
		<li class="sqrnavlogo"><a href="{$homelink|escape}"><img width="{$navlogowidth}" height="{$navlogoheight}" class="sqrlogo" src="{$navlogosource|escape}" alt="" {if isset ($navlogosourcehd)} srcset="{$navlogosource|escape} 1x, {$navlogosourcehd|escape} 2x" {/if} /></a></li>
		{/if}

		{$nav}
		{if $search!==''}
		<li class="sqrnavsearch"><a href="#"><span>{$lang['search']->value}</span></a>
		<ul><li>
		<form action="{$search|escape}"  >
			<input type="text" name="criteria"  />
		</form>
		</li></ul>
		</li>
		{/if}
		{if isset($accountlink)}
			<li class="sqrnavaccount"><a href="{$accountlink|escape}"><span>{$accountcaption|escape}</span></a></li>
		{/if}
		{if isset($cartlink)}
			<li class="sqrnavcart ngshopcartindicatorsimple"><a href="{$cartlink|escape}"><span>{$cartcaption|escape}</span></a></li>
		{/if}
		</ul>

		</div>
		</div>
	{/if}
{/if}

{if $settings->eyecatchervisible && (count($pictures)>0 || isset($eyecatchersource) || isset($topich264) || isset($topicogv) || isset($topicwebm))}
<div id="eyecatchercontainer">
<div id="eyecatcher" data-size="{$settings->eyecatcherheight}" data-autoprogress="{$settings->eyecatcherautoprogress}">
<div id="eyecatcherstage">

{if isset($topich264) || isset($topicogv) || isset($topicwebm)}
<video class="eyecatcherchild" loop autoplay="autoplay" playsinline="playsinline" {if isset($poster)} poster="{$poster|escape}"{/if} {if $settings->eyecatchermutevideo}muted="muted"{/if}>
{if isset($topich264)}
  <source src="{$topich264|escape}" type="video/mp4" />
{/if}
{if isset($topicogv)}
  <source src="{$topicogv|escape}" type="video/ogg" />
{/if}
{if isset($topicwebm)}
  <source src="{$topicwebm|escape}" type="video/webm" />
{/if}
</video>
{else if count($pictures)>0}
<img class="eyecatcherchild" src="{$pictures[0]|escape}" alt="" />
{else if isset($eyecatchersource)}
<img class="eyecatcherchild" src="{$eyecatchersource|escape}" alt="" />
{/if}
</div>


{if count($pictures)>1 && !isset($topich264) && !isset($topicogv) && !isset($topicwebm)}
<div id="eyecatcherbullets">
{foreach $pictures as $picture}
<a href="{$picture|escape}"></a>
{/foreach}
</div>
{/if}

</div>
</div>
{/if}

</div>

<div id="fillbottom">
		
{if $streams['header']->isVisible}
<div id="headercontainer">
<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="header">
{if $settings->captionposition==='header' && $page->pagecaption()!==''}
	<div class="sqrallwaysboxed" >
		<h1>{$page->pagecaption()|escape}</h1>
{if (isset($breadcrumbs))}
		<p class="breadcrumbs">{$lang['youarehere']->value} {$breadcrumbs}</p>
{/if}
	</div>
{/if}
	{$streams['header']->output}
</div>
</div>
	
{/if}

<div id="maincontainer">
<div id="main" class="{$mainstyle} {if $cols>1}sqrdesktopboxed{/if}">
{if $streams['sidebarleft']->isVisible}
<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarleft">
{$streams['sidebarleft']->output}
</div>		
{/if}
<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="content">
{if $settings->captionposition==='content' && $page->pagecaption()!==''}
	<div class="sqrallwaysboxed" >
		<h1>{$page->pagecaption()|escape}</h1>
{if (isset($breadcrumbs))}
		<p class="breadcrumbs">{$lang['youarehere']->value} {$breadcrumbs}</p>
{/if}
	</div>
{/if}
{$streams['content']->output}
</div>		
{if $streams['sidebarright']->isVisible}
<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarright">
{$streams['sidebarright']->output}
</div>		
{/if}

</div>
</div>


{if $streams['footer']->isVisible}
<div id="footercontainer">
<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="footer">
{$streams['footer']->output}
</div>		
</div>
{/if}

</div>

{if $settings->commonvisible}
<div id="commoncontainer">
<div id="common">

{if isset($commonnavhierarchical)}
<ul class="sqrcommonnavhierarchical sqrcommonnavhierarchical{min(5,count($commonnavhierarchical))}col">
{foreach $commonnavhierarchical as $topic}
<li>
<em>{$topic->caption|escape}</em>
<ul>
{foreach $topic->pages as $page}
<li><a href="{$page->link|escape}">{$page->caption|escape}</a></li>
{/foreach}
</ul>
</li>
{/foreach}
</ul>
{/if}

{if isset($commonnav) && $settings->commonshowpages}
<ul class="sqrcommonnav">
{foreach $commonnav as $item}
<li>
<a href="{$item->link|escape}">{$item->caption|escape}</a>
</li>
{/foreach}
</ul>
{/if}

{if $commonhtml!==''}
<div> 
{$commonhtml}
</div>
{/if}

{if $settings->commonshowcontact}
	<div id="commoncontact">
		{if $settings->contactphone!==''}<a href="tel:{$settings->contactphoneiso|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 5.42457,10.521C 7.18458,13.98 10.0199,16.8029 13.4789,18.5754L 16.168,15.8862C 16.4974,15.5568 16.9868,15.447 17.4141,15.5926C 18.7831,16.0461 20.262,16.2897 21.7778,16.2897C 22.4498,16.2897 23,16.8399 23,17.5119L 23,21.7777C 23,22.4497 22.4498,22.9999 21.7778,22.9999C 10.301,22.9999 1.00002,13.6995 1.00002,2.22212C 1.00002,1.55014 1.55026,0.999901 2.22224,0.999901L 6.50002,0.999901C 7.17201,0.999901 7.72225,1.55014 7.72225,2.22212C 7.72225,3.7499 7.96693,5.21681 8.41866,6.5852C 8.55361,7.0131 8.4557,7.49001 8.1131,7.8319L 5.42457,10.521 Z "/></svg>&nbsp;{$settings->contactphone|escape}</a>{/if}
		{if $settings->contactaddress!=='' || $settings->contactnavigation!==''}{if $settings->contactnavigation!==''}<a href="{$settings->contactnavigation|escape}" target="_blank">{else}<span>{/if}<svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 12,1.00006C 7.74292,1.00006 4.30002,4.44296 4.30002,8.70006C 4.30002,14.4751 12,23.0001 12,23.0001C 12,23.0001 19.7,14.4751 19.7,8.70006C 19.7,4.44296 16.2571,1.00006 12,1.00006 Z M 12,11.4501C 10.4821,11.4501 9.25002,10.218 9.25002,8.70006C 9.25002,7.18215 10.4821,5.95006 12,5.95006C 13.5179,5.95006 14.75,7.18215 14.75,8.70006C 14.75,10.218 13.5179,11.4501 12,11.4501 Z "/></svg>{if $settings->contactaddress!==''}&nbsp;{$settings->contactaddress|escape}{/if}{if $settings->contactnavigation!==''}</a>{else}</span>{/if}{/if}
		{if $settings->contactmail!==''}<a title="{$lang['mail']->value|escape}" href="mailto:{$settings->contactmail|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 20.8,3.19991L 3.19999,3.19991C 1.98988,3.19991 1.01076,4.18981 1.01076,5.39991L 0.999988,18.5999C 0.999988,19.8095 1.98988,20.7999 3.19999,20.7999L 20.8,20.7999C 22.0096,20.7999 23,19.8095 23,18.5999L 23,5.39991C 23,4.18981 22.0096,3.19991 20.8,3.19991 Z M 20.8,18.5999L 3.19999,18.5999L 3.19999,7.59991L 12,13.0999L 20.8,7.59991L 20.8,18.5999 Z M 12,10.8999L 3.19999,5.39991L 20.8,5.39991L 12,10.8999 Z "/></svg></a>{/if}
		{if $settings->contactfacebook!==''}<a title="{$lang['facebook']->value|escape}" target="_blank" href="{$settings->contactfacebook|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 13.8333,8.33334L 13.8333,6.15052C 13.8333,5.16512 14.051,4.66667 15.5807,4.66667L 17.5,4.66667L 17.5,1L 14.2974,1C 10.3729,1 9.07813,2.79896 9.07813,5.88697L 9.07813,8.33334L 6.5,8.33334L 6.5,12L 9.07813,12L 9.07813,23L 13.8333,23L 13.8333,12L 17.0646,12L 17.5,8.33334L 13.8333,8.33334 Z "/></svg></a>{/if}
		{if $settings->contacttwitter!==''}<a title="{$lang['twitter']->value|escape}" target="_blank" href="{$settings->contacttwitter|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 23,5.17015C 22.1888,5.52913 21.3217,5.77154 20.408,5.88343C 21.3404,5.32399 22.0583,4.43821 22.394,3.38461C 21.5221,3.90207 20.5571,4.2797 19.5268,4.48018C 18.7016,3.59904 17.5268,3.04894 16.2308,3.04894C 13.7366,3.04894 11.718,5.07224 11.718,7.56642C 11.718,7.92073 11.7552,8.26572 11.8345,8.59672C 8.0816,8.41024 4.75293,6.6107 2.52914,3.87412C 2.1422,4.54078 1.91841,5.31934 1.91841,6.1445C 1.91841,7.71094 2.72029,9.09557 3.93241,9.90675C 3.18649,9.88811 2.48719,9.68296 1.88113,9.34264C 1.88113,9.36129 1.88113,9.37993 1.88113,9.3986C 1.88113,11.5897 3.43823,13.4126 5.50352,13.8275C 5.12589,13.9301 4.72495,13.986 4.3147,13.986C 4.02565,13.986 3.74126,13.958 3.46621,13.9021C 4.03963,15.6969 5.70864,17.0023 7.68533,17.0396C 6.1422,18.2517 4.19349,18.9743 2.07694,18.9743C 1.71329,18.9743 1.35433,18.951 1.00001,18.9091C 2.99068,20.2051 5.36366,20.951 7.90909,20.951C 16.2214,20.951 20.7623,14.0652 20.7623,8.09324C 20.7623,7.89742 20.7576,7.70161 20.7483,7.51048C 21.6294,6.87178 22.394,6.07924 23,5.17015 Z "/></svg></a>{/if}
		{if $settings->contactgoogleplus!==''}<a title="{$lang['googleplus']->value|escape}" target="_blank" href="{$settings->contactgoogleplus|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 15.786,13.1173L 14.7443,12.3353L 14.7407,12.3323C 14.407,12.0701 14.1707,11.8562 14.1707,11.4913C 14.1707,11.0916 14.4599,10.8141 14.7948,10.4927L 14.8215,10.467C 15.9684,9.59805 17.3831,8.50322 17.3831,6.19678C 17.3831,4.65414 16.7006,3.63495 16.0498,2.89038L 16.7925,2.89038L 20.2475,1.00032L 12.6042,1.00032C 11.1537,1.00032 9.01416,1.18504 7.18821,2.63701L 7.18088,2.65133C 5.93178,3.68861 5.18611,5.20485 5.18611,6.70012C 5.18611,7.91415 5.68475,9.11473 6.5541,9.99035C 7.78139,11.2263 9.32059,11.4868 10.3957,11.4868C 10.4795,11.4868 10.5651,11.4852 10.6518,11.4814C 10.6083,11.6515 10.5802,11.8435 10.5802,12.0726C 10.5802,12.6984 10.788,13.178 11.0431,13.5729C 9.67064,13.6835 7.71271,13.9439 6.1807,14.8488C 3.92778,16.1411 3.75247,18.0491 3.75247,18.6032C 3.75247,20.7915 5.79757,22.9997 10.3665,22.9997C 15.6134,22.9997 18.3587,20.148 18.3587,17.3308C 18.3587,15.2025 17.0508,14.1424 15.786,13.1173 Z M 8.60505,5.34717C 8.60505,4.58205 8.77802,4.00368 9.13515,3.57739C 9.50822,3.12767 10.1764,2.82544 10.7977,2.82544C 11.9363,2.82544 12.6842,3.68501 13.1109,4.40609C 13.6378,5.29608 13.965,6.47342 13.965,7.47847C 13.965,7.76151 13.965,8.62298 13.3815,9.18501C 12.9834,9.56795 12.3101,9.83525 11.744,9.83525C 10.5698,9.83525 9.82804,8.99303 9.41257,8.28649C 8.8172,7.27367 8.60505,6.10405 8.60505,5.34717 Z M 15.5418,18.4104C 15.5418,19.9822 14.0979,20.9586 11.7732,20.9586C 9.02077,20.9586 7.17143,19.7786 7.17143,18.0225C 7.17143,16.5254 8.40512,15.9154 9.33639,15.5871C 10.4214,15.2398 11.8735,15.1687 12.2037,15.1687C 12.4274,15.1687 12.5523,15.1687 12.701,15.1819C 14.803,16.6258 15.5418,17.251 15.5418,18.4104 Z "/></svg></a>{/if}
		{if $settings->contactlinkedin!==''}<a title="{$lang['linkedin']->value|escape}" target="_blank" href="{$settings->contactlinkedin|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 21.2407,1L 2.87966,1C 1.8768,1 1.00002,1.72207 1.00002,2.71346L 1.00002,21.1146C 1.00002,22.1118 1.8768,23 2.87966,23L 21.2349,23C 22.2436,23 23,22.106 23,21.1146L 23,2.71346C 23.0057,1.72207 22.2436,1 21.2407,1 Z M 7.8195,19.3381L 4.66764,19.3381L 4.66764,9.53867L 7.8195,9.53867L 7.8195,19.3381 Z M 6.35245,8.04871L 6.32953,8.04871C 5.32093,8.04871 4.66764,7.29798 4.66764,6.35816C 4.66764,5.40113 5.33814,4.66762 6.36965,4.66762C 7.40117,4.66762 8.03154,5.39542 8.05446,6.35816C 8.05446,7.29798 7.40117,8.04871 6.35245,8.04871 Z M 19.3381,19.3381L 16.1863,19.3381L 16.1863,13.9799C 16.1863,12.6962 15.7278,11.8195 14.5874,11.8195C 13.7164,11.8195 13.2006,12.4097 12.9714,12.9828C 12.8854,13.1891 12.8625,13.4699 12.8625,13.7564L 12.8625,19.3381L 9.71061,19.3381L 9.71061,9.53867L 12.8625,9.53867L 12.8625,10.9026C 13.3209,10.2493 14.0373,9.30945 15.7049,9.30945C 17.7737,9.30945 19.3381,10.6733 19.3381,13.6131L 19.3381,19.3381 Z "/></svg></a>{/if}
		{if $settings->contactxing!==''}<a title="{$lang['xing']->value|escape}" target="_blank" href="{$settings->contactxing|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 10.5734,9.73878C 10.4847,9.8984 9.34526,11.9202 7.15496,15.8042C 6.91553,16.2121 6.62733,16.4161 6.29037,16.4161L 3.11134,16.4161C 2.92512,16.4161 2.78767,16.3407 2.69899,16.19C 2.61032,16.0392 2.61032,15.8796 2.69899,15.7111L 6.06425,9.75208C 6.07312,9.75208 6.07312,9.74765 6.06425,9.73878L 3.92272,6.02769C 3.81631,5.83261 3.81188,5.66856 3.90942,5.53554C 3.98923,5.40253 4.13111,5.33602 4.33507,5.33602L 7.5141,5.33602C 7.8688,5.33602 8.16144,5.53554 8.39199,5.93458L 10.5734,9.73878 Z M 21.2943,1.19929C 21.3919,1.34117 21.3919,1.50522 21.2943,1.69144L 14.2712,14.1149L 14.2712,14.1282L 18.7405,22.3086C 18.838,22.4859 18.8425,22.65 18.7538,22.8007C 18.6651,22.9338 18.5232,23.0003 18.3281,23.0003L 15.1491,23.0003C 14.7767,23.0003 14.484,22.8007 14.2712,22.4017L 9.76203,14.1282C 9.92165,13.8445 12.276,9.66784 16.8251,1.59833C 17.0468,1.19929 17.3305,0.999769 17.6764,0.999769L 20.882,0.999769C 21.0771,0.999769 21.2145,1.06628 21.2943,1.19929 Z "/></svg></a>{/if}
		{if $settings->contactinstagram!==''}<a title="{$lang['instagram']->value|escape}" target="_blank" href="{$settings->contactinstagram|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 11.9714,7.37845C 14.5026,7.37845 16.5547,9.43049 16.5547,11.9618C 16.5547,14.4931 14.5026,16.5451 11.9714,16.5451C 9.44006,16.5451 7.38802,14.4931 7.38802,11.9618C 7.38802,9.43049 9.44006,7.37845 11.9714,7.37845 Z M 7.49144,7.43882C 6.72245,8.20782 6.17309,9.13542 5.8739,10.1667L 1,10.1667L 1,3.69271C 1,2.17392 2.2885,1.00001 3.80729,1.00001L 20.3073,1.00001C 21.8261,1.00001 23,2.17392 23,3.69271L 23,10.1667L 18.1833,10.1667C 17.8842,9.13542 17.3348,8.21137 16.5659,7.4424C 15.3539,6.23044 13.7426,5.55228 12.0286,5.55228C 10.3147,5.55228 8.70338,6.22689 7.49144,7.43882 Z M 21.1667,5.76668L 21.1667,3.56666C 21.1667,3.16162 20.8383,2.83334 20.4333,2.83334L 18.2333,2.83334C 17.8283,2.83334 17.5,3.16167 17.5,3.56666L 17.5,5.76668C 17.5,6.17172 17.8284,6.5 18.2333,6.5L 20.4333,6.5C 20.8384,6.5 21.1667,6.17166 21.1667,5.76668 Z M 16.5659,16.5134C 17.7756,15.3037 18.4427,13.6615 18.4452,12L 23,12L 23,20.1927C 23,21.7115 21.8261,23 20.3073,23L 3.80729,23C 2.2885,23 1,21.7115 1,20.1927L 1,12L 5.61209,12C 5.61461,13.6615 6.28171,15.3073 7.49144,16.517C 8.70338,17.7289 10.3147,18.3856 12.0286,18.3856C 13.7426,18.3856 15.3539,17.7254 16.5659,16.5134 Z "/></svg></a>{/if}
		{if $settings->contactyoutube!==''}<a title="{$lang['youtube']->value|escape}" target="_blank" href="{$settings->contactyoutube|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 22.8582,7.39283C 22.8582,5.45886 21.4356,3.9031 19.6779,3.9031C 17.2969,3.79136 14.8687,3.74838 12.389,3.74838C 12.26,3.74838 12.1311,3.74838 12.0022,3.74838C 11.8732,3.74838 11.7443,3.74838 11.6154,3.74838C 9.13988,3.74838 6.70737,3.79136 4.32645,3.9031C 2.57299,3.9031 1.15044,5.46746 1.15044,7.40143C 1.043,8.93142 0.995719,10.4614 1.00002,11.9914C 0.995719,13.5214 1.043,15.0514 1.14614,16.5856C 1.14614,18.5196 2.56869,20.0883 4.32214,20.0883C 6.82342,20.2043 9.38916,20.2559 11.9979,20.2516C 14.6109,20.2602 17.168,20.2086 19.6736,20.0883C 21.4314,20.0883 22.8539,18.5196 22.8539,16.5856C 22.957,15.0514 23.0043,13.5214 23,11.9871C 23.0086,10.4571 22.9613,8.92712 22.8582,7.39283 Z M 9.89628,16.2075L 9.89628,7.76244L 16.128,11.9828L 9.89628,16.2075 Z "/></svg></a>{/if}
		{if $settings->contactpinterest!==''}<a title="{$lang['pinterest']->value|escape}" target="_blank" href="{$settings->contactpinterest|escape}"><svg width="24" height="24" viewBox="0 0 24.00 24.00"><path fill="currentColor" d="M 12.0024,1.00011C 5.92929,1.00011 1.005,5.9244 1.005,11.9976C 1.005,16.4996 3.71509,20.3684 7.58874,22.072C 7.55928,21.3061 7.58383,20.3831 7.78021,19.5485C 7.99131,18.6549 9.19416,13.5539 9.19416,13.5539C 9.19416,13.5539 8.84068,12.8518 8.84068,11.8159C 8.84068,10.1859 9.78331,8.96834 10.9616,8.96834C 11.9632,8.96834 12.4443,9.71952 12.4443,10.618C 12.4443,11.6244 11.8011,13.1268 11.4722,14.5211C 11.1973,15.6896 12.0564,16.6371 13.2102,16.6371C 15.2919,16.6371 16.696,13.9614 16.696,10.7898C 16.696,8.37919 15.0709,6.57739 12.1203,6.57739C 8.78667,6.57739 6.70502,9.06653 6.70502,11.8454C 6.70502,12.8027 6.98976,13.4803 7.43162,14.0007C 7.63292,14.2412 7.66238,14.3394 7.58874,14.6144C 7.53473,14.8157 7.4169,15.3017 7.36289,15.4981C 7.28925,15.7779 7.06341,15.8761 6.81301,15.773C 5.27633,15.1446 4.55952,13.4655 4.55952,11.5704C 4.55952,8.44794 7.19597,4.70193 12.4198,4.70193C 16.6174,4.70193 19.3815,7.74095 19.3815,11.0009C 19.3815,15.3164 16.9808,18.5371 13.4459,18.5371C 12.2577,18.5371 11.1433,17.8939 10.7603,17.1673C 10.7603,17.1673 10.1221,19.7007 9.9846,20.1917C 9.75387,21.041 9.29726,21.8855 8.87995,22.5483C 9.86678,22.8379 10.9125,22.9999 11.9975,22.9999C 18.0707,22.9999 22.995,18.0756 22.995,12.0025C 22.9999,5.9244 18.0756,1.00011 12.0024,1.00011 Z "/></svg></a>{/if}
	</div>
{/if}

</div>
</div>
{/if}

 </div>


{include file='footer.tpl'}