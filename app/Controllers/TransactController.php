<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Models\Transactions;
use App\View;
use App\Formats;
class TransactController{
    public function add():View
    {
        $filePath=STORAGE_PATH . '/' . $_FILES['transacts']['name'];
        (new Transactions())->addData($filePath);
        return View::make('index');
    }
    public function load():View{
        $formats=new Formats();
        $rawData=(new Transactions())->getData();
        $totals=(new Transactions())->totals($rawData);
        $data = array_map(function($line) use ($formats) {
        return [
            'date' => $formats->DateN($line['date']),
            'check' => $line['check'],
            'descr' => $line['descr'],
            'amount' => $formats->Amount((float)$line['amount']),
        ];
         }, $rawData);
        return View::make('transactions',['data' => $data,'totals'=>$totals]);
    }
}