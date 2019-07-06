<?php
// Алгоритм: идём с начала массива, для каждого элемента пытаемся найти пару, с которой потери будут минимальны, среди оставшихся элементов. Фактически происходит полный перебор всех решений.

$cl = new ResaleCalculator;
echo $cl->calculateLowestLoss(array(210, 130, 50, 175, 100)) . "\n";

class ResaleCalculator{
    const MAX_VALUE = 100000000; // необходимо для поиска минимальных элементов. Если входные данные содержат большие значения, необходимо изменить данную константу.

    public function calculateLowestLoss($input){   
        if (count($input) < 2){ // обработка слишком короткой длины входного массива
            return -1;
        }   
        $min = ResaleCalculator::MAX_VALUE; // общее минимальное значение потерь
        for ($i = 0; $i < count($input); $i++) {
            $localMin = ResaleCalculator::MAX_VALUE + 1; // минимальное значение потерь при проходе
            for ($j = $i + 1; $j < count($input); $j++) {
                $delta = $input[$i] - $input[$j];
                if ($delta >= 0){
                    if ($delta < $localMin){
                        $localMin = $delta;
                    }
                }
            }
            if ($localMin < $min){
                $min = $localMin;
            }
        }
        // в случае возрастающего набора данных ответа не существует
        if ($min == ResaleCalculator::MAX_VALUE){ 
            $min = -1;
        }
        return $min;
    }
}