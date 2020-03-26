<?php
require('../functions.php');
use PHPUnit\Framework\TestCase;
class collection_appTest extends TestCase
{
    public function testSuccessDBCheck()
    {
        $expected = '';
        $actual = DBCheck([1,2,3]);
        $this->assertEquals($expected,$actual);
    }

    public function testErrorDBCheckEmptyInput()
    {
        $expected = 'There is no data for this collection.';
        $actual = DBCheck([]);
        $this->assertEquals($expected,$actual);
    }

    public function testErrorDBCheckStringInput()
    {
        $this->expectException(TypeError::class);
        $actual = DBCheck('test');
    }

    public function testErrorDBCheckBoolInput()
    {
        $this->expectException(TypeError::class);
        $actual = DBCheck(true);
    }

    public function testErrorDBCheckIntInput()
    {
        $this->expectException(TypeError::class);
        $actual = DBCheck(1);
    }

    public function testErrorDBCheckFloatInput()
    {
        $this->expectException(TypeError::class);
        $actual = DBCheck(1.1);
    }

    public function testSuccessMakePlantEntryTile()
    {
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

    public function testErrorMakePlantEntryTileTooShort()
    {
        $expected = 'There is not enough information given for this type of entry.';
        $actual = makePlantEntryTile(['science_name' => "Querbus robur",
                                      'name' => "English Oak"]);
        $this->assertEquals($expected,$actual);
    }

    public function testErrorMakePlantEntryTileEmptyInput()
    {
        $expected = 'There is no data for this entry';
        $actual = makePlantEntryTile([]);
        $this->assertEquals($expected,$actual);
    }

    public function testSuccessGetErrorMessage1()
    {
        $expected = 'Please enter data for all fields.';
        $actual = getErrorMessage('1');
        $this->assertEquals($expected,$actual);
    }

    public function testSuccessGetErrorMessage2()
    {
        $expected = 'Oops! Something went wrong. Please try again.';
        $actual = getErrorMessage('2');
        $this->assertEquals($expected,$actual);
    }

    public function testSuccessGetErrorMessage3()
    {
        $expected = 'The plant type given wasn\'t recognised. 
                            Please select from the list of possible types and try again.';
        $actual = getErrorMessage('3');
        $this->assertEquals($expected,$actual);
    }

    public function testSuccessGetErrorMessage4()
    {
        $expected = 'This entry has already been added.';
        $actual = getErrorMessage('4');
        $this->assertEquals($expected,$actual);
    }

    public function testCatchGetErrorMessageIntInput() {
        $expected = 'Please enter data for all fields.';
        $actual = getErrorMessage(1);
        $this->assertEquals($expected,$actual);
    }

    public function testCatchGetErrorMessageFloatInput() {
        $expected = 'Undefined error. Please try again.';
        $actual = getErrorMessage(1.1);
        $this->assertEquals($expected,$actual);
    }

    public function testCatchGetErrorMessageBoolInput() {
        $expected = 'Undefined error. Please try again.';
        $actual = getErrorMessage(false);
        $this->assertEquals($expected,$actual);
    }

    public function testSuccessGetPlantTypeOptions() {
        $expected = '<option class = \'styled_option\' value=bl>Bl</option>';
        $actual = getPlantTypeOptions([['id' => 'bl', 'type' => 'bl']]);
        $this->assertEquals($expected,$actual);
    }

    public function testFailGetPlantTypeOptionsInt() {
        $this->expectException(TypeError::class);
        $actual = getPlantTypeOptions(1);
    }

    public function testFailGetPlantTypeOptionsFloat() {
        $this->expectException(TypeError::class);
        $actual = getPlantTypeOptions(1.1);
    }

    public function testFailGetPlantTypeOptionsString() {
        $this->expectException(TypeError::class);
        $actual = getPlantTypeOptions('1');
    }

    public function testFailGetPlantTypeOptionsBool() {
        $this->expectException(TypeError::class);
        $actual = getPlantTypeOptions(false);
    }
}
