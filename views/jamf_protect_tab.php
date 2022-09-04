<h2 data-i18n="jamf_protect.title"></h2>
<div id="jamf_protect-tab"></div>

<div id="jamf_protect-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>

<script>
$(document).on('appReady', function(){
	$.getJSON(appUrl + '/module/jamf_protect/get_data/' + serialNumber, function(data){
        // Check if we have data
        console.log(data)
	if(!data[0].protect_version && data[0].protect_version !== null && data[0].protect_version !== 0){
            $('#jamf_protect-msg').text(i18n.t('no_data'));
            $('#jamf_protect-header').removeClass('hide');

        } else {

            // Hide
            $('#jamf_protect-msg').text('');
            $('#jamf_protect-view').removeClass('hide');

            var skipThese = ['id','serial_number'];
            $.each(data, function(i,d){

                // Generate rows from data
                var rows = ''
                for (var prop in d){
                    // Skip skipThese
                    if(skipThese.indexOf(prop) == -1){
                        // Do nothing for empty values to blank them
                        if (d[prop] == '' || d[prop] == null){
                            rows = rows

                        // Format date
                        } else if((prop == "last_insights_sync" || prop == "last_check_in") && d[prop] > 0){
			    var corrected_timestamp = (parseInt(d[prop]) * 1000);
			    var date = new Date(parseInt(d[prop]));
                // var date = new Date(parseInt(d[prop])*1000);
                            rows = rows + '<tr><th>'+i18n.t('jamf_protect.'+prop)+'</th><td><span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span></td></tr>';
                        } else {
                            rows = rows + '<tr><th>'+i18n.t('jamf_protect.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                        }
                    }
                }

                $('#jamf_protect-tab')
                    .append($('<div style="max-width:600px;">')
                        .append($('<table>')
                            .addClass('table table-striped table-condensed')
                            .append($('<tbody>')
                                .append(rows))))
            })
        }
	});
});
</script>
