<?php
require_once __DIR__ . '/../Models/Payment.php';

class PaymentController
{
    public function all()
    {
        $payments = Payment::all();
    }   

    public function getById($id)    
    {
        $payment = Payment::getById($id);
    }
}