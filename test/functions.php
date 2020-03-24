<?php
require('../functions.php');
use PHPUnit\Framework\TestCase;
class collection_appTest extends TestCase
{
    public function testSuccessDBCheck() {
        $expected = ' ';
        $actual = DBCheck([1,2,3]);
        $this->assertEquals($expected,$actual);
    }

    public function testErrorDBCheckEmptyInput() {
        $expected = 'There is no data for this collection.';
        $actual = DBCheck([]);
        $this->assertEquals($expected,$actual);
    }

    public function testErrorDBCheckStringInput() {
        $expected = 'Database error. Please refresh page.';
        $actual = DBCheck('test');
        $this->assertEquals($expected,$actual);
    }

    public function testErrorDBCheckBoolInput() {
        $expected = 'Database error. Please refresh page.';
        $actual = DBCheck(true);
        $this->assertEquals($expected,$actual);
    }

    public function testErrorDBCheckIntInput() {
        $expected = 'Database error. Please refresh page.';
        $actual = DBCheck(1);
        $this->assertEquals($expected,$actual);
    }

    public function testErrorDBCheckFloatInput() {
        $expected = 'Database error. Please refresh page.';
        $actual = DBCheck(1.1);
        $this->assertEquals($expected,$actual);
    }

    public function testSuccessMakePlantEntryTile() {
        $expected = "<div class='entry_box'>
                        <div class='entry science_name'>Querbus robur</div>
                        <div class='entry'>English Oak</div>
                        <div class='entry'>Tree</div>
                    </div>";
        $actual = makePlantEntryTile(['id' => "1",
                                      'science_name' => "Querbus robur",
                                      'name' => "English Oak",
                                      'type' => "Tree"]);
        $this->assertEquals($expected,$actual);
     }

    public function testErrorMakePlantEntryTileTooShort() {
        $expected = 'There is not enough data for this entry';
        $actual = makePlantEntryTile(['id' => "1",
                                      'science_name' => "Querbus robur",
                                      'name' => "English Oak"]);
        $this->assertEquals($expected,$actual);
    }

    public function testErrorMakePlantEntryTileEmptyInput() {
        $expected = 'There is no data for this entry';
        $actual = makePlantEntryTile([]);
        $this->assertEquals($expected,$actual);
    }
}
