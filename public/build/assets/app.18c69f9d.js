const a="modulepreload",m=function(i){return"/build/"+i},l={},o=function(s,n,d){return!n||n.length===0?s():Promise.all(n.map(e=>{if(e=m(e),e in l)return;l[e]=!0;const t=e.endsWith(".css"),c=t?'[rel="stylesheet"]':"";if(document.querySelector(`link[href="${e}"]${c}`))return;const r=document.createElement("link");if(r.rel=t?"stylesheet":a,t||(r.as="script",r.crossOrigin=""),r.href=e,document.head.appendChild(r),t)return new Promise((u,_)=>{r.addEventListener("load",u),r.addEventListener("error",()=>_(new Error(`Unable to preload CSS for ${e}`)))})})).then(()=>s())};o(()=>import("./bootstrap.c5ce4836.js"),[]);o(()=>import("./alpine.min.afe4fbc8.js"),[]);o(()=>import("./main.c252aae6.js"),[]);