<?php

$cl = new HideAndSeek;
echo $cl->has(array("Ваня","Аня","Настя","Алена","Петя","Коля","Лена","Саша","Рома","Катя","Андрей","Максим"), 4) . "\n";


class LinkedListElem{
    public $value; 
    public $next;
}

class HideAndSeek{
    public function has(array $children, $wordCount){
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
}