<?php
    //=======================================================================
    // File:        One.php
    // Description: Example of Late Static Binding
    // Created:     20161128
    // Author:      Cory Dean <cory.dean@oakwoodsoftware.com>
    // PHP Version: 5
    //========================================================================

    /** Source: http://stackoverflow.com/questions/17782441/trying-to-understand-late-static-bindings-in-php */

    class Record
    {
        protected static $tableName = 'base';

        public static function getTableName()
        {
            echo self::$tableName;
        }
    }

    class User extends Record
    {
        protected static $tableName = 'users';
    }

    User::getTableName();

    /*
     * self is "bound" at compile time, statically. That means when the code is compiled, it is decided what self
     * refers to. static is resolved at run time, i.e. when the code is executed. That's late static binding. And
     * that's the difference.
     *
     * With self, it is decided at compile time (when the code is "read"), that self refers to Record. Later on the
     * code for User is parsed, but self::$tableName in Record already refers to Record::$tableName and cannot be
     * changed anymore.
     *
     * When you use static, the reference is not resolved immediately. It is only resolved when you call
     * User::getTableName(), at which point you're in the context of User, so static::$tableName is resolved
     * to User::$tableName.
     *
     * In other words: self always refers to the class that it has been written in, no two ways about it. What static
     * refers to depends on what context it's used in; in practice that means it may refer to child classes if the
     * class it occurs in is being extended. That makes it work like $this, only for static contexts.
     */