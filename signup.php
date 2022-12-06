<?php
// 데이터베이스에서 가져온 아이디가 중복값이 있을때 체크하는 php
// 또한 아이디나 비밀번호에 빈칸이 들어올때 반환함
// 회원가입때 쓰는 php
$db = '
(DESCRIPTION =
    (ADDRESS_LIST=
        (ADDRESS = (PROTOCOL = TCP) (HOST = 203.249.87.57) (PORT = 1521))
    )
    (CONNECT_DATA =
    (SID = orcl)
        )
)';
$username = "DBA2022G7";
$password = "test12345";
$conn = oci_connect($username,$password,$db);

$userid = $_POST['id'];
$userpw = $_POST['password'];
$username = $_POST['username'];
$usercategory = $_POST['category'];

if ( (empty($userid) || empty($userpw) )) {
        echo "<script>alert('아이디나 패스워드를 입력하세요.');history.back();</script>";
}
$sql = "select MEMBERNUMBER from member12 where MEMBERID = '$userid'";
$stid = oci_parse($conn,$sql);
oci_execute($stid);

$id_check = oci_fetch_array($stid,OCI_ASSOC);

if($id_check > 0) {
        echo "<script> alert ('중복된 아이디입니다.'); </script>";
        echo "<script> history.back(); </script>";
}
else {
        $sql = "insert into member(MEMBERID,MEMBERPASSWORD,CATEGORY,MEMBERNAME) values ('$userid','$userpw','$usercategory','$username')";
        $stid = oci_parse($conn,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conn);
        echo "<script> alert ('회원가입이 완료되었습니다.'); </script>";

}
?>
