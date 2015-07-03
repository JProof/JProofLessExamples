<?php
/**
 * PHP version 5.4
 *
 * @package    JProofLess Template Pattern
 * @author     JProof(Romacron)  <info@jproof.de> http://www.jproof.de
 * @copyright  2005 - 2015 jproof
 * @license    WTFPL (../LICENSE)
 * @link
 * @see        http://wiki.jproof.de/projects/joomla-library-jproof-less
 * @since
 **/

defined('_JEXEC') or die('Restricted access');

$variablesArray  = array('colorstyle' => 'red', 'testVar' => 'pink', 'anVar' => '22px');
$variablesObject = (object) $variablesArray;

$multiDimensionsArray  = array($variablesArray, $variablesArray, "testVar" => 'green');
$multiDimensionsObject = (object) $multiDimensionsArray;

$iniString = '
myIniVar=red
myOtherIniVar=green
';

$jsonString = '{"jsonVar":"yellow","jsonVar2":"pink"}';

if(JLoader::import('jproofless.jproofless')){

	$joomlaLess = JProofLess::getInstance();

	$joomlaLess->setLessFile(JPATH_THEMES . '/' . $this->template . '/less/template.less');
	$joomlaLess->setCssFile(JPATH_THEMES . '/' . $this->template . '/css/template.css');

	// Chained Method
	$fromAnOtherConfig = array('myTemplateConfigParameter' => '22px');
	$fromAnConfig      = array('myTemplateConfigParameter' => '12px', 'myComponentVar' => '928px');

	// sets @myTemplateConfigParameter:12px; @myComponentVar:928px
	$joomlaLess->setVariables($fromAnConfig)->setVariables($fromAnOtherConfig);

	// as Array
	$joomlaLess->setVariables($variablesArray);

	// or as Object
	$joomlaLess->setVariables($variablesObject);

	// or as multiDimensionsArray
	$joomlaLess->setVariables($multiDimensionsArray);

	// or as multiDimensionsObject
	$joomlaLess->setVariables($multiDimensionsObject);

	// or as INI formatted string
	$joomlaLess->setVariables($iniString);

	// or as INI formatted string
	$joomlaLess->setVariables($iniString);

	// or as JSON formatted string
	$joomlaLess->setVariables($jsonString);

	$joomlaLess->autoCompile();
}
else{
	// adding an Log message if it is an good choice to install the JProofLess
	JLog::add('JProofLess is missing: ' . __FILE__ . ' @see <a target="_blank" href="http://wiki.jproof.de/projects/joomla-library-jproof-less/wiki"><b>Wiki</b></a>',
		  JLog::NOTICE);

	// Adding each time the regular already rendered css into the template if the LessCompiler not found
	JFactory::getDocument()->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');
}
