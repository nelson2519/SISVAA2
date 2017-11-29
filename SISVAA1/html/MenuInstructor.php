<!DOCTYPE html>
<html>
<head>
	<title>Menú Instructor</title>
	<meta charset="utf-8">
	<style>
button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #ddd; 
}

div.panel {
    padding: 0 18px;
    display: none;
    background-color: white;
}
</style>
</head>
<body>

<h1>Menú</h1>

<form>
	<button class="accordion" type="submit" formaction="https://www.w3schools.com/tags/tag_button.asp" formtarget="_blank">Usuario</button>
	<button class="accordion" type="submit" formaction="https://www.w3schools.com/tags/tag_button.asp" formtarget="_blank">Ambiente</button>
	<button class="accordion" type="submit" formaction="https://www.w3schools.com/tags/tag_button.asp" formtarget="_blank">Ficha</button>
	<button class="accordion" type="submit" formaction="https://www.w3schools.com/tags/tag_button.asp" formtarget="_blank">Lista de Chequeo</button>
</form>
</body>
</html>