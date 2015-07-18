<?php

/**
 * PHP version 5
 *
 * @category
 * @package
 * @author     JProof(romacron)<development@jproof.de>
 * @copyright  JProof/romacron
 * @license
 * @version    SVN: $Id$ 18.07.2015 12:00
 * @link
 * @see
 * @since
 */
class KunenaTemplateJProofLess_Crypsis extends KunenaTemplate
{

	/**
	 * Template initialization.
	 *
	 * @return void
	 */
	public function initialize()
	{
		// Template requires Bootstrap javascript


		// Template also requires jQuery framework.


		// Load JavaScript.


		// Compile CSS from LESS files.
		if(jimport('jproofless.jproofless')){

			$jproofLess = JProofLess::getInstance();

			$cssFile  = KPATH_MEDIA . "/cache/{$this->name}/css/" . $this->name . '.css';
			$lessFile = KPATH_COMPONENT_RELATIVE . "/template/{$this->name}/less/{$this->name}.less";

			$extraStyle = JPATH_SITE . '/components/com_kunena/template/crypsis/css/custom.css';

			$jproofLess->setCssFile($cssFile)
				   ->setLessFile($lessFile)
				   ->setVariables($this->style_variables)
				   ->useStrategy('missingcss')
				   ->setExtraContent($extraStyle);
			$class = $this;

			$jproofLess->getLess()->registerFunction('url', function ($arg) use ($class){
				list($type, $q, $values) = $arg;
				$value = reset($values);

				return "url({$q}{$class->getFile($value, true, 'media', 'media/kunena')}{$q})";
			});



			// Load template colors settings
			$this->ktemplate = KunenaFactory::getTemplate();
			$styles          = <<<EOF
		/* Kunena Custom CSS */
EOF;
			$iconcolor       = $this->ktemplate->params->get('IconColor');
			if($iconcolor){
				$styles .= <<<EOF
		.layout#kunena [class*="category"] i,
		.layout#kunena #kwho i.icon-users,
		.layout#kunena#kstats i.icon-bars { color: {$iconcolor}; }
EOF;
			}

			$iconcolornew = $this->ktemplate->params->get('IconColorNew');
			if($iconcolornew){
				$styles .= <<<EOF
		.layout#kunena [class*="category"] .icon-knewchar { color: {$iconcolornew} !important; }
		.layout#kunena sup.knewchar { color: {$iconcolornew} !important; }
		.layout#kunena .topic-item-unread { border-left-color: {$iconcolornew} !important; }
EOF;
			}

			$jproofLess->setExtraContent($styles);
			$jproofLess->autoCompile();
		}
		else{
			// adding an Log message if it is an good choice to install the JProofLess
			JLog::add('JProofLess is missing: ' . __FILE__ . ' @see <a target="_blank" href="http://wiki.jproof.de/projects/joomla-library-jproof-less/wiki"><b>Wiki</b></a>',
				  JLog::NOTICE);

			// Adding each time the regular already rendered css into the template if the LessCompiler not found
			//JFactory::getDocument()->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');
		}

		parent::initialize();
	}

}
