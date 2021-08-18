<?php
require_once (__DIR__ . "/../entity/TicketDB.php");

/**
 * class of Order, contains info about an order
 * @author Yuning Bao
 *
 */
class Order
{
    
    /**
     * fields of the class
     */
    private $o_id;
    private $o_name;
    private $o_quantity;
    private $o_price;
    private $o_total;
    private $userid;

    /**
     * constructor, set all the parameters when called
     * @param int $o_id, id of an order
     * @param $o_name, the name of a ticket
     * @param int $o_quantity, the number of a ticket
     * @param int $o_price, the price of a ticket
     * @param int $o_total, total price
     * @param int $userid, the user id
     */
    public function __construct($o_id, $o_name, $o_quantity, $o_price, $o_total, $userid)
    {
        $this->o_id = $o_id;
        $this->o_name = $o_name;
        $this->o_quantity = $o_quantity;
        $this->o_price = $o_price;
        $this->o_total = $o_total;
        $this->userid = $userid;
    }

    /* --- getters and setters below --- */
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->o_id;
    }

    /**
     * @param int $id
     */
    public function setId($o_id)
    {
        $this->o_id = $o_id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->o_name;
    }

    /**
     * @param string $title
     */
    public function setName($o_name)
    {
        $this->o_name = $o_name;
    }

    /**
     * @return string
     */
    public function getQuantity()
    {
        return $this->detail;
    }

    /**
     * @param string $title
     */
    public function setQuantity($o_quantity)
    {
        $this->o_quantity = $o_quantity;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->o_price;
    }

    /**
     * @param float $price
     */
    public function setPrice($o_price)
    {
        $this->o_price = $o_price;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->o_total;
    }

    /**
     * @param int $availableQuantity
     */
    public function setTotal($o_total)
    {
        $this->o_total = $o_total;
    }


      /**
     * @return string
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param string $title
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

}