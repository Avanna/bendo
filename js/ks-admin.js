jQuery(document).ready(function($)
{
	var templateDir = "<?php bloginfo('template_directory'); ?>/images/icon-date.gif";
	
$(".ksdate").datepicker({
    dateFormat: 'D, M d, yy',
    showOn: 'both',
    buttonImage: ks_variables['templateUrl'] + '/images/icon-date.gif',
    buttonImageOnly: true,
    numberOfMonths: 3
 
    });
});
