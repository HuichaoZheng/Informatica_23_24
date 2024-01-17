<?php
    namespace models;


    class carts
    {
        private $id;
        private $used_id;

        public function getId() {
            return $this->id;
        }

        // Metodo setter per $id
        public function setId($id) {
            $this->id = $id;
        }

        // Metodo getter per $used_id
        public function getUsedId() {
            return $this->used_id;
        }

        // Metodo setter per $used_id
        public function setUsedId($used_id) {
            $this->used_id = $used_id;
        }

    }