const rightDiv = document.getElementById('right');
const imgElement = document.getElementById('img');
const czcionkaInput = document.getElementById('czcionka');
const listSelect = document.getElementById('list');
const boxCheckbox = document.getElementById('box');
const radioButtons = document.getElementsByName('punktor');

function changeBackgroundColor(color) {
    rightDiv.style.backgroundColor = color;
}

function changeFontColor() {
    const selectedColor = listSelect.value;
    rightDiv.style.color = selectedColor;
}

function changeFontSize() {
    const fontSize = czcionkaInput.value;
    rightDiv.style.fontSize = fontSize;
}

function changeBorder() {
    const borderStyle = boxCheckbox.checked ? '1px solid white' : 'none';
    imgElement.style.border = borderStyle;
}

function change_to_indigo() {
    changeBackgroundColor('indigo');
}

function change_to_steelblue() {
    changeBackgroundColor('steelblue');
}

function change_to_olive() {
    changeBackgroundColor('olive');
}

function change_font_color() {
    changeFontColor();
}

function change_size() {
    changeFontSize();
}

function change_border() {
    changeBorder();
}


change_to_indigo();
changeFontColor();
changeFontSize();
changeBorder();
radio('dysk');
