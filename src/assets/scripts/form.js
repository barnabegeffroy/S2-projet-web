function openForm(id) {
    document.getElementById(id).style.display = "block";
}

function closeForm(id) {
    document.getElementById(id).style.display = "none";
}

function change(name, value) {
    document.getElementById(name).setAttribute('value', value);
}