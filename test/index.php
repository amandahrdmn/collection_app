<?php
require('../functions.php');
use PHPUnit\Framework\TestCase;
class collection_appTest extends TestCase
{
    public function testSuccessgetDataEntry() {
        $testQuery = getDB();
        $expected = ['id' => "1", 'science_name' => "Querbus robur", 'name' => "English Oak", 'type' => "Tree"];
        $actual = getDataEntry($testQuery);
        $this->assertSame($expected, $actual);
    }

    public function testSuccessMakePlantEntryTile () {
        $expected = "<div class='entry_box'><div class='entry science_name'>" . "Querbus robur" . "</div><div class='entry'>" . "English Oak" . "</div><div class='entry'>" . "Tree" . "</div></div>";
        $this->expectOutputString($expected);
        $actual = makePlantEntryTile(['id' => "1", 'science_name' => "Querbus robur", 'name' => "English Oak", 'type' => "Tree"]);
    }

    public function testErrorMakePlantEntryTileTooShort () {
        $expected = 'There is not enough data for this entry';
        $this->expectOutputString($expected);
        $actual = makePlantEntryTile(['id' => "1", 'science_name' => "Querbus robur", 'name' => "English Oak"]);
    }

    public function testErrorMakePlantEntryTileEmptyInput () {
        $expected = 'There is no data for this entry';
        $this->expectOutputString($expected);
        $actual = makePlantEntryTile([]);
    }
}
