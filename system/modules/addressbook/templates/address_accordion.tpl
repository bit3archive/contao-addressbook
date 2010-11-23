<?php if (strlen($this->title)): ?><div class="address-toggler address-toggler-<?php echo $this->upath ?>"><?php echo $this->title ?></div><?php endif; ?>
<div class="address-accordion address-accordion-<?php echo $this->upath ?>"><div class="address-accordion_content">
<?php if (strlen($this->description)): ?><div class="description"><?php echo $this->description ?></div><?php endif; ?>
<?php foreach ($this->entries as $entry) echo $entry; ?>
</div></div>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
window.addEvent('domready', function() {
  new Accordion($$('div.address-toggler-<?php echo $this->upath ?>'), $$('div.address-accordion-<?php echo $this->upath ?>'), {
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
  new Accordion($$('div.person-toggler-<?php echo $this->upath ?>-<?php echo $this->id ?>'), $$('div.person-accordion-<?php echo $this->upath ?>-<?php echo $this->id ?>'), {
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
});
//--><!]]>
</script>
