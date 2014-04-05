<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DxUsers
 *
 * @Table(name="dx_users")
 * @Entity
 */
class DxUsers
{
    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $username
     *
     * @Column(name="username", type="string", length=25, nullable=false)
     */
    private $username;

    /**
     * @var string $password
     *
     * @Column(name="password", type="string", length=34, nullable=false)
     */
    private $password;

    /**
     * @var string $email
     *
     * @Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var boolean $banned
     *
     * @Column(name="banned", type="boolean", nullable=false)
     */
    private $banned;

    /**
     * @var string $banReason
     *
     * @Column(name="ban_reason", type="string", length=255, nullable=true)
     */
    private $banReason;

    /**
     * @var string $newpass
     *
     * @Column(name="newpass", type="string", length=34, nullable=true)
     */
    private $newpass;

    /**
     * @var string $newpassKey
     *
     * @Column(name="newpass_key", type="string", length=32, nullable=true)
     */
    private $newpassKey;

    /**
     * @var datetime $newpassTime
     *
     * @Column(name="newpass_time", type="datetime", nullable=true)
     */
    private $newpassTime;

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
     * @var datetime $created
     *
     * @Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var datetime $modified
     *
     * @Column(name="modified", type="datetime", nullable=false)
     */
    private $modified;

    /**
     * @var string $fbSession
     *
     * @Column(name="fb_session", type="string", length=1000, nullable=true)
     */
    private $fbSession;
    
    /**
     * @var string $fbId
     *
     * @Column(name="fb_id", type="bigint", nullable=true)
     */
    private $fbId;
    
    /**
     * @var string $twitterSession
     *
     * @Column(name="twitter_session", type="string", length=1000, nullable=true)
     */
    private $twitterSession;
    
    /**
     * @var string $twitterId
     *
     * @Column(name="twitter_id", type="bigint", nullable=true)
     */
    private $twitterId;
    
    /**
     * @var DxRoles
     *
     * @ManyToOne(targetEntity="DxRoles")
     * @JoinColumns({
     *   @JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $role;
    
    /**
     * @var DxUserProfile
     * 
     * @OneToOne(targetEntity="DxUserProfile", mappedBy="user") 
     */
    private $userProfile;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return DxUsers
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return DxUsers
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return DxUsers
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set banned
     *
     * @param boolean $banned
     * @return DxUsers
     */
    public function setBanned($banned)
    {
        $this->banned = $banned;
        return $this;
    }

    /**
     * Get banned
     *
     * @return boolean 
     */
    public function getBanned()
    {
        return $this->banned;
    }

    /**
     * Set banReason
     *
     * @param string $banReason
     * @return DxUsers
     */
    public function setBanReason($banReason)
    {
        $this->banReason = $banReason;
        return $this;
    }

    /**
     * Get banReason
     *
     * @return string 
     */
    public function getBanReason()
    {
        return $this->banReason;
    }

    /**
     * Set newpass
     *
     * @param string $newpass
     * @return DxUsers
     */
    public function setNewpass($newpass)
    {
        $this->newpass = $newpass;
        return $this;
    }

    /**
     * Get newpass
     *
     * @return string 
     */
    public function getNewpass()
    {
        return $this->newpass;
    }

    /**
     * Set newpassKey
     *
     * @param string $newpassKey
     * @return DxUsers
     */
    public function setNewpassKey($newpassKey)
    {
        $this->newpassKey = $newpassKey;
        return $this;
    }

    /**
     * Get newpassKey
     *
     * @return string 
     */
    public function getNewpassKey()
    {
        return $this->newpassKey;
    }

    /**
     * Set newpassTime
     *
     * @param datetime $newpassTime
     * @return DxUsers
     */
    public function setNewpassTime($newpassTime)
    {
        $this->newpassTime = $newpassTime;
        return $this;
    }

    /**
     * Get newpassTime
     *
     * @return datetime 
     */
    public function getNewpassTime()
    {
        return $this->newpassTime;
    }

    /**
     * Set lastIp
     *
     * @param string $lastIp
     * @return DxUsers
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
     * @return DxUsers
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

    /**
     * Set created
     *
     * @param datetime $created
     * @return DxUsers
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param datetime $modified
     * @return DxUsers
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
        return $this;
    }

    /**
     * Get modified
     *
     * @return datetime 
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set fbSession
     *
     * @param string $fbSession
     * @return DxUsers
     */
    public function setFbSession($fbSession)
    {
        $this->fbSession = $fbSession;
        return $this;
    }

    /**
     * Get fbSession
     *
     * @return string 
     */
    public function getFbSession()
    {
        return $this->fbSession;
    }
    
    /**
     * Set fbId
     *
     * @param integer $fbId
     * @return DxUsers
     */
    public function setFbId($fbId)
    {
        $this->fbId = $fbId;
        return $this;
    }

    /**
     * Get fbId
     *
     * @return integer 
     */
    public function getFbId()
    {
        return $this->fbId;
    }
    
    /**
     * Set twitterSession
     *
     * @param string $twitterSession
     * @return DxUsers
     */
    public function setTwitterSession($twitterSession)
    {
        $this->twitterSession = $twitterSession;
        return $this;
    }

    /**
     * Get twitterSession
     *
     * @return string 
     */
    public function getTwitterSession()
    {
        return $this->twitterSession;
    }
    
    /**
     * Set twitterId
     *
     * @param integer $twitterId
     * @return DxUsers
     */
    public function setTwitterId($twitterId)
    {
        $this->twitterId = $twitterId;
        return $this;
    }

    /**
     * Get twitterId
     *
     * @return integer 
     */
    public function getTwitterId()
    {
        return $this->twitterId;
    }
    
    /**
     * Set role
     *
     * @param DxRoles $role
     * @return DxUsers
     */
    public function setRole(\DxRoles $role = null)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get role
     *
     * @return DxRoles 
     */
    public function getRole()
    {
        return $this->role;
    }
    
    /**
     * Get userProfile
     *
     * @return DxUserProfile 
     */
    public function getUserProfile()
    {
        return $this->userProfile;
    }
}