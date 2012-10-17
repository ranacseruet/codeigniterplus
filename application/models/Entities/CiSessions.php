<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * CiSessions
 *
 * @Table(name="ci_sessions")
 * @Entity
 */
class CiSessions
{
    /**
     * @var string $sessionId
     *
     * @Column(name="session_id", type="string", length=40, nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $sessionId;

    /**
     * @var string $ipAddress
     *
     * @Column(name="ip_address", type="string", length=45, nullable=false)
     */
    private $ipAddress;

    /**
     * @var string $userAgent
     *
     * @Column(name="user_agent", type="string", length=120, nullable=true)
     */
    private $userAgent;

    /**
     * @var integer $lastActivity
     *
     * @Column(name="last_activity", type="integer", nullable=false)
     */
    private $lastActivity;

    /**
     * @var text $userData
     *
     * @Column(name="user_data", type="text", nullable=false)
     */
    private $userData;


    /**
     * Get sessionId
     *
     * @return string 
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return CiSessions
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string 
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     * @return CiSessions
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
     * Set lastActivity
     *
     * @param integer $lastActivity
     * @return CiSessions
     */
    public function setLastActivity($lastActivity)
    {
        $this->lastActivity = $lastActivity;
        return $this;
    }

    /**
     * Get lastActivity
     *
     * @return integer 
     */
    public function getLastActivity()
    {
        return $this->lastActivity;
    }

    /**
     * Set userData
     *
     * @param text $userData
     * @return CiSessions
     */
    public function setUserData($userData)
    {
        $this->userData = $userData;
        return $this;
    }

    /**
     * Get userData
     *
     * @return text 
     */
    public function getUserData()
    {
        return $this->userData;
    }
}