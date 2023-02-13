<?php
class like_model extends main_model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function addRecord($datas)
	{
        parent::addRecord($datas);
	}

	// public function getRecordUser($fields = '*', $options = null)
	// {
	// 	$conditions = '';
	// 	if (isset($options)) {
	// 		$conditions .= ' and ' . $options;
	// 	}
	// 	$query = "SELECT $fields FROM users INNER JOIN $this->table ON $this->table.user_id = users.id" . $conditions;
	// 	$result = mysqli_query($this->con, $query);
	// 	$result = $result->fetch_all(MYSQLI_ASSOC);
	// 	//$record = mysqli_fetch_all($result);
	// 	//echo "<pre>";
	// 	//var_dump($result); exit();
	// 	return $result;
	// }
}
