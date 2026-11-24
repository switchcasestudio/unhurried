const {chromium}=require('playwright');
const base='http://127.0.0.1:9400';
const routes=process.argv.slice(2).length?process.argv.slice(2):['/','/about/','/services/','/contact/','/journal/','/what-a-first-consultation-is-really-for/','/nope404/'];
(async()=>{const b=await chromium.launch();
for (const [w,h] of [[1440,900],[390,844]]){
 const c=await b.newContext({viewport:{width:w,height:h}});
 for (const r of routes){ const p=await c.newPage(); const errs=[];
  p.on('console',m=>{if(m.type()==='error')errs.push(m.text())});
  try{ const res=await p.goto(base+r,{waitUntil:'load',timeout:90000});
  await p.evaluate(()=>document.fonts.ready);
  await p.evaluate(async()=>{for(let y=0;y<document.body.scrollHeight;y+=400){scrollTo(0,y);await new Promise(r=>setTimeout(r,60));}scrollTo(0,0)});
  await p.waitForTimeout(900);
  const n=(r.replace(/\//g,'')||'home');
  await p.screenshot({path:`${__dirname}/s-${n}-${w}.png`,fullPage:true});
  const m=await p.evaluate(()=>({H:document.documentElement.scrollHeight,overflow:document.documentElement.scrollWidth>innerWidth, h1:document.querySelectorAll('h1').length}));
  console.log(w,r,res.status(),JSON.stringify(m),errs.slice(0,3).join(' | '));
  }catch(e){console.log(w,r,'ERR',e.message.split('\n')[0]);}
  await p.close();}
 await c.close();}
await b.close();})();
