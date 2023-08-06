<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/Session.php');
include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../helpers/Format.php');
class Admin
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
	}
	public function getAdminData($data)
	{
		$adminUser = ($data['adminUser']);
		$adminPass = ($data['adminPass']);

		$query = "select * from admin where adminUser = '$adminUser' and adminPass = '$adminPass'";
		$result = $this->db->select($query);
		if ($result != false) {
			$value = $result->fetch_assoc();
			Session::init();
			Session::set("adminLogin", true);
			Session::init("adminUser", $value['adminUser']);
			Session::init("adminId", $value['adminId']);
			header("Location:index.php");

		} else {
			$msg = "<span class='error'>Username/Password Not Matched!!!!</span>";
			return $msg;
		}

	}
}
?>