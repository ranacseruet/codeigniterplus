<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * PdMessage
 *
 * @Table(name="pd_message")
 * @Entity
 */
class PdMessage
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
     * @var string $name
     *
     * @Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string $email
     *
     * @Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string $subject
     *
     * @Column(name="subject", type="string", length=100, nullable=false)
     */
    private $subject;

    /**
     * @var text $message
     *
     * @Column(name="message", type="text", nullable=false)
     */
    private $message;

    /**
     * @var datetime $time
     *
     * @Column(name="time", type="datetime", nullable=false)
     */
    private $time;


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
     * Set name
     *
     * @param string $name
     * @return PdContact
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Set userProfile
     *
     * @param DxUserProfile $userProfile
     * @return PdMessage
     */
    public function setUserProfile(\DxUserProfile $userProfile = null)
    {
        $this->userProfile = $userProfile;
        return $this;
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
    
    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return PdContact
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
     * Set subject
     *
     * @param string $subject
     * @return PdContact
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message
     *
     * @param text $message
     * @return PdContact
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get message
     *
     * @return text 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set time
     *
     * @param datetime $time
     * @return PdContact
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Get time
     *
     * @return datetime 
     */
    public function getTime()
    {
        return $this->time;
    }
}