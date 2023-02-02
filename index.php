<?php
include __DIR__.'/db.php';

$sql_probation = 'SELECT * FROM `user` where TIMESTAMPDIFF(YEAR, created_at, CURDATE())<2  ORDER BY first_name ASC';
$probation = $db->query($sql_probation);
while($row = $probation->fetch_assoc()){
    echo $row['id'].'  '.$row['first_name'].'<BR>';
}

echo '<BR>';

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

echo '<BR>';

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
    echo '<BR>';
    
}



?>