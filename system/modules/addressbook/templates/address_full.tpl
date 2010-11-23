<div class="address_full block">
<?php if ($this->photo): ?><div class="photo float_right"><img src="<?php echo $this->photo ?>" alt="<?php echo $this->name ?>" /></div><?php endif; ?>
<h5><?php if ($this->title): ?><strong><?php echo $this->title; ?></strong> <?php endif; ?><?php echo $this->name ?></h5>

<?php if ($this->position || $this->job || $this->company || $this->description): ?>
<h6>Persönliche Informationen</h6>
<div class="personals">
<?php if ($this->position): ?><div class="position">Position: <?php echo $this->position ?></div><?php endif; ?>
<?php if ($this->job): ?><div class="job">Beruf: <?php echo $this->job ?></div><?php endif; ?>
<?php if ($this->company): ?><div class="company">Unternehmen: <?php if ($this->company->homepage): ?><a href="<?php echo $this->company->homepage ?>" onclick="window.open(this.href); return false;"><?php endif; echo $this->company->name; if ($this->company->homepage): ?></a><?php endif; ?></div><?php endif; ?>
<?php if ($this->description): ?><div class="description"><?php echo $this->description ?></div><?php endif; ?>
</div>
<?php endif; ?>

<?php if ($this->email || $this->fon || $this->mobile || $this->fax || $this->homepage): ?>
<h6>Kontaktdaten</h6>
<div class="contact">
<?php if ($this->email): ?><div class="email">E-Mail: <a href="mailto:<?php echo $this->email ?>"><?php echo $this->email ?></a></div><?php endif; ?>
<?php if ($this->fon): ?><div class="fon">Telefon: <?php echo $this->fon ?></div><?php endif; ?>
<?php if ($this->mobile): ?><div class="mobile">Mobil: <?php echo $this->mobile ?></div><?php endif; ?>
<?php if ($this->fax): ?><div class="fax">Fax: <?php echo $this->fax ?></div><?php endif; ?>
<?php if ($this->homepage): ?><div class="homepage">Homepage: <a href="<?php echo $this->homepage ?>" onclick="window.open(this.href); return false;"><?php echo $this->homepage ?></a></div><?php endif; ?>
</div>
<?php endif; ?>

<?php if ($this->address || $this->city || $this->country): ?>
<h6>Adressdaten</h6>
<div class="location">
<?php if ($this->address): ?><div class="address">Adresse: <?php echo $this->address ?></div><?php endif; ?>
<?php if ($this->city): ?><div class="city">Stadt: <?php echo $this->city ?></div><?php endif; ?>
<?php if ($this->country): ?><div class="country">Land: <?php echo $this->country ?></div><?php endif; ?>
</div>
<?php endif; ?>

<?php if ($this->icq || $this->google || $this->aim || $this->yahoo || $this->skype || $this->jabber): ?>
<h6>Instant Messaging</h6>
<div class="im">
<?php if ($this->icq): ?><div class="icq">ICQ: <a href="http://people.icq.com/people/&uin=<?php echo $this->icq ?>" onclick="window.open(this.href); return false;"><?php echo $this->icq ?></a></div><?php endif; ?>
<?php if ($this->google): ?><div class="google">Google-Talk: <?php echo $this->google ?></div><?php endif; ?>
<?php if ($this->aim): ?><div class="aim">AIM: <?php echo $this->aim ?></div><?php endif; ?>
<?php if ($this->yahoo): ?><div class="yahoo">Yahoo: <?php echo $this->yahoo ?></div><?php endif; ?>
<?php if ($this->skype): ?><div class="skype">Skype: <?php echo $this->skype ?></div><?php endif; ?>
<?php if ($this->jabber): ?><div class="jabber">Jabber: <?php echo $this->jabber ?></div><?php endif; ?>
</div>
<?php endif; ?>

<?php if ($this->xing || $this->facebook || $this->stayfriends || $this->wkw || $this->twitter): ?>
<h6>Soziale Netze</h6>
<div class="social">
<?php if ($this->xing): ?><div class="xing">XING: <?php echo $this->xing ?></div><?php endif; ?>
<?php if ($this->facebook): ?><div class="facebook">Facebook: <?php echo $this->facebook ?></div><?php endif; ?>
<?php if ($this->stayfriends): ?><div class="stayfriends">StayFriends: <?php echo $this->stayfriends ?></div><?php endif; ?>
<?php if ($this->wkw): ?><div class="wkw">Wer kennt Wen?: <?php echo $this->wkw ?></div><?php endif; ?>
<?php if ($this->twitter): ?><div class="twitter">Twitter?: <?php echo $this->twitter ?></div><?php endif; ?>
</div>
<?php endif; ?>
</div>