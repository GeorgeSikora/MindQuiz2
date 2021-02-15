<?php

function SQL($sql, $params = []) {

    $conn = new mysqli("localhost", "root", "", "mindQuiz2");

    $stmt = $conn->stmt_init();
    $stmt->prepare($sql);
    $typeSign = '';

    for ($i = 0; $i < count($params); $i++) {
        
        $param = $params[$i];
        $type = gettype($param);

        switch($type) {
            case 'string':  $typeSign .= 's'; break;
            case 'integer': $typeSign .= 'i'; break;
            case 'double':  $typeSign .= 'd'; break;
            case 'boolean': $typeSign .= 's'; $params[$i] = $param?'true':'false'; break;
            default: die('Špatný parametr .. ' . $type);
        }
    }

    if ($stmt->errno != null) {
        die('<br>V syntaxi SQL došlo k chybě ' . $stmt->errno . '<br>SQL: <b>' . $sql . '</b>');
    }

    if (count($params) > 0) {
        $stmt->bind_param($typeSign, ...$params);
    }

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result == null) {
        return $stmt->insert_id;
    }

    $arrayResult = array();

    while ($row = $result->fetch_assoc()) {
        array_push($arrayResult, $row);
    }

    $stmt->close();

    return $arrayResult;
}

function firstOrDefault($arr) {
    if ($arr[0] != null) {
        return $arr[0];
    }
    return null;
}

?>