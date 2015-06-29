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

/*
*
* templates/YOUR-template/index.php
* */
if(JLoader::import('jproofless.jproofless')){

	$joomlaLess = JProofLess::getInstance();
	$joomlaLess->setLessFile(JPATH_THEMES . '/' . $this->template . '/less/template.less');
	$joomlaLess->setCssFile(JPATH_THEMES . '/' . $this->template . '/css/template.css');
	$joomlaLess->autoCompile();
}
else{
	// adding an Log message if it is an good choice to install the JProofLess
	JLog::add('JProofLess is missing: ' . __FILE__ . ' @see <a target="_blank" href="http://wiki.jproof.de/projects/joomla-library-jproof-less/wiki"><b>Wiki</b></a>',
		  JLog::NOTICE);

	// Adding each time the regular already rendered css into the template if the LessCompiler not found
	JFactory::getDocument()->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');
}

// Start your standard HTML
?>
<head>
	<!-- Less rendered Template css already inside  -->
	<jdoc:include type="head" />
</head>
