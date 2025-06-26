<?php
declare(strict_types=1);
namespace App\Models;

use App\Model;

class Transactions extends Model{
    public function addData(string $filePath){
        $fo=fopen($filePath,'r');
        if($fo){
            while (($line = fgetcsv($fo)) !== false) {
            $data[]=$line;
            } 
        }
        array_shift($data);
        foreach($data as $line){
            $date = \DateTime::createFromFormat('d/m/Y', $line[0]);
            $check = trim($line[1]);
            if ($check === '') $check = null; 
            $amount = floatval(str_replace(['$', ','], '', $line[3]));
            
            $query=$this->db->prepare('insert into transactions(date,`check`,descr,amount) values(?,?,?,?);');
            $query->execute([$date->format('Y-m-d'),$check,$line[2],$amount]);  
        }             
    }
    public function getData():array{
            $query=$this->db->prepare('select * from transactions');
            $query->execute();   
            $data=$query->fetchAll();
            return $data;
    }
    function totals(array $data):array{
    $totals=['Total'=>0,'Income'=>0,'Expense'=>0];
    foreach($data as $transact){
        $totals['Total']+=$transact['amount'];
        if($transact['amount']>=0){
            $totals['Income']+=$transact['amount'];
        }else{
            $totals['Expense']+=$transact['amount'];
        }
    }
    return $totals;
    }
}