<?php
class Model_DbTable_Users extends Zend_Db_Table_Abstract
{
	protected $_name = 'users';
	
	public function findCredentials($username, $pwd)
	{
		$select = $this->select()->where('username = ?', $username)
			->where('password = ?', $this->hashPassword($pwd));
		$row = $this->fetchRow($select);
		if($row) {
			return $row;
		}
		return false;
	}

	protected function hashPassword($pwd)
	{
		return md5($pwd);
	}

}