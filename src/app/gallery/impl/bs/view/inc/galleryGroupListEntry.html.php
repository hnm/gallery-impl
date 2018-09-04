<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2n\io\managed\File;
	use n2nutil\bootstrap\img\MimgBs;
	use n2n\impl\web\ui\view\html\img\Mimg;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$image = $view->getParam('image');
	$view->assert($image instanceof File);
	
	$murl = $view->getParam('murl');
	$title = $view->getParam('title');
	
	$small = $view->getParam('small', false);
	$description = $view->getParam('description', false);
	$linkLabel = $view->getParam('linkLabel');
	
?>
<div class="col-sm-6 col-md-12">
	<div class="row gallery mb-4">
		<div class="col-xs-4 col-md-3">
			<div class="gallery-title-image-holder">
				<div class="gallery-title-image">
					<?php $html->link($murl, $html->getImage($image, 
							MimgBs::xs(Mimg::crop(250, 250)), array('class' => 'img-fluid'), false, false)) ?>
				</div>
			</div>
		</div>
		<div class="col-xs-8 col-md-9">
			<div class="gallery-image-info">
				<h2>
					<?php $html->linkStart($murl) ?>
						<?php $html->out($title) ?>
					<?php $html->linkEnd() ?>
				</h2>
				<?php if (null !== $small): ?>
					<div>
						<small><?php $html->out($small) ?></small>
					</div>
				<?php endif ?> 
				<?php if (null !== $description): ?>
					<p><?php $html->escBr($description) ?></p>
				<?php endif ?>
				<?php $html->link($murl, $linkLabel, array('class' => 'btn btn-primary'))?>
			</div>
		</div>
	</div>
</div>