<?php if ($this->intLevel == 0): ?>
	<?php if (strlen($this->title)): ?><div class="address-root-title"><?php echo $this->title ?></div><?php endif; ?>
	<div class="address-root"><div class="address-root_content">
	<?php if (strlen($this->description)): ?><div class="address-root-description"><?php echo $this->description ?></div><?php endif; ?>
	<?php foreach ($this->entries as $entry) echo $entry; ?>
	</div></div>
<?php else: ?>
	<?php if (strlen($this->title)): ?><div class="address-toggler address-toggler-<?php echo $this->upath ?> <?php echo $this->level ?>"><?php echo $this->title ?></div><?php endif; ?>
	<div class="address-accordion address-accordion-<?php echo $this->upath ?>"><div class="address-accordion_content">
	<?php if (strlen($this->description)): ?><div class="description"><?php echo $this->description ?></div><?php endif; ?>
	<?php foreach ($this->entries as $entry) echo $entry; ?>
	</div></div>
<?php endif; ?>
<?php if (strlen($this->cupath . $this->pupath)): ?>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
window.addEvent('domready', function() {
	<?php if (strlen($this->cupath)): ?>
	new Accordion($$('div.address-toggler-<?php echo $this->cupath ?>'), $$('div.address-accordion-<?php echo $this->cupath ?>'), {
		show: 0,
		alwaysHide: false,
		opacity: true,
		onActive: function (toggler, element) { toggler.addClass('toggler-active'); element.addClass('accordion-active'); },
		onBackground: function (toggler, element) { toggler.removeClass('toggler-active'); element.removeClass('accordion-active'); },
		onComplete: function() {
			$each(arguments, function(element) {
				if (element.hasClass('accordion-active')) {
					element.setStyle('height', '');
				}
			});
		}
	});
	<?php endif; if (strlen($this->pupath)): ?>
	new Accordion($$('div.person-toggler-<?php echo $this->pupath ?>'), $$('div.person-accordion-<?php echo $this->pupath ?>'), {
		show: 0,
		alwaysHide: false,
		opacity: true,
		onActive: function (toggler, element) { toggler.addClass('toggler-active'); element.addClass('accordion-active'); },
		onBackground: function (toggler, element) { toggler.removeClass('toggler-active'); element.removeClass('accordion-active'); },
		onComplete: function() {
			$each(arguments, function(element) {
				if (element.hasClass('accordion-active')) {
					element.setStyle('height', '');
				}
			});
		}
	});
	<?php endif; ?>
});
//--><!]]>
</script>
<?php endif; ?>
