<?php
namespace gallery\impl\bs\ui;

use n2n\impl\web\ui\view\html\HtmlView;
use gallery\core\bo\GalleryImageT;
use n2n\impl\web\ui\view\html\HtmlElement;

class GalleryHtmlBuilder {

	private $view;
	private $html;
	
	public function __construct(HtmlView $view) {
		$this->view = $view;
		$this->html = $view->getHtmlBuilder();
	}
	
	
	public function lyteboxTitle(GalleryImageT $galleryImageT) {
		return $this->view->out($this->getLyteboxTitle($galleryImageT));
	}
	public function getLyteboxTitle(GalleryImageT $galleryImageT) {
		if (null === $galleryImageT->getTitle() && null === $galleryImageT->getDescription()) return null;
		
		$div = new HtmlElement('div', null, '');
		
		if (null !== ($title = $galleryImageT->getTitle())) {
			$div->appendContent(new HtmlElement('h3', null, $title));
		}
		
		if (null !== ($description = $galleryImageT->getDescription())) {
			$div->appendContent(new HtmlElement('p', null, $description));
		}
		
		return $div;
	}
}