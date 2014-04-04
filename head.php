<link rel="stylesheet" href="<?php echo  plugin_dir_url( __FILE__ ); ?>/css/main.css" />
<script type="text/javascript">
window.acfYoutubeInit = function(iframe){
	var $ = jQuery,
	input = $(iframe).siblings('input'),
	target = iframe.contentWindow.ntYoutubeFetch,
	sanitized;
	target.callback = function(data){
		var sanitized = encodeURIComponent( JSON.stringify(data) );
		input.val(sanitized);
		$(iframe).height(target.getHeight());
	}
	target.APIKey = 'AIzaSyBUi36u48h1eFld14jwUajKKpiI61UMyDM';
	try
	  {
	  sanitized = JSON.parse(decodeURIComponent(input.val()));
	  }
	catch(err)
	  {
	  	console.log('error', err, input.val(), 'x');
	  sanitized = '';
	  }
	target.r = sanitized;
	window.t = target;
	target.$apply();//FIXME: smells like a kludge.
	$(iframe).height(target.getHeight());
}

</script>