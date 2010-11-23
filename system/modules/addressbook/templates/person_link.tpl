<div class="person_link block">
<a href="<?php global $objPage; echo $this->generateFrontendUrl($objPage->row(), '/person/' . $this->name . '_' . $this->id . (strlen($this->from) ? ':' . $this->from : '')); ?>"><?php
	if ($this->title): ?><strong><?php echo $this->title; ?></strong> <?php endif; ?><?php echo $this->name ?></a>
</div>