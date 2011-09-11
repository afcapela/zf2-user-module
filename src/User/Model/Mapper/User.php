<?php

namespace User\Model\Mapper;

use Edp\Common\DbMapper,
    User\Model\User as UserModel,
    Zend\Db\Expr;

class User extends DbMapper
{
    protected $tableName = 'user';

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
}
