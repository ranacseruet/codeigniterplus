<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DxPermissions
 *
 * @Table(name="dx_permissions")
 * @Entity
 */
class DxPermissions
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
     * @var integer $roleId
     *
     * @Column(name="role_id", type="integer", nullable=false)
     */
    private $roleId;

    /**
     * @var text $data
     *
     * @Column(name="data", type="text", nullable=true)
     */
    private $data;


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
     * Set roleId
     *
     * @param integer $roleId
     * @return DxPermissions
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
        return $this;
    }

    /**
     * Get roleId
     *
     * @return integer 
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set data
     *
     * @param text $data
     * @return DxPermissions
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Get data
     *
     * @return text 
     */
    public function getData()
    {
        return $this->data;
    }
}