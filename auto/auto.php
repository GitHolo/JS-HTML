<?php
$connection = new mysqli('localhost', 'root', '', 'auto');

if ($connection->connect_error) {
    die("Błąd połączenia z bazą danych: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand = $_POST['marka'];
    $model = $_POST['model'];
    $size = $_POST['rozmiar'];
    $fuel = $_POST['paliwo'];
    $color = $_POST['kolor'];
    $parkingS = isset($_POST['opcje']) && in_array('czujnikParkowania', $_POST['opcje']) ? 1 : 0;
    $abs = isset($_POST['opcje']) && in_array('abs', $_POST['opcje']) ? 1 : 0;
    $conditioning = isset($_POST['opcje']) && in_array('klima', $_POST['opcje']) ? 1 : 0;

    $sql = "INSERT INTO orders (brand, model, size, fuel, color, parkingS, abs, conditioning)
            VALUES ('$brand', '$model', '$size', '$fuel', '$color', '$parkingS', '$abs', '$conditioning')";

    if ($connection->query($sql) === TRUE) {
        echo "Dane zostały dodane do bazy danych.";
    } else {
        echo "Błąd: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body{
        text-align: center;
    }
</style>
<title>Formularz Samochodu</title>
</head>
<body>

<h2>Formularz Samochodu</h2>

<form action="#" method="post">
  <label for="marka">Marka:</label>
  <select id="marka" name="marka" onchange="populateModels()">
    <option value="audi">Audi</option>
    <option value="bmw">BMW</option>
    <option value="mercedes">Mercedes</option>
  </select>
  <br><br>

  <label for="model">Model:</label>
  <select id="model" name="model" onchange="populateColors()">
  </select>
  <br><br>

  <label>Rozmiar:</label><br>
  <input type="radio" id="maly" name="rozmiar" value="maly">
  <label for="maly">Mały</label><br>
  <input type="radio" id="sredni" name="rozmiar" value="sredni">
  <label for="sredni">Średni</label><br>
  <input type="radio" id="duzy" name="rozmiar" value="duzy">
  <label for="duzy">Duży</label><br><br>

  <label>Rodzaj Paliwa:</label><br>
  <input type="radio" id="benzyna" name="paliwo" value="benzyna">
  <label for="benzyna">Benzyna</label><br>
  <input type="radio" id="diesel" name="paliwo" value="diesel">
  <label for="diesel">Diesel</label><br>
  <input type="radio" id="elektryk" name="paliwo" value="elektryk">
  <label for="elektryk">Elektryk</label><br><br>

  <label for="kolor">Kolor:</label>
  <select id="kolor" name="kolor" onchange="showPreview()">
</select>
  <br><br>


  <label>Opcje Dodatkowe:</label><br>
  <input type="checkbox" id="czujnikParkowania" name="opcje[]" value="czujnikParkowania">
  <label for="czujnikParkowania">Czujnik parkowania</label><br>
  <input type="checkbox" id="abs" name="opcje[]" value="abs">
  <label for="abs">ABS</label><br>
  <input type="checkbox" id="klima" name="opcje[]" value="klima">
  <label for="klima">Klimatyzacja</label><br><br>
  
  <div id="podglad"></div>
  <br><br>

  <input type="submit" value="Wyślij">
</form>

<script>
  const modele = {
    audi: ["A1", "A3"],
    bmw: ["Seria 1", "Seria 3"],
    mercedes: ["Klasa A", "Klasa C"]
  };

  const kolory = {
    A1: ["Szary", "Niebieski", "Zółty"],
    A3: ["Czarny", "Biały", "Czerwony"],
    "Seria 1": ["Niebieski", "Biały", "Srebrny"],
    "Seria 3": ["Niebieski", "Czerwony", "Żółty"],
    "Klasa A": ["Biały", "Czarny", "Czerwony"],
    "Klasa C": ["Czarny", "Srebrny", "Biały"],
  };

  function populateModels() {
    const selectedMarka = document.getElementById("marka").value;
    const modelSelect = document.getElementById("model");
    modelSelect.innerHTML = "";

    const models = modele[selectedMarka];
    for (let i = 0; i < models.length; i++) {
      const option = document.createElement("option");
      option.text = models[i];
      modelSelect.add(option);
    }

    populateColors();
  }

  function populateColors() {
    const selectedModel = document.getElementById("model").value;
    const kolorSelect = document.getElementById("kolor");
    kolorSelect.innerHTML = ""; 

    const colors = kolory[selectedModel];
    if (colors) {
      for (let i = 0; i < colors.length; i++) {
        const option = document.createElement("option");
        option.text = colors[i];
        kolorSelect.add(option);
      }
    } else {
      const option = document.createElement("option");
      option.text = "Wybierz model";
      kolorSelect.add(option);
    }


    showPreview();
  }

  function showPreview() {
    const selectedMarka = document.getElementById("marka").value;
    const selectedModel = document.getElementById("model").value;
    const selectedKolor = document.getElementById("kolor").value;

    const imageSrc = `img/${selectedMarka.toLowerCase()}-${selectedModel.toLowerCase().replace(/\s+/g, '')}-${selectedKolor.toLowerCase().replace(/\s+/g, '')}.png`;

    const previewContainer = document.getElementById("podglad");
    previewContainer.innerHTML = ""; 
    const img = document.createElement("img");
    img.src = imageSrc;
    img.alt = "Podgląd samochodu";
    img.style.maxWidth = "300px"; 
    previewContainer.appendChild(img);
  }

  window.onload = populateModels;
</script>
</body>
</html>
