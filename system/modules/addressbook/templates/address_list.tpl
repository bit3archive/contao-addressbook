<?php if (strlen($this->title)): ?><h6><?php echo $this->title ?></h6><?php endif; ?>
<?php if (strlen($this->description)): ?><div class="description"><?php echo $this->description ?></div><?php endif; ?>
<?php foreach ($this->entries as $entry) echo $entry; ?>
