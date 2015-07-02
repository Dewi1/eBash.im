<?php

/**
 * Class Cart
 */
class Cart
{

    private static $instance;  // экземпляра объекта

    private function __clone()
    { /* ... @return Singleton */
    }  // Защищаем от создания через клонирование

    private function __wakeup()
    { /* ... @return Singleton */
    }  // Защищаем от создания через unserialize

    public static function getInstance()
    {    // Возвращает единственный экземпляр класса. @return Singleton
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @var array
     */
    protected $items = array();

    /**
     * Clear all items
     */
    public function clear()
    {
        $this->items = array();
    }

    private function __construct()
    {
        $this->items = $_SESSION['cart'];
    }

    public function __destruct()
    {
        $_SESSION['cart'] = $this->items;
    }

    /**
     * @param integer $itemId
     * @param integer $count
     */
    public function add($itemId, $count)
    {
        if (isset($this->items[$itemId])) {
            $this->items[$itemId] += $count;
        } else {
            $this->items[$itemId] = $count;
        }
    }

    public function isAdded($itemId)
    {
        return isset($this->items[$itemId]);
    }

    public function remove($itemId)
    {
        unset($this->items[$itemId]);
    }

    public function setCount($itemId, $count)
    {
        $this->items[$itemId] = $count;
    }

    public function getAll()
    {
        return $this->items;
    }

    public function totalSum($oldTotalSum, $newCount, $oldCount, $itemPrice)
    {
        if ($newCount > $oldCount) {
            $totalSum = $oldTotalSum + ($newCount - $oldCount) * $itemPrice;
            return $totalSum;
        } else {
            $totalSum = $oldTotalSum - ($oldCount - $newCount) * $itemPrice;
            return $totalSum;
        }
    }
}
