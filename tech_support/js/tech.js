function viewAddSection() {
    var view = document.getElementsByClassName("viewTable");
    for(var i = 0; i < view.length; i++){
        view[i].style.display = "none";
    }
    var add = document.getElementsByClassName("addForm");
    for(var i = 0; i < add.length; i++){
        add[i].style.display = "block";
    }
}


function hideAddSection() {
    var view = document.getElementsByClassName("viewTable");
    for(var i = 0; i < view.length; i++){
        view[i].style.display = "block";
    }
    var add = document.getElementsByClassName("addForm");
    for(var i = 0; i < add.length; i++){
        add[i].style.display = "none";
    }
}
