<?php
require_once 'H:\inetpub\lib\sqlsrvLibFL.php';
ini_set("error_log", "./Alog/getMDServiceError.txt");
$handle = connectDB_FL();
$fp = fopen("./Alog/getAdmins.txt", "a+"); $todayString =  date('Y-m-d H:i:s'); fwrite($fp, "\r\n $todayString");
   
    $selStr = "SELECT p.id, p.physicianID, p.adminID, p.noticeType, p.active,p.noticeType, b.lastName, b.id, pn.userKey FROM en_PhysicianAdminManager p LEFT JOIN en_AdminsForPhysicians b on p.physicianID = b.id
    LEFT JOIN en_PhysiciansWithAdmins pn on p.physicianID = pn.id
   WHERE p.active = 1 and p.noticeType='routine'";
   
    fwrite($fp, "\r\n $selStr");
    $dB = new getDBData($selStr, $handle);
    $i = 1;
    while ($assoc = $dB->getAssoc())
        $row[$assoc['userKey']] = $assoc;
  //  sort($row);    
    $jData = json_encode($row);
    echo $jData;    
?>