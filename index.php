<?php
include __DIR__.'/db.php'; //подключение к базе данных

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=ё, initial-scale=1.0">
    <title>HRD</title>
</head>
<body>
    <h1>Отдел кадров</h1>

<!---Форма с радио--->
<form action="" method="GET" name="FORM_NAME">
	<input type="radio" name="HR_print" value="probation" onClick="FORM_NAME.submit()" <?php
		if (!empty($_GET['HR_print']) and $_GET['HR_print'] === 'probation') {
			echo 'checked';
		}
	?>>
    <label for = "probation"> Испытательный срок </label>
	<input type="radio" name="HR_print" value="dismission" onClick="FORM_NAME.submit()"<?php
		if (!empty($_GET['HR_print']) and $_GET['HR_print'] === 'dismission') {
			echo 'checked';
		}
	?>>
    <label for = "dismission"> Уволенные </label>
	<input type="radio" name="HR_print" value="leaders" onClick="FORM_NAME.submit()"<?php
		if (!empty($_GET['HR_print']) and $_GET['HR_print'] === 'leaders') {
			echo 'checked';
		}
	?>>
    <label for = "leaders"> Последний нанятый по отделам </label>


<!---Через свитч мы проверяем, какое радио нажато. Внутри кэйсов sql запросы и вывод--->
    <?php
        switch( $_GET['HR_print'] )
    {
        case 'probation':
            $sql_probation = 'SELECT * FROM `user` where TIMESTAMPDIFF(YEAR, created_at, CURDATE())<2  ORDER BY first_name ASC';
            $probation = $db->query($sql_probation);
            while($row = $probation->fetch_assoc()){
                echo $row['id'].'  '.$row['first_name'].'<BR>';
            }
            break;

        case 'dismission':
            $sql_dismission = 
            'SELECT first_name, last_name, description 
            FROM `user` JOIN `user_dismission` 
            ON user.id = user_dismission.user_id 
            JOIN `dismission_reason`
            ON user_dismission.reason_id = dismission_reason.id';
            
            $dismission = $db->query($sql_dismission);
            while($row = $dismission->fetch_assoc()){
                echo $row['first_name'].'  '.$row['last_name'].'  '.$row['description'].'<BR>';
            }
            break;

        case 'leaders':
            $sql_leaders = 'SELECT leader_id FROM `department`';
            $leaders = $db->query($sql_leaders);
            while($row1 = $leaders->fetch_assoc()){
                $sql_leaders_name = 
                'SELECT 
                first_name,
                last_name,
                middle_name,
                description
                FROM 
                `user` JOIN `user_position` 
                ON user.id = user_position.user_id
                JOIN `department`
                ON department.id = user_position.department_id
                where leader_id = position_id
                AND leader_id ='.$row1['leader_id'];
                $leader_name = $db->query($sql_leaders_name);
                $row2 = $leader_name->fetch_assoc();
                echo 'Начальник: '.$row2['first_name'].'  '.$row2['last_name'].'  '.$row2['middle_name'].'  '.$row2['description'].'<BR>';
            
            
                $sql_position = 
                'SELECT 
                first_name,
                last_name,
                middle_name,
                description, 
                user_position.created_at FROM 
                `user` JOIN `user_position`     
                ON user.id = user_position.user_id
                JOIN `department`
                ON department.id = user_position.department_id
                where leader_id = '.$row1['leader_id'].' 
                order by user.created_at DESC limit 1';
                $position = $db->query($sql_position);
                $row3 = $position->fetch_assoc();
                echo 'Последний нанятый работник: '.$row3['first_name'].'  '.$row3['last_name'].'  '.$row3['middle_name'].'  '.$row3['description'].'  '.$row3['user_position.created_at'].'<BR>'; 
            }
            break;
    }
    ?>
</form>
</body>
</html>