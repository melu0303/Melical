<?php
include("./../connection.php");
$_PUT = getPutRequestParameters();
$id = $_PUT['id'];
$dni = getInputValue($_PUT['tramitNumber'],  ' El dni', 8, 'integer', 8);
$cuilFirstCharacters = getInputValue($_PUT['cuilFirstCharacters'], 'La primera parte del  CUIL', 2, 'integer');
$cuilLastCharacters = getInputValue($_PUT['cuilLastCharacters'],  'La ultima parte del  CUIL', 1, 'integer');
$cuil = $cuilFirstCharacters . $dni . $cuilLastCharacters;
$cuil = $_PUT['tramitNumber'];
$name = $_PUT['name'];
$surname = $_PUT['surname'];
$dateBirth = $_PUT['dateBirth'];
$gender = setSelectValue($_PUT['gender']);
$phone = $_PUT['phone'];
$email = $_PUT['email'];
$address = $_PUT['address'];
$addressNumber = $_PUT['addressNumber'];
$location =  setSelectValue($_PUT['location']);
//Revisa si ya hay un registro con los datos del paciente registrado;
$sql = "SELECT COUNT(*) AS numberOfMatches FROM `PERSONAL_INFORMATION` WHERE `tramit_nume` = ? AND ID_DNI != ?";
$typeOfParameters = "is";
$parameters = array($cuil, $id);
$result = getPreparedStatement($sql, $typeOfParameters, $parameters);
$data =  getResultOfPreparedStatement($result);
setMessageOfDuplicateRecord($data, 'un paciente');
$sql = "UPDATE PERSONAL_INFORMATION SET dni = ?, tramit_nume= ? , name= ? , surname= ?, gender = ? , date_birth = ? , phone = ? , email = ? , address = ? , address_number = ? , PK_ID_LOCATION = ? WHERE ID_DNI = ? ";
$typeOfParameters = "iissisissiis";
$parameters = array($dni, $cuil, $name, $surname, $gender, $dateBirth, $phone, $email, $address, $addressNumber, $location, $id);
$result = getPreparedStatement($sql, $typeOfParameters, $parameters);
sendJson(null, $msg, null, null, null);
