<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebUser
 *
 * @author parallels
 */
class WebUser extends CWebUser
{

    public $loginUrl = array("site/login");

    public function isFirstTimeUser()
    {
        $user = User::model()->findByPk($this->id);

        if ($user === null)
            return true;
        else if (empty($user->first_name))
            return true;
        else
            return false;
    }

    /**
     * @var mixed easy access to logged database user
     */
    private $_dbUser = false;

    /**
     * @return User the user record associated with the currently logged in user.
     * Null if there is no such user record (user not logged).
     */
    public function getDbUser()
    {

        if ($this->_dbUser === false) {
            $this->_dbUser = $this->isGuest ? null : User::model()->findByPk($this->id);
        }
        return $this->_dbUser;
    }

    /**
     * Returns logged user netid
     * @return string
     */
    public function getNetId()
    {
        return $this->getDbUser()->netid;
    }
    
    public function getFirst_Name()
    {
        return $this->getDbUser()->first_name;
    }

    /**
     * Checks whether the
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        if(!in_array($role, User::roles()))
        {
            return false;
        }
        $sql = "SELECT COUNT(*) FROM {$role} WHERE netid = :netId";
        $params = array(':netId' => $this->getNetId());

        if (strcmp($role, User::TYPE_COACHEE) === 0)
        {
            $sql .= " AND status=:status";
            $params[':status'] = CoachingApplication::STATUS_ACCEPTED;
        }

		return (bool) Yii::app()->db->createCommand($sql)->queryScalar($params);
    }

}

?>
