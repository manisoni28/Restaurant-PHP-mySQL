<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Review.php';

    $server = 'mysql:host=localhost;dbname=restaurant_test';
    $userrestaurant_id = 'root';
    $password = 'root';
    $DB = new PDO($server, $userrestaurant_id, $password);

    class ReviewTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Review::deleteAll();
        }

       function test_getId()
      {
          $id = null;
          $restaurant_id = 2;
          $review = 'There was a hipster in my soup';
          $test_Review = new Review($id, $restaurant_id, $review);
          $result = $test_Review->getReviewProperty('id');
          $this->assertEquals($id, $result);
      }

      function test_getRestaurant_id()
     {
         $id = null;
         $restaurant_id = 2;
         $review = 'There was a hipster in my soup';
         $test_Review = new Review($id, $restaurant_id, $review);
         $result = $test_Review->getReviewProperty('restaurant_id');
         $this->assertEquals($restaurant_id, $result);
     }

     function test_getReview()
    {
        $id = null;
        $restaurant_id = 2;
        $review = 'There was a hipster in my soup';
        $test_Review = new Review($id, $restaurant_id, $review);
        $result = $test_Review->getReviewProperty('review');
        $this->assertEquals($review, $result);
    }

    function test_setId()
    {
        $id = null;
        $restaurant_id = 2;
        $review = 'There was a hipster in my soup';
        $test_Review = new Review($id, $restaurant_id, $review);
        $new_value = 3;

        $test_Review->setReviewProperty('id', $new_value);
        $result = $test_Review->getReviewProperty('id');

        $this->assertEquals($new_value, $result);
      }

    function test_setRestaurant_Id()
    {
        $id = null;
        $restaurant_id = 2;
        $review = 'There was a hipster in my soup';
        $test_Review = new Review($id, $restaurant_id, $review);
        $new_value = 1;

        $test_Review->setReviewProperty('restaurant_id', $new_value);
        $result = $test_Review->getReviewProperty('restaurant_id');

        $this->assertEquals($new_value, $result);
    }

    function test_setReview()
    {
        $id = null;
        $restaurant_id = 2;
        $review = 'There was a hipster in my soup';
        $test_Review = new Review($id, $restaurant_id, $review);
        $new_value = 'Formerly called Pizza the Hutt';

        $test_Review->setReviewProperty('review', $new_value);
        $result = $test_Review->getReviewProperty('review');

        $this->assertEquals($new_value, $result);
    }

    function test_save()
    {
        $id = null;
        $restaurant_id = 2;
        $review = 'There was a hipster in my soup';
        $test_Review = new Review($id, $restaurant_id, $review);
        $test_Review->save();
        $result = Review::getAll();
        $this->assertEquals($test_Review, $result[0]);
    }

    function test_Update()
    {
        $id = null;
        $restaurant_id = 2;
        $review = 'There was a hipster in my soup';
        $test_Review = new Review($id, $restaurant_id, $review);
        $test_Review->save();
        $new_restaurant_id = 'Pizza the Hutt';
        //Act
        $test_Review->update('restaurant_id', $new_restaurant_id);
        //Assert
        $this->assertEquals($new_restaurant_id, $test_Review->getReviewProperty('restaurant_id'));
    }

    function test_delete()
    {
        //Arrange
        $id = null;
        $restaurant_id = 2;
        $review = 'There was a hipster in my soup';
        $test_Review = new Review($id, $restaurant_id, $review);
        $test_Review->save();

        $id = null;
        $restaurant_id = 2;
        $review = 'My bun was cold';
        $test_Review2 = new Review($id, $restaurant_id, $review);
        $test_Review2->save();

        //Act
        $test_Review->delete();

        //Assert
        $this->assertEquals([$test_Review2], Review::getAll());
    }

    function test_deleteAll()
    {
        //Arrange
        $id = null;
        $restaurant_id = 2;
        $review = 'There was a hipster in my soup';
        $test_Review = new Review($id, $restaurant_id, $review);
        $test_Review->save();

        $id = null;
        $restaurant_id = 2;
        $review = 'My bun was cold';
        $test_Review2 = new Review($id, $restaurant_id, $review);
        $test_Review2->save();

        //Act
        Review::deleteAll();
        $result = Review::getAll();

        //Assert
        $this->assertEquals([], $result);
    }

    function test_getAll()
    {
        //Arrange
        $id = null;
        $restaurant_id = 2;
        $review = 'There was a hipster in my soup';
        $test_Review = new Review($id, $restaurant_id, $review);
        $test_Review->save();

        $id = null;
        $restaurant_id = 2;
        $review = 'My bun was cold';
        $test_Review2 = new Review($id, $restaurant_id, $review);
        $test_Review2->save();

        //Act
        $result = Review::getAll();

        //Assert
        $this->assertEquals([$test_Review, $test_Review2], $result);
    }


    }
?>
