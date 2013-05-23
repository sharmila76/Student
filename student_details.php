<?php
$open = fopen('student_details.csv', "r") or die('Could not open');
while (($datas = fgetcsv($open)) !== FALSE) {
    $details[$datas[0]] = array('name' => $datas[1], 'tamil' => $datas[2], 'english' => $datas[3], 'maths' => $datas[4]);
}
//print_r($details);
print 'Enter student roll number to get total marks : ';
fscanf(STDIN, "%d", $number);
if(array_key_exists($number, $details)) {
    get_total_marks($number,$details);
    print 'Total mark is : '.$number."\n";
    $average = $number/3;
    print 'Average is : '.$average."\n";
    if(round($average) > 50) 
        print 'Student status : PASS'."\n";
    else
        print 'Student status : FAIL'."\n";
}
else {
    print 'Please Enter correct roll number'."\n";
    return;
}
//print 'List of tamil failed student';
if($tamil_failed_student = failed_student($details, $subject = 'tamil')) {
    print 'Failed students in Tamil : '.count($tamil_failed_student)."\n";
    print_r($tamil_failed_student);
    $tamil_average = (count($tamil_failed_student)/count($details))*100;
    print 'Average : '.$tamil_average."\n";
    print "\n";
}
 else {
    print 'All students pass in tamil'."\n";
}
if($english_failed_student = failed_student($details, $subject = 'english')) {
    print 'Failed students in English : '.count($english_failed_student)."\n";
    print_r($english_failed_student);
    $english_average = (count($english_failed_student)/count($details))*100;
    print 'Average : '.$english_average."\n";
    print "\n";
}
 else {
    print 'All students pass in english'."\n";
}
if($maths_failed_student = failed_student($details, $subject = 'maths')) {
    print 'Failed students in Maths : '.count($maths_failed_student)."\n";
    print_r($maths_failed_student);
    $maths_average = (count($maths_failed_student)/count($details))*100;
    print 'Average : '.$maths_average."\n";
    print "\n";
}
 else {
    print 'All students pass in maths'."\n";
}
number_of_pass($details, $pass);
print 'TOTAL NUMBER OF STUDENTS IN THE LIST : '.count($details)."\n";
print 'TOTAL NUMBER OF PASS : '.$pass."\n";
if($pass != 0) {
    print 'TOTAL NUMBER OF FAIL : '.(count($details) - $pass)."\n";
}
 else {
    print 'TOTAL NUMBER OF FAIL : '.count($details)."\n";
}    

function get_total_marks(&$number,$details) {
    $number = $details[$number]['tamil']+$details[$number]['english']+$details[$number]['maths'];
    return $number;
}

function failed_student($details, $subject) {
    $failed_student = array();
    for($i=1; $i<=count($details); $i++) {
        if(35>=$details[$i][$subject]) {
            $failed_student[$i] = $details[$i]['name'];
        }
    }
    if($failed_student == 0) {
        return FALSE;
    }
    else
    return $failed_student;
}

function number_of_pass($details, &$pass) {
    $pass = 0;
    for($i=1; $i<=count($details); $i++) {
        if(35 >= $details[$i]['tamil'] && $details[$i]['english'] && $details[$i]['maths']) {
            $pass = $pass + 1;
        }
    }
    return $pass;
}

?>


