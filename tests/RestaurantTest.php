<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Restaurant.php';
    require_once 'src/Review.php';

    $server = 'mysql:host=localhost;dbname=restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
        }

        function test_getName()
       {
           $id = null;
           $name = 'Ham Salad';
           $cuisine_id = 1;
           $description = 'Ham Shot First';
           $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
           $phone = '503-666-1212';
           $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
           $result = $test_Restaurant->getRestaurantProperty('name');
           $this->assertEquals($name, $result);
       }

       function test_getId()
      {
          $id = null;
          $name = 'Ham Salad';
          $cuisine_id = 1;
          $description = 'Ham Shot First';
          $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
          $phone = '503-666-1212';
          $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
          $result = $test_Restaurant->getRestaurantProperty('id');
          $this->assertEquals($id, $result);
      }

      function test_getCuisine_id()
     {
         $id = null;
         $name = 'Ham Salad';
         $cuisine_id = 1;
         $description = 'Ham Shot First';
         $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
         $phone = '503-666-1212';
         $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
         $result = $test_Restaurant->getRestaurantProperty('cuisine_id');
         $this->assertEquals($cuisine_id, $result);
     }

     function test_getDescription()
    {
        $id = null;
        $name = 'Ham Salad';
        $cuisine_id = 1;
        $description = 'Ham Shot First';
        $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1212';
        $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $result = $test_Restaurant->getRestaurantProperty('description');
        $this->assertEquals($description, $result);
    }

    function test_getAddress()
   {
       $id = null;
       $name = 'Ham Salad';
       $cuisine_id = 1;
       $description = 'Ham Shot First';
       $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
       $phone = '503-666-1212';
       $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
       $result = $test_Restaurant->getRestaurantProperty('address');
       $this->assertEquals($address, $result);
   }

   function test_getPhone()
  {
      $id = null;
      $name = 'Ham Salad';
      $cuisine_id = 1;
      $description = 'Ham Shot First';
      $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
      $phone = '503-666-1212';
      $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
      $result = $test_Restaurant->getRestaurantProperty('phone');
      $this->assertEquals($phone, $result);
  }

    function test_setName()
    {
        $id = null;
        $name = 'Ham Salad';
        $cuisine_id = 1;
        $description = 'Ham Shot First';
        $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1212';
        $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $new_value = 'Thai Fighter';

        $test_Restaurant->setRestaurantProperty('name', $new_value);
        $result = $test_Restaurant->getRestaurantProperty('name');

        $this->assertEquals($new_value, $result);
      }

    function test_setCuisine_Id()
    {
        $id = null;
        $name = 'Ham Salad';
        $cuisine_id = 1;
        $description = 'Ham Shot First';
        $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1212';
        $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $new_value = 2;

        $test_Restaurant->setRestaurantProperty('cuisine_id', $new_value);
        $result = $test_Restaurant->getRestaurantProperty('cuisine_id');

        $this->assertEquals($new_value, $result);
    }

    function test_setDescription()
    {
        $id = null;
        $name = 'Ham Salad';
        $cuisine_id = 1;
        $description = 'Ham Shot First';
        $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1212';
        $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $new_value = 'Formerly called Pizza the Hutt';

        $test_Restaurant->setRestaurantProperty('description', $new_value);
        $result = $test_Restaurant->getRestaurantProperty('description');

        $this->assertEquals($new_value, $result);
    }

    function test_setAddress()
    {
        $id = null;
        $name = 'Ham Salad';
        $cuisine_id = 1;
        $description = 'Ham Shot First';
        $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1212';
        $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $new_value = '101 Alderaan Drive, Portland, Oregon 97001';

        $test_Restaurant->setRestaurantProperty('address', $new_value);
        $result = $test_Restaurant->getRestaurantProperty('address');

        $this->assertEquals($new_value, $result);
    }

    function test_setPhone()
    {
        $id = null;
        $name = 'Ham Salad';
        $cuisine_id = 1;
        $description = 'Ham Shot First';
        $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1212';
        $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $new_value = '503-666-6666';

        $test_Restaurant->setRestaurantProperty('phone', $new_value);
        $result = $test_Restaurant->getRestaurantProperty('phone');

        $this->assertEquals($new_value, $result);
    }

    function test_save()
    {
        $id = null;
        $name = 'Ham Salad';
        $cuisine_id = 1;
        $description = 'Ham Shot First';
        $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1212';
        $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $test_Restaurant->save();
        $result = Restaurant::getAll();
        $this->assertEquals($test_Restaurant, $result[0]);
    }

    function test_Update()
    {
        $id = null;
        $name = 'Ham Salad';
        $cuisine_id = 1;
        $description = 'Ham Shot First';
        $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1212';
        $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $test_Restaurant->save();
        $new_name = 'Pizza the Hutt';
        //Act
        $test_Restaurant->update('name', $new_name);
        //Assert
        $this->assertEquals($new_name, $test_Restaurant->getRestaurantProperty('name'));
    }

    function test_delete()
    {
        //Arrange
        $id = null;
        $name = 'Ham Salad';
        $cuisine_id = 1;
        $description = 'Ham Shot First';
        $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1212';
        $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $test_Restaurant->save();

        $id = null;
        $name = 'Pizza the Hutt';
        $cuisine_id = 2;
        $description = 'Let the Wookee Eat';
        $address = '1315 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1213';
        $test_Restaurant2 = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $test_Restaurant2->save();

        //Act
        $test_Restaurant->delete();

        //Assert
        $this->assertEquals([$test_Restaurant2], Restaurant::getAll());
    }

    function test_deleteAll()
    {
        //Arrange
        $id = null;
        $name = 'Ham Salad';
        $cuisine_id = 1;
        $description = 'Ham Shot First';
        $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1212';
        $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $test_Restaurant->save();

        $id = null;
        $name = 'Pizza the Hutt';
        $cuisine_id = 2;
        $description = 'Let the Wookee Eat';
        $address = '1315 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1213';
        $test_Restaurant2 = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $test_Restaurant2->save();

        //Act
        Restaurant::deleteAll();
        $result = Restaurant::getAll();

        //Assert
        $this->assertEquals([], $result);
    }

    function test_getAll()
    {
        //Arrange
        $id = null;
        $name = 'Ham Salad';
        $cuisine_id = 1;
        $description = 'Ham Shot First';
        $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1212';
        $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $test_Restaurant->save();

        $id = null;
        $name = 'Pizza the Hutt';
        $cuisine_id = 2;
        $description = 'Let the Wookee Eat';
        $address = '1315 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1213';
        $test_Restaurant2 = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $test_Restaurant2->save();

        //Act
        $result = Restaurant::getAll();

        //Assert
        $this->assertEquals([$test_Restaurant, $test_Restaurant2], $result);
    }

    function test_findReviews()
    {
        $id = null;
        $name = 'Ham Salad';
        $cuisine_id = 1;
        $description = 'Ham Shot First';
        $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
        $phone = '503-666-1212';
        $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
        $test_Restaurant->save();

        $restaurant_id = $test_Restaurant->getRestaurantProperty('id');
        $review = "this place sucks";
        $new_review = new Review($id, $restaurant_id, $review);
        $new_review->save();
        $review2 = "this place rocks";
        $new_review2 = new Review($id, $restaurant_id, $review2);
        $new_review2->save();

        //Act
        $result = $test_Restaurant->findReviews();

        //Assert
        $this->assertEquals([$new_review, $new_review2], $result);
    }

    }
?>
