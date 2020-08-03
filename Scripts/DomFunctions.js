function toggleMenu(element) {
    var menu = element.parentNode.nextElementSibling;
    if(menu.classList.contains("lowResHide")) {
        menu.classList.remove("lowResHide");
    }
    else {
        menu.classList.add("lowResHide");
    }
}

window.onload = function() {

    var elts = document.getElementsByClassName("formElement");
    for(var i = 0; i < elts.length; i++) {
        if(elts[i].getElementsByTagName("input").length > 0) {
            elts[i].getElementsByTagName("input")[0].addEventListener("input", function(e) {
                var label = e.target.nextElementSibling;
                if(e.target.value === "") {
                    label.classList.remove("asFocused");
                }
                else {
                    label.classList.add("asFocused");
                }
            })
        }
    }

};