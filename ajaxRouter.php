<?php
require_once 'classes/DB.php';

$dataTable = DB::getInstance();

$dataTable->join('customers', 'cars', array(
    'cars' => array(
        'type_car',
    ),
    'customers' => array(
        'first_name',
        'last_name',
        'age',
        'email',
        'mobile_number',
        'pay_method',
        'car_id',
    ),
));

$result = array('pages' => $dataTable->totalPages(), 'perPage' => $dataTable->perPage(), 'pageNumber' => $dataTable->activePage(), 'DataTable' => $dataTable->results());
echo json_encode($result);



