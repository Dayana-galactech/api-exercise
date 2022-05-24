<?php

require_once './utility/URLRouter.php';

URLRouter::resource('/employees', 'EmployeeController');
