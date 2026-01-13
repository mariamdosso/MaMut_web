<?php
require_once __DIR__ . '/../Models/Cash.php';

class CashController
{
    public function all()
    {
        $cash = Cash::all();
    }

    public function getById($id)
    {
        $cash = Cash::getById($id);
    }

    public function showCashList() {

    }

    public function showCashForm(){
      
    }

}   