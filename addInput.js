var i = 0;


function addInput() {
    var original = document.getElementById('dynamicInput');
    var clone = original.cloneNode(true);
    clone.id = "duplicater" + ++i;
    original.parentNode.appendChild(clone);
}