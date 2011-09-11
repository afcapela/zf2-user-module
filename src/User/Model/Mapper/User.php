<?php

namespace User\Model\Mapper;

use Edp\Common\DbMapper,
    User\Model\User as UserModel,
    Zend\Db\Expr;

class User extends DbMapper
{
    protected $tableName = 'user';
    protected $fields;

    public function init()
    {
        $this->fields = array('*',
            'last_ip'      => new Expr('INET_NTOA(`last_ip`)'),
            'register_ip'  => new Expr('INET_NTOA(`register_ip`)')
        );
    }

    public function getUserByEmail($email)
    {
        $db = $this->getReadAdapter();
        $sql = $db->select()
            ->from($this->getTableName(), $this->fields)
            ->where('email = ?', $email);
        $row = $db->fetchRow($sql);
        return UserModel::fromArray($row);
    }

    public function insert(UserModel $user)
    {
        $data = array(
            'user_id'       => $user->getUserId(),
            'email'         => $user->getEmail(),
            'display_name'  => $user->getDisplayName(),
            'password'      => $user->getPassword(),
            'salt'          => $user->getSalt(),
            'register_time' => new Expr('NOW()'),
            'register_ip'   => new Expr("INET_ATON('{$_SERVER['REMOTE_ADDR']}')"),
        );
        $db = $this->getWriteAdapter();
        $db->insert($this->getTableName(), $data);
        $userId = $db->lastInsertId();
        $user->setUserId($userId);
        return $user;
    }
    
    public function updateLastLogin($user)
    {
        $data = array(
            'last_login' => new Expr('NOW()'),
            'last_ip'    => new Expr("INET_ATON('{$_SERVER['REMOTE_ADDR']}')")
        );
        $db = $this->getWriteAdapter();
        return $db->update($this->getTableName(), $data, $db->quoteInto('user_id = ?', $user->getUserId()));
    }
}
