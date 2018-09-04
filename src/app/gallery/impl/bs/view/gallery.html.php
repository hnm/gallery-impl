<?php

/*
	.gallery-image-box {
		background: <?php echo $styles->colorRange->getRangeE() ?>;
		padding: 0 15px 0px 15px;
		margin-bottom: <?php echo $styles->gridGutterWidth ?>;
		position: relative;
	}
	
	.gallery-image-box .img-container {
		margin: 0 -15px;
		<?php echo $css->calc('padding-bottom', '66.66666% - -20px') ?>
		position: relative;
		text-algin: center;
	}
	
	.gallery-image-box .img-container img {
		position: absolute;
		<?php echo $css->transform('translate(-50%, -50%)') ?>
		top: 50%;
		left: 50%;
		max-height: 100%;
	}
	
	.gallery-image-box .img-responsive {
		display: inline-block;
	}
*/

	use n2n\impl\web\ui\view\html\HtmlView;
	use bstmpl\ui\TemplateHtmlBuilder;
	use n2nutil\bootstrap\img\MimgBs;
	use n2n\impl\web\ui\view\html\img\Mimg;
	use gallery\core\model\GalleryState;
	use gallery\core\bo\GalleryImage;
	use gallery\impl\bs\ui\GalleryHtmlBuilder;
	
	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	$request = HtmlView::request($view);
	
	$galleryState = $view->lookup(GalleryState::class);
	$view->assert($galleryState instanceof GalleryState);
	$galleryConfig = $galleryState->getGalleryConfig();
	
	$gallery = $view->getParam('gallery', false);
	if (null === $gallery) {
		$gallery = $galleryState->getCurrentGallery();
	}
	$galleryT = $gallery->t($view->getN2nLocale());
	
	$meta = $html->meta();
	
	$thumbImageDimension = MimgBs::xs(Mimg::crop(250, 250));
	$fullImageDimension = MimgBs::xs(Mimg::prop(900, 900, false));
	$tmplHtml = new TemplateHtmlBuilder($view);
	$galleryHtml = new GalleryHtmlBuilder($view);
	if ($view->getParam('useTemplate', false, true)) {
		$this->useTemplate($galleryConfig->getTemplateViewId(), array(
				'title' => $galleryState->getTitle($view->getN2nLocale())));
	}
?>
<?php if ($galleryState->hasCurrentGalleryGroup()): ?>
	<?php $view->import($galleryConfig->getBreadCrumbsViewId()) ?>
<?php elseif ($galleryState->hasRootUrl()): ?>
	<?php $html->linkToController(null, $view->getL10nText('back_txt')) ?>
<?php endif ?>

<p class="lead"><?php $html->out($galleryT->getDescription()) ?></p>
<div>
	<div class="row">
		<?php foreach ($gallery->getGalleryImages() as $galleryImage): $galleryImage instanceof  GalleryImage ?>
			<?php  $galleryImageT = $galleryImage->t($view->getN2nLocale()) ?>
			<div class="col-md-4">
				<figure class="gallery-image-box">
					<div class="img-container">
						<?php $tmplHtml->fancyImage($galleryImage->getFileImage(),$thumbImageDimension, $fullImageDimension, null, 
								array('title' => $galleryImageT ? $galleryImageT->getTitle() : null, 'alt' => $galleryImageT ? $galleryImageT->determineAltTag() : null), 
								array('data-fancybox' => 'gallery', 'data-caption' => $galleryHtml->getLyteboxTitle($galleryImageT))) ?>
					</div>
				</figure>
			</div>
		<?php endforeach ?>
	</div>
</div>