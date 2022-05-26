<?php
require_once 'Database.php';
$database = new Database();
$conn = $database->con;
$sql = "SELECT * FROM `customers` ";
if ($_POST['name'] != '' && $_POST['name'] != '0') $sql.= "WHERE customerName = '{$_POST['name']}'";
$result_set = mysqli_query($conn,$sql);
$customers =array();

while ($row = mysqli_fetch_assoc($result_set)){
    $customers[] = array(
        'name'=>$row['customerName'],
        'phone'=>$row['phone'],
        'city'=>$row['city'],
        'country'=>$row['country'],
    );
}

echo json_encode(array(
    'data'=>utf8ize($customers)
));



function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}



