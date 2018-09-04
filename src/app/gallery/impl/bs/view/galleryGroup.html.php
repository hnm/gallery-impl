<?php
    use n2n\impl\web\ui\view\html\HtmlView;
    use n2n\web\http\nav\Murl;
    use gallery\core\bo\GalleryGroup;
    use gallery\core\bo\Gallery;
    use gallery\core\model\GalleryState;
    
    $view = HtmlView::view($this);
    $html = HtmlView::html($view);
    $request = HtmlView::request($view);
    
    $galleryState = $view->lookup(GalleryState::class);
    $view->assert($galleryState instanceof GalleryState);
    
    $galleryConfig = $galleryState->getGalleryConfig();
    
    $galleryGroupT = null;
    if ($galleryState->hasCurrentGalleryGroup()) {
        $galleryGroup = $galleryState->getCurrentGalleryGroup();
        $galleryGroupT = $galleryGroup->t($view->getN2nLocale());
    }
    
    $view->useTemplate($galleryConfig->getTemplateViewId(), array(
        'title' => $galleryState->getTitle($view->getN2nLocale())));
?>
<?php $view->import($galleryConfig->getBreadCrumbsViewId()) ?>
<?php if ($galleryState->hasCurrentGalleryGroup()): ?>
	<?php if (null !== ($introText = $galleryGroupT->getIntro())): ?>
		<p class="lead">
			<?php $html->escBr($galleryGroupT->getIntro()) ?>
		</p>
	<?php endif ?>
<?php endif ?>
<div class="row">
	<?php if (count($childGalleryGroups = $galleryState->getChildGalleryGroups()) > 0): ?>
		<?php foreach ($galleryState->getChildGalleryGroups() as $key => $childGalleryGroup): $childGalleryGroup instanceof GalleryGroup ?>
			<?php if (!$childGalleryGroup->hasContent()) continue ?>
			
			<?php $childGalleryGroupT = $childGalleryGroup->t($view->getN2nLocale()) ?>
			<?php $numGalleries = $galleryState->getNumGalleries($childGalleryGroup)?>
			<?php $view->import('inc\galleryGroupListEntry.html', array('murl' => Murl::controller()->pathExt($childGalleryGroupT->getPathPart()),
					'image' => $childGalleryGroupT->determineTitleImage(), 'title' => $childGalleryGroupT->getTitle(), 
					'small' => $view->getL10nText($numGalleries !== 1 ? 'galleries_txt': 'gallery_txt', array('num' => $numGalleries)),
					'description' => $childGalleryGroupT->getIntro(), 'linkLabel' => $html->getText('gallery_group_link_label'))) ?>
		<?php endforeach ?>
	<?php endif ?>
	
	<?php foreach ($galleryState->getChildGalleries() as $key => $gallery): $gallery instanceof Gallery ?>
		<?php if (!$gallery->hasGalleryImages()) continue ?>
		<?php $galleryT = $gallery->t($view->getN2nLocale()) ?>
		<?php $numImages = count($gallery->getGalleryImages()) ?>
		<?php $view->import('inc\galleryGroupListEntry.html', array('murl' => Murl::controller()->pathExt(
						$galleryState->getDetailPaths($view->getN2nLocale(), $gallery)),
				'image' => $galleryT->determineTitleImage(), 'title' => $galleryT->getName(), 
				'small' => $view->getL10nText($numImages !== 1 ? 'images_txt': 'image_txt', array('num' => $numImages)),
				'description' => $galleryT->getDescription(), 'linkLabel' => $html->getText('gallery_link_label'))) ?>
	<?php endforeach ?>
</div>