<?php

function insertBarber($pdo, $fname, $lname, 
	$role_duty, $contact_number) {

	$sql = "INSERT INTO barbers (fname, lname, 
    role_duty, contact_number) VALUES(?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$fname, $lname, 
    $role_duty, $contact_number]);

	if ($executeQuery) {
		return true;
	}
}

function getAllBarbers($pdo) {
	$sql = "SELECT * FROM barbers";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getBarberByID($pdo, $barber_id) {
	$sql = "SELECT * FROM barbers WHERE barber_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$barber_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateBarber($pdo, $fname, $lname, 
	$role_duty, $contact_number, $barber_id) {

	$sql = "UPDATE barbers
				SET fname = ?,
					lname = ?,
					role_duty = ?, 
					contact_number = ?
				WHERE barber_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$fname, $lname, 
		$role_duty, $contact_number, $barber_id]);
	
	if ($executeQuery) {
		return true;
	}

}

function deleteBarber($pdo, $barber_id) {
	$deleteBarberCus = "DELETE FROM customers WHERE barber_id = ?";
	$deleteStmt = $pdo->prepare($deleteBarberCus);
	$executeDeleteQuery = $deleteStmt->execute([$barber_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM barbers WHERE barber_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$barber_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}

function insertCustomer($pdo, $cname, $customer_type, $barber_id) {
	$sql = "INSERT INTO customers (cname, customer_type, barber_id) VALUES (?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$cname, $customer_type, $barber_id]);
	if ($executeQuery) {
		return true;
	}

}


function getCustomersByBarber($pdo, $barber_id) {
	
	$sql = "SELECT 
				customers.customer_id AS customer_id,
				customers.cname AS cname,
				customers.customer_type AS customer_type,
				customers.time_joined AS time_joined,
				CONCAT(barbers.fname,' ',barbers.lname) AS stylist
			FROM customers
			JOIN barbers ON customers.barber_id = barbers.barber_id
			WHERE customers.barber_id = ? 
			GROUP BY customers.cname;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$barber_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getCustomerByID($pdo, $customer_id) {
	$sql = "SELECT 
				customers.customer_id AS customer_id,
				customers.cname AS cname,
				customers.customer_type AS customer_type,
				customers.time_joined AS time_joined,
				CONCAT(barbers.fname,' ',barbers.lname) AS stylist
			FROM customers
			JOIN barbers ON customers.barber_id = barbers.barber_id
			WHERE customers.customer_id  = ? 
			GROUP BY customers.cname";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateCustomer($pdo, $cname, $customer_type, $customer_id) {
	$sql = "UPDATE customers
			SET cname = ?,
				customer_type = ?
			WHERE customer_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$cname, $customer_type, $customer_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteCustomer($pdo, $customer_id) {
	$sql = "DELETE FROM customers WHERE customer_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_id]);
	if ($executeQuery) {
		return true;
	}
}



?>