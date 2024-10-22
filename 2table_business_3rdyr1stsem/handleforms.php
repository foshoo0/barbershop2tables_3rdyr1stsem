<?php 

require_once 'dbconfig.php'; 
require_once 'models.php';

if (isset($_POST['insertBarberBtn'])) {

	$query = insertBarber($pdo, $_POST['fname'], $_POST['lname'], 
		$_POST['role_duty'], $_POST['contact_number']);

	if ($query) {
		header("Location: index.php");
	}
	else {
		echo "Insertion failed";
	}

}

if (isset($_POST['EditBarberBtn'])) {
	$query = updateBarber($pdo, $_POST['fname'], $_POST['lname'], 
		$_POST['role_duty'], $_POST['contact_number'], $_GET['barber_id']);

	if ($query) {
		header("Location: index.php");
	}

	else {
		echo "Edit failed";;
	}

}

if (isset($_POST['deleteBarberBtn'])) {
	$query = deleteBarber($pdo, $_GET['barber_id']);

	if ($query) {
		header("Location: index.php");
	}

	else {
		echo "Deletion failed";
	}
}


if (isset($_POST['insertCustomerBtn'])) {
	echo "Query";
	$query = insertCustomer($pdo, $_POST['cname'], $_POST['customer_type'],$_GET["barber_id"]);

	echo "$query";
	if ($query) {
		header("Location: customerlist.php?barber_id=" .$_GET['barber_id']);
	}
	else {
		echo "Insertion failed";
	}
}

if (isset($_POST['editCustomerBtn'])) {
	$query = updateCustomer($pdo, $_POST['cname'], $_POST['customer_type'], $_GET['customer_id']);

	if ($query) {
		header("Location: customerlist.php?barber_id=" .$_GET['barber_id']);
	}
	else {
		echo "Update failed";
	}

}

if (isset($_POST['deleteCustomerBtn'])) {
	$query = deleteCustomer($pdo, $_GET['customer_id']);

	if ($query) {
		header("Location: customerlist.php?barber_id=" .$_GET['barber_id']);
	}
	else {
		echo "Deletion failed";
	}
}

?>