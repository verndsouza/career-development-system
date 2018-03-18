var majors = Object();
majors['Arts'] = 'Commercial Advertising|Digital Arts|Game & Interactive Media Design|Graphic Design|Technical Writing';
majors['Business Administration'] = 'Family Business|Finance|Operations|Stastics|Stratergy';
majors['Commerce'] = 'Accounting|Actural Studies|Economics|Marketing|Statistics';
majors['Engineering'] = 'Computer Engineering|Electronics & Telecommunication Engineering|Engineering Management|Mechanical Engineering|Systems Enginerring';
majors['Science'] = 'Business Analytics|Computer Science|Data Science|Data Science|Information Systems|Physics';

function set_major(oStreamidSel, oMajorSel)
{
	var countryArr;
	oMajorSel.length = 0;
	var streamid = oStreamidSel.options[oStreamidSel.selectedIndex].text;
	if (majors[streamid])
	{
		oMajorSel.disabled = false;
		oMajorSel.options[0] = new Option('Select Majors','');
		countryArr = majors[streamid].split('|');
		for (var i = 0; i < countryArr.length; i++)
			oMajorSel.options[i + 1] = new Option(countryArr[i], countryArr[i]);
	}
	else oMajorSel.disabled = true;
}

var i = 0;


function addInput() {
    var original = document.getElementById('dynamicInput');
    var clone = original.cloneNode(true);
    clone.id = "duplicater" + ++i;
    original.parentNode.appendChild(clone);
}