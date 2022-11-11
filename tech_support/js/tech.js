<!-- Jayden Cooper 11/02/2022, Ben Yuter 11/02/2022, John Giaquinto 11/10/2022 -->
function viewAddSection() {
    let view = document.getElementsByClassName("viewTable"); // Hide every element in the viewTable class
    for(let i = 0; i < view.length; i++){
        view[i].style.display = "none";
    }
    let add = document.getElementsByClassName("addForm"); // View every element in the addForm class
    for(let i = 0; i < add.length; i++){
        add[i].style.display = "block";
    }
}


function hideAddSection() {
    let view = document.getElementsByClassName("viewTable"); // View every element in the viewTable class
    for(let i = 0; i < view.length; i++){
        view[i].style.display = "block";
    }
    let add = document.getElementsByClassName("addForm"); // Hide every element in the addForm class
    for(let i = 0; i < add.length; i++){
        add[i].style.display = "none";
    }
}
