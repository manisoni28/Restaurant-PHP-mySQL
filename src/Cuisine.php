<?php
    class Cuisine
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }
        function getId()
        {
            return $this->id;
        }
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisines (name) VALUES ('{$this->getName()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        function getRestaurants()
        {
            $restaurants = Array();
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = {$this->getId()};");
            foreach($returned_restaurants as $restaurant) {
                $id = $restaurant['id'];
                $cuisine_id = $restaurant['cuisine_id'];
                $name = $restaurant['name'];
                $breed = $restaurant['breed'];
                $gender = $restaurant['gender'];
                $date_admitted = $restaurant['date_admitted'];
                $new_restaurant = new Restaurant($id, $cuisine_id, $name, $breed, $gender, $date_admitted);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }
        static function find($search_id)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $cuisine_id = $cuisine->getId();
                if ($cuisine_id == $search_id) {
                  $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }
        static function getAll()
        {
            $returned_cuisine = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisine as $cuisine) {
                $name = $cuisine['name'];
                $id = $cuisine['id'];
                $new_cuisine = new Cuisine($name, $id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }
        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE cuisines SET name = '{$new_name}' WHERE id = {$this->getId()};");
           $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines WHERE id = {$this->getId()};");
        }
    }
?>
