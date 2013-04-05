var sendPemantuan = function sendEvoUrl(details) {
	$.ajax({
		url: 'http://pl-2.lh?job=pemantuan',
		type: 'POST',
		data: {
			indicator_id: 1,
			value: details.contentLoaded
		}
	});
};

window.addEventListener('perf', function(perf) {
	sendPemantuan(perf.detail);
})
