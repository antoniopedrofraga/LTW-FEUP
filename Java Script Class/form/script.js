var products = ['ABCD', 'DEFG'];



firstTagChild = function(element) {
	
	var nodes = document.getElementById(element).childNodes;
	
	for(var i = 0; i < nodes.length; i++)
		if(nodes[i].nodeType == 1)
			return nodes[i];
	
	return 'no tag elements';
}


firstTagChild = function(element, tagName) {
	
	var nodes = document.getElementById(element).childNodes;
	
	for(var i = 0; i < nodes.length; i++)
		if(nodes[i].tagName == tagName)
			return nodes[i];
	
	return 'no tag elements with the name ' + tagName;
}


loadDocument = function () {
	var p = firstTagChild('products', 'SELECT');
	window.alert(p);
}


window.addEventListener("click", loadDocument, false);




