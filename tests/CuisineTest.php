<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
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
    }
?>
