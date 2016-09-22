<?php
    class Review
    {
        private $id;
        private $restaurant_id;
        private $review;

        function __construct($id = null, $restaurant_id, $review)
        {
            $this->id = $id;
            $this->restaurant_id = $restaurant_id;
            $this->review = $review;
        }

        function getReviewProperty($property_id)
        {
            switch($property_id) {
                case "id":
                    return $this->id;
                    break;
                case "restaurant_id":
                    return $this->restaurant_id;
                    break;
                case "review":
                    return $this->review;
                    break;
                default:
                    return "Pick something, hoss.";
            }
        }

        function setReviewProperty($property_id, $new_value)
        {
            switch($property_id) {
                case "id":
                    $this->id = $new_value;
                    break;
                case "restaurant_id":
                    $this->restaurant_id = $new_value;
                    break;
                case "review":
                    $this->review = $new_value;
                    break;
                default:
                    return "Pick something, hoss.";
            }
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO reviews (restaurant_id, review) VALUES ({$this->getReviewProperty('restaurant_id')}, '{$this->getReviewProperty('review')}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($property_id, $new_value)
        {
            $GLOBALS['DB']->exec("UPDATE reviews SET " . $property_id . " = '{$new_value}' WHERE id = {$this->getReviewProperty('id')};");
            $this->setReviewProperty($property_id, $new_value);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM reviews WHERE id = {$this->getReviewProperty('id')};");
        }

        static function find($search_id)
        {
            $found_review = null;
            $reviews = Review::getAll();
            foreach($reviews as $review) {
                $review_id = $review->getReviewProperty('id');
                if ($review_id == $search_id) {
                  $found_review = $review;
                }
            }
            return $found_review;
        }

        static function getAll()
        {
            $returned_review = $GLOBALS['DB']->query("SELECT * FROM reviews;");
            $reviews = array();
            foreach($returned_review as $review) {
                $id = $review['id'];
                $restaurant_id = $review['restaurant_id'];
                $review = $review['review'];
                $new_review = new Review($id, $restaurant_id, $review);
                array_push($reviews, $new_review);
            }
            return $reviews;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM reviews;");
        }

    }
?>
