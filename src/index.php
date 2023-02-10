<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=500, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <title>HRD</title>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" 
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" 
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/radio.js"></script>
    <script type="text/javascript" src="js/button.js"></script>
</head>
<body>

<div class="h1">
<h1>Отдел кадров</h1>
</div>

<!---Форма с кнопками--->
<form id="ButtonForm" method="GET" name="FORM_NAME">
	<input type="button" name="HR_button" value="Испытательный срок">

	<input type="button" name="HR_button" value="Уволенные">

	<input type="button" name="HR_button" value="Последний нанятый по отделам" >

    <input type="button" name="HR_button" value="Все">
</form>

<div id="result_print_block">
<div id="result_print">
Нажмите на кнопку или выбирете радио, чтобы увидеть результат.
</div>
</div>

<!---Форма с радио--->
<form id="RadioForm" method="GET" name="FORM_NAME">
	<input type="radio" name="HR_radio" value="Испытательный срок">

	<input type="radio" name="HR_radio" value="Уволенные" >

	<input type="radio" name="HR_radio" value="Последний нанятый по отделам" >

    	<input type="radio" name="HR_radio" value="Все">
</form>

</body>
</html> 
