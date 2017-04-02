 
<?php
$serverName = "SQL5028";   
$uid = "DB_A12A6F_mer_admin";     
$pwd = "UmmanBey123";    
$databaseName = "DB_A12A6F_mer";   

$CustomerId = $_POST["CustomerId"];
$CustomerId = intval($CustomerId);

$TechId = $_POST["TechnicianId"];
$TechId = intval($TechId);

$TaskId = $_POST["TaskId"];
$TaskId = intval($TaskId);

$InvTotal = $_POST["TotalofInvoice"];
$InvTotal = floatval($InvTotal);

echo $InvTotal;

if ($InvTotal>0){

        echo $_POST["TaskId"];

        $TotalLineNumber = $_POST['CurrentLineNumber'];
        $TotalLineNumber = intval($TotalLineNumber);

   
        $connectionInfo = array( "UID"=>$uid,                              
                                 "PWD"=>$pwd,                              
                                 "Database"=>$databaseName);   
    
        /* Connect using SQL Server Authentication. */    
        $connection = sqlsrv_connect( $serverName, $connectionInfo);    

        if( $connection ) {
             echo "Connection established.<br />";
        }else{
             echo "Connection could not be established.<br />";
             die( print_r( sqlsrv_errors(), true));
        }
    
        $sqlInsertInvMain = "INSERT INTO INVMAIN (invDate,custId,techId,taskId,invTotal) VALUES (?,?,?,?,?)";
        $params = array(date('m-d-Y'),$CustomerId,$TechId,$TaskId,$InvTotal);
        $sqlComandInsertInvMain= sqlsrv_query( $connection, $sqlInsertInvMain, $params);


        if ($sqlComandInsertInvMain == false){
           if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }
            echo 'problem1';
        }

        $sqlSelectInvMain = "SELECT @@identity AS id";
    
        $sqlComandSelectInvMain = sqlsrv_query( $connection, $sqlSelectInvMain);
        $row = sqlsrv_fetch_array( $sqlComandSelectInvMain, SQLSRV_FETCH_ASSOC);  
        $CurrentInvId= $row['id']."\n";  
        $CurrentInvId = intval($CurrentInvId);

        /*$sqlDeleteInvoices = "DELETE FROM INVOICES WHERE invId=0";
        sqlsrv_query( $connection, $sqlDeleteInvoices);*/

        echo $CurrentInvId;

        for ($i = 1; $i <= $TotalLineNumber; $i++) {
            $sqlInsertInvDetails = "INSERT INTO INVOICES (invId,prodId,prodName,prodPrice,prodQty,prodTotal) VALUES (?,?,?,?,?,?)";
            $prodId = $_POST["ProdId"."$i"];
            $prodName = $_POST["ProdName"."$i"];
            $prodPrice = $_POST["ProdPrice"."$i"];
            $prodQty = $_POST["ProdQty"."$i"];
            $LineTotal = $_POST["LineTotal"."$i"];
            $params = array($CurrentInvId,$prodId,$prodName,$prodPrice,$prodQty,$LineTotal);
            $sqlComandInsertInvDetails= sqlsrv_query( $connection, $sqlInsertInvDetails, $params);

        }


        if ($sqlComandInsertInvDetails == false){
           if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }
            echo 'problem with database operation while adding invoice details(items)!';
        }

        $sqlSelectTask = "SELECT * FROM Task WHERE Task.Id=?";
        $params = array($TaskId);
        $sqlComandUpdateTask= sqlsrv_query( $connection, $sqlSelectTask, $params);

        if ($sqlComandUpdateTask == false){
           if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }
            echo 'problem with database operation while selecting Task';
        }


        $sqlUpdateTask = "UPDATE Task SET InvoiceId=?";
        $params = array($CurrentInvId);
        $sqlComandUpdateTask= sqlsrv_query( $connection, $sqlUpdateTask, $params);


        if ($sqlComandUpdateTask == false){
           if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }
            echo 'problem with database operation while adding updating Task(Inv ID)!';
        }




        /* Free statement and connection resources. */    
        //sqlsrv_free_stmt( $sqlComandInsertInvMain);
        //sqlsrv_free_stmt( $$sqlInsertInvDetails);
        sqlsrv_close( $connection);
        
} else {
}   
header("Location: http://meridian.kudsituluoglu.net/members/Invoices/Invoices");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
     <p id="msg"></p>  
   
    </body>
</html>