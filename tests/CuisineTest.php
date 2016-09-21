<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_getName()
        {
            $name = "Thai";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $result = $test_cuisine->getName();
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            $name = "Thai";
            $id = 1;
            $test_cuisine = new Cuisine($name, $id);
            $result = $test_cuisine->getId();
            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            $name = "Thai";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();
            $result = Cuisine::getAll();
            $this->assertEquals($test_cuisine, $result[0]);
        }

        function test_Update()
        {
            //Arrange
            $name = "Thai";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();
            $new_name = "Northern Thai";
            //Act
            $test_cuisine->update($new_name);
            //Assert
            $this->assertEquals($new_name, $test_cuisine->getName());
        }

        function test_delete()
        {
            //Arrange
           $name = "Thai";
           $id = null;
           $test_cuisine = new Cuisine($name, $id);
           $test_cuisine->save();
           $name2 = "Italian";
           $test_cuisine2 = new Cuisine($name2, $id);
           $test_cuisine2->save();
           //Act
           $test_cuisine->delete();
           //Assert
           $this->assertEquals([$test_cuisine2], Cuisine::getAll());
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Thai";
            $name2 = "Italian";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2);
            $test_Cuisine2->save();
            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();
            //Assert
            $this->assertEquals([], $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Thai";
            $name2 = "Italian";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2);
            $test_Cuisine2->save();
            //Act
            $result = Cuisine::getAll();
            //Assert
            $this->assertEquals([$test_Cuisine, $test_Cuisine2], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Thai";
            $name2 = "Italian";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::find($test_Cuisine->getId());

            //Assert
            $this->assertEquals($test_Cuisine, $result);
        }

        function test_getRestaurants()
        {
            //Arrange

            $name = "Thai";
            $name2 = "Italian";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2);
            $test_Cuisine2->save();

            $id = null;
            $name = 'Ham Salad';
            $cuisine_id = $test_Cuisine->getId();
            $description = 'Ham Shot First';
            $address = '1313 Mockingbird Lane, Portland, Oregon 97210';
            $phone = '503-666-1212';
            $test_Restaurant = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
            $test_Restaurant->save();

            $id = null;
            $name = 'Ham Salad2';
            $cuisine_id = $test_Cuisine->getId();
            $description = 'Ham Shot Second';
            $address = '1414 Mockingbird Lane, Portland, Oregon 97210';
            $phone = '503-666-1313';
            $test_Restaurant1 = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
            $test_Restaurant1->save();

            $id = null;
            $name = 'Pizza the Hutt';
            $cuisine_id = $test_Cuisine2->getId();
            $description = 'Let the Wookee Eat';
            $address = '1315 Mockingbird Lane, Portland, Oregon 97210';
            $phone = '503-666-1213';
            $test_Restaurant2 = new Restaurant($id, $name, $cuisine_id, $description, $address, $phone);
            $test_Restaurant2->save();

            //Act
            $result = $test_Cuisine->getRestaurants();
            //Assert
            $this->assertEquals($result, array($test_Restaurant, $test_Restaurant1));
        }
    }
?>
