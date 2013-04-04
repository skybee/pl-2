//if(window.location.hash === '#test_bg') {
	var evoLoggerCount = 0;
	
	/*var originalFunction = document.createElement;
	document.createElement = function(tag, attributes) {
	    var element = originalFunction.call(document, tag);
	
	    if (attributes) {
	        for (var attribute in attributes) {
	            element.setAttribute(attribute, attributes[attribute]);
	        }
	    }
	    
	    return element;
	};*/
	
	var originalWriteFunction = document.write;
	
	document.write = function(text) {
		var element = originalWriteFunction.call(document, text);
		
		if(text.indexOf('http://go.evolutionmedia.bbelements.com/please/showit/0/0/0/1/?typkodu=js&one2n1=/17849/') !== -1) {
			evoLoggerCount++;
		}
		
		return element;
	};
	
	var sendEvoUrl = function sendEvoUrl() {
		$.ajax({
			url: 'http://poland.lh?cron=1&task=evoTrigger',
			type: 'POST',
			data: {
				url: window.location.href
			}
		});
	};
	
	var evoTriggerProbes = 0;
	var ele;
	var evoTrigger = function evoTrigger() {
		try {
			if(evoLoggerCount === 0) {
				if(evoTriggerProbes === 40) {
					if(ele === undefined) {
						var ele = $('<div id="adright">&nbsp;</div>');
						
						$(document.body).append(ele);
					}
					
					setTimeout(function() {
						if(ele.height() !== 0) {
							sendEvoUrl();
						}
					}, 2000);
				} else {
					evoTriggerProbes++;
					setTimeout(function() {
						evoTrigger();
					}, 1000);
				}
			}
		} catch(err) {
			console.log(err);
		}
		
	};
	
	setTimeout(evoTrigger, 5000);
	
//}

