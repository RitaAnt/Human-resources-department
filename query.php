<?php
include __DIR__.'/db.php'; //подключение к базе данных

$result_array = array();
    //Через свитч мы проверяем, какое радио нажато. Внутри кэйсов sql запросы и вывод
        switch($_GET['result'])
    {
        
        //Выводим людей, которые пришли в компанию 2 года назад. По ТЗ просят 3 месяца, но таких людей нет. Сделала так, чтобы показать, что я умею так делать.
        case 'Испытательный срок':

            $sql_probation = 'SELECT * FROM `user` where TIMESTAMPDIFF(YEAR, created_at, CURDATE())<2  ORDER BY first_name ASC';
            $probation = $db->query($sql_probation);

            while($row = $probation->fetch_assoc()){
                $result_array[] =  'id = '.$row['id'].'. ФИО: '.$row['first_name'].' '.$row['last_name'].' '.
                $row['middle_name'].'. День рождения: '.$row['data_of_birth'].'.'.'<br>'.'Дата поступления на работу: '.$row['created_at'].'<br>'.'<br>';
            }
            break;

        //Соединяю три таблицы, чтобы вывести уволенных людей и причины их увольнения
        case 'Уволенные':

            $sql_dismission = 
            'SELECT user.id, first_name, last_name, 
            middle_name, description
            FROM `user` JOIN `user_dismission` 
            ON user.id = user_dismission.user_id 
            JOIN `dismission_reason`
            ON user_dismission.reason_id = dismission_reason.id';
            $dismission = $db->query($sql_dismission);

            while($row = $dismission->fetch_assoc()){
                $result_array[] = 'id = '.$row['id'].'. ФИО: '.$row['first_name'].' '.$row['last_name'].' '.
                $row['middle_name'].'.'.'<br>'.'Причина увольнения: '.$row['description'].'<br>'.'<br>';
            }
            break;

        /*сначала я по айдишнику начальника нахожу его данные и вывожу их. 
        Потом я делаю запрос на людей, которые работают на этого начальника, 
        сортирую по дате приема на работу и вывожу только одного человека. 
        Так выводится только тот человек, которого последнего взяли на работе*/
        case 'Последний нанятый по отделам':

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

                $result_array[] = 'Отдел: '.$row2['description'].'<br>'.'Начальник: '.$row2['first_name'].' '.$row2['last_name'].
                ' '.$row2['middle_name'].'. '.'<br>';
            
            
                $sql_position = 
                'SELECT 
                first_name,
                last_name,
                middle_name FROM 
                `user` JOIN `user_position`     
                ON user.id = user_position.user_id
                JOIN `department`
                ON department.id = user_position.department_id
                where leader_id = '.$row1['leader_id'].' 
                order by user.created_at DESC limit 1';
                $position = $db->query($sql_position);
                $row3 = $position->fetch_assoc();

                $result_array[] = 'Последний нанятый сотрудник: '.$row3['first_name'].
                '  '.$row3['last_name'].'  '.$row3['middle_name'].'  '.$row3['description'].'<br>'.'<br>'; 
            }
            break;

            //Выводим всех людей
            case 'Все':

                $sql_userAll = 'SELECT * FROM `user`';
                $userAll = $db->query($sql_userAll);
    
                while($row = $userAll->fetch_assoc()){
                    $result_array[] =  'id = '.$row['id'].'. ФИО: '.$row['first_name'].' '.$row['last_name'].' '.
                    $row['middle_name'].'. День рождения: '.$row['data_of_birth'].'.'.'<br>'.'Дата поступления на работу: '.$row['created_at'].'<br>'.'<br>';
                }
                break;
    }
     foreach($result_array as $value){
        echo $value;
    }
    ?>