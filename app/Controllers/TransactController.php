<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Models\Transactions;
use App\View;

class TransactController{
    public function add()
    {
        $filePath=STORAGE_PATH . '/' . $_FILES['transacts']['name'];
        (new Transactions())->addData($filePath);
    }
    public function load():View{
        return View::make('transactions');
    }
}