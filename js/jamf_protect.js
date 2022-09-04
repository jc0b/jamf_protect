// re-use of Tuxudo's ms_defenderTimestampToMoment in tuxudo/ms_defender
var jamf_protectTimestampToMoment = function(col, row){
    var cell = $('td:eq('+col+')', row);
    console.log(cell)
    //var checkin = parseInt(cell.text()) * 1000;
    var checkin = parseInt(cell.text());
    if (checkin > 0){
	console.log("Checkin: " +checkin);
        var date = new Date(checkin);
        cell.html('<span title="'+date+'">'+moment(date).fromNow()+'</span>');
    } else {
        cell.text("")
    }
}
