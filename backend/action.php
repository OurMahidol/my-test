<?php

$servername = "localhost" ;         //Your  server
$username = "root" ;                //Your  username
$password = "" ;                    //Your  password
$dbname = "my_test" ;               //Database name
$tablename = "users_data" ;         //Table name

$conn = new mysqli($servername, $username, $password, $dbname);             //Connect with SQL.
if ($conn->connect_error) {                                                 //Check SQL connecting status.
  die("Connection failed: " . $conn->connect_error);
}else{
    $conn->set_charset("utf8");
    $request_data = json_decode(file_get_contents("php://input"));          //Recive input parameter.
    $data = array();
    if($request_data->action=='insert'){                                    //Start inserting data.
        $rawid = bin2hex(random_bytes(20));
        $params = "INSERT INTO $tablename (id, fname, lname, sex, birthdate, address, email, tel) VALUES ('$rawid', '$request_data->fname', '$request_data->lname', '$request_data->sex', '$request_data->birthdate', '$request_data->address', '$request_data->email', '$request_data->tel' )";
        if (mysqli_query($conn, $params)) {                                 //Check woking status.
            var_dump(http_response_code(200));
            $respone = array("message"=>"Insert data complete.");
            echo json_encode($respone);
        } else {
            var_dump(http_response_code(400));
            $respone = array("message"=>"Error: " . mysqli_error($conn));
            echo json_encode($respone);
        }
    }
    if($request_data->action=='getall'){                                    //Start sending data.
        $params = "SELECT id, fname, lname, sex, birthdate, address, email, tel FROM $tablename";
        $result = mysqli_query($conn, $params);
        if (mysqli_query($conn, $params)) {                                 //Check woking status.                      
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                var_dump(http_response_code(200));
                $respone = array("data"=>$data,"message"=>"get all data complete.");
                echo json_encode($data);
            }
        }else{
            var_dump(http_response_code(400));
            $respone = array("message"=>"Error: " . mysqli_error($conn));
            echo json_encode($respone);
        }
    }
    if($request_data->action=='delete'){                                    //Start removing data.
        $params = "DELETE FROM $tablename WHERE id='$request_data->id'";
        if ($conn->query($params) === TRUE) {                               //Check woking status.
            var_dump(http_response_code(200));
            $respone = array("message"=>"Delete data complete.");
            echo json_encode($respone);
        } else {
            var_dump(http_response_code(400));
            $respone = array("message"=>"Error: " . mysqli_error($conn));
            echo json_encode($respone);
        }
    }
    if($request_data->action=='edit'){                                      //Editing removing data.
        $params = "UPDATE $tablename SET fname='$request_data->fname', lname='$request_data->lname', sex='$request_data->sex', birthdate='$request_data->birthdate', address='$request_data->address', email='$request_data->email', tel='$request_data->tel' WHERE id='$request_data->id'";
        if ($conn->query($params) === TRUE) {                               //Check woking status.
            var_dump(http_response_code(200));
            $respone = array("message"=>"Edit data complete.");
            echo json_encode($respone);
        } else {
            var_dump(http_response_code(400));
            $respone = array("message"=>"Error: " . mysqli_error($conn));
            echo json_encode($respone);
        }
    }
    mysqli_close($conn);
}
?>