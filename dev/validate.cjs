const {chromium}=require('playwright');
const base='http://127.0.0.1:9400';
(async()=>{const b=await chromium.launch();const c=await b.newContext({viewport:{width:1440,height:900}});const p=await c.newPage();
await c.addCookies([{name:'wordpress_test_cookie',value:'WP%20Cookie%20check',url:base}]);const r=await c.request.post(base+'/wp-login.php',{form:{log:'admin',pwd:'password','wp-submit':'Log In',testcookie:'1',redirect_to:base+'/wp-admin/'},maxRedirects:0});console.log('login status',r.status());
// Validate every registered pattern by parsing + validating its blocks inside the editor
await p.goto(base+'/wp-admin/post-new.php?post_type=page',{timeout:120000});
for(let i=0;i<30;i++){await p.waitForTimeout(2000); if(await p.evaluate(()=>window.wp&&wp.blocks&&wp.blocks.getBlockTypes().length>50)) break;}
await p.waitForTimeout(3000); console.log("editor ok");
await p.waitForTimeout(8000); await p.waitForFunction(()=>window.wp&&wp.data&&wp.data.resolveSelect&&wp.blocks&&wp.blocks.getBlockTypes().length>50,null,{timeout:120000,polling:1000});
const out=await p.evaluate(async()=>{
  const pats=await wp.data.resolveSelect('core').getBlockPatterns();
  const res=[];
  const walk=(blocks,acc)=>{for(const bl of blocks){ if(bl.isValid===false) acc.push(bl.name+': '+(bl.validationIssues||[]).map(i=>i.args&&i.args.slice(0,1).join(' ')).join(';').slice(0,160)); walk(bl.innerBlocks||[],acc);} return acc;};
  for(const pt of pats.filter(x=>x.name.startsWith('unhurried'))){
    const blocks=wp.blocks.parse(pt.content); const bad=walk(blocks,[]);
    res.push(pt.name+' -> '+(bad.length?'INVALID '+bad.join(' || '):'ok'));
  }
  return res;});
console.log(out.join('\n'));
const tpl=await p.evaluate(async()=>{const t=await wp.data.resolveSelect('core').getEntityRecords('postType','wp_template',{per_page:-1});const tp=await wp.data.resolveSelect('core').getEntityRecords('postType','wp_template_part',{per_page:-1});
 const walk=(blocks,acc)=>{for(const bl of blocks){ if(bl.isValid===false) acc.push(bl.name); walk(bl.innerBlocks||[],acc);} return acc;};
 return [...t,...tp].filter(x=>x.theme==='unhurried'||x.theme==='unhurried-pro').map(x=>x.slug+' -> '+(walk(wp.blocks.parse(x.content.raw),[]).join(',')||'ok'));});
console.log(tpl.join('\n'));
await b.close();})();
