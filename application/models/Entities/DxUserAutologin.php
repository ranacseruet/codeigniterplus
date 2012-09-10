<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DxUserAutologin
 *
 * @Table(name="dx_user_autologin")
 * @Entity
 */
class DxUserAutologin
{
    /**
     * @var string $keyId
     *
     * @Column(name="key_id", type="string", length=32, nullable=false)
     * @Id
     * @GeneratedValue(strategy="NONE")
     */
    private $keyId;

    /**
     * @var integer $userId
     *
     * @Column(name="user_id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="NONE")
     */
    private $userId;

    /**
     * @var string $userAgent
     *
     * @Column(name="user_agent", type="string", length=150, nullable=false)
     */
    private $userAgent;

    /**
     * @var string $lastIp
     *
     * @Column(name="last_ip", type="string", length=40, nullable=false)
     */
    private $lastIp;

    /**
     * @var datetime $lastLogin
     *
     * @Column(name="last_login", type="datetime", nullable=false)
     */
    private $lastLogin;


    /**
     * Set keyId
     *
     * @param string $keyId
     * @return DxUserAutologin
     */
    public function setKeyId($keyId)
    {
        $this->keyId = $keyId;
        return $this;
    }

    /**
     * Get keyId
     *
     * @return string 
     */
    public function getKeyId()
    {
        return $this->keyId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return DxUserAutologin
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     * @return DxUserAutologin
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string 
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set lastIp
     *
     * @param string $lastIp
     * @return DxUserAutologin
     */
    public function setLastIp($lastIp)
    {
        $this->lastIp = $lastIp;
        return $this;
    }

    /**
     * Get lastIp
     *
     * @return string 
     */
    public function getLastIp()
    {
        return $this->lastIp;
    }

    /**
     * Set lastLogin
     *
     * @param datetime $lastLogin
     * @return DxUserAutologin
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return datetime 
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }
}