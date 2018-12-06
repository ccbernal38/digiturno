require('./bootstrap');

Echo.channel('turn-channel').listen('TurnWasReceived', (data) => {
	var turno  = data.turno;
	var modulo = data.modulo.nombreVisible;

	for (var i = 0; i < 5; i++) {
		var h3Turno = $("#turno"+i+" h3").text();
		var h3Modulo = $("#modulo"+i+" h3").text();
		if(h3Turno == turno || modulo == h3Modulo){
			$("#turno"+i+" h3").text("");
			$("#modulo"+i+" h3").text("");
			continue;
		}
	}
	for (var j = 0; j < 5; j++) {
		var h3Turno = $("#turno" + j + " h3");
		var h3Modulo = $("#modulo" + j + " h3");
		if (isEmpty(h3Turno)) {
			h3Turno.text(data.turno);
			h3Modulo.text(data.modulo.nombreVisible);
			$("#row" + j).addClass('animated tada infinite');
			document.getElementById("buzzer").play();
			wait(60 * 1000, h3Turno, h3Modulo);
			stopAnimation(5 * 1000, $("#row" + j));
			break;
		} else {
			continue;
		}
	}
});

