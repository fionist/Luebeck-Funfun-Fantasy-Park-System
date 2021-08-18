<?php
require_once (__DIR__ . "/../entity/TicketDB.php");

/**
 * class of ticket, contains info of a ticket
 * @author Yuning Bao
 *
 */
class Ticket
{
    
    /**
     * fields of the class
     */
    private $id;
    private $name;
    private $detail;
    private $price;
    private $amount;


    /**
     * constructor, set all the parameters when called
     * @param int $id, id of an ticket
     * @param string $name, name of a ticket
     * @param string $detail, detail explaination of a ticket
     * @param int $price, the price of a ticket
     * @param int $amount, amount of a ticket
     */
    public function __construct($id, $name, $detail, $price, $amount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->detail = $detail;
        $this->price = $price;
        $this->amount = $amount;
    }
    
    /* --- getters and setters below --- */
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $title
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param string $title
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $availableQuantity
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function addToCart(Cart $cart, int $amount)
    {
        return $cart->addProduct($this, $amount);
    }
    
    public function removeFromCart(Cart $cart)
    {
        return $cart->removeProduct($this);
    }
}