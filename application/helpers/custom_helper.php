<?php

/**
 * @author  PrensDev & Bandroite
 */ 

// TO MONEY NOTATION FORMAT FUNCTION
function toMoneyNotationFormat(Float $money) {
    if ($money < 1000) {
        $styledMoney =  number_format($money, 1, '.', '');
    } else if ($money < 1000000) {
        $styledMoney =  number_format($money / 1000, 1, '.', '') . 'K';
    } else if ($money < 1000000000) {
        $styledMoney =  number_format($money / 1000000, 1, '.', '') . 'M';
    } else if ($money < 1000000000000) {
        $styledMoney =  number_format($money / 1000000000, 1, '.', '') . 'B';
    } else if ($money < 1000000000000000) {
        $styledMoney =  number_format($money / 1000000000000, 1, '.', '') . 'T';
    }
    return '&#8369;' . $styledMoney;
}

// SALARY RANGE FORMAT FUNCTION
function salaryRangeFormat(Float $minSalary, Float $maxSalary) {
    return toMoneyNotationFormat($minSalary) . ' - ' . toMoneyNotationFormat($maxSalary);
}

// GET JOB TYPE CLASS FUNCTION
function getJobTypeClass(String $jobType) {
    $jobTypeClasses = [
        'Full Time'     => 'success',
        'Part Time'     => 'info',
        'Intern/OJT'    => 'warning',
        'Temporary'     => 'secondary'
    ];
    return $jobTypeClasses[$jobType];
}

// DATE FORMAT FUNCTION
function dateFormat(String $date, String $format) {
    return date_format(date_create($date), $format);
}