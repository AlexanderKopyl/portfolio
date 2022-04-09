<?php
declare(strict_types=1);

namespace App\Shared;

class DataObjectTransfer implements \ArrayAccess
{
    /**
     * Constructor
     *
     * By default is looking for first argument as array and assigns it as object attributes
     * This behavior may change in child classes
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->_data = $data;
    }

    /**
     * Object attributes
     *
     * @var array
     */
    protected $_data = [];

    /**
     * @param string $name
     * @param $value
     *
     * @return void
     */
    public function __set(string $name, $value): void
    {
        $this->_data[$name] = $value;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        if (!isset($this->_data[$name])) {
            throw new \RuntimeException("Parameter " . $name . " doesn't exist");
        }

        return $this->_data[$name];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->_data[$name]);
    }

    /**
     * Overwrite data in the object.
     *
     * The $key parameter can be string or array.
     * If $key is string, the attribute value will be overwritten by $value
     *
     * If $key is an array, it will overwrite all the data in the object.
     *
     * @param string|array $key
     * @param mixed $value
     * @return $this
     */
    public function setData($key, $value = null)
    {
        if ($key === (array)$key) {
            $this->_data = $key;
        } else {
            $this->_data[$key] = $value;
        }
        return $this;
    }

    /**
     * Unset data from the object.
     *
     * @param null|string|array $key
     * @return $this
     */
    public function unsetData($key = null)
    {
        if ($key === null) {
            $this->setData([]);
        } elseif (is_string($key)) {
            if (isset($this->_data[$key]) || array_key_exists($key, $this->_data)) {
                unset($this->_data[$key]);
            }
        } elseif ($key === (array)$key) {
            foreach ($key as $element) {
                $this->unsetData($element);
            }
        }
        return $this;
    }

    /**
     * Convert array of object data with to array with keys requested in $keys array
     *
     * @param array $keys array of required keys
     * @return array
     */
    public function toArray(array $keys = []): array
    {
        if (empty($keys)) {
            return $this->_data;
        }

        $result = [];
        foreach ($keys as $key) {
            if (isset($this->_data[$key])) {
                $result[$key] = $this->_data[$key];
            } else {
                $result[$key] = null;
            }
        }
        return $result;
    }

    /**
     * Convert array of object data with to array with keys requested in $keys array
     *
     * @param array $data
     *
     * @return $this
     */
    public function fromArray(array $data = []): self
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            } elseif (isset($this->_data[$key])) {
                $this->_data[$key] = $value;
            }
        }

        return $this;
    }

    /**
     * Implementation of \ArrayAccess::offsetSet()
     *
     * @param string $offset
     * @param mixed $value
     * @return void
     * @link http://www.php.net/manual/en/arrayaccess.offsetset.php
     */
    public function offsetSet($offset, $value)
    {
        $this->_data[$offset] = $value;
    }

    /**
     * Implementation of \ArrayAccess::offsetExists()
     *
     * @param string $offset
     * @return bool
     * @link http://www.php.net/manual/en/arrayaccess.offsetexists.php
     */
    public function offsetExists($offset)
    {
        return isset($this->_data[$offset]) || array_key_exists($offset, $this->_data);
    }

    /**
     * Implementation of \ArrayAccess::offsetUnset()
     *
     * @param string $offset
     * @return void
     * @link http://www.php.net/manual/en/arrayaccess.offsetunset.php
     */
    public function offsetUnset($offset)
    {
        unset($this->_data[$offset]);
    }

    /**
     * Implementation of \ArrayAccess::offsetGet()
     *
     * @param string $offset
     * @return mixed
     * @link http://www.php.net/manual/en/arrayaccess.offsetget.php
     */
    public function offsetGet($offset)
    {
        if (isset($this->_data[$offset])) {
            return $this->_data[$offset];
        }
        return null;
    }
}