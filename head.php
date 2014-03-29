<link rel="stylesheet" href="<?php echo  plugin_dir_url( __FILE__ ); ?>/css/main.css" />
<script type="text/javascript">
	window.acfYoutubeRead = function(key, data, height){
		var $ = jQuery;
		var input = $('input' + '[data-key=' + key + ']');
		var iframe = $('iframe[data-key=' + key + ']');
		//console.log('put into', input);
		iframe.height(height)
		var sanitized = encodeURIComponent( JSON.stringify(data) );
		input.val(sanitized).attr('value', sanitized);
	}
	window.acfYoutubeInitFrame = function(key){
		var $ = jQuery;
		var input =  $('input' + '[data-key=' + key + ']');
		var data = input.val();
		try
		{
		   data = JSON.parse(decodeURIComponent( input.val() ) )
		}
		catch(e)
		{
		   data = null;
		}
		var iframe = $('iframe[data-key=' + key + ']');
		var fd = iframe[0].contentWindow || $f[0]; // document of iframe
		fd.setupFrame('AIzaSyBUi36u48h1eFld14jwUajKKpiI61UMyDM', key, data)
	}
</script>