<?php
    class Restaurant
    {
        private $id;
        private $name;
        private $cuisine_id;
        private $description;
        private $address;
        private $phone;

        function __construct($id = null, $name, $cuisine_id, $description, $address, $phone)
        {
            $this->id = $id;
            $this->name = $name;
            $this->cuisine_id = $cuisine_id;
            $this->description = $description;
            $this->address = $address;
            $this->phone = $phone;
        }

        function getRestaurantProperty($property_id)
        {
            switch($property_id) {
                case "id":
                    return $this->id;
                    break;
                case "name":
                    return $this->name;
                    break;
                case "cuisine_id":
                    return $this->cuisine_id;
                    break;
                case "description":
                    return $this->description;
                    break;
                case "address":
                    return $this->address;
                    break;
                case "phone":
                    return $this->phone;
                    break;
                default:
                    return "Pick something, hoss.";
            }
        }

        function setRestaurantProperty($property_id, $new_value)
        {
            switch($property_id) {
                case "id":
                    $this->id = $new_value;
                    break;
                case "name":
                    $this->name = $new_value;
                    break;
                case "cuisine_id":
                    $this->cuisine_id = $new_value;
                    break;
                case "description":
                    $this->description = $new_value;
                    break;
                case "address":
                    $this->address = $new_value;
                    break;
                case "phone":
                    $this->phone = $new_value;
                    break;
                default:
                    return "Pick something, hoss.";
            }
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, cuisine_id, description, address, phone) VALUES ('{$this->getRestaurantProperty('name')}', {$this->getRestaurantProperty('cuisine_id')}, '{$this->getRestaurantProperty('description')}', '{$this->getRestaurantProperty('address')}', '{$this->getRestaurantProperty('phone')}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($property_id, $new_value)
        {
            $GLOBALS['DB']->exec("UPDATE restaurants SET " . $property_id . " = '{$new_value}' WHERE id = {$this->getRestaurantProperty('id')};");
            $this->setRestaurantProperty($property_id, $new_value);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE id = {$this->getRestaurantProperty('id')};");
        }

        function getRestaurants()
        {
            $restaurants = Array();
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE restaurant_id = {$this->getId()};");
            foreach($returned_restaurants as $restaurant) {
                $id = $restaurant['id'];
                $restaurant_id = $restaurant['restaurant_id'];
                $new_restaurant = new Restaurant($id, $restaurant_id, $name, $breed, $gender, $date_admitted);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function find($search_id)
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            foreach($restaurants as $restaurant) {
                $restaurant_id = $restaurant->getRestaurantProperty('id');
                if ($restaurant_id == $search_id) {
                  $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }

        static function getAll()
        {
            $returned_restaurant = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurant as $restaurant) {
                $id = $restaurant['id'];
                $name = $restaurant['name'];
                $cuisine_id = $restaurant['cuisine_id'];
                $description = $restaurant['description'];
                $address = $restaurant['address'];
                $phone = $restaurant['phone'];
                $new_restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        function findReviews()
        {
            $found_reviews = array();
            $reviews = Review::getAll();
            foreach ($reviews as $review) {
                $restaurant_id = $review->getReviewProperty('restaurant_id');
                if ($restaurant_id == $this->getRestaurantProperty('id')) {
                    array_push($found_reviews, $review);
                }
            }
            return $found_reviews;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

        static function search($search_term)
        {
            $query = "/" . $search_term . "/i";
            $found_restaurants = array();
            $restaurants = Restaurant::getAll();
            foreach ($restaurants as $restaurant) {
                if (preg_match($query, $restaurant->getRestaurantProperty('name'))) {
                    array_push($found_restaurants, $restaurant);
                }
            }
            return $found_restaurants;
        }

    }
?>
