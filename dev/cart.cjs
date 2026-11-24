const {chromium}=require('playwright');
(async()=>{const b=await chromium.launch();const c=await b.newContext({viewport:{width:1440,height:900}});const p=await c.newPage();
const r=await (await c.request.get('http://127.0.0.1:9400/wp-json/wc/store/v1/products?per_page=2')).json();
for(const x of r){await p.goto('http://127.0.0.1:9400/?add-to-cart='+x.id,{timeout:90000});}
for(const u of ['cart','checkout']){await p.goto('http://127.0.0.1:9400/'+u+'/',{waitUntil:'load',timeout:90000});await p.waitForTimeout(4000);
 await p.screenshot({path:__dirname+'/s-'+u+'.png',fullPage:true});console.log(u,await p.evaluate(()=>document.documentElement.scrollWidth>innerWidth));}
await p.goto('http://127.0.0.1:9400/product/massage-oil-warm-amber/',{waitUntil:'load'});await p.waitForTimeout(3500);await p.screenshot({path:__dirname+'/s-product.png'});
await b.close();})();
