<?php
require_once('../functions.php');
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
                        <img src='https://s.ecrater.com/stores/59305/4f39bf0bddea9_59305n.jpg'>
                        <div class='entry science_name'>Querbus robur</div>
                        <div class='entry'>English Oak</div>
                        <div class='entry'>Tree</div>
                        <form action='editpage.php' method='POST'>
                            <button class='edit_button' 
                                    type='submit' 
                                    name='entry_number' 
                                    value='1'>Edit</button>
                            <button class='delete_button' 
                                    type='submit' 
                                    name='entry_number' 
                                    formaction='deletepage.php'
                                    value='1'>Delete</button>
                        </form>
                    </div>";
        $actual = makePlantEntryTile(['id' => '1',
                                      'image' => "https://s.ecrater.com/stores/59305/4f39bf0bddea9_59305n.jpg",
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

    public function testSuccessGetPlantTypeOptions()
    {
        $expected = '<option disable selected value class = \'styled_option\'></option><option class = \'styled_option\' value="bl">Bl</option>';
        $actual = getPlantTypeOptions([['id' => 'bl', 'type' => 'bl']]);
        $this->assertEquals($expected,$actual);
    }

    public function testFailGetPlantTypeOptionsInt()
    {
        $this->expectException(TypeError::class);
        $actual = getPlantTypeOptions(1);
    }

    public function testFailGetPlantTypeOptionsFloat()
    {
        $this->expectException(TypeError::class);
        $actual = getPlantTypeOptions(1.1);
    }

    public function testFailGetPlantTypeOptionsString()
    {
        $this->expectException(TypeError::class);
        $actual = getPlantTypeOptions('1');
    }

    public function testFailGetPlantTypeOptionsBool()
    {
        $this->expectException(TypeError::class);
        $actual = getPlantTypeOptions(false);
    }

    public function testSuccessRemoveTileButtons()
    {
        $expected = '<div class=\'entry science_name\'>Davidia involucrata</div>
                        <div class=\'entry\'>Dove Tree,  Handkerchief Tree</div>
                        <div class=\'entry\'>Tree</div>
                        </div>';
        $actual = removeTileButtons('<div class=\'entry science_name\'>Davidia involucrata</div>
                        <div class=\'entry\'>Dove Tree,  Handkerchief Tree</div>
                        <div class=\'entry\'>Tree</div>
                        <form action=\'editpage.php\' method=\'POST\'>
                            <button class=\'edit_button\' 
                                    type=\'submit\' 
                                    name=\'entry_number\' 
                                    value=\'2\'>Edit</button>
                            <button class=\'delete_button\' 
                                    type=\'submit\' 
                                    name=\'entry_number\' 
                                    formaction=\'deletepage.php\'
                                    value=\'2\'>Delete</button>
                        </form>
                    </div>');
        $this->assertEquals($expected,$actual);

    }

    public function testFailRemoveTileButtonsNoSearchString()
    {
        $expected = '</div>';
        $actual = removeTileButtons('<div class=\'entry science_name\'>Davidia involucrata</div>
                        <div class=\'entry\'>Dove Tree,  Handkerchief Tree</div>
                        <div class=\'entry\'>Tree</div>
                        </div>');
        $this->assertEquals($expected,$actual);

    }

    public function testFailRemoveTileButtonsArray()
    {
        $this->expectException(TypeError::class);
        $actual = removeTileButtons([1]);
    }

    public function testFailRemoveTileButtonsInt()
    {
        $expected = '</div>';
        $actual = removeTileButtons(1);
        $this->assertEquals($expected,$actual);
    }

    public function testFailRemoveTileButtonsFloat()
    {
        $expected = '</div>';
        $actual = removeTileButtons(1.1);
        $this->assertEquals($expected,$actual);
    }

    public function testFailRemoveTileButtonsBool()
    {
        $expected = '</div>';
        $actual = removeTileButtons(false);
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
        $expected = 'This entry has already been added.';
        $actual = getErrorMessage('3');
        $this->assertEquals($expected,$actual);
    }

    public function testCatchGetErrorMessageIntInput()
    {
        $expected = 'Please enter data for all fields.';
        $actual = getErrorMessage(1);
        $this->assertEquals($expected,$actual);
    }

    public function testCatchGetErrorMessageFloatInput()
    {
        $expected = 'Undefined error. Please try again.';
        $actual = getErrorMessage(1.1);
        $this->assertEquals($expected,$actual);
    }

    public function testCatchGetErrorMessageBoolInput()
    {
        $expected = 'Undefined error. Please try again.';
        $actual = getErrorMessage(false);
        $this->assertEquals($expected,$actual);
    }

    public function testSuccessGetErrorMessageEdit1()
    {
        $expected = "You haven't changed any data. Please try again.";
        $actual = getErrorMessageEdit('1');
        $this->assertEquals($expected,$actual);
    }

    public function testSuccessGetErrorMessageEdit2()
    {
        $expected = 'This entry has previously been added to the collection.
                            Please enter different details.';
        $actual = getErrorMessageEdit('2');
        $this->assertEquals($expected,$actual);
    }

    public function testSuccessGetErrorMessageEdit3()
    {
        $expected = 'Oops! Something went wrong. Please try again.';
        $actual = getErrorMessageEdit('3');
        $this->assertEquals($expected,$actual);
    }

    public function testCatchGetErrorMessageEditIntInput()
    {
        $expected = "You haven't changed any data. Please try again.";
        $actual = getErrorMessageEdit(1);
        $this->assertEquals($expected,$actual);
    }

    public function testCatchGetErrorMessageEditFloatInput()
    {
        $expected = 'Undefined error. Please try again.';
        $actual = getErrorMessageEdit(1.1);
        $this->assertEquals($expected,$actual);
    }

    public function testCatchGetErrorMessageEditBoolInput()
    {
        $expected = 'Undefined error. Please try again.';
        $actual = getErrorMessageEdit(false);
        $this->assertEquals($expected,$actual);
    }
}