<?php

require_once('MailCSV.php');

$csvData = array(
    array('ID', 'Company', 'Name', 'Email'),
    array(1,'testCompany1', 'testName1','test1@email.com'),
    array(2,'testCompany2', 'testName2','test2@email.com'),
    array(3,'testCompany3', 'testName3','test3@email.com'),
    array(4,'testCompany4', 'testName4','test4@email.com'),
    array(4,'testCompany5', 'testName5','test5@email.com'),
);
$address = 'yelpcampdeveloper@gmail.com';
$from = 'yelpcampdeveloper@gmail.com';
$subject = 'Website report';
$body = '<p>This is automatic report message</p>';


$mailCSV = new MailCSV();
$result = $mailCSV->sendCSVEmail($csvData, $address, $from, $subject, $body);

echo $result ? 'message sent' : 'message not sent';


