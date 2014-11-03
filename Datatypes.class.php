<?php
  # Copyright (c) 2014 Haskell Camargo <haskell@linuxmail.org>
  #
  # Permission is hereby granted, free of charge, to any person
  # obtaining a copy of this software and associated documentation files
  # (the "Software"), to deal in the Software without restriction,
  # including without limitation the rights to use, copy, modify, merge,
  # publish, distribute, sublicense, and/or sell copies of the Software,
  # and to permit persons to whom the Software is furnished to do so,
  # subject to the following conditions:
  #
  # The above copyright notice and this permission notice shall be
  # included in all copies or substantial of portions the Software.
  #
  # THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
  # EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
  # MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
  # NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
  # LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
  # OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
  # WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

  require_once 'Binary.class.php';
  require_once 'Boolean.class.php';
  require_once 'Byte.class.php';
  require_once 'Char.class.php';
  require_once 'Collection.class.php';
  require_once 'Double.class.php';
  require_once 'Either.class.php';
  require_once 'Float.class.php';
  require_once 'Func.class.php';
  require_once 'Integer.class.php';
  require_once 'Loop.class.php';
  require_once 'Object.class.php';
  require_once 'String.class.php';
  require_once 'Extras/Shortcuts.php';
  require_once 'Modules/Memoize.class.php';
  require_once 'prototype/Prototype.class.php';
  require_once 'prototype/Define.class.php';

  # Types may want to inherit from this class.
  class Datatypes {
    protected $value, $memoize;
    public $prototype = null;

    public function __construct() {
      global $memoize;
      $this->memoize   = $memoize;
      $this->prototype = new Define;
      return $this;
    }

    public function __call($name, $arguments) {
      array_unshift($arguments, $this);
      return call_user_func_array($this->prototype->{$name}, $arguments);
    }

    public function __clone() {
      $this->prototype = clone $this->prototype;
    }

    # Returns the element by itself.
    # Mixed → Mixed
    public function id() {
      return $this;
    }

    # Equivalent to php's var_dump.
    # Mixed → Void
    public function inspect() {
      var_dump($this->value);
      return $this;
    }

    # Returns the protected value as a php primitive.
    # Mixed → Mixed
    public function value() {
      return $this->value;
    }

    # Casts to Binary.
    # Mixed → Binary
    public function toBinary() {
      return new Binary($this->value);
    }

    # Casts to Boolean.
    # Mixed → Boolean
    public function toBoolean() {
      return new Boolean($this->value);
    }

    # Casts to Byte.
    # Mixed → Byte
    public function toByte() {
      return new Byte($this->value);
    }

    # Casts to Char.
    # Mixed → Char
    public function toChar() {
      return new Char($this->value);
    }

    # Casts to Double.
    # Mixed → Double
    public function toDouble() {
      return new Double($this->value);
    }

    # Casts to Either.
    # Mixed → Either
    public function toEither() {
      return new Either($this->value);
    }

    # Casts to Float.
    # Mixed → Float
    public function toFloat() {
      return new Float($this->value);
    }

    # Casts to Func.
    # Mixed → Func
    public function toFunc() {
      return new Func($this->value);
    }

    # Casts to Integer.
    # Mixed → Integer
    public function toInteger() {
      return new Integer($this->value);
    }

    # Casts to Loop (Why in the world would somebody do this!?).
    # Mixed → Loop
    public function toLoop() {
      return new Loop($this->value);
    }

    # Casts to Object.
    # Mixed → Object
    public function toObject() {
      return new Object($this->value);
    }

    # Casts to String.
    # Mixed → String
    public function toString() {
      return new String($this->value);
    }
  }