<?php

	require_once('../preheader.php');

	#the code for the class
	include ('../ajaxCRUD.class.php');
//echo "<head><title>pupilStatus</title></head><body bgcolor=black><font color=grey>";


    #this one line of code is how you implement the class
    ########################################################
    ##

    $tblDemo = new ajaxCRUD("updateStatus", "pupilStatus", "pSid", "../");

    ##
    ########################################################

    ## all that follows is setup configuration for your fields....
    ## full API reference material for all functions can be found here - http://ajaxcrud.com/api/
    ## note: many functions below are commented out (with //). note which ones are and which are not

    #i can define a relationship to another table
    #the 1st field is the fk in the table, the 2nd is the second table, the 3rd is the pk in the second table, the 4th is field i want to retrieve as the dropdown value
    #http://ajaxcrud.com/api/index.php?id=defineRelationship
    $tblDemo->defineRelationship("pid", "pupil", "pid", "firstname", "firstname  asc"); //use your own table - this table (tblDemoRelationship) not included in the installation script

    #i don't want to visually show the primary key in the table
    $tblDemo->omitPrimaryKey();

    #the table fields have prefixes; i want to give the heading titles something more meaningful
    $tblDemo->displayAs("pid", "name");

	#set the textarea height of the longer field (for editing/adding)
    #http://ajaxcrud.com/api/index.php?id=setTextareaHeight
    //$tblDemo->setTextareaHeight('comments', 150);

    #i could omit a field if I wanted
    #http://ajaxcrud.com/api/index.php?id=omitField
    //$tblDemo->omitField("fldField2");

    #i could omit a field from being on the add form if I wanted
    $tblDemo->omitAddField("timestamp");
    //$tblDemo->omitAddField("time_out");

    #i could disallow editing for certain, individual fields
    //$tblDemo->disallowEdit('fldField2');

    #i could set a field to accept file uploads (the filename is stored) if wanted
    //$tblDemo->setFileUpload("fldField2", "uploads/");

    #i can have a field automatically populate with a certain value (eg the current timestamp)
	//$nowMySQLFormat = date('Y-m-d H:i:s');//for reference only
	$nowPlusOneHour = date("Y-m-d H:i:s", strtotime("+1 hours"));
	$tblDemo->addValueOnInsert("timestamp", $nowPlusOneHour);
    $tblDemo->addValueOnInsert("timestamp", "NOW()");

    #i can use a where field to better-filter my table
    //$tblDemo->addWhereClause("WHERE (fldField1 = 'test'");

    #i can order my table by whatever i want
    //$tblDemo->addOrderBy("ORDER BY timestamp desc");

    #i can set certain fields to only allow certain values
    #http://ajaxcrud.com/api/index.php?id=defineAllowableValues
    //$allowableValues = array("Allowable Value 1", "Allowable Value2", "Dropdown Value", "CRUD");
    //$tblDemo->defineAllowableValues("fldCertainFields", $allowableValues);

    //set field fldCheckbox to be a checkbox
    $tblDemo->defineCheckbox("fldCheckbox");

    #i can disallow deleting of rows from the table
    #http://ajaxcrud.com/api/index.php?id=disallowDelete
    //$tblDemo->disallowDelete();

    #i can disallow adding rows to the table
    #http://ajaxcrud.com/api/index.php?id=disallowAdd
    //$tblDemo->disallowAdd();

    #i can add a button that performs some action deleting of rows for the entire table
    #http://ajaxcrud.com/api/index.php?id=addButtonToRow
    //$tblDemo->addButtonToRow("Add", "add_item.php", "all");

    #set the number of rows to display (per page)
    $tblDemo->setLimit(1000);

	#set a filter box at the top of the table
    //$tblDemo->addAjaxFilterBox('fldField1');

    #if really desired, a filter box can be used for all fields
    //$tblDemo->addAjaxFilterBoxAllFields();

    #i can set the size of the filter box
    //$tblDemo->setAjaxFilterBoxSize('fldField1', 3);

	#i can format the data in cells however I want with formatFieldWithFunction
	#this is arguably one of the most important (visual) functions
	$tblDemo->formatFieldWithFunction('fldField1', 'makeBlue');
	$tblDemo->formatFieldWithFunction('fldField2', 'makeBold');

	//$tblDemo->onAddExecuteCallBackFunction("mycallbackfunction"); //uncomment this to try out an ADD ROW callback function

?>

		<div style="float: left">
			Total Returned Rows: <b><?=$tblDemo->insertRowsReturned();?></b><br />
		</div>

		<div style="clear:both;"></div>

<?

	#actually show the table
	$tblDemo->showTable();

	#my self-defined functions used for formatFieldWithFunction
	function makeBold($val){
		return "<b>$val</b>";
	}

	function makeBlue($val){
		return "$val";
	}

	function myCallBackFunction($array){
		echo "THE ADD ROW CALLBACK FUNCTION WAS implemented";
		print_r($array);
	}
?>
