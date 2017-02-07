<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 7.2.17
 * Time: 11:38
 */


use Cundd\Processor\Processor;
use Iresults\Core\DataObject;

$processor = new Processor();

$processor
    ->process(
        'map',
        function (DataObject $row) {

            $newRow = clone($row);
            $newRow['tstamp'] = strtotime($row['tstamp']);
            $newRow['crdate'] = strtotime($row['crdate']);
            $newRow['gender'] = $row['gender'] === 'männlich' ? 'm' : ($row['gender'] === 'weiblich' ? 'f' : '');
            $newRow['hidden'] = $row['hidden'] === 'Ja' ? 1 : 0;

            return $newRow;
        }
    )
//    ->process(
//        'array.slice',
//
//          [  0,1],
//          [  0,1]
//    )
//    ->process(
//        'array.unshift',
//        [
//            new \Cundd\Processor\Argument\Argument(
//                function () {
//                    return 'ff';
//                }
//            ),
//        ]
//    )
    ->process(
        'array.unshift',
        [
            new \Cundd\Processor\Argument\ComputedArgument(
                function (\Cundd\Collection $input) {
                    /** @var DataObject $firstElement */
                    $firstElement = $input[0];

                    return new DataObject(array_keys($firstElement->toArray()));
                }
            ),
        ]
    )
    ->process(
        'map',
        function (DataObject $row) {
            $mem = fopen('php://memory', 'r+');
            fputcsv($mem, $row->toArray());
            rewind($mem);

            return trim(stream_get_contents($mem));
        }
    )
    ->process('implode', [PHP_EOL])
    ->process('io.write', 'output.csv')
    ->process('print');


$processor->run($data);

//var_dump($processor->getLastOutput());