(()=>{
const $=(s,r=document)=>r.querySelector(s),$$=(s,r=document)=>[...r.querySelectorAll(s)];
const csrf=$('meta[name=csrf]')?.content,base=$('meta[name=base]')?.content||'';if(!csrf)return;
const url=a=>base+'admin/api.php?a='+a;
const api=async(a,d)=>{try{const r=await fetch(url(a),{method:'POST',headers:{'Content-Type':'application/json','X-CSRF':csrf},body:JSON.stringify(d||{})});return await r.json()}catch(e){return{ok:false,error:'Server နှင့် ချိတ်ဆက်၍ မရပါ'}}};
const upload=async f=>{const fd=new FormData();fd.append('file',f);try{const r=await fetch(url('upload'),{method:'POST',headers:{'X-CSRF':csrf},body:fd});return await r.json()}catch(e){return{ok:false,error:'Upload မအောင်မြင်ပါ'}}};
let tt;const toast=(m,ok=true)=>{let t=$('#a-toast');if(!t){t=document.createElement('div');t.id='a-toast';document.body.appendChild(t)}t.textContent=m;t.className=ok?'ok show':'err show';clearTimeout(tt);tt=setTimeout(()=>t.classList.remove('show'),3200)};
const done=async(p,msg)=>{const r=await p;if(r&&r.ok){toast(msg||'သိမ်းပြီးပါပြီ ✓');return r}toast((r&&r.error)||'မအောင်မြင်ပါ',false);return null};
const reload=()=>setTimeout(()=>location.reload(),350);
const esc=s=>String(s??'').replace(/[&<>"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]));
function modal(title,fields,vals,onSave){
 const m=document.createElement('div');m.className='a-modal';
 m.innerHTML='<form class="a-box"><h3>'+esc(title)+'</h3>'+fields.map(f=>{const v=vals[f.k]??'';let i;
  if(f.t==='area')i='<textarea name="'+f.k+'" rows="3">'+esc(v)+'</textarea>';
  else if(f.t==='select')i='<select name="'+f.k+'">'+f.o.map(o=>'<option value="'+esc(o[0])+'"'+(String(o[0])===String(v)?' selected':'')+'>'+esc(o[1])+'</option>').join('')+'</select>';
  else if(f.t==='image')i='<div class="imgf"><input name="'+f.k+'" value="'+esc(v)+'" placeholder="assets/..."><label class="btn line">ပုံတင်မည်<input type="file" accept="image/*" hidden></label></div>';
  else i='<input name="'+f.k+'" value="'+esc(v)+'">';
  return '<label>'+esc(f.l)+i+'</label>'}).join('')+'<div class="a-btns"><button type="button" class="btn line" data-x>မလုပ်တော့ပါ</button><button class="btn" type="submit">သိမ်းမည်</button></div></form>';
 document.body.appendChild(m);const fm=$('form',m);$('input,textarea,select',fm)?.focus();
 $('[data-x]',m).onclick=()=>m.remove();m.onmousedown=e=>{if(e.target===m)m.remove()};
 const fi=$('input[type=file]',m);if(fi)fi.onchange=async()=>{const r=await upload(fi.files[0]);if(r.ok){fm.elements[fields.find(f=>f.t==='image').k].value=r.url;toast('ပုံတင်ပြီးပါပြီ ✓')}else toast(r.error,false)};
 fm.onsubmit=async e=>{e.preventDefault();const d={};fields.forEach(f=>d[f.k]=fm.elements[f.k].value);if(await onSave(d))m.remove()};
}
const catOpts=(none)=>(none?[['',' — မီနူးထဲ မထည့်ပါ —']]:[]).concat(window.ACATS||[]);
document.addEventListener('click',async e=>{
 const b=e.target.closest('[data-a]');if(!b||b.type==='file')return;const a=b.dataset.a,id=b.dataset.id,d=+b.dataset.d;
 const row=()=>{try{return JSON.parse(b.dataset.row||'{}')}catch(x){return{}}};
 if(a==='page-new')modal('စာမျက်နှာအသစ်',[{k:'title',l:'ခေါင်းစဉ်'},{k:'cat',l:'အမျိုးအစား',t:'select',o:catOpts(true)}],{},async v=>{const r=await done(api('page_create',v),'ဖန်တီးပြီးပါပြီ');if(r)location.href=base+r.url+'&edit=1';return !!r});
 else if(a==='page-del'){if(confirm('ဤစာမျက်နှာကို ဖျက်မည်လား? ပြန်ယူ၍ မရပါ။'))if(await done(api('page_delete',{slug:id}),'ဖျက်ပြီးပါပြီ'))reload()}
 else if(a==='page-move'){if(await done(api('page_move',{slug:id,dir:d}),'ရွှေ့ပြီးပါပြီ'))reload()}
 else if(a==='cat-edit'){const r0=row();modal(r0.id?'အမျိုးအစား ပြင်ရန်':'အမျိုးအစားအသစ်',[{k:'icon',l:'Icon (emoji)'},{k:'title',l:'အမည်'},{k:'desc',l:'ဖော်ပြချက်',t:'area'}],r0,async v=>{v.id=r0.id||'';const r=await done(api('cat_save',v));if(r)reload();return !!r})}
 else if(a==='cat-del'){if(confirm('ဤအမျိုးအစားကို ဖျက်မည်လား?'))if(await done(api('cat_delete',{id}),'ဖျက်ပြီးပါပြီ'))reload()}
 else if(a==='cat-move'){if(await done(api('cat_move',{id,dir:d}),'ရွှေ့ပြီးပါပြီ'))reload()}
 else if(a==='sp-edit'){const r0=row();modal(r0.id?'ငါးမျိုးစိတ် ပြင်ရန်':'ငါးမျိုးစိတ်အသစ်',[{k:'name',l:'ငါးအမည်'},{k:'en',l:'အင်္ဂလိပ်အမည်'},{k:'sci',l:'သိပ္ပံအမည်'},{k:'page',l:'အသေးစိတ်စာမျက်နှာ (မရှိလျှင် မရွေးပါ)',t:'select',o:[['',' — မရှိပါ —']].concat((window.APAGES||[]).map(p=>[p[1],p[0]]))},{k:'img',l:'ပုံ',t:'image'}],Object.assign({},r0,{page:r0.page||''}),async v=>{v.id=r0.id||'';const r=await done(api('species_save',v));if(r)reload();return !!r})}
 else if(a==='sp-del'){if(confirm('ဤငါးမျိုးစိတ်ကို ဖျက်မည်လား?'))if(await done(api('species_delete',{id}),'ဖျက်ပြီးပါပြီ'))reload()}
 else if(a==='sp-move'){if(await done(api('species_move',{id,dir:d}),'ရွှေ့ပြီးပါပြီ'))reload()}
 else if(a==='msg-del'){if(confirm('ဖျက်မည်လား?'))if(await done(api('msg_delete',{file:b.dataset.file,idx:+b.dataset.idx}),'ဖျက်ပြီးပါပြီ'))reload()}
 else if(a==='media-del'){if(confirm('ဤပုံကို ဖျက်မည်လား?'))if(await done(api('media_delete',{name:b.dataset.name}),'ဖျက်ပြီးပါပြီ'))reload()}
 else if(a==='media-copy'){try{await navigator.clipboard.writeText(b.dataset.url);toast('Copy ပြီးပါပြီ ✓')}catch(x){prompt('URL',b.dataset.url)}}
 else if(a==='settings-save'){const v={};$$('#sf [name]').forEach(i=>v[i.name]=i.value);await done(api('setting_save',{values:v}))}
 else if(a==='pw-save'){const f=$('#pf');const r=await done(api('password_change',{cur:f.cur.value,new:f.new.value}),'စကားဝှက် ပြောင်းပြီးပါပြီ');if(r)f.reset()}
});
const mu=$('[data-a=media-up]');if(mu)mu.onchange=async()=>{const r=await upload(mu.files[0]);if(r.ok){toast('တင်ပြီးပါပြီ ✓');reload()}else toast(r.error,false)};
// ---------- in-place editing on the public pages
const eb=$('#a-edit'),sv=$('#a-save'),ca=$('#a-cancel'),pb=$('#pb'),ph=$('#ph1');if(!eb)return;
const editable=el=>{try{el.contentEditable='plaintext-only'}catch(x){}if(el.contentEditable!=='plaintext-only')el.contentEditable='true'};
 const imgVals={};
 async function replaceImg(im){const fi=document.createElement('input');fi.type='file';fi.accept='image/*';
  fi.onchange=async()=>{const r=await upload(fi.files[0]);if(!r.ok)return toast(r.error,false);
   im.src=r.url;
   if(im.dataset.img){imgVals[im.dataset.img]=r.url;toast('ပုံ ပြောင်းပြီးပါပြီ ✓');return}
   if(im.closest('#pb')){toast('ပုံ ပြောင်းပြီးပါပြီ ✓ (သိမ်းမည် နှိပ်ပါ)');return}
   const row=(window.SSPECIES||[]).find(s=>(im.getAttribute('alt')||'')===s.name);
   if(row){row.img=r.url;const x=await api('species_save',{id:row.id,name:row.name,en:row.en,sci:row.sci,page:row.page||'',img:r.url});toast(x&&x.ok?'ပုံ သိမ်းပြီးပါပြီ ✓':'သိမ်း၍မရပါ',!!(x&&x.ok));return}
   toast('ပုံ ပြောင်းပြီးပါပြီ (ဤစာမျက်နှာတွင်သာ)')};fi.click();}
const leave=()=>{const u=new URL(location.href);u.searchParams.delete('edit');location.href=u.toString()};
function toolbar(){
 const tb=document.createElement('div');tb.id='a-tb';
 const C=[['B','bold'],['I','italic'],['ခေါင်းစဉ်ကြီး','formatBlock','h2'],['ခေါင်းစဉ်ခွဲ','formatBlock','h3'],['စာပိုဒ်','formatBlock','p'],['• စာရင်း','insertUnorderedList'],['၁။ စာရင်း','insertOrderedList'],['🔗 Link','link'],['🖼 ပုံ','image'],['ဖယ်ရှားရန်','removeFormat']];
 const fi=document.createElement('input');fi.type='file';fi.accept='image/*';fi.hidden=true;let rg=null;
 C.forEach(c=>{const x=document.createElement('button');x.type='button';x.textContent=c[0];x.onmousedown=e=>e.preventDefault();
  x.onclick=()=>{pb.focus();if(c[1]==='link'){const u=prompt('Link လိပ်စာ (ဥပမာ - https://… သို့မဟုတ် feeding.php)');if(u)document.execCommand('createLink',false,u)}
   else if(c[1]==='image'){const s=getSelection();rg=s.rangeCount?s.getRangeAt(0).cloneRange():null;fi.click()}
   else document.execCommand(c[1],false,c[2]?'<'+c[2]+'>':null)};tb.appendChild(x)});
 fi.onchange=async()=>{const r=await upload(fi.files[0]);fi.value='';if(!r.ok)return toast(r.error,false);pb.focus();if(rg){const s=getSelection();s.removeAllRanges();s.addRange(rg)}
  document.execCommand('insertHTML',false,'<figure><img src="'+r.url+'" alt="" loading="lazy"></figure><p><br></p>');toast('ပုံထည့်ပြီးပါပြီ ✓')};
 tb.appendChild(fi);document.body.appendChild(tb);
 pb.addEventListener('paste',e=>{e.preventDefault();document.execCommand('insertText',false,(e.clipboardData||window.clipboardData).getData('text/plain'))});
 pb.addEventListener('click',e=>{if(e.target.closest('a'))e.preventDefault()});
}
function enter(){document.body.classList.add('editing');eb.hidden=true;sv.hidden=ca.hidden=false;
 $$('[data-set]').forEach(el=>{el.dataset.orig=el.innerText;editable(el)});
 if(pb){pb.contentEditable='true';editable(ph);toolbar();
  pb.addEventListener('click',e=>{const im=e.target.closest('img');if(im&&document.body.classList.contains('editing')){e.preventDefault();replaceImg(im)}});}
 if(typeof toast==='function')toast('စာသားကို နှိပ်ပြီး ပြင်ပါ။ ပုံကို နှိပ်ပြီး ပုံ အသစ်တင်ပါ။');
 $$('[data-img]').forEach(im=>im.addEventListener('click',e=>{e.preventDefault();replaceImg(im)}));
 document.addEventListener('click',e=>{if(!document.body.classList.contains('editing')||e.target.closest('#a-tb'))return;const a=e.target.closest('a');if(a)e.preventDefault();
  const b=e.target.closest('button[data-set]');if(b)e.preventDefault();
  const l=e.target.closest('label[data-set]');if(l)e.preventDefault();},true);
 $$('img').forEach(im=>{if(im.closest('.abar')||im.closest('.adm-ov')||im.closest('#a-tb')||im.closest('.side')||im.closest('.mg'))return;if(!im.dataset.img)im.addEventListener('click',e=>{if(document.body.classList.contains('editing')&&!im.closest('#pb')){e.preventDefault();replaceImg(im)}})});}
eb.onclick=enter;ca.onclick=leave;
sv.onclick=async()=>{sv.disabled=true;let ok=true;const vals={};
 $$('[data-set]').forEach(el=>{const v=el.innerText.trim();if(v!==(el.dataset.orig||'').trim())vals[el.dataset.set]=v});
 if(Object.keys(vals).length||Object.keys(imgVals).length)ok=!!await done(api('setting_save',{values:Object.assign({},vals,imgVals)}));
 if(ok&&pb){const c=pb.cloneNode(true);c.removeAttribute('contenteditable');$$('[id]',c).forEach(x=>x.removeAttribute('id'));
  ok=!!await done(api('page_save',{slug:pb.dataset.slug,title:ph.innerText.trim(),label:$('#ap-label').value,desc:$('#ap-desc').value,cat:$('#ap-cat').value,body:c.innerHTML}))}
 if(ok)setTimeout(leave,500);else sv.disabled=false};
const del=$('#ap-del');if(del)del.onclick=async()=>{if(confirm('ဤစာမျက်နှာကို ဖျက်မည်လား? ပြန်ယူ၍ မရပါ။')&&await done(api('page_delete',{slug:pb.dataset.slug}),'ဖျက်ပြီးပါပြီ'))setTimeout(()=>location.href=base+'index.php',400)};
if(new URLSearchParams(location.search).get('edit')==='1')enter();
})();
