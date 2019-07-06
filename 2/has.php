<?php

class LinkedListElem{
    public $value; 
    public $next;
}

if ($_SERVER ['REQUEST_METHOD'] == 'POST'){
    $dataEncoded = file_get_contents('php://input');
    $data = json_decode($dataEncoded);

    $name = HideAndSeek($data->children, $data->count);

    echo json_encode(array('name'=>$name), JSON_UNESCAPED_UNICODE); 
    // второй параметр нужен для нормальной кодировки русского текста
}
else{
    echo "Not POST request.";
}

function HideAndSeek(array $children, $wordCount){
    // заполнение списка
    $root = new LinkedListElem();
    $root->value = "root";
    $first = new LinkedListElem();
    $first->value = $children[0];
    $root->next = $first;
    
    for ($i = 1; $i < count($children); $i++){
        $current = new LinkedListElem();
        $current->value = $children[$i];
        $first->next = $current;
        $current->prev = $first;
        $first = $current;
    }

    $first->next = $root->next;        
    $root->next->prev = $first;

    // выполнение поиска
    $current = $root->next; // начало списка
    $wordCountTemp = $wordCount;
    while ($current != null){
        if ($current->value == $current->next->value){
            return $current->value;
        }

        if ($wordCountTemp == 2){
            $current->next = $current->next->next; // удаление
            $wordCountTemp = $wordCount;
        }
        else{
            $wordCountTemp--;
        }
        $current = $current->next; // переход к следующему элементу
    }

    return 'error';
}