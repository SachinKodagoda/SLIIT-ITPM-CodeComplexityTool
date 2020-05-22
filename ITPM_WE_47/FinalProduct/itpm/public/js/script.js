
selectionItem = document.getElementsByClassName("selectionItem");
for (i = 0; i < selectionItem.length; i++) {
    selectionItem[i].className = selectionItem[i].className.replace(" active", "");
}
document.getElementById("size_selected").className += " active";
document.getElementById("table_1").style.display = "block";

function openTab(evt, tabName) {
    var i, customTableInnerCover, selectionItem;
    customTableInnerCover = document.getElementsByClassName("customTableInnerCover");
    for (i = 0; i < customTableInnerCover.length; i++) {
        customTableInnerCover[i].style.display = "none";
    }
    selectionItem = document.getElementsByClassName("selectionItem");
    for (i = 0; i < selectionItem.length; i++) {
        selectionItem[i].className = selectionItem[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
    if(tabName == "table_7"){
        document.getElementById("programComplexity").style.display = "block";
    }else{
        document.getElementById("programComplexity").style.display = "none";
    }
}

function showWeightTable(){
    activeItem = document.getElementsByClassName("active")[0];
    showModal(activeItem.id);
    switch (activeItem.id) {
        case "size_selected":
            showModal("uploadModal_size");
            break;
        case "variable_selected":
            showModal("uploadModal_variable");
            break;
        case "methods_selected":
            showModal("uploadModal_methods");
            break;
        case "coupling_selected":
            showModal("uploadModal_coupling");
            break;
        case "controlStructure_selected":
            showModal("uploadModal_controlStructures");
            break;
        case "Inheritance_selected":
            showModal("uploadModal_inheritance");
            break;
        case "allFactor_selected":
            hideModal();
            break;
        default:
            break;
    }
}


function showModal(id) {
    hideModal();
    document.getElementById("uploadModalBack").style.display = "block"; 
    document.getElementById("commonModal").style.display = "block";    
    document.getElementById(id).style.display = "block";   
}

function hideModal() {
    var modalItems = document.getElementsByClassName("uploadModal");
    for (i = 0; i < modalItems.length; i++) {
        modalItems[i].style.display = "none";
    }
    document.getElementById("uploadModalBack").style.display = "none";
    document.getElementById("commonModal").style.display = "none"; 
}
reCalculate();


function reCalculate(){
    var keyword_value = document.getElementById("1_keyword_value").innerText;
    var identifier_value = document.getElementById("1_identifier_value").innerText;
    var operator_value = document.getElementById("1_operator_value").innerText;
    var numerical_value = document.getElementById("1_numerical_value").innerText;
    var string_value = document.getElementById("1_string_value").innerText;
    table = document.getElementById("table_1_inner");
}