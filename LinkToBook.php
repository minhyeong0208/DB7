<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $db = '
    (DESCRIPTION =
        (ADDRESS LIST=
            (ADDRESS = (PROTOCOL = TCP) (HOST = 203.249.87.57) (PORT = 1521))
        )
        (CONNECT_DATA = 
        (SID = orcl)
        )
    )';

    $username="DBA2022G7";
    $password="test12345";

    $connect = oci_connect($username,$password,$db);

    if (!$connect){
        $e = oci_error();
        trigger_error(htmlentitles($e['message'],ENT_QUOTES),E_USER_ERROR);
    }

    $sql="SELECT * FROM book";

    $stid = oci_parse($connect,$sql);

    $oci_exesute($stid);

    echo "<table width='300' border='1' cellpadding='0' cellspacing='0'>\n";
    
    while ($row = $oci_fetch_array($stid,OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        foreach ($row as $item) {
            echo "  <td>" . ($item !==NULL ? htmlentitles($item,ENT_QUOTES)  : "&nbsp;") . "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";

    oci_free_statement($stid);
    oci_close($connect);

?>

</body>
</html>