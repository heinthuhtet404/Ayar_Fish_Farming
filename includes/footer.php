<?php if(empty($page['raw'])):?></article><aside class="toc" id="toc" aria-label="မာတိကာ"></aside></div>
<?php if($cur):$items=$CATS[$cur['ci']]['items'];$pv=$items[$cur['ii']-1]??null;$nx=$items[$cur['ii']+1]??null;?>
<div class="wrap pager"><?php if($pv):?><a href="<?=h($pv[1])?>"><small<?=ed('prev_lbl')?>><?=h(T('prev_lbl'))?></small><?=h($pv[0])?></a><?php endif;?><?php if($nx):?><a class="n" href="<?=h($nx[1])?>"><small<?=ed('next_lbl')?>><?=h(T('next_lbl'))?></small><?=h($nx[0])?></a><?php endif;?></div>
<section class="rel"><div class="wrap"><h2><?=h($CATS[$cur['ci']]['title'])?><span<?=ed('rel_suffix')?>><?=h(T('rel_suffix'))?></span></h2><div class="rl"><?php foreach($items as $it):if($it[2]===$cs)continue;?><a href="<?=h($it[1])?>"><?=h($it[0])?></a><?php endforeach;?></div></div></section>
<?php endif;endif;?>
</main>
<footer class="ft"><div class="wrap"><div class="fg"><div><a class="brand" href="index.php" style="color:#fff"><img src="<?=h(IMG('logo'))?>" alt=""<?=edimg('logo')?>><span><span<?=ed('brand_name')?>><?=h(T('brand_name'))?></span><small style="color:#9fc0c4"<?=ed('brand_sub')?>><?=h(T('brand_sub'))?></small></span></a><p<?=ed('footer_desc')?>><?=h(T('footer_desc'))?></p></div>
<div><h4<?=ed('footer_col1')?>><?=h(T('footer_col1'))?></h4><?php foreach(array_slice($CATS,0,3,true) as $i=>$c):?><a href="index.php#c<?=$i?>"><?=h($c['title'])?></a><?php endforeach;?></div>
<div><h4<?=ed('footer_col2')?>><?=h(T('footer_col2'))?></h4><?php foreach(array_slice($CATS,3,3,true) as $i=>$c):?><a href="index.php#c<?=$i?>"><?=h($c['title'])?></a><?php endforeach;?></div>
<div><h4<?=ed('footer_col3')?>><?=h(T('footer_col3'))?></h4><a href="fish-species.php"<?=ed('footer_species')?>><?=h(T('footer_species'))?></a><a href="fish-gallery.php"<?=ed('footer_gallery')?>><?=h(T('footer_gallery'))?></a><a href="about.php"<?=ed('footer_about')?>><?=h(T('footer_about'))?></a><a href="contact.php"<?=ed('footer_contact')?>><?=h(T('footer_contact'))?></a><a href="sign-in.php"<?=ed('footer_signin')?>><?=h(T('footer_signin'))?></a></div></div>
<div class="fb"><span>© <?=date('Y')?> <span<?=ed('copy_name')?>><?=h(T('copy_name'))?></span></span><span><a href="admin/login.php" style="display:inline;color:inherit">Admin</a></span></div></div></footer>
<button id="top" aria-label="အပေါ်သို့">↑</button></body></html>
