<?php
    class employee {
        static public $NextID = 0;
        public $ID;

        public function __construct() {
            $this->ID = $this::$NextID++;
        }
    }

    $bob = new employee;
    $jan = new employee;
    $simon = new employee;

    print $bob->ID . "\n";
    print $jan->ID . "\n";
    print $simon->ID . "\n";
    print employee::$NextID . "\n";
?>