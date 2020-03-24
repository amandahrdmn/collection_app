<?php
require('../functions.php');
use PHPUnit\Framework\TestCase;
class collection_appTest extends TestCase
{
    public function testSuccessDBCheckIntInput () {
        $expected = 1;
        $this->expectOutputString($expected);
        DBCheck(1);
    }


    public function testSuccessDBCheckBoolInput () {
        $expected = true;
        $this->expectOutputString($expected);
        DBCheck(true);
    }

    public function testSuccessDBCheckStringInput () {
        $expected = '1';
        $this->expectOutputString($expected);
        DBCheck('1');
    }

    public function testSuccessDBCheckfloatInput () {
        $expected = 1.1;
        $this->expectOutputString($expected);
        DBCheck(1.1);
    }

    public function testSuccessMakePlantEntryTile () {
        $expected = "<div class='entry_box'><div class='entry science_name'>" . "Querbus robur" . "</div><div class='entry'>" . "English Oak" . "</div><div class='entry'>" . "Tree" . "</div></div>";
        $actual = makePlantEntryTile(['id' => "1", 'science_name' => "Querbus robur", 'name' => "English Oak", 'type' => "Tree"]);
        $this->assertEquals($expected,$actual);
     }

    public function testErrorMakePlantEntryTileTooShort () {
        $expected = 'There is not enough data for this entry';
        $actual = makePlantEntryTile(['id' => "1", 'science_name' => "Querbus robur", 'name' => "English Oak"]);
        $this->assertEquals($expected,$actual);
    }

    public function testErrorMakePlantEntryTileEmptyInput () {
        $expected = 'There is no data for this entry';
        $actual = makePlantEntryTile([]);
        $this->assertEquals($expected,$actual);
    }
}
