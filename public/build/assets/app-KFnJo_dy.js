function Gr(e,t){return function(){return e.apply(t,arguments)}}const{toString:ho}=Object.prototype,{getPrototypeOf:Sn}=Object,{iterator:lt,toStringTag:Xr}=Symbol,ft=(e=>t=>{const n=ho.call(t);return e[n]||(e[n]=n.slice(8,-1).toLowerCase())})(Object.create(null)),F=e=>(e=e.toLowerCase(),t=>ft(t)===e),dt=e=>t=>typeof t===e,{isArray:_e}=Array,Ne=dt("undefined");function Fe(e){return e!==null&&!Ne(e)&&e.constructor!==null&&!Ne(e.constructor)&&k(e.constructor.isBuffer)&&e.constructor.isBuffer(e)}const Yr=F("ArrayBuffer");function go(e){let t;return typeof ArrayBuffer<"u"&&ArrayBuffer.isView?t=ArrayBuffer.isView(e):t=e&&e.buffer&&Yr(e.buffer),t}const mo=dt("string"),k=dt("function"),Qr=dt("number"),Le=e=>e!==null&&typeof e=="object",bo=e=>e===!0||e===!1,Ye=e=>{if(ft(e)!=="object")return!1;const t=Sn(e);return(t===null||t===Object.prototype||Object.getPrototypeOf(t)===null)&&!(Xr in e)&&!(lt in e)},_o=e=>{if(!Le(e)||Fe(e))return!1;try{return Object.keys(e).length===0&&Object.getPrototypeOf(e)===Object.prototype}catch{return!1}},yo=F("Date"),wo=F("File"),Eo=F("Blob"),So=F("FileList"),Ao=e=>Le(e)&&k(e.pipe),xo=e=>{let t;return e&&(typeof FormData=="function"&&e instanceof FormData||k(e.append)&&((t=ft(e))==="formdata"||t==="object"&&k(e.toString)&&e.toString()==="[object FormData]"))},vo=F("URLSearchParams"),[To,Oo,Co,Io]=["ReadableStream","Request","Response","Headers"].map(F),Ro=e=>e.trim?e.trim():e.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,"");function $e(e,t,{allOwnKeys:n=!1}={}){if(e===null||typeof e>"u")return;let r,i;if(typeof e!="object"&&(e=[e]),_e(e))for(r=0,i=e.length;r<i;r++)t.call(null,e[r],r,e);else{if(Fe(e))return;const s=n?Object.getOwnPropertyNames(e):Object.keys(e),o=s.length;let a;for(r=0;r<o;r++)a=s[r],t.call(null,e[a],a,e)}}function Zr(e,t){if(Fe(e))return null;t=t.toLowerCase();const n=Object.keys(e);let r=n.length,i;for(;r-- >0;)if(i=n[r],t===i.toLowerCase())return i;return null}const te=typeof globalThis<"u"?globalThis:typeof self<"u"?self:typeof window<"u"?window:global,ei=e=>!Ne(e)&&e!==te;function Vt(){const{caseless:e}=ei(this)&&this||{},t={},n=(r,i)=>{const s=e&&Zr(t,i)||i;Ye(t[s])&&Ye(r)?t[s]=Vt(t[s],r):Ye(r)?t[s]=Vt({},r):_e(r)?t[s]=r.slice():t[s]=r};for(let r=0,i=arguments.length;r<i;r++)arguments[r]&&$e(arguments[r],n);return t}const Do=(e,t,n,{allOwnKeys:r}={})=>($e(t,(i,s)=>{n&&k(i)?e[s]=Gr(i,n):e[s]=i},{allOwnKeys:r}),e),No=e=>(e.charCodeAt(0)===65279&&(e=e.slice(1)),e),ko=(e,t,n,r)=>{e.prototype=Object.create(t.prototype,r),e.prototype.constructor=e,Object.defineProperty(e,"super",{value:t.prototype}),n&&Object.assign(e.prototype,n)},Po=(e,t,n,r)=>{let i,s,o;const a={};if(t=t||{},e==null)return t;do{for(i=Object.getOwnPropertyNames(e),s=i.length;s-- >0;)o=i[s],(!r||r(o,e,t))&&!a[o]&&(t[o]=e[o],a[o]=!0);e=n!==!1&&Sn(e)}while(e&&(!n||n(e,t))&&e!==Object.prototype);return t},Mo=(e,t,n)=>{e=String(e),(n===void 0||n>e.length)&&(n=e.length),n-=t.length;const r=e.indexOf(t,n);return r!==-1&&r===n},Bo=e=>{if(!e)return null;if(_e(e))return e;let t=e.length;if(!Qr(t))return null;const n=new Array(t);for(;t-- >0;)n[t]=e[t];return n},Fo=(e=>t=>e&&t instanceof e)(typeof Uint8Array<"u"&&Sn(Uint8Array)),Lo=(e,t)=>{const r=(e&&e[lt]).call(e);let i;for(;(i=r.next())&&!i.done;){const s=i.value;t.call(e,s[0],s[1])}},$o=(e,t)=>{let n;const r=[];for(;(n=e.exec(t))!==null;)r.push(n);return r},jo=F("HTMLFormElement"),Uo=e=>e.toLowerCase().replace(/[-_\s]([a-z\d])(\w*)/g,function(n,r,i){return r.toUpperCase()+i}),rr=(({hasOwnProperty:e})=>(t,n)=>e.call(t,n))(Object.prototype),Ho=F("RegExp"),ti=(e,t)=>{const n=Object.getOwnPropertyDescriptors(e),r={};$e(n,(i,s)=>{let o;(o=t(i,s,e))!==!1&&(r[s]=o||i)}),Object.defineProperties(e,r)},qo=e=>{ti(e,(t,n)=>{if(k(e)&&["arguments","caller","callee"].indexOf(n)!==-1)return!1;const r=e[n];if(k(r)){if(t.enumerable=!1,"writable"in t){t.writable=!1;return}t.set||(t.set=()=>{throw Error("Can not rewrite read-only method '"+n+"'")})}})},Ko=(e,t)=>{const n={},r=i=>{i.forEach(s=>{n[s]=!0})};return _e(e)?r(e):r(String(e).split(t)),n},Vo=()=>{},zo=(e,t)=>e!=null&&Number.isFinite(e=+e)?e:t;function Wo(e){return!!(e&&k(e.append)&&e[Xr]==="FormData"&&e[lt])}const Jo=e=>{const t=new Array(10),n=(r,i)=>{if(Le(r)){if(t.indexOf(r)>=0)return;if(Fe(r))return r;if(!("toJSON"in r)){t[i]=r;const s=_e(r)?[]:{};return $e(r,(o,a)=>{const c=n(o,i+1);!Ne(c)&&(s[a]=c)}),t[i]=void 0,s}}return r};return n(e,0)},Go=F("AsyncFunction"),Xo=e=>e&&(Le(e)||k(e))&&k(e.then)&&k(e.catch),ni=((e,t)=>e?setImmediate:t?((n,r)=>(te.addEventListener("message",({source:i,data:s})=>{i===te&&s===n&&r.length&&r.shift()()},!1),i=>{r.push(i),te.postMessage(n,"*")}))(`axios@${Math.random()}`,[]):n=>setTimeout(n))(typeof setImmediate=="function",k(te.postMessage)),Yo=typeof queueMicrotask<"u"?queueMicrotask.bind(te):typeof process<"u"&&process.nextTick||ni,Qo=e=>e!=null&&k(e[lt]),f={isArray:_e,isArrayBuffer:Yr,isBuffer:Fe,isFormData:xo,isArrayBufferView:go,isString:mo,isNumber:Qr,isBoolean:bo,isObject:Le,isPlainObject:Ye,isEmptyObject:_o,isReadableStream:To,isRequest:Oo,isResponse:Co,isHeaders:Io,isUndefined:Ne,isDate:yo,isFile:wo,isBlob:Eo,isRegExp:Ho,isFunction:k,isStream:Ao,isURLSearchParams:vo,isTypedArray:Fo,isFileList:So,forEach:$e,merge:Vt,extend:Do,trim:Ro,stripBOM:No,inherits:ko,toFlatObject:Po,kindOf:ft,kindOfTest:F,endsWith:Mo,toArray:Bo,forEachEntry:Lo,matchAll:$o,isHTMLForm:jo,hasOwnProperty:rr,hasOwnProp:rr,reduceDescriptors:ti,freezeMethods:qo,toObjectSet:Ko,toCamelCase:Uo,noop:Vo,toFiniteNumber:zo,findKey:Zr,global:te,isContextDefined:ei,isSpecCompliantForm:Wo,toJSONObject:Jo,isAsyncFn:Go,isThenable:Xo,setImmediate:ni,asap:Yo,isIterable:Qo};function y(e,t,n,r,i){Error.call(this),Error.captureStackTrace?Error.captureStackTrace(this,this.constructor):this.stack=new Error().stack,this.message=e,this.name="AxiosError",t&&(this.code=t),n&&(this.config=n),r&&(this.request=r),i&&(this.response=i,this.status=i.status?i.status:null)}f.inherits(y,Error,{toJSON:function(){return{message:this.message,name:this.name,description:this.description,number:this.number,fileName:this.fileName,lineNumber:this.lineNumber,columnNumber:this.columnNumber,stack:this.stack,config:f.toJSONObject(this.config),code:this.code,status:this.status}}});const ri=y.prototype,ii={};["ERR_BAD_OPTION_VALUE","ERR_BAD_OPTION","ECONNABORTED","ETIMEDOUT","ERR_NETWORK","ERR_FR_TOO_MANY_REDIRECTS","ERR_DEPRECATED","ERR_BAD_RESPONSE","ERR_BAD_REQUEST","ERR_CANCELED","ERR_NOT_SUPPORT","ERR_INVALID_URL"].forEach(e=>{ii[e]={value:e}});Object.defineProperties(y,ii);Object.defineProperty(ri,"isAxiosError",{value:!0});y.from=(e,t,n,r,i,s)=>{const o=Object.create(ri);return f.toFlatObject(e,o,function(c){return c!==Error.prototype},a=>a!=="isAxiosError"),y.call(o,e.message,t,n,r,i),o.cause=e,o.name=e.name,s&&Object.assign(o,s),o};const Zo=null;function zt(e){return f.isPlainObject(e)||f.isArray(e)}function si(e){return f.endsWith(e,"[]")?e.slice(0,-2):e}function ir(e,t,n){return e?e.concat(t).map(function(i,s){return i=si(i),!n&&s?"["+i+"]":i}).join(n?".":""):t}function ea(e){return f.isArray(e)&&!e.some(zt)}const ta=f.toFlatObject(f,{},null,function(t){return/^is[A-Z]/.test(t)});function pt(e,t,n){if(!f.isObject(e))throw new TypeError("target must be an object");t=t||new FormData,n=f.toFlatObject(n,{metaTokens:!0,dots:!1,indexes:!1},!1,function(b,d){return!f.isUndefined(d[b])});const r=n.metaTokens,i=n.visitor||l,s=n.dots,o=n.indexes,c=(n.Blob||typeof Blob<"u"&&Blob)&&f.isSpecCompliantForm(t);if(!f.isFunction(i))throw new TypeError("visitor must be a function");function u(g){if(g===null)return"";if(f.isDate(g))return g.toISOString();if(f.isBoolean(g))return g.toString();if(!c&&f.isBlob(g))throw new y("Blob is not supported. Use a Buffer instead.");return f.isArrayBuffer(g)||f.isTypedArray(g)?c&&typeof Blob=="function"?new Blob([g]):Buffer.from(g):g}function l(g,b,d){let m=g;if(g&&!d&&typeof g=="object"){if(f.endsWith(b,"{}"))b=r?b:b.slice(0,-2),g=JSON.stringify(g);else if(f.isArray(g)&&ea(g)||(f.isFileList(g)||f.endsWith(b,"[]"))&&(m=f.toArray(g)))return b=si(b),m.forEach(function(E,v){!(f.isUndefined(E)||E===null)&&t.append(o===!0?ir([b],v,s):o===null?b:b+"[]",u(E))}),!1}return zt(g)?!0:(t.append(ir(d,b,s),u(g)),!1)}const p=[],h=Object.assign(ta,{defaultVisitor:l,convertValue:u,isVisitable:zt});function _(g,b){if(!f.isUndefined(g)){if(p.indexOf(g)!==-1)throw Error("Circular reference detected in "+b.join("."));p.push(g),f.forEach(g,function(m,w){(!(f.isUndefined(m)||m===null)&&i.call(t,m,f.isString(w)?w.trim():w,b,h))===!0&&_(m,b?b.concat(w):[w])}),p.pop()}}if(!f.isObject(e))throw new TypeError("data must be an object");return _(e),t}function sr(e){const t={"!":"%21","'":"%27","(":"%28",")":"%29","~":"%7E","%20":"+","%00":"\0"};return encodeURIComponent(e).replace(/[!'()~]|%20|%00/g,function(r){return t[r]})}function An(e,t){this._pairs=[],e&&pt(e,this,t)}const oi=An.prototype;oi.append=function(t,n){this._pairs.push([t,n])};oi.toString=function(t){const n=t?function(r){return t.call(this,r,sr)}:sr;return this._pairs.map(function(i){return n(i[0])+"="+n(i[1])},"").join("&")};function na(e){return encodeURIComponent(e).replace(/%3A/gi,":").replace(/%24/g,"$").replace(/%2C/gi,",").replace(/%20/g,"+").replace(/%5B/gi,"[").replace(/%5D/gi,"]")}function ai(e,t,n){if(!t)return e;const r=n&&n.encode||na;f.isFunction(n)&&(n={serialize:n});const i=n&&n.serialize;let s;if(i?s=i(t,n):s=f.isURLSearchParams(t)?t.toString():new An(t,n).toString(r),s){const o=e.indexOf("#");o!==-1&&(e=e.slice(0,o)),e+=(e.indexOf("?")===-1?"?":"&")+s}return e}class or{constructor(){this.handlers=[]}use(t,n,r){return this.handlers.push({fulfilled:t,rejected:n,synchronous:r?r.synchronous:!1,runWhen:r?r.runWhen:null}),this.handlers.length-1}eject(t){this.handlers[t]&&(this.handlers[t]=null)}clear(){this.handlers&&(this.handlers=[])}forEach(t){f.forEach(this.handlers,function(r){r!==null&&t(r)})}}const ci={silentJSONParsing:!0,forcedJSONParsing:!0,clarifyTimeoutError:!1},ra=typeof URLSearchParams<"u"?URLSearchParams:An,ia=typeof FormData<"u"?FormData:null,sa=typeof Blob<"u"?Blob:null,oa={isBrowser:!0,classes:{URLSearchParams:ra,FormData:ia,Blob:sa},protocols:["http","https","file","blob","url","data"]},xn=typeof window<"u"&&typeof document<"u",Wt=typeof navigator=="object"&&navigator||void 0,aa=xn&&(!Wt||["ReactNative","NativeScript","NS"].indexOf(Wt.product)<0),ca=typeof WorkerGlobalScope<"u"&&self instanceof WorkerGlobalScope&&typeof self.importScripts=="function",ua=xn&&window.location.href||"http://localhost",la=Object.freeze(Object.defineProperty({__proto__:null,hasBrowserEnv:xn,hasStandardBrowserEnv:aa,hasStandardBrowserWebWorkerEnv:ca,navigator:Wt,origin:ua},Symbol.toStringTag,{value:"Module"})),I={...la,...oa};function fa(e,t){return pt(e,new I.classes.URLSearchParams,{visitor:function(n,r,i,s){return I.isNode&&f.isBuffer(n)?(this.append(r,n.toString("base64")),!1):s.defaultVisitor.apply(this,arguments)},...t})}function da(e){return f.matchAll(/\w+|\[(\w*)]/g,e).map(t=>t[0]==="[]"?"":t[1]||t[0])}function pa(e){const t={},n=Object.keys(e);let r;const i=n.length;let s;for(r=0;r<i;r++)s=n[r],t[s]=e[s];return t}function ui(e){function t(n,r,i,s){let o=n[s++];if(o==="__proto__")return!0;const a=Number.isFinite(+o),c=s>=n.length;return o=!o&&f.isArray(i)?i.length:o,c?(f.hasOwnProp(i,o)?i[o]=[i[o],r]:i[o]=r,!a):((!i[o]||!f.isObject(i[o]))&&(i[o]=[]),t(n,r,i[o],s)&&f.isArray(i[o])&&(i[o]=pa(i[o])),!a)}if(f.isFormData(e)&&f.isFunction(e.entries)){const n={};return f.forEachEntry(e,(r,i)=>{t(da(r),i,n,0)}),n}return null}function ha(e,t,n){if(f.isString(e))try{return(t||JSON.parse)(e),f.trim(e)}catch(r){if(r.name!=="SyntaxError")throw r}return(0,JSON.stringify)(e)}const je={transitional:ci,adapter:["xhr","http","fetch"],transformRequest:[function(t,n){const r=n.getContentType()||"",i=r.indexOf("application/json")>-1,s=f.isObject(t);if(s&&f.isHTMLForm(t)&&(t=new FormData(t)),f.isFormData(t))return i?JSON.stringify(ui(t)):t;if(f.isArrayBuffer(t)||f.isBuffer(t)||f.isStream(t)||f.isFile(t)||f.isBlob(t)||f.isReadableStream(t))return t;if(f.isArrayBufferView(t))return t.buffer;if(f.isURLSearchParams(t))return n.setContentType("application/x-www-form-urlencoded;charset=utf-8",!1),t.toString();let a;if(s){if(r.indexOf("application/x-www-form-urlencoded")>-1)return fa(t,this.formSerializer).toString();if((a=f.isFileList(t))||r.indexOf("multipart/form-data")>-1){const c=this.env&&this.env.FormData;return pt(a?{"files[]":t}:t,c&&new c,this.formSerializer)}}return s||i?(n.setContentType("application/json",!1),ha(t)):t}],transformResponse:[function(t){const n=this.transitional||je.transitional,r=n&&n.forcedJSONParsing,i=this.responseType==="json";if(f.isResponse(t)||f.isReadableStream(t))return t;if(t&&f.isString(t)&&(r&&!this.responseType||i)){const o=!(n&&n.silentJSONParsing)&&i;try{return JSON.parse(t)}catch(a){if(o)throw a.name==="SyntaxError"?y.from(a,y.ERR_BAD_RESPONSE,this,null,this.response):a}}return t}],timeout:0,xsrfCookieName:"XSRF-TOKEN",xsrfHeaderName:"X-XSRF-TOKEN",maxContentLength:-1,maxBodyLength:-1,env:{FormData:I.classes.FormData,Blob:I.classes.Blob},validateStatus:function(t){return t>=200&&t<300},headers:{common:{Accept:"application/json, text/plain, */*","Content-Type":void 0}}};f.forEach(["delete","get","head","post","put","patch"],e=>{je.headers[e]={}});const ga=f.toObjectSet(["age","authorization","content-length","content-type","etag","expires","from","host","if-modified-since","if-unmodified-since","last-modified","location","max-forwards","proxy-authorization","referer","retry-after","user-agent"]),ma=e=>{const t={};let n,r,i;return e&&e.split(`
`).forEach(function(o){i=o.indexOf(":"),n=o.substring(0,i).trim().toLowerCase(),r=o.substring(i+1).trim(),!(!n||t[n]&&ga[n])&&(n==="set-cookie"?t[n]?t[n].push(r):t[n]=[r]:t[n]=t[n]?t[n]+", "+r:r)}),t},ar=Symbol("internals");function ve(e){return e&&String(e).trim().toLowerCase()}function Qe(e){return e===!1||e==null?e:f.isArray(e)?e.map(Qe):String(e)}function ba(e){const t=Object.create(null),n=/([^\s,;=]+)\s*(?:=\s*([^,;]+))?/g;let r;for(;r=n.exec(e);)t[r[1]]=r[2];return t}const _a=e=>/^[-_a-zA-Z0-9^`|~,!#$%&'*+.]+$/.test(e.trim());function Ot(e,t,n,r,i){if(f.isFunction(r))return r.call(this,t,n);if(i&&(t=n),!!f.isString(t)){if(f.isString(r))return t.indexOf(r)!==-1;if(f.isRegExp(r))return r.test(t)}}function ya(e){return e.trim().toLowerCase().replace(/([a-z\d])(\w*)/g,(t,n,r)=>n.toUpperCase()+r)}function wa(e,t){const n=f.toCamelCase(" "+t);["get","set","has"].forEach(r=>{Object.defineProperty(e,r+n,{value:function(i,s,o){return this[r].call(this,t,i,s,o)},configurable:!0})})}class P{constructor(t){t&&this.set(t)}set(t,n,r){const i=this;function s(a,c,u){const l=ve(c);if(!l)throw new Error("header name must be a non-empty string");const p=f.findKey(i,l);(!p||i[p]===void 0||u===!0||u===void 0&&i[p]!==!1)&&(i[p||c]=Qe(a))}const o=(a,c)=>f.forEach(a,(u,l)=>s(u,l,c));if(f.isPlainObject(t)||t instanceof this.constructor)o(t,n);else if(f.isString(t)&&(t=t.trim())&&!_a(t))o(ma(t),n);else if(f.isObject(t)&&f.isIterable(t)){let a={},c,u;for(const l of t){if(!f.isArray(l))throw TypeError("Object iterator must return a key-value pair");a[u=l[0]]=(c=a[u])?f.isArray(c)?[...c,l[1]]:[c,l[1]]:l[1]}o(a,n)}else t!=null&&s(n,t,r);return this}get(t,n){if(t=ve(t),t){const r=f.findKey(this,t);if(r){const i=this[r];if(!n)return i;if(n===!0)return ba(i);if(f.isFunction(n))return n.call(this,i,r);if(f.isRegExp(n))return n.exec(i);throw new TypeError("parser must be boolean|regexp|function")}}}has(t,n){if(t=ve(t),t){const r=f.findKey(this,t);return!!(r&&this[r]!==void 0&&(!n||Ot(this,this[r],r,n)))}return!1}delete(t,n){const r=this;let i=!1;function s(o){if(o=ve(o),o){const a=f.findKey(r,o);a&&(!n||Ot(r,r[a],a,n))&&(delete r[a],i=!0)}}return f.isArray(t)?t.forEach(s):s(t),i}clear(t){const n=Object.keys(this);let r=n.length,i=!1;for(;r--;){const s=n[r];(!t||Ot(this,this[s],s,t,!0))&&(delete this[s],i=!0)}return i}normalize(t){const n=this,r={};return f.forEach(this,(i,s)=>{const o=f.findKey(r,s);if(o){n[o]=Qe(i),delete n[s];return}const a=t?ya(s):String(s).trim();a!==s&&delete n[s],n[a]=Qe(i),r[a]=!0}),this}concat(...t){return this.constructor.concat(this,...t)}toJSON(t){const n=Object.create(null);return f.forEach(this,(r,i)=>{r!=null&&r!==!1&&(n[i]=t&&f.isArray(r)?r.join(", "):r)}),n}[Symbol.iterator](){return Object.entries(this.toJSON())[Symbol.iterator]()}toString(){return Object.entries(this.toJSON()).map(([t,n])=>t+": "+n).join(`
`)}getSetCookie(){return this.get("set-cookie")||[]}get[Symbol.toStringTag](){return"AxiosHeaders"}static from(t){return t instanceof this?t:new this(t)}static concat(t,...n){const r=new this(t);return n.forEach(i=>r.set(i)),r}static accessor(t){const r=(this[ar]=this[ar]={accessors:{}}).accessors,i=this.prototype;function s(o){const a=ve(o);r[a]||(wa(i,o),r[a]=!0)}return f.isArray(t)?t.forEach(s):s(t),this}}P.accessor(["Content-Type","Content-Length","Accept","Accept-Encoding","User-Agent","Authorization"]);f.reduceDescriptors(P.prototype,({value:e},t)=>{let n=t[0].toUpperCase()+t.slice(1);return{get:()=>e,set(r){this[n]=r}}});f.freezeMethods(P);function Ct(e,t){const n=this||je,r=t||n,i=P.from(r.headers);let s=r.data;return f.forEach(e,function(a){s=a.call(n,s,i.normalize(),t?t.status:void 0)}),i.normalize(),s}function li(e){return!!(e&&e.__CANCEL__)}function ye(e,t,n){y.call(this,e??"canceled",y.ERR_CANCELED,t,n),this.name="CanceledError"}f.inherits(ye,y,{__CANCEL__:!0});function fi(e,t,n){const r=n.config.validateStatus;!n.status||!r||r(n.status)?e(n):t(new y("Request failed with status code "+n.status,[y.ERR_BAD_REQUEST,y.ERR_BAD_RESPONSE][Math.floor(n.status/100)-4],n.config,n.request,n))}function Ea(e){const t=/^([-+\w]{1,25})(:?\/\/|:)/.exec(e);return t&&t[1]||""}function Sa(e,t){e=e||10;const n=new Array(e),r=new Array(e);let i=0,s=0,o;return t=t!==void 0?t:1e3,function(c){const u=Date.now(),l=r[s];o||(o=u),n[i]=c,r[i]=u;let p=s,h=0;for(;p!==i;)h+=n[p++],p=p%e;if(i=(i+1)%e,i===s&&(s=(s+1)%e),u-o<t)return;const _=l&&u-l;return _?Math.round(h*1e3/_):void 0}}function Aa(e,t){let n=0,r=1e3/t,i,s;const o=(u,l=Date.now())=>{n=l,i=null,s&&(clearTimeout(s),s=null),e(...u)};return[(...u)=>{const l=Date.now(),p=l-n;p>=r?o(u,l):(i=u,s||(s=setTimeout(()=>{s=null,o(i)},r-p)))},()=>i&&o(i)]}const nt=(e,t,n=3)=>{let r=0;const i=Sa(50,250);return Aa(s=>{const o=s.loaded,a=s.lengthComputable?s.total:void 0,c=o-r,u=i(c),l=o<=a;r=o;const p={loaded:o,total:a,progress:a?o/a:void 0,bytes:c,rate:u||void 0,estimated:u&&a&&l?(a-o)/u:void 0,event:s,lengthComputable:a!=null,[t?"download":"upload"]:!0};e(p)},n)},cr=(e,t)=>{const n=e!=null;return[r=>t[0]({lengthComputable:n,total:e,loaded:r}),t[1]]},ur=e=>(...t)=>f.asap(()=>e(...t)),xa=I.hasStandardBrowserEnv?((e,t)=>n=>(n=new URL(n,I.origin),e.protocol===n.protocol&&e.host===n.host&&(t||e.port===n.port)))(new URL(I.origin),I.navigator&&/(msie|trident)/i.test(I.navigator.userAgent)):()=>!0,va=I.hasStandardBrowserEnv?{write(e,t,n,r,i,s){const o=[e+"="+encodeURIComponent(t)];f.isNumber(n)&&o.push("expires="+new Date(n).toGMTString()),f.isString(r)&&o.push("path="+r),f.isString(i)&&o.push("domain="+i),s===!0&&o.push("secure"),document.cookie=o.join("; ")},read(e){const t=document.cookie.match(new RegExp("(^|;\\s*)("+e+")=([^;]*)"));return t?decodeURIComponent(t[3]):null},remove(e){this.write(e,"",Date.now()-864e5)}}:{write(){},read(){return null},remove(){}};function Ta(e){return/^([a-z][a-z\d+\-.]*:)?\/\//i.test(e)}function Oa(e,t){return t?e.replace(/\/?\/$/,"")+"/"+t.replace(/^\/+/,""):e}function di(e,t,n){let r=!Ta(t);return e&&(r||n==!1)?Oa(e,t):t}const lr=e=>e instanceof P?{...e}:e;function ue(e,t){t=t||{};const n={};function r(u,l,p,h){return f.isPlainObject(u)&&f.isPlainObject(l)?f.merge.call({caseless:h},u,l):f.isPlainObject(l)?f.merge({},l):f.isArray(l)?l.slice():l}function i(u,l,p,h){if(f.isUndefined(l)){if(!f.isUndefined(u))return r(void 0,u,p,h)}else return r(u,l,p,h)}function s(u,l){if(!f.isUndefined(l))return r(void 0,l)}function o(u,l){if(f.isUndefined(l)){if(!f.isUndefined(u))return r(void 0,u)}else return r(void 0,l)}function a(u,l,p){if(p in t)return r(u,l);if(p in e)return r(void 0,u)}const c={url:s,method:s,data:s,baseURL:o,transformRequest:o,transformResponse:o,paramsSerializer:o,timeout:o,timeoutMessage:o,withCredentials:o,withXSRFToken:o,adapter:o,responseType:o,xsrfCookieName:o,xsrfHeaderName:o,onUploadProgress:o,onDownloadProgress:o,decompress:o,maxContentLength:o,maxBodyLength:o,beforeRedirect:o,transport:o,httpAgent:o,httpsAgent:o,cancelToken:o,socketPath:o,responseEncoding:o,validateStatus:a,headers:(u,l,p)=>i(lr(u),lr(l),p,!0)};return f.forEach(Object.keys({...e,...t}),function(l){const p=c[l]||i,h=p(e[l],t[l],l);f.isUndefined(h)&&p!==a||(n[l]=h)}),n}const pi=e=>{const t=ue({},e);let{data:n,withXSRFToken:r,xsrfHeaderName:i,xsrfCookieName:s,headers:o,auth:a}=t;t.headers=o=P.from(o),t.url=ai(di(t.baseURL,t.url,t.allowAbsoluteUrls),e.params,e.paramsSerializer),a&&o.set("Authorization","Basic "+btoa((a.username||"")+":"+(a.password?unescape(encodeURIComponent(a.password)):"")));let c;if(f.isFormData(n)){if(I.hasStandardBrowserEnv||I.hasStandardBrowserWebWorkerEnv)o.setContentType(void 0);else if((c=o.getContentType())!==!1){const[u,...l]=c?c.split(";").map(p=>p.trim()).filter(Boolean):[];o.setContentType([u||"multipart/form-data",...l].join("; "))}}if(I.hasStandardBrowserEnv&&(r&&f.isFunction(r)&&(r=r(t)),r||r!==!1&&xa(t.url))){const u=i&&s&&va.read(s);u&&o.set(i,u)}return t},Ca=typeof XMLHttpRequest<"u",Ia=Ca&&function(e){return new Promise(function(n,r){const i=pi(e);let s=i.data;const o=P.from(i.headers).normalize();let{responseType:a,onUploadProgress:c,onDownloadProgress:u}=i,l,p,h,_,g;function b(){_&&_(),g&&g(),i.cancelToken&&i.cancelToken.unsubscribe(l),i.signal&&i.signal.removeEventListener("abort",l)}let d=new XMLHttpRequest;d.open(i.method.toUpperCase(),i.url,!0),d.timeout=i.timeout;function m(){if(!d)return;const E=P.from("getAllResponseHeaders"in d&&d.getAllResponseHeaders()),T={data:!a||a==="text"||a==="json"?d.responseText:d.response,status:d.status,statusText:d.statusText,headers:E,config:e,request:d};fi(function($){n($),b()},function($){r($),b()},T),d=null}"onloadend"in d?d.onloadend=m:d.onreadystatechange=function(){!d||d.readyState!==4||d.status===0&&!(d.responseURL&&d.responseURL.indexOf("file:")===0)||setTimeout(m)},d.onabort=function(){d&&(r(new y("Request aborted",y.ECONNABORTED,e,d)),d=null)},d.onerror=function(){r(new y("Network Error",y.ERR_NETWORK,e,d)),d=null},d.ontimeout=function(){let v=i.timeout?"timeout of "+i.timeout+"ms exceeded":"timeout exceeded";const T=i.transitional||ci;i.timeoutErrorMessage&&(v=i.timeoutErrorMessage),r(new y(v,T.clarifyTimeoutError?y.ETIMEDOUT:y.ECONNABORTED,e,d)),d=null},s===void 0&&o.setContentType(null),"setRequestHeader"in d&&f.forEach(o.toJSON(),function(v,T){d.setRequestHeader(T,v)}),f.isUndefined(i.withCredentials)||(d.withCredentials=!!i.withCredentials),a&&a!=="json"&&(d.responseType=i.responseType),u&&([h,g]=nt(u,!0),d.addEventListener("progress",h)),c&&d.upload&&([p,_]=nt(c),d.upload.addEventListener("progress",p),d.upload.addEventListener("loadend",_)),(i.cancelToken||i.signal)&&(l=E=>{d&&(r(!E||E.type?new ye(null,e,d):E),d.abort(),d=null)},i.cancelToken&&i.cancelToken.subscribe(l),i.signal&&(i.signal.aborted?l():i.signal.addEventListener("abort",l)));const w=Ea(i.url);if(w&&I.protocols.indexOf(w)===-1){r(new y("Unsupported protocol "+w+":",y.ERR_BAD_REQUEST,e));return}d.send(s||null)})},Ra=(e,t)=>{const{length:n}=e=e?e.filter(Boolean):[];if(t||n){let r=new AbortController,i;const s=function(u){if(!i){i=!0,a();const l=u instanceof Error?u:this.reason;r.abort(l instanceof y?l:new ye(l instanceof Error?l.message:l))}};let o=t&&setTimeout(()=>{o=null,s(new y(`timeout ${t} of ms exceeded`,y.ETIMEDOUT))},t);const a=()=>{e&&(o&&clearTimeout(o),o=null,e.forEach(u=>{u.unsubscribe?u.unsubscribe(s):u.removeEventListener("abort",s)}),e=null)};e.forEach(u=>u.addEventListener("abort",s));const{signal:c}=r;return c.unsubscribe=()=>f.asap(a),c}},Da=function*(e,t){let n=e.byteLength;if(n<t){yield e;return}let r=0,i;for(;r<n;)i=r+t,yield e.slice(r,i),r=i},Na=async function*(e,t){for await(const n of ka(e))yield*Da(n,t)},ka=async function*(e){if(e[Symbol.asyncIterator]){yield*e;return}const t=e.getReader();try{for(;;){const{done:n,value:r}=await t.read();if(n)break;yield r}}finally{await t.cancel()}},fr=(e,t,n,r)=>{const i=Na(e,t);let s=0,o,a=c=>{o||(o=!0,r&&r(c))};return new ReadableStream({async pull(c){try{const{done:u,value:l}=await i.next();if(u){a(),c.close();return}let p=l.byteLength;if(n){let h=s+=p;n(h)}c.enqueue(new Uint8Array(l))}catch(u){throw a(u),u}},cancel(c){return a(c),i.return()}},{highWaterMark:2})},ht=typeof fetch=="function"&&typeof Request=="function"&&typeof Response=="function",hi=ht&&typeof ReadableStream=="function",Pa=ht&&(typeof TextEncoder=="function"?(e=>t=>e.encode(t))(new TextEncoder):async e=>new Uint8Array(await new Response(e).arrayBuffer())),gi=(e,...t)=>{try{return!!e(...t)}catch{return!1}},Ma=hi&&gi(()=>{let e=!1;const t=new Request(I.origin,{body:new ReadableStream,method:"POST",get duplex(){return e=!0,"half"}}).headers.has("Content-Type");return e&&!t}),dr=64*1024,Jt=hi&&gi(()=>f.isReadableStream(new Response("").body)),rt={stream:Jt&&(e=>e.body)};ht&&(e=>{["text","arrayBuffer","blob","formData","stream"].forEach(t=>{!rt[t]&&(rt[t]=f.isFunction(e[t])?n=>n[t]():(n,r)=>{throw new y(`Response type '${t}' is not supported`,y.ERR_NOT_SUPPORT,r)})})})(new Response);const Ba=async e=>{if(e==null)return 0;if(f.isBlob(e))return e.size;if(f.isSpecCompliantForm(e))return(await new Request(I.origin,{method:"POST",body:e}).arrayBuffer()).byteLength;if(f.isArrayBufferView(e)||f.isArrayBuffer(e))return e.byteLength;if(f.isURLSearchParams(e)&&(e=e+""),f.isString(e))return(await Pa(e)).byteLength},Fa=async(e,t)=>{const n=f.toFiniteNumber(e.getContentLength());return n??Ba(t)},La=ht&&(async e=>{let{url:t,method:n,data:r,signal:i,cancelToken:s,timeout:o,onDownloadProgress:a,onUploadProgress:c,responseType:u,headers:l,withCredentials:p="same-origin",fetchOptions:h}=pi(e);u=u?(u+"").toLowerCase():"text";let _=Ra([i,s&&s.toAbortSignal()],o),g;const b=_&&_.unsubscribe&&(()=>{_.unsubscribe()});let d;try{if(c&&Ma&&n!=="get"&&n!=="head"&&(d=await Fa(l,r))!==0){let T=new Request(t,{method:"POST",body:r,duplex:"half"}),N;if(f.isFormData(r)&&(N=T.headers.get("content-type"))&&l.setContentType(N),T.body){const[$,ge]=cr(d,nt(ur(c)));r=fr(T.body,dr,$,ge)}}f.isString(p)||(p=p?"include":"omit");const m="credentials"in Request.prototype;g=new Request(t,{...h,signal:_,method:n.toUpperCase(),headers:l.normalize().toJSON(),body:r,duplex:"half",credentials:m?p:void 0});let w=await fetch(g,h);const E=Jt&&(u==="stream"||u==="response");if(Jt&&(a||E&&b)){const T={};["status","statusText","headers"].forEach(Ve=>{T[Ve]=w[Ve]});const N=f.toFiniteNumber(w.headers.get("content-length")),[$,ge]=a&&cr(N,nt(ur(a),!0))||[];w=new Response(fr(w.body,dr,$,()=>{ge&&ge(),b&&b()}),T)}u=u||"text";let v=await rt[f.findKey(rt,u)||"text"](w,e);return!E&&b&&b(),await new Promise((T,N)=>{fi(T,N,{data:v,headers:P.from(w.headers),status:w.status,statusText:w.statusText,config:e,request:g})})}catch(m){throw b&&b(),m&&m.name==="TypeError"&&/Load failed|fetch/i.test(m.message)?Object.assign(new y("Network Error",y.ERR_NETWORK,e,g),{cause:m.cause||m}):y.from(m,m&&m.code,e,g)}}),Gt={http:Zo,xhr:Ia,fetch:La};f.forEach(Gt,(e,t)=>{if(e){try{Object.defineProperty(e,"name",{value:t})}catch{}Object.defineProperty(e,"adapterName",{value:t})}});const pr=e=>`- ${e}`,$a=e=>f.isFunction(e)||e===null||e===!1,mi={getAdapter:e=>{e=f.isArray(e)?e:[e];const{length:t}=e;let n,r;const i={};for(let s=0;s<t;s++){n=e[s];let o;if(r=n,!$a(n)&&(r=Gt[(o=String(n)).toLowerCase()],r===void 0))throw new y(`Unknown adapter '${o}'`);if(r)break;i[o||"#"+s]=r}if(!r){const s=Object.entries(i).map(([a,c])=>`adapter ${a} `+(c===!1?"is not supported by the environment":"is not available in the build"));let o=t?s.length>1?`since :
`+s.map(pr).join(`
`):" "+pr(s[0]):"as no adapter specified";throw new y("There is no suitable adapter to dispatch the request "+o,"ERR_NOT_SUPPORT")}return r},adapters:Gt};function It(e){if(e.cancelToken&&e.cancelToken.throwIfRequested(),e.signal&&e.signal.aborted)throw new ye(null,e)}function hr(e){return It(e),e.headers=P.from(e.headers),e.data=Ct.call(e,e.transformRequest),["post","put","patch"].indexOf(e.method)!==-1&&e.headers.setContentType("application/x-www-form-urlencoded",!1),mi.getAdapter(e.adapter||je.adapter)(e).then(function(r){return It(e),r.data=Ct.call(e,e.transformResponse,r),r.headers=P.from(r.headers),r},function(r){return li(r)||(It(e),r&&r.response&&(r.response.data=Ct.call(e,e.transformResponse,r.response),r.response.headers=P.from(r.response.headers))),Promise.reject(r)})}const bi="1.11.0",gt={};["object","boolean","number","function","string","symbol"].forEach((e,t)=>{gt[e]=function(r){return typeof r===e||"a"+(t<1?"n ":" ")+e}});const gr={};gt.transitional=function(t,n,r){function i(s,o){return"[Axios v"+bi+"] Transitional option '"+s+"'"+o+(r?". "+r:"")}return(s,o,a)=>{if(t===!1)throw new y(i(o," has been removed"+(n?" in "+n:"")),y.ERR_DEPRECATED);return n&&!gr[o]&&(gr[o]=!0,console.warn(i(o," has been deprecated since v"+n+" and will be removed in the near future"))),t?t(s,o,a):!0}};gt.spelling=function(t){return(n,r)=>(console.warn(`${r} is likely a misspelling of ${t}`),!0)};function ja(e,t,n){if(typeof e!="object")throw new y("options must be an object",y.ERR_BAD_OPTION_VALUE);const r=Object.keys(e);let i=r.length;for(;i-- >0;){const s=r[i],o=t[s];if(o){const a=e[s],c=a===void 0||o(a,s,e);if(c!==!0)throw new y("option "+s+" must be "+c,y.ERR_BAD_OPTION_VALUE);continue}if(n!==!0)throw new y("Unknown option "+s,y.ERR_BAD_OPTION)}}const Ze={assertOptions:ja,validators:gt},j=Ze.validators;class ie{constructor(t){this.defaults=t||{},this.interceptors={request:new or,response:new or}}async request(t,n){try{return await this._request(t,n)}catch(r){if(r instanceof Error){let i={};Error.captureStackTrace?Error.captureStackTrace(i):i=new Error;const s=i.stack?i.stack.replace(/^.+\n/,""):"";try{r.stack?s&&!String(r.stack).endsWith(s.replace(/^.+\n.+\n/,""))&&(r.stack+=`
`+s):r.stack=s}catch{}}throw r}}_request(t,n){typeof t=="string"?(n=n||{},n.url=t):n=t||{},n=ue(this.defaults,n);const{transitional:r,paramsSerializer:i,headers:s}=n;r!==void 0&&Ze.assertOptions(r,{silentJSONParsing:j.transitional(j.boolean),forcedJSONParsing:j.transitional(j.boolean),clarifyTimeoutError:j.transitional(j.boolean)},!1),i!=null&&(f.isFunction(i)?n.paramsSerializer={serialize:i}:Ze.assertOptions(i,{encode:j.function,serialize:j.function},!0)),n.allowAbsoluteUrls!==void 0||(this.defaults.allowAbsoluteUrls!==void 0?n.allowAbsoluteUrls=this.defaults.allowAbsoluteUrls:n.allowAbsoluteUrls=!0),Ze.assertOptions(n,{baseUrl:j.spelling("baseURL"),withXsrfToken:j.spelling("withXSRFToken")},!0),n.method=(n.method||this.defaults.method||"get").toLowerCase();let o=s&&f.merge(s.common,s[n.method]);s&&f.forEach(["delete","get","head","post","put","patch","common"],g=>{delete s[g]}),n.headers=P.concat(o,s);const a=[];let c=!0;this.interceptors.request.forEach(function(b){typeof b.runWhen=="function"&&b.runWhen(n)===!1||(c=c&&b.synchronous,a.unshift(b.fulfilled,b.rejected))});const u=[];this.interceptors.response.forEach(function(b){u.push(b.fulfilled,b.rejected)});let l,p=0,h;if(!c){const g=[hr.bind(this),void 0];for(g.unshift(...a),g.push(...u),h=g.length,l=Promise.resolve(n);p<h;)l=l.then(g[p++],g[p++]);return l}h=a.length;let _=n;for(p=0;p<h;){const g=a[p++],b=a[p++];try{_=g(_)}catch(d){b.call(this,d);break}}try{l=hr.call(this,_)}catch(g){return Promise.reject(g)}for(p=0,h=u.length;p<h;)l=l.then(u[p++],u[p++]);return l}getUri(t){t=ue(this.defaults,t);const n=di(t.baseURL,t.url,t.allowAbsoluteUrls);return ai(n,t.params,t.paramsSerializer)}}f.forEach(["delete","get","head","options"],function(t){ie.prototype[t]=function(n,r){return this.request(ue(r||{},{method:t,url:n,data:(r||{}).data}))}});f.forEach(["post","put","patch"],function(t){function n(r){return function(s,o,a){return this.request(ue(a||{},{method:t,headers:r?{"Content-Type":"multipart/form-data"}:{},url:s,data:o}))}}ie.prototype[t]=n(),ie.prototype[t+"Form"]=n(!0)});class vn{constructor(t){if(typeof t!="function")throw new TypeError("executor must be a function.");let n;this.promise=new Promise(function(s){n=s});const r=this;this.promise.then(i=>{if(!r._listeners)return;let s=r._listeners.length;for(;s-- >0;)r._listeners[s](i);r._listeners=null}),this.promise.then=i=>{let s;const o=new Promise(a=>{r.subscribe(a),s=a}).then(i);return o.cancel=function(){r.unsubscribe(s)},o},t(function(s,o,a){r.reason||(r.reason=new ye(s,o,a),n(r.reason))})}throwIfRequested(){if(this.reason)throw this.reason}subscribe(t){if(this.reason){t(this.reason);return}this._listeners?this._listeners.push(t):this._listeners=[t]}unsubscribe(t){if(!this._listeners)return;const n=this._listeners.indexOf(t);n!==-1&&this._listeners.splice(n,1)}toAbortSignal(){const t=new AbortController,n=r=>{t.abort(r)};return this.subscribe(n),t.signal.unsubscribe=()=>this.unsubscribe(n),t.signal}static source(){let t;return{token:new vn(function(i){t=i}),cancel:t}}}function Ua(e){return function(n){return e.apply(null,n)}}function Ha(e){return f.isObject(e)&&e.isAxiosError===!0}const Xt={Continue:100,SwitchingProtocols:101,Processing:102,EarlyHints:103,Ok:200,Created:201,Accepted:202,NonAuthoritativeInformation:203,NoContent:204,ResetContent:205,PartialContent:206,MultiStatus:207,AlreadyReported:208,ImUsed:226,MultipleChoices:300,MovedPermanently:301,Found:302,SeeOther:303,NotModified:304,UseProxy:305,Unused:306,TemporaryRedirect:307,PermanentRedirect:308,BadRequest:400,Unauthorized:401,PaymentRequired:402,Forbidden:403,NotFound:404,MethodNotAllowed:405,NotAcceptable:406,ProxyAuthenticationRequired:407,RequestTimeout:408,Conflict:409,Gone:410,LengthRequired:411,PreconditionFailed:412,PayloadTooLarge:413,UriTooLong:414,UnsupportedMediaType:415,RangeNotSatisfiable:416,ExpectationFailed:417,ImATeapot:418,MisdirectedRequest:421,UnprocessableEntity:422,Locked:423,FailedDependency:424,TooEarly:425,UpgradeRequired:426,PreconditionRequired:428,TooManyRequests:429,RequestHeaderFieldsTooLarge:431,UnavailableForLegalReasons:451,InternalServerError:500,NotImplemented:501,BadGateway:502,ServiceUnavailable:503,GatewayTimeout:504,HttpVersionNotSupported:505,VariantAlsoNegotiates:506,InsufficientStorage:507,LoopDetected:508,NotExtended:510,NetworkAuthenticationRequired:511};Object.entries(Xt).forEach(([e,t])=>{Xt[t]=e});function _i(e){const t=new ie(e),n=Gr(ie.prototype.request,t);return f.extend(n,ie.prototype,t,{allOwnKeys:!0}),f.extend(n,t,null,{allOwnKeys:!0}),n.create=function(i){return _i(ue(e,i))},n}const O=_i(je);O.Axios=ie;O.CanceledError=ye;O.CancelToken=vn;O.isCancel=li;O.VERSION=bi;O.toFormData=pt;O.AxiosError=y;O.Cancel=O.CanceledError;O.all=function(t){return Promise.all(t)};O.spread=Ua;O.isAxiosError=Ha;O.mergeConfig=ue;O.AxiosHeaders=P;O.formToJSON=e=>ui(f.isHTMLForm(e)?new FormData(e):e);O.getAdapter=mi.getAdapter;O.HttpStatusCode=Xt;O.default=O;window.axios=O;window.axios.defaults.headers.common["X-Requested-With"]="XMLHttpRequest";var Yt=!1,Qt=!1,se=[],Zt=-1;function qa(e){Ka(e)}function Ka(e){se.includes(e)||se.push(e),za()}function Va(e){let t=se.indexOf(e);t!==-1&&t>Zt&&se.splice(t,1)}function za(){!Qt&&!Yt&&(Yt=!0,queueMicrotask(Wa))}function Wa(){Yt=!1,Qt=!0;for(let e=0;e<se.length;e++)se[e](),Zt=e;se.length=0,Zt=-1,Qt=!1}var we,he,Ee,yi,en=!0;function Ja(e){en=!1,e(),en=!0}function Ga(e){we=e.reactive,Ee=e.release,he=t=>e.effect(t,{scheduler:n=>{en?qa(n):n()}}),yi=e.raw}function mr(e){he=e}function Xa(e){let t=()=>{};return[r=>{let i=he(r);return e._x_effects||(e._x_effects=new Set,e._x_runEffects=()=>{e._x_effects.forEach(s=>s())}),e._x_effects.add(i),t=()=>{i!==void 0&&(e._x_effects.delete(i),Ee(i))},i},()=>{t()}]}function wi(e,t){let n=!0,r,i=he(()=>{let s=e();JSON.stringify(s),n?r=s:queueMicrotask(()=>{t(s,r),r=s}),n=!1});return()=>Ee(i)}var Ei=[],Si=[],Ai=[];function Ya(e){Ai.push(e)}function Tn(e,t){typeof t=="function"?(e._x_cleanups||(e._x_cleanups=[]),e._x_cleanups.push(t)):(t=e,Si.push(t))}function xi(e){Ei.push(e)}function vi(e,t,n){e._x_attributeCleanups||(e._x_attributeCleanups={}),e._x_attributeCleanups[t]||(e._x_attributeCleanups[t]=[]),e._x_attributeCleanups[t].push(n)}function Ti(e,t){e._x_attributeCleanups&&Object.entries(e._x_attributeCleanups).forEach(([n,r])=>{(t===void 0||t.includes(n))&&(r.forEach(i=>i()),delete e._x_attributeCleanups[n])})}function Qa(e){var t,n;for((t=e._x_effects)==null||t.forEach(Va);(n=e._x_cleanups)!=null&&n.length;)e._x_cleanups.pop()()}var On=new MutationObserver(Dn),Cn=!1;function In(){On.observe(document,{subtree:!0,childList:!0,attributes:!0,attributeOldValue:!0}),Cn=!0}function Oi(){Za(),On.disconnect(),Cn=!1}var Te=[];function Za(){let e=On.takeRecords();Te.push(()=>e.length>0&&Dn(e));let t=Te.length;queueMicrotask(()=>{if(Te.length===t)for(;Te.length>0;)Te.shift()()})}function x(e){if(!Cn)return e();Oi();let t=e();return In(),t}var Rn=!1,it=[];function ec(){Rn=!0}function tc(){Rn=!1,Dn(it),it=[]}function Dn(e){if(Rn){it=it.concat(e);return}let t=new Set,n=new Set,r=new Map,i=new Map;for(let s=0;s<e.length;s++)if(!e[s].target._x_ignoreMutationObserver&&(e[s].type==="childList"&&(e[s].addedNodes.forEach(o=>o.nodeType===1&&t.add(o)),e[s].removedNodes.forEach(o=>o.nodeType===1&&n.add(o))),e[s].type==="attributes")){let o=e[s].target,a=e[s].attributeName,c=e[s].oldValue,u=()=>{r.has(o)||r.set(o,[]),r.get(o).push({name:a,value:o.getAttribute(a)})},l=()=>{i.has(o)||i.set(o,[]),i.get(o).push(a)};o.hasAttribute(a)&&c===null?u():o.hasAttribute(a)?(l(),u()):l()}i.forEach((s,o)=>{Ti(o,s)}),r.forEach((s,o)=>{Ei.forEach(a=>a(o,s))});for(let s of n)t.has(s)||Si.forEach(o=>o(s));t.forEach(s=>{s._x_ignoreSelf=!0,s._x_ignore=!0});for(let s of t)n.has(s)||s.isConnected&&(delete s._x_ignoreSelf,delete s._x_ignore,Ai.forEach(o=>o(s)),s._x_ignore=!0,s._x_ignoreSelf=!0);t.forEach(s=>{delete s._x_ignoreSelf,delete s._x_ignore}),t=null,n=null,r=null,i=null}function Ci(e){return He(me(e))}function Ue(e,t,n){return e._x_dataStack=[t,...me(n||e)],()=>{e._x_dataStack=e._x_dataStack.filter(r=>r!==t)}}function me(e){return e._x_dataStack?e._x_dataStack:typeof ShadowRoot=="function"&&e instanceof ShadowRoot?me(e.host):e.parentNode?me(e.parentNode):[]}function He(e){return new Proxy({objects:e},nc)}var nc={ownKeys({objects:e}){return Array.from(new Set(e.flatMap(t=>Object.keys(t))))},has({objects:e},t){return t==Symbol.unscopables?!1:e.some(n=>Object.prototype.hasOwnProperty.call(n,t)||Reflect.has(n,t))},get({objects:e},t,n){return t=="toJSON"?rc:Reflect.get(e.find(r=>Reflect.has(r,t))||{},t,n)},set({objects:e},t,n,r){const i=e.find(o=>Object.prototype.hasOwnProperty.call(o,t))||e[e.length-1],s=Object.getOwnPropertyDescriptor(i,t);return s!=null&&s.set&&(s!=null&&s.get)?s.set.call(r,n)||!0:Reflect.set(i,t,n)}};function rc(){return Reflect.ownKeys(this).reduce((t,n)=>(t[n]=Reflect.get(this,n),t),{})}function Ii(e){let t=r=>typeof r=="object"&&!Array.isArray(r)&&r!==null,n=(r,i="")=>{Object.entries(Object.getOwnPropertyDescriptors(r)).forEach(([s,{value:o,enumerable:a}])=>{if(a===!1||o===void 0||typeof o=="object"&&o!==null&&o.__v_skip)return;let c=i===""?s:`${i}.${s}`;typeof o=="object"&&o!==null&&o._x_interceptor?r[s]=o.initialize(e,c,s):t(o)&&o!==r&&!(o instanceof Element)&&n(o,c)})};return n(e)}function Ri(e,t=()=>{}){let n={initialValue:void 0,_x_interceptor:!0,initialize(r,i,s){return e(this.initialValue,()=>ic(r,i),o=>tn(r,i,o),i,s)}};return t(n),r=>{if(typeof r=="object"&&r!==null&&r._x_interceptor){let i=n.initialize.bind(n);n.initialize=(s,o,a)=>{let c=r.initialize(s,o,a);return n.initialValue=c,i(s,o,a)}}else n.initialValue=r;return n}}function ic(e,t){return t.split(".").reduce((n,r)=>n[r],e)}function tn(e,t,n){if(typeof t=="string"&&(t=t.split(".")),t.length===1)e[t[0]]=n;else{if(t.length===0)throw error;return e[t[0]]||(e[t[0]]={}),tn(e[t[0]],t.slice(1),n)}}var Di={};function L(e,t){Di[e]=t}function nn(e,t){let n=sc(t);return Object.entries(Di).forEach(([r,i])=>{Object.defineProperty(e,`$${r}`,{get(){return i(t,n)},enumerable:!1})}),e}function sc(e){let[t,n]=Fi(e),r={interceptor:Ri,...t};return Tn(e,n),r}function oc(e,t,n,...r){try{return n(...r)}catch(i){ke(i,e,t)}}function ke(e,t,n=void 0){e=Object.assign(e??{message:"No error message given."},{el:t,expression:n}),console.warn(`Alpine Expression Error: ${e.message}

${n?'Expression: "'+n+`"

`:""}`,t),setTimeout(()=>{throw e},0)}var et=!0;function Ni(e){let t=et;et=!1;let n=e();return et=t,n}function oe(e,t,n={}){let r;return D(e,t)(i=>r=i,n),r}function D(...e){return ki(...e)}var ki=Pi;function ac(e){ki=e}function Pi(e,t){let n={};nn(n,e);let r=[n,...me(e)],i=typeof t=="function"?cc(r,t):lc(r,t,e);return oc.bind(null,e,t,i)}function cc(e,t){return(n=()=>{},{scope:r={},params:i=[]}={})=>{let s=t.apply(He([r,...e]),i);st(n,s)}}var Rt={};function uc(e,t){if(Rt[e])return Rt[e];let n=Object.getPrototypeOf(async function(){}).constructor,r=/^[\n\s]*if.*\(.*\)/.test(e.trim())||/^(let|const)\s/.test(e.trim())?`(async()=>{ ${e} })()`:e,s=(()=>{try{let o=new n(["__self","scope"],`with (scope) { __self.result = ${r} }; __self.finished = true; return __self.result;`);return Object.defineProperty(o,"name",{value:`[Alpine] ${e}`}),o}catch(o){return ke(o,t,e),Promise.resolve()}})();return Rt[e]=s,s}function lc(e,t,n){let r=uc(t,n);return(i=()=>{},{scope:s={},params:o=[]}={})=>{r.result=void 0,r.finished=!1;let a=He([s,...e]);if(typeof r=="function"){let c=r(r,a).catch(u=>ke(u,n,t));r.finished?(st(i,r.result,a,o,n),r.result=void 0):c.then(u=>{st(i,u,a,o,n)}).catch(u=>ke(u,n,t)).finally(()=>r.result=void 0)}}}function st(e,t,n,r,i){if(et&&typeof t=="function"){let s=t.apply(n,r);s instanceof Promise?s.then(o=>st(e,o,n,r)).catch(o=>ke(o,i,t)):e(s)}else typeof t=="object"&&t instanceof Promise?t.then(s=>e(s)):e(t)}var Nn="x-";function Se(e=""){return Nn+e}function fc(e){Nn=e}var ot={};function C(e,t){return ot[e]=t,{before(n){if(!ot[n]){console.warn(String.raw`Cannot find directive \`${n}\`. \`${e}\` will use the default order of execution`);return}const r=ne.indexOf(n);ne.splice(r>=0?r:ne.indexOf("DEFAULT"),0,e)}}}function dc(e){return Object.keys(ot).includes(e)}function kn(e,t,n){if(t=Array.from(t),e._x_virtualDirectives){let s=Object.entries(e._x_virtualDirectives).map(([a,c])=>({name:a,value:c})),o=Mi(s);s=s.map(a=>o.find(c=>c.name===a.name)?{name:`x-bind:${a.name}`,value:`"${a.value}"`}:a),t=t.concat(s)}let r={};return t.map(ji((s,o)=>r[s]=o)).filter(Hi).map(gc(r,n)).sort(mc).map(s=>hc(e,s))}function Mi(e){return Array.from(e).map(ji()).filter(t=>!Hi(t))}var rn=!1,Ie=new Map,Bi=Symbol();function pc(e){rn=!0;let t=Symbol();Bi=t,Ie.set(t,[]);let n=()=>{for(;Ie.get(t).length;)Ie.get(t).shift()();Ie.delete(t)},r=()=>{rn=!1,n()};e(n),r()}function Fi(e){let t=[],n=a=>t.push(a),[r,i]=Xa(e);return t.push(i),[{Alpine:Ke,effect:r,cleanup:n,evaluateLater:D.bind(D,e),evaluate:oe.bind(oe,e)},()=>t.forEach(a=>a())]}function hc(e,t){let n=()=>{},r=ot[t.type]||n,[i,s]=Fi(e);vi(e,t.original,s);let o=()=>{e._x_ignore||e._x_ignoreSelf||(r.inline&&r.inline(e,t,i),r=r.bind(r,e,t,i),rn?Ie.get(Bi).push(r):r())};return o.runCleanups=s,o}var Li=(e,t)=>({name:n,value:r})=>(n.startsWith(e)&&(n=n.replace(e,t)),{name:n,value:r}),$i=e=>e;function ji(e=()=>{}){return({name:t,value:n})=>{let{name:r,value:i}=Ui.reduce((s,o)=>o(s),{name:t,value:n});return r!==t&&e(r,t),{name:r,value:i}}}var Ui=[];function Pn(e){Ui.push(e)}function Hi({name:e}){return qi().test(e)}var qi=()=>new RegExp(`^${Nn}([^:^.]+)\\b`);function gc(e,t){return({name:n,value:r})=>{let i=n.match(qi()),s=n.match(/:([a-zA-Z0-9\-_:]+)/),o=n.match(/\.[^.\]]+(?=[^\]]*$)/g)||[],a=t||e[n]||n;return{type:i?i[1]:null,value:s?s[1]:null,modifiers:o.map(c=>c.replace(".","")),expression:r,original:a}}}var sn="DEFAULT",ne=["ignore","ref","data","id","anchor","bind","init","for","model","modelable","transition","show","if",sn,"teleport"];function mc(e,t){let n=ne.indexOf(e.type)===-1?sn:e.type,r=ne.indexOf(t.type)===-1?sn:t.type;return ne.indexOf(n)-ne.indexOf(r)}function Re(e,t,n={}){e.dispatchEvent(new CustomEvent(t,{detail:n,bubbles:!0,composed:!0,cancelable:!0}))}function le(e,t){if(typeof ShadowRoot=="function"&&e instanceof ShadowRoot){Array.from(e.children).forEach(i=>le(i,t));return}let n=!1;if(t(e,()=>n=!0),n)return;let r=e.firstElementChild;for(;r;)le(r,t),r=r.nextElementSibling}function M(e,...t){console.warn(`Alpine Warning: ${e}`,...t)}var br=!1;function bc(){br&&M("Alpine has already been initialized on this page. Calling Alpine.start() more than once can cause problems."),br=!0,document.body||M("Unable to initialize. Trying to load Alpine before `<body>` is available. Did you forget to add `defer` in Alpine's `<script>` tag?"),Re(document,"alpine:init"),Re(document,"alpine:initializing"),In(),Ya(t=>K(t,le)),Tn(t=>Ae(t)),xi((t,n)=>{kn(t,n).forEach(r=>r())});let e=t=>!mt(t.parentElement,!0);Array.from(document.querySelectorAll(zi().join(","))).filter(e).forEach(t=>{K(t)}),Re(document,"alpine:initialized"),setTimeout(()=>{wc()})}var Mn=[],Ki=[];function Vi(){return Mn.map(e=>e())}function zi(){return Mn.concat(Ki).map(e=>e())}function Wi(e){Mn.push(e)}function Ji(e){Ki.push(e)}function mt(e,t=!1){return qe(e,n=>{if((t?zi():Vi()).some(i=>n.matches(i)))return!0})}function qe(e,t){if(e){if(t(e))return e;if(e._x_teleportBack&&(e=e._x_teleportBack),!!e.parentElement)return qe(e.parentElement,t)}}function _c(e){return Vi().some(t=>e.matches(t))}var Gi=[];function yc(e){Gi.push(e)}function K(e,t=le,n=()=>{}){pc(()=>{t(e,(r,i)=>{n(r,i),Gi.forEach(s=>s(r,i)),kn(r,r.attributes).forEach(s=>s()),r._x_ignore&&i()})})}function Ae(e,t=le){t(e,n=>{Qa(n),Ti(n)})}function wc(){[["ui","dialog",["[x-dialog], [x-popover]"]],["anchor","anchor",["[x-anchor]"]],["sort","sort",["[x-sort]"]]].forEach(([t,n,r])=>{dc(n)||r.some(i=>{if(document.querySelector(i))return M(`found "${i}", but missing ${t} plugin`),!0})})}var on=[],Bn=!1;function Fn(e=()=>{}){return queueMicrotask(()=>{Bn||setTimeout(()=>{an()})}),new Promise(t=>{on.push(()=>{e(),t()})})}function an(){for(Bn=!1;on.length;)on.shift()()}function Ec(){Bn=!0}function Ln(e,t){return Array.isArray(t)?_r(e,t.join(" ")):typeof t=="object"&&t!==null?Sc(e,t):typeof t=="function"?Ln(e,t()):_r(e,t)}function _r(e,t){let n=i=>i.split(" ").filter(s=>!e.classList.contains(s)).filter(Boolean),r=i=>(e.classList.add(...i),()=>{e.classList.remove(...i)});return t=t===!0?t="":t||"",r(n(t))}function Sc(e,t){let n=a=>a.split(" ").filter(Boolean),r=Object.entries(t).flatMap(([a,c])=>c?n(a):!1).filter(Boolean),i=Object.entries(t).flatMap(([a,c])=>c?!1:n(a)).filter(Boolean),s=[],o=[];return i.forEach(a=>{e.classList.contains(a)&&(e.classList.remove(a),o.push(a))}),r.forEach(a=>{e.classList.contains(a)||(e.classList.add(a),s.push(a))}),()=>{o.forEach(a=>e.classList.add(a)),s.forEach(a=>e.classList.remove(a))}}function bt(e,t){return typeof t=="object"&&t!==null?Ac(e,t):xc(e,t)}function Ac(e,t){let n={};return Object.entries(t).forEach(([r,i])=>{n[r]=e.style[r],r.startsWith("--")||(r=vc(r)),e.style.setProperty(r,i)}),setTimeout(()=>{e.style.length===0&&e.removeAttribute("style")}),()=>{bt(e,n)}}function xc(e,t){let n=e.getAttribute("style",t);return e.setAttribute("style",t),()=>{e.setAttribute("style",n||"")}}function vc(e){return e.replace(/([a-z])([A-Z])/g,"$1-$2").toLowerCase()}function cn(e,t=()=>{}){let n=!1;return function(){n?t.apply(this,arguments):(n=!0,e.apply(this,arguments))}}C("transition",(e,{value:t,modifiers:n,expression:r},{evaluate:i})=>{typeof r=="function"&&(r=i(r)),r!==!1&&(!r||typeof r=="boolean"?Oc(e,n,t):Tc(e,r,t))});function Tc(e,t,n){Xi(e,Ln,""),{enter:i=>{e._x_transition.enter.during=i},"enter-start":i=>{e._x_transition.enter.start=i},"enter-end":i=>{e._x_transition.enter.end=i},leave:i=>{e._x_transition.leave.during=i},"leave-start":i=>{e._x_transition.leave.start=i},"leave-end":i=>{e._x_transition.leave.end=i}}[n](t)}function Oc(e,t,n){Xi(e,bt);let r=!t.includes("in")&&!t.includes("out")&&!n,i=r||t.includes("in")||["enter"].includes(n),s=r||t.includes("out")||["leave"].includes(n);t.includes("in")&&!r&&(t=t.filter((m,w)=>w<t.indexOf("out"))),t.includes("out")&&!r&&(t=t.filter((m,w)=>w>t.indexOf("out")));let o=!t.includes("opacity")&&!t.includes("scale"),a=o||t.includes("opacity"),c=o||t.includes("scale"),u=a?0:1,l=c?Oe(t,"scale",95)/100:1,p=Oe(t,"delay",0)/1e3,h=Oe(t,"origin","center"),_="opacity, transform",g=Oe(t,"duration",150)/1e3,b=Oe(t,"duration",75)/1e3,d="cubic-bezier(0.4, 0.0, 0.2, 1)";i&&(e._x_transition.enter.during={transformOrigin:h,transitionDelay:`${p}s`,transitionProperty:_,transitionDuration:`${g}s`,transitionTimingFunction:d},e._x_transition.enter.start={opacity:u,transform:`scale(${l})`},e._x_transition.enter.end={opacity:1,transform:"scale(1)"}),s&&(e._x_transition.leave.during={transformOrigin:h,transitionDelay:`${p}s`,transitionProperty:_,transitionDuration:`${b}s`,transitionTimingFunction:d},e._x_transition.leave.start={opacity:1,transform:"scale(1)"},e._x_transition.leave.end={opacity:u,transform:`scale(${l})`})}function Xi(e,t,n={}){e._x_transition||(e._x_transition={enter:{during:n,start:n,end:n},leave:{during:n,start:n,end:n},in(r=()=>{},i=()=>{}){un(e,t,{during:this.enter.during,start:this.enter.start,end:this.enter.end},r,i)},out(r=()=>{},i=()=>{}){un(e,t,{during:this.leave.during,start:this.leave.start,end:this.leave.end},r,i)}})}window.Element.prototype._x_toggleAndCascadeWithTransitions=function(e,t,n,r){const i=document.visibilityState==="visible"?requestAnimationFrame:setTimeout;let s=()=>i(n);if(t){e._x_transition&&(e._x_transition.enter||e._x_transition.leave)?e._x_transition.enter&&(Object.entries(e._x_transition.enter.during).length||Object.entries(e._x_transition.enter.start).length||Object.entries(e._x_transition.enter.end).length)?e._x_transition.in(n):s():e._x_transition?e._x_transition.in(n):s();return}e._x_hidePromise=e._x_transition?new Promise((o,a)=>{e._x_transition.out(()=>{},()=>o(r)),e._x_transitioning&&e._x_transitioning.beforeCancel(()=>a({isFromCancelledTransition:!0}))}):Promise.resolve(r),queueMicrotask(()=>{let o=Yi(e);o?(o._x_hideChildren||(o._x_hideChildren=[]),o._x_hideChildren.push(e)):i(()=>{let a=c=>{let u=Promise.all([c._x_hidePromise,...(c._x_hideChildren||[]).map(a)]).then(([l])=>l==null?void 0:l());return delete c._x_hidePromise,delete c._x_hideChildren,u};a(e).catch(c=>{if(!c.isFromCancelledTransition)throw c})})})};function Yi(e){let t=e.parentNode;if(t)return t._x_hidePromise?t:Yi(t)}function un(e,t,{during:n,start:r,end:i}={},s=()=>{},o=()=>{}){if(e._x_transitioning&&e._x_transitioning.cancel(),Object.keys(n).length===0&&Object.keys(r).length===0&&Object.keys(i).length===0){s(),o();return}let a,c,u;Cc(e,{start(){a=t(e,r)},during(){c=t(e,n)},before:s,end(){a(),u=t(e,i)},after:o,cleanup(){c(),u()}})}function Cc(e,t){let n,r,i,s=cn(()=>{x(()=>{n=!0,r||t.before(),i||(t.end(),an()),t.after(),e.isConnected&&t.cleanup(),delete e._x_transitioning})});e._x_transitioning={beforeCancels:[],beforeCancel(o){this.beforeCancels.push(o)},cancel:cn(function(){for(;this.beforeCancels.length;)this.beforeCancels.shift()();s()}),finish:s},x(()=>{t.start(),t.during()}),Ec(),requestAnimationFrame(()=>{if(n)return;let o=Number(getComputedStyle(e).transitionDuration.replace(/,.*/,"").replace("s",""))*1e3,a=Number(getComputedStyle(e).transitionDelay.replace(/,.*/,"").replace("s",""))*1e3;o===0&&(o=Number(getComputedStyle(e).animationDuration.replace("s",""))*1e3),x(()=>{t.before()}),r=!0,requestAnimationFrame(()=>{n||(x(()=>{t.end()}),an(),setTimeout(e._x_transitioning.finish,o+a),i=!0)})})}function Oe(e,t,n){if(e.indexOf(t)===-1)return n;const r=e[e.indexOf(t)+1];if(!r||t==="scale"&&isNaN(r))return n;if(t==="duration"||t==="delay"){let i=r.match(/([0-9]+)ms/);if(i)return i[1]}return t==="origin"&&["top","right","left","center","bottom"].includes(e[e.indexOf(t)+2])?[r,e[e.indexOf(t)+2]].join(" "):r}var G=!1;function Q(e,t=()=>{}){return(...n)=>G?t(...n):e(...n)}function Ic(e){return(...t)=>G&&e(...t)}var Qi=[];function _t(e){Qi.push(e)}function Rc(e,t){Qi.forEach(n=>n(e,t)),G=!0,Zi(()=>{K(t,(n,r)=>{r(n,()=>{})})}),G=!1}var ln=!1;function Dc(e,t){t._x_dataStack||(t._x_dataStack=e._x_dataStack),G=!0,ln=!0,Zi(()=>{Nc(t)}),G=!1,ln=!1}function Nc(e){let t=!1;K(e,(r,i)=>{le(r,(s,o)=>{if(t&&_c(s))return o();t=!0,i(s,o)})})}function Zi(e){let t=he;mr((n,r)=>{let i=t(n);return Ee(i),()=>{}}),e(),mr(t)}function es(e,t,n,r=[]){switch(e._x_bindings||(e._x_bindings=we({})),e._x_bindings[t]=n,t=r.includes("camel")?jc(t):t,t){case"value":kc(e,n);break;case"style":Mc(e,n);break;case"class":Pc(e,n);break;case"selected":case"checked":Bc(e,t,n);break;default:ts(e,t,n);break}}function kc(e,t){if(is(e))e.attributes.value===void 0&&(e.value=t),window.fromModel&&(typeof t=="boolean"?e.checked=tt(e.value)===t:e.checked=yr(e.value,t));else if($n(e))Number.isInteger(t)?e.value=t:!Array.isArray(t)&&typeof t!="boolean"&&![null,void 0].includes(t)?e.value=String(t):Array.isArray(t)?e.checked=t.some(n=>yr(n,e.value)):e.checked=!!t;else if(e.tagName==="SELECT")$c(e,t);else{if(e.value===t)return;e.value=t===void 0?"":t}}function Pc(e,t){e._x_undoAddedClasses&&e._x_undoAddedClasses(),e._x_undoAddedClasses=Ln(e,t)}function Mc(e,t){e._x_undoAddedStyles&&e._x_undoAddedStyles(),e._x_undoAddedStyles=bt(e,t)}function Bc(e,t,n){ts(e,t,n),Lc(e,t,n)}function ts(e,t,n){[null,void 0,!1].includes(n)&&Hc(t)?e.removeAttribute(t):(ns(t)&&(n=t),Fc(e,t,n))}function Fc(e,t,n){e.getAttribute(t)!=n&&e.setAttribute(t,n)}function Lc(e,t,n){e[t]!==n&&(e[t]=n)}function $c(e,t){const n=[].concat(t).map(r=>r+"");Array.from(e.options).forEach(r=>{r.selected=n.includes(r.value)})}function jc(e){return e.toLowerCase().replace(/-(\w)/g,(t,n)=>n.toUpperCase())}function yr(e,t){return e==t}function tt(e){return[1,"1","true","on","yes",!0].includes(e)?!0:[0,"0","false","off","no",!1].includes(e)?!1:e?!!e:null}var Uc=new Set(["allowfullscreen","async","autofocus","autoplay","checked","controls","default","defer","disabled","formnovalidate","inert","ismap","itemscope","loop","multiple","muted","nomodule","novalidate","open","playsinline","readonly","required","reversed","selected","shadowrootclonable","shadowrootdelegatesfocus","shadowrootserializable"]);function ns(e){return Uc.has(e)}function Hc(e){return!["aria-pressed","aria-checked","aria-expanded","aria-selected"].includes(e)}function qc(e,t,n){return e._x_bindings&&e._x_bindings[t]!==void 0?e._x_bindings[t]:rs(e,t,n)}function Kc(e,t,n,r=!0){if(e._x_bindings&&e._x_bindings[t]!==void 0)return e._x_bindings[t];if(e._x_inlineBindings&&e._x_inlineBindings[t]!==void 0){let i=e._x_inlineBindings[t];return i.extract=r,Ni(()=>oe(e,i.expression))}return rs(e,t,n)}function rs(e,t,n){let r=e.getAttribute(t);return r===null?typeof n=="function"?n():n:r===""?!0:ns(t)?!![t,"true"].includes(r):r}function $n(e){return e.type==="checkbox"||e.localName==="ui-checkbox"||e.localName==="ui-switch"}function is(e){return e.type==="radio"||e.localName==="ui-radio"}function ss(e,t){var n;return function(){var r=this,i=arguments,s=function(){n=null,e.apply(r,i)};clearTimeout(n),n=setTimeout(s,t)}}function os(e,t){let n;return function(){let r=this,i=arguments;n||(e.apply(r,i),n=!0,setTimeout(()=>n=!1,t))}}function as({get:e,set:t},{get:n,set:r}){let i=!0,s,o=he(()=>{let a=e(),c=n();if(i)r(Dt(a)),i=!1;else{let u=JSON.stringify(a),l=JSON.stringify(c);u!==s?r(Dt(a)):u!==l&&t(Dt(c))}s=JSON.stringify(e()),JSON.stringify(n())});return()=>{Ee(o)}}function Dt(e){return typeof e=="object"?JSON.parse(JSON.stringify(e)):e}function Vc(e){(Array.isArray(e)?e:[e]).forEach(n=>n(Ke))}var Z={},wr=!1;function zc(e,t){if(wr||(Z=we(Z),wr=!0),t===void 0)return Z[e];Z[e]=t,Ii(Z[e]),typeof t=="object"&&t!==null&&t.hasOwnProperty("init")&&typeof t.init=="function"&&Z[e].init()}function Wc(){return Z}var cs={};function Jc(e,t){let n=typeof t!="function"?()=>t:t;return e instanceof Element?us(e,n()):(cs[e]=n,()=>{})}function Gc(e){return Object.entries(cs).forEach(([t,n])=>{Object.defineProperty(e,t,{get(){return(...r)=>n(...r)}})}),e}function us(e,t,n){let r=[];for(;r.length;)r.pop()();let i=Object.entries(t).map(([o,a])=>({name:o,value:a})),s=Mi(i);return i=i.map(o=>s.find(a=>a.name===o.name)?{name:`x-bind:${o.name}`,value:`"${o.value}"`}:o),kn(e,i,n).map(o=>{r.push(o.runCleanups),o()}),()=>{for(;r.length;)r.pop()()}}var ls={};function Xc(e,t){ls[e]=t}function Yc(e,t){return Object.entries(ls).forEach(([n,r])=>{Object.defineProperty(e,n,{get(){return(...i)=>r.bind(t)(...i)},enumerable:!1})}),e}var Qc={get reactive(){return we},get release(){return Ee},get effect(){return he},get raw(){return yi},version:"3.14.3",flushAndStopDeferringMutations:tc,dontAutoEvaluateFunctions:Ni,disableEffectScheduling:Ja,startObservingMutations:In,stopObservingMutations:Oi,setReactivityEngine:Ga,onAttributeRemoved:vi,onAttributesAdded:xi,closestDataStack:me,skipDuringClone:Q,onlyDuringClone:Ic,addRootSelector:Wi,addInitSelector:Ji,interceptClone:_t,addScopeToNode:Ue,deferMutations:ec,mapAttributes:Pn,evaluateLater:D,interceptInit:yc,setEvaluator:ac,mergeProxies:He,extractProp:Kc,findClosest:qe,onElRemoved:Tn,closestRoot:mt,destroyTree:Ae,interceptor:Ri,transition:un,setStyles:bt,mutateDom:x,directive:C,entangle:as,throttle:os,debounce:ss,evaluate:oe,initTree:K,nextTick:Fn,prefixed:Se,prefix:fc,plugin:Vc,magic:L,store:zc,start:bc,clone:Dc,cloneNode:Rc,bound:qc,$data:Ci,watch:wi,walk:le,data:Xc,bind:Jc},Ke=Qc;function Zc(e,t){const n=Object.create(null),r=e.split(",");for(let i=0;i<r.length;i++)n[r[i]]=!0;return i=>!!n[i]}var eu=Object.freeze({}),tu=Object.prototype.hasOwnProperty,yt=(e,t)=>tu.call(e,t),ae=Array.isArray,De=e=>fs(e)==="[object Map]",nu=e=>typeof e=="string",jn=e=>typeof e=="symbol",wt=e=>e!==null&&typeof e=="object",ru=Object.prototype.toString,fs=e=>ru.call(e),ds=e=>fs(e).slice(8,-1),Un=e=>nu(e)&&e!=="NaN"&&e[0]!=="-"&&""+parseInt(e,10)===e,iu=e=>{const t=Object.create(null);return n=>t[n]||(t[n]=e(n))},su=iu(e=>e.charAt(0).toUpperCase()+e.slice(1)),ps=(e,t)=>e!==t&&(e===e||t===t),fn=new WeakMap,Ce=[],U,ce=Symbol("iterate"),dn=Symbol("Map key iterate");function ou(e){return e&&e._isEffect===!0}function au(e,t=eu){ou(e)&&(e=e.raw);const n=lu(e,t);return t.lazy||n(),n}function cu(e){e.active&&(hs(e),e.options.onStop&&e.options.onStop(),e.active=!1)}var uu=0;function lu(e,t){const n=function(){if(!n.active)return e();if(!Ce.includes(n)){hs(n);try{return du(),Ce.push(n),U=n,e()}finally{Ce.pop(),gs(),U=Ce[Ce.length-1]}}};return n.id=uu++,n.allowRecurse=!!t.allowRecurse,n._isEffect=!0,n.active=!0,n.raw=e,n.deps=[],n.options=t,n}function hs(e){const{deps:t}=e;if(t.length){for(let n=0;n<t.length;n++)t[n].delete(e);t.length=0}}var be=!0,Hn=[];function fu(){Hn.push(be),be=!1}function du(){Hn.push(be),be=!0}function gs(){const e=Hn.pop();be=e===void 0?!0:e}function B(e,t,n){if(!be||U===void 0)return;let r=fn.get(e);r||fn.set(e,r=new Map);let i=r.get(n);i||r.set(n,i=new Set),i.has(U)||(i.add(U),U.deps.push(i),U.options.onTrack&&U.options.onTrack({effect:U,target:e,type:t,key:n}))}function X(e,t,n,r,i,s){const o=fn.get(e);if(!o)return;const a=new Set,c=l=>{l&&l.forEach(p=>{(p!==U||p.allowRecurse)&&a.add(p)})};if(t==="clear")o.forEach(c);else if(n==="length"&&ae(e))o.forEach((l,p)=>{(p==="length"||p>=r)&&c(l)});else switch(n!==void 0&&c(o.get(n)),t){case"add":ae(e)?Un(n)&&c(o.get("length")):(c(o.get(ce)),De(e)&&c(o.get(dn)));break;case"delete":ae(e)||(c(o.get(ce)),De(e)&&c(o.get(dn)));break;case"set":De(e)&&c(o.get(ce));break}const u=l=>{l.options.onTrigger&&l.options.onTrigger({effect:l,target:e,key:n,type:t,newValue:r,oldValue:i,oldTarget:s}),l.options.scheduler?l.options.scheduler(l):l()};a.forEach(u)}var pu=Zc("__proto__,__v_isRef,__isVue"),ms=new Set(Object.getOwnPropertyNames(Symbol).map(e=>Symbol[e]).filter(jn)),hu=bs(),gu=bs(!0),Er=mu();function mu(){const e={};return["includes","indexOf","lastIndexOf"].forEach(t=>{e[t]=function(...n){const r=A(this);for(let s=0,o=this.length;s<o;s++)B(r,"get",s+"");const i=r[t](...n);return i===-1||i===!1?r[t](...n.map(A)):i}}),["push","pop","shift","unshift","splice"].forEach(t=>{e[t]=function(...n){fu();const r=A(this)[t].apply(this,n);return gs(),r}}),e}function bs(e=!1,t=!1){return function(r,i,s){if(i==="__v_isReactive")return!e;if(i==="__v_isReadonly")return e;if(i==="__v_raw"&&s===(e?t?Ru:Es:t?Iu:ws).get(r))return r;const o=ae(r);if(!e&&o&&yt(Er,i))return Reflect.get(Er,i,s);const a=Reflect.get(r,i,s);return(jn(i)?ms.has(i):pu(i))||(e||B(r,"get",i),t)?a:pn(a)?!o||!Un(i)?a.value:a:wt(a)?e?Ss(a):zn(a):a}}var bu=_u();function _u(e=!1){return function(n,r,i,s){let o=n[r];if(!e&&(i=A(i),o=A(o),!ae(n)&&pn(o)&&!pn(i)))return o.value=i,!0;const a=ae(n)&&Un(r)?Number(r)<n.length:yt(n,r),c=Reflect.set(n,r,i,s);return n===A(s)&&(a?ps(i,o)&&X(n,"set",r,i,o):X(n,"add",r,i)),c}}function yu(e,t){const n=yt(e,t),r=e[t],i=Reflect.deleteProperty(e,t);return i&&n&&X(e,"delete",t,void 0,r),i}function wu(e,t){const n=Reflect.has(e,t);return(!jn(t)||!ms.has(t))&&B(e,"has",t),n}function Eu(e){return B(e,"iterate",ae(e)?"length":ce),Reflect.ownKeys(e)}var Su={get:hu,set:bu,deleteProperty:yu,has:wu,ownKeys:Eu},Au={get:gu,set(e,t){return console.warn(`Set operation on key "${String(t)}" failed: target is readonly.`,e),!0},deleteProperty(e,t){return console.warn(`Delete operation on key "${String(t)}" failed: target is readonly.`,e),!0}},qn=e=>wt(e)?zn(e):e,Kn=e=>wt(e)?Ss(e):e,Vn=e=>e,Et=e=>Reflect.getPrototypeOf(e);function ze(e,t,n=!1,r=!1){e=e.__v_raw;const i=A(e),s=A(t);t!==s&&!n&&B(i,"get",t),!n&&B(i,"get",s);const{has:o}=Et(i),a=r?Vn:n?Kn:qn;if(o.call(i,t))return a(e.get(t));if(o.call(i,s))return a(e.get(s));e!==i&&e.get(t)}function We(e,t=!1){const n=this.__v_raw,r=A(n),i=A(e);return e!==i&&!t&&B(r,"has",e),!t&&B(r,"has",i),e===i?n.has(e):n.has(e)||n.has(i)}function Je(e,t=!1){return e=e.__v_raw,!t&&B(A(e),"iterate",ce),Reflect.get(e,"size",e)}function Sr(e){e=A(e);const t=A(this);return Et(t).has.call(t,e)||(t.add(e),X(t,"add",e,e)),this}function Ar(e,t){t=A(t);const n=A(this),{has:r,get:i}=Et(n);let s=r.call(n,e);s?ys(n,r,e):(e=A(e),s=r.call(n,e));const o=i.call(n,e);return n.set(e,t),s?ps(t,o)&&X(n,"set",e,t,o):X(n,"add",e,t),this}function xr(e){const t=A(this),{has:n,get:r}=Et(t);let i=n.call(t,e);i?ys(t,n,e):(e=A(e),i=n.call(t,e));const s=r?r.call(t,e):void 0,o=t.delete(e);return i&&X(t,"delete",e,void 0,s),o}function vr(){const e=A(this),t=e.size!==0,n=De(e)?new Map(e):new Set(e),r=e.clear();return t&&X(e,"clear",void 0,void 0,n),r}function Ge(e,t){return function(r,i){const s=this,o=s.__v_raw,a=A(o),c=t?Vn:e?Kn:qn;return!e&&B(a,"iterate",ce),o.forEach((u,l)=>r.call(i,c(u),c(l),s))}}function Xe(e,t,n){return function(...r){const i=this.__v_raw,s=A(i),o=De(s),a=e==="entries"||e===Symbol.iterator&&o,c=e==="keys"&&o,u=i[e](...r),l=n?Vn:t?Kn:qn;return!t&&B(s,"iterate",c?dn:ce),{next(){const{value:p,done:h}=u.next();return h?{value:p,done:h}:{value:a?[l(p[0]),l(p[1])]:l(p),done:h}},[Symbol.iterator](){return this}}}}function z(e){return function(...t){{const n=t[0]?`on key "${t[0]}" `:"";console.warn(`${su(e)} operation ${n}failed: target is readonly.`,A(this))}return e==="delete"?!1:this}}function xu(){const e={get(s){return ze(this,s)},get size(){return Je(this)},has:We,add:Sr,set:Ar,delete:xr,clear:vr,forEach:Ge(!1,!1)},t={get(s){return ze(this,s,!1,!0)},get size(){return Je(this)},has:We,add:Sr,set:Ar,delete:xr,clear:vr,forEach:Ge(!1,!0)},n={get(s){return ze(this,s,!0)},get size(){return Je(this,!0)},has(s){return We.call(this,s,!0)},add:z("add"),set:z("set"),delete:z("delete"),clear:z("clear"),forEach:Ge(!0,!1)},r={get(s){return ze(this,s,!0,!0)},get size(){return Je(this,!0)},has(s){return We.call(this,s,!0)},add:z("add"),set:z("set"),delete:z("delete"),clear:z("clear"),forEach:Ge(!0,!0)};return["keys","values","entries",Symbol.iterator].forEach(s=>{e[s]=Xe(s,!1,!1),n[s]=Xe(s,!0,!1),t[s]=Xe(s,!1,!0),r[s]=Xe(s,!0,!0)}),[e,n,t,r]}var[vu,Tu,Qd,Zd]=xu();function _s(e,t){const n=e?Tu:vu;return(r,i,s)=>i==="__v_isReactive"?!e:i==="__v_isReadonly"?e:i==="__v_raw"?r:Reflect.get(yt(n,i)&&i in r?n:r,i,s)}var Ou={get:_s(!1)},Cu={get:_s(!0)};function ys(e,t,n){const r=A(n);if(r!==n&&t.call(e,r)){const i=ds(e);console.warn(`Reactive ${i} contains both the raw and reactive versions of the same object${i==="Map"?" as keys":""}, which can lead to inconsistencies. Avoid differentiating between the raw and reactive versions of an object and only use the reactive version if possible.`)}}var ws=new WeakMap,Iu=new WeakMap,Es=new WeakMap,Ru=new WeakMap;function Du(e){switch(e){case"Object":case"Array":return 1;case"Map":case"Set":case"WeakMap":case"WeakSet":return 2;default:return 0}}function Nu(e){return e.__v_skip||!Object.isExtensible(e)?0:Du(ds(e))}function zn(e){return e&&e.__v_isReadonly?e:As(e,!1,Su,Ou,ws)}function Ss(e){return As(e,!0,Au,Cu,Es)}function As(e,t,n,r,i){if(!wt(e))return console.warn(`value cannot be made reactive: ${String(e)}`),e;if(e.__v_raw&&!(t&&e.__v_isReactive))return e;const s=i.get(e);if(s)return s;const o=Nu(e);if(o===0)return e;const a=new Proxy(e,o===2?r:n);return i.set(e,a),a}function A(e){return e&&A(e.__v_raw)||e}function pn(e){return!!(e&&e.__v_isRef===!0)}L("nextTick",()=>Fn);L("dispatch",e=>Re.bind(Re,e));L("watch",(e,{evaluateLater:t,cleanup:n})=>(r,i)=>{let s=t(r),a=wi(()=>{let c;return s(u=>c=u),c},i);n(a)});L("store",Wc);L("data",e=>Ci(e));L("root",e=>mt(e));L("refs",e=>(e._x_refs_proxy||(e._x_refs_proxy=He(ku(e))),e._x_refs_proxy));function ku(e){let t=[];return qe(e,n=>{n._x_refs&&t.push(n._x_refs)}),t}var Nt={};function xs(e){return Nt[e]||(Nt[e]=0),++Nt[e]}function Pu(e,t){return qe(e,n=>{if(n._x_ids&&n._x_ids[t])return!0})}function Mu(e,t){e._x_ids||(e._x_ids={}),e._x_ids[t]||(e._x_ids[t]=xs(t))}L("id",(e,{cleanup:t})=>(n,r=null)=>{let i=`${n}${r?`-${r}`:""}`;return Bu(e,i,t,()=>{let s=Pu(e,n),o=s?s._x_ids[n]:xs(n);return r?`${n}-${o}-${r}`:`${n}-${o}`})});_t((e,t)=>{e._x_id&&(t._x_id=e._x_id)});function Bu(e,t,n,r){if(e._x_id||(e._x_id={}),e._x_id[t])return e._x_id[t];let i=r();return e._x_id[t]=i,n(()=>{delete e._x_id[t]}),i}L("el",e=>e);vs("Focus","focus","focus");vs("Persist","persist","persist");function vs(e,t,n){L(t,r=>M(`You can't use [$${t}] without first installing the "${e}" plugin here: https://alpinejs.dev/plugins/${n}`,r))}C("modelable",(e,{expression:t},{effect:n,evaluateLater:r,cleanup:i})=>{let s=r(t),o=()=>{let l;return s(p=>l=p),l},a=r(`${t} = __placeholder`),c=l=>a(()=>{},{scope:{__placeholder:l}}),u=o();c(u),queueMicrotask(()=>{if(!e._x_model)return;e._x_removeModelListeners.default();let l=e._x_model.get,p=e._x_model.set,h=as({get(){return l()},set(_){p(_)}},{get(){return o()},set(_){c(_)}});i(h)})});C("teleport",(e,{modifiers:t,expression:n},{cleanup:r})=>{e.tagName.toLowerCase()!=="template"&&M("x-teleport can only be used on a <template> tag",e);let i=Tr(n),s=e.content.cloneNode(!0).firstElementChild;e._x_teleport=s,s._x_teleportBack=e,e.setAttribute("data-teleport-template",!0),s.setAttribute("data-teleport-target",!0),e._x_forwardEvents&&e._x_forwardEvents.forEach(a=>{s.addEventListener(a,c=>{c.stopPropagation(),e.dispatchEvent(new c.constructor(c.type,c))})}),Ue(s,{},e);let o=(a,c,u)=>{u.includes("prepend")?c.parentNode.insertBefore(a,c):u.includes("append")?c.parentNode.insertBefore(a,c.nextSibling):c.appendChild(a)};x(()=>{o(s,i,t),Q(()=>{K(s),s._x_ignore=!0})()}),e._x_teleportPutBack=()=>{let a=Tr(n);x(()=>{o(e._x_teleport,a,t)})},r(()=>x(()=>{s.remove(),Ae(s)}))});var Fu=document.createElement("div");function Tr(e){let t=Q(()=>document.querySelector(e),()=>Fu)();return t||M(`Cannot find x-teleport element for selector: "${e}"`),t}var Ts=()=>{};Ts.inline=(e,{modifiers:t},{cleanup:n})=>{t.includes("self")?e._x_ignoreSelf=!0:e._x_ignore=!0,n(()=>{t.includes("self")?delete e._x_ignoreSelf:delete e._x_ignore})};C("ignore",Ts);C("effect",Q((e,{expression:t},{effect:n})=>{n(D(e,t))}));function hn(e,t,n,r){let i=e,s=c=>r(c),o={},a=(c,u)=>l=>u(c,l);if(n.includes("dot")&&(t=Lu(t)),n.includes("camel")&&(t=$u(t)),n.includes("passive")&&(o.passive=!0),n.includes("capture")&&(o.capture=!0),n.includes("window")&&(i=window),n.includes("document")&&(i=document),n.includes("debounce")){let c=n[n.indexOf("debounce")+1]||"invalid-wait",u=at(c.split("ms")[0])?Number(c.split("ms")[0]):250;s=ss(s,u)}if(n.includes("throttle")){let c=n[n.indexOf("throttle")+1]||"invalid-wait",u=at(c.split("ms")[0])?Number(c.split("ms")[0]):250;s=os(s,u)}return n.includes("prevent")&&(s=a(s,(c,u)=>{u.preventDefault(),c(u)})),n.includes("stop")&&(s=a(s,(c,u)=>{u.stopPropagation(),c(u)})),n.includes("once")&&(s=a(s,(c,u)=>{c(u),i.removeEventListener(t,s,o)})),(n.includes("away")||n.includes("outside"))&&(i=document,s=a(s,(c,u)=>{e.contains(u.target)||u.target.isConnected!==!1&&(e.offsetWidth<1&&e.offsetHeight<1||e._x_isShown!==!1&&c(u))})),n.includes("self")&&(s=a(s,(c,u)=>{u.target===e&&c(u)})),(Uu(t)||Os(t))&&(s=a(s,(c,u)=>{Hu(u,n)||c(u)})),i.addEventListener(t,s,o),()=>{i.removeEventListener(t,s,o)}}function Lu(e){return e.replace(/-/g,".")}function $u(e){return e.toLowerCase().replace(/-(\w)/g,(t,n)=>n.toUpperCase())}function at(e){return!Array.isArray(e)&&!isNaN(e)}function ju(e){return[" ","_"].includes(e)?e:e.replace(/([a-z])([A-Z])/g,"$1-$2").replace(/[_\s]/,"-").toLowerCase()}function Uu(e){return["keydown","keyup"].includes(e)}function Os(e){return["contextmenu","click","mouse"].some(t=>e.includes(t))}function Hu(e,t){let n=t.filter(s=>!["window","document","prevent","stop","once","capture","self","away","outside","passive"].includes(s));if(n.includes("debounce")){let s=n.indexOf("debounce");n.splice(s,at((n[s+1]||"invalid-wait").split("ms")[0])?2:1)}if(n.includes("throttle")){let s=n.indexOf("throttle");n.splice(s,at((n[s+1]||"invalid-wait").split("ms")[0])?2:1)}if(n.length===0||n.length===1&&Or(e.key).includes(n[0]))return!1;const i=["ctrl","shift","alt","meta","cmd","super"].filter(s=>n.includes(s));return n=n.filter(s=>!i.includes(s)),!(i.length>0&&i.filter(o=>((o==="cmd"||o==="super")&&(o="meta"),e[`${o}Key`])).length===i.length&&(Os(e.type)||Or(e.key).includes(n[0])))}function Or(e){if(!e)return[];e=ju(e);let t={ctrl:"control",slash:"/",space:" ",spacebar:" ",cmd:"meta",esc:"escape",up:"arrow-up",down:"arrow-down",left:"arrow-left",right:"arrow-right",period:".",comma:",",equal:"=",minus:"-",underscore:"_"};return t[e]=e,Object.keys(t).map(n=>{if(t[n]===e)return n}).filter(n=>n)}C("model",(e,{modifiers:t,expression:n},{effect:r,cleanup:i})=>{let s=e;t.includes("parent")&&(s=e.parentNode);let o=D(s,n),a;typeof n=="string"?a=D(s,`${n} = __placeholder`):typeof n=="function"&&typeof n()=="string"?a=D(s,`${n()} = __placeholder`):a=()=>{};let c=()=>{let h;return o(_=>h=_),Cr(h)?h.get():h},u=h=>{let _;o(g=>_=g),Cr(_)?_.set(h):a(()=>{},{scope:{__placeholder:h}})};typeof n=="string"&&e.type==="radio"&&x(()=>{e.hasAttribute("name")||e.setAttribute("name",n)});var l=e.tagName.toLowerCase()==="select"||["checkbox","radio"].includes(e.type)||t.includes("lazy")?"change":"input";let p=G?()=>{}:hn(e,l,t,h=>{u(kt(e,t,h,c()))});if(t.includes("fill")&&([void 0,null,""].includes(c())||$n(e)&&Array.isArray(c())||e.tagName.toLowerCase()==="select"&&e.multiple)&&u(kt(e,t,{target:e},c())),e._x_removeModelListeners||(e._x_removeModelListeners={}),e._x_removeModelListeners.default=p,i(()=>e._x_removeModelListeners.default()),e.form){let h=hn(e.form,"reset",[],_=>{Fn(()=>e._x_model&&e._x_model.set(kt(e,t,{target:e},c())))});i(()=>h())}e._x_model={get(){return c()},set(h){u(h)}},e._x_forceModelUpdate=h=>{h===void 0&&typeof n=="string"&&n.match(/\./)&&(h=""),window.fromModel=!0,x(()=>es(e,"value",h)),delete window.fromModel},r(()=>{let h=c();t.includes("unintrusive")&&document.activeElement.isSameNode(e)||e._x_forceModelUpdate(h)})});function kt(e,t,n,r){return x(()=>{if(n instanceof CustomEvent&&n.detail!==void 0)return n.detail!==null&&n.detail!==void 0?n.detail:n.target.value;if($n(e))if(Array.isArray(r)){let i=null;return t.includes("number")?i=Pt(n.target.value):t.includes("boolean")?i=tt(n.target.value):i=n.target.value,n.target.checked?r.includes(i)?r:r.concat([i]):r.filter(s=>!qu(s,i))}else return n.target.checked;else{if(e.tagName.toLowerCase()==="select"&&e.multiple)return t.includes("number")?Array.from(n.target.selectedOptions).map(i=>{let s=i.value||i.text;return Pt(s)}):t.includes("boolean")?Array.from(n.target.selectedOptions).map(i=>{let s=i.value||i.text;return tt(s)}):Array.from(n.target.selectedOptions).map(i=>i.value||i.text);{let i;return is(e)?n.target.checked?i=n.target.value:i=r:i=n.target.value,t.includes("number")?Pt(i):t.includes("boolean")?tt(i):t.includes("trim")?i.trim():i}}})}function Pt(e){let t=e?parseFloat(e):null;return Ku(t)?t:e}function qu(e,t){return e==t}function Ku(e){return!Array.isArray(e)&&!isNaN(e)}function Cr(e){return e!==null&&typeof e=="object"&&typeof e.get=="function"&&typeof e.set=="function"}C("cloak",e=>queueMicrotask(()=>x(()=>e.removeAttribute(Se("cloak")))));Ji(()=>`[${Se("init")}]`);C("init",Q((e,{expression:t},{evaluate:n})=>typeof t=="string"?!!t.trim()&&n(t,{},!1):n(t,{},!1)));C("text",(e,{expression:t},{effect:n,evaluateLater:r})=>{let i=r(t);n(()=>{i(s=>{x(()=>{e.textContent=s})})})});C("html",(e,{expression:t},{effect:n,evaluateLater:r})=>{let i=r(t);n(()=>{i(s=>{x(()=>{e.innerHTML=s,e._x_ignoreSelf=!0,K(e),delete e._x_ignoreSelf})})})});Pn(Li(":",$i(Se("bind:"))));var Cs=(e,{value:t,modifiers:n,expression:r,original:i},{effect:s,cleanup:o})=>{if(!t){let c={};Gc(c),D(e,r)(l=>{us(e,l,i)},{scope:c});return}if(t==="key")return Vu(e,r);if(e._x_inlineBindings&&e._x_inlineBindings[t]&&e._x_inlineBindings[t].extract)return;let a=D(e,r);s(()=>a(c=>{c===void 0&&typeof r=="string"&&r.match(/\./)&&(c=""),x(()=>es(e,t,c,n))})),o(()=>{e._x_undoAddedClasses&&e._x_undoAddedClasses(),e._x_undoAddedStyles&&e._x_undoAddedStyles()})};Cs.inline=(e,{value:t,modifiers:n,expression:r})=>{t&&(e._x_inlineBindings||(e._x_inlineBindings={}),e._x_inlineBindings[t]={expression:r,extract:!1})};C("bind",Cs);function Vu(e,t){e._x_keyExpression=t}Wi(()=>`[${Se("data")}]`);C("data",(e,{expression:t},{cleanup:n})=>{if(zu(e))return;t=t===""?"{}":t;let r={};nn(r,e);let i={};Yc(i,r);let s=oe(e,t,{scope:i});(s===void 0||s===!0)&&(s={}),nn(s,e);let o=we(s);Ii(o);let a=Ue(e,o);o.init&&oe(e,o.init),n(()=>{o.destroy&&oe(e,o.destroy),a()})});_t((e,t)=>{e._x_dataStack&&(t._x_dataStack=e._x_dataStack,t.setAttribute("data-has-alpine-state",!0))});function zu(e){return G?ln?!0:e.hasAttribute("data-has-alpine-state"):!1}C("show",(e,{modifiers:t,expression:n},{effect:r})=>{let i=D(e,n);e._x_doHide||(e._x_doHide=()=>{x(()=>{e.style.setProperty("display","none",t.includes("important")?"important":void 0)})}),e._x_doShow||(e._x_doShow=()=>{x(()=>{e.style.length===1&&e.style.display==="none"?e.removeAttribute("style"):e.style.removeProperty("display")})});let s=()=>{e._x_doHide(),e._x_isShown=!1},o=()=>{e._x_doShow(),e._x_isShown=!0},a=()=>setTimeout(o),c=cn(p=>p?o():s(),p=>{typeof e._x_toggleAndCascadeWithTransitions=="function"?e._x_toggleAndCascadeWithTransitions(e,p,o,s):p?a():s()}),u,l=!0;r(()=>i(p=>{!l&&p===u||(t.includes("immediate")&&(p?a():s()),c(p),u=p,l=!1)}))});C("for",(e,{expression:t},{effect:n,cleanup:r})=>{let i=Ju(t),s=D(e,i.items),o=D(e,e._x_keyExpression||"index");e._x_prevKeys=[],e._x_lookup={},n(()=>Wu(e,i,s,o)),r(()=>{Object.values(e._x_lookup).forEach(a=>x(()=>{Ae(a),a.remove()})),delete e._x_prevKeys,delete e._x_lookup})});function Wu(e,t,n,r){let i=o=>typeof o=="object"&&!Array.isArray(o),s=e;n(o=>{Gu(o)&&o>=0&&(o=Array.from(Array(o).keys(),d=>d+1)),o===void 0&&(o=[]);let a=e._x_lookup,c=e._x_prevKeys,u=[],l=[];if(i(o))o=Object.entries(o).map(([d,m])=>{let w=Ir(t,m,d,o);r(E=>{l.includes(E)&&M("Duplicate key on x-for",e),l.push(E)},{scope:{index:d,...w}}),u.push(w)});else for(let d=0;d<o.length;d++){let m=Ir(t,o[d],d,o);r(w=>{l.includes(w)&&M("Duplicate key on x-for",e),l.push(w)},{scope:{index:d,...m}}),u.push(m)}let p=[],h=[],_=[],g=[];for(let d=0;d<c.length;d++){let m=c[d];l.indexOf(m)===-1&&_.push(m)}c=c.filter(d=>!_.includes(d));let b="template";for(let d=0;d<l.length;d++){let m=l[d],w=c.indexOf(m);if(w===-1)c.splice(d,0,m),p.push([b,d]);else if(w!==d){let E=c.splice(d,1)[0],v=c.splice(w-1,1)[0];c.splice(d,0,v),c.splice(w,0,E),h.push([E,v])}else g.push(m);b=m}for(let d=0;d<_.length;d++){let m=_[d];m in a&&(x(()=>{Ae(a[m]),a[m].remove()}),delete a[m])}for(let d=0;d<h.length;d++){let[m,w]=h[d],E=a[m],v=a[w],T=document.createElement("div");x(()=>{v||M('x-for ":key" is undefined or invalid',s,w,a),v.after(T),E.after(v),v._x_currentIfEl&&v.after(v._x_currentIfEl),T.before(E),E._x_currentIfEl&&E.after(E._x_currentIfEl),T.remove()}),v._x_refreshXForScope(u[l.indexOf(w)])}for(let d=0;d<p.length;d++){let[m,w]=p[d],E=m==="template"?s:a[m];E._x_currentIfEl&&(E=E._x_currentIfEl);let v=u[w],T=l[w],N=document.importNode(s.content,!0).firstElementChild,$=we(v);Ue(N,$,s),N._x_refreshXForScope=ge=>{Object.entries(ge).forEach(([Ve,po])=>{$[Ve]=po})},x(()=>{E.after(N),Q(()=>K(N))()}),typeof T=="object"&&M("x-for key cannot be an object, it must be a string or an integer",s),a[T]=N}for(let d=0;d<g.length;d++)a[g[d]]._x_refreshXForScope(u[l.indexOf(g[d])]);s._x_prevKeys=l})}function Ju(e){let t=/,([^,\}\]]*)(?:,([^,\}\]]*))?$/,n=/^\s*\(|\)\s*$/g,r=/([\s\S]*?)\s+(?:in|of)\s+([\s\S]*)/,i=e.match(r);if(!i)return;let s={};s.items=i[2].trim();let o=i[1].replace(n,"").trim(),a=o.match(t);return a?(s.item=o.replace(t,"").trim(),s.index=a[1].trim(),a[2]&&(s.collection=a[2].trim())):s.item=o,s}function Ir(e,t,n,r){let i={};return/^\[.*\]$/.test(e.item)&&Array.isArray(t)?e.item.replace("[","").replace("]","").split(",").map(o=>o.trim()).forEach((o,a)=>{i[o]=t[a]}):/^\{.*\}$/.test(e.item)&&!Array.isArray(t)&&typeof t=="object"?e.item.replace("{","").replace("}","").split(",").map(o=>o.trim()).forEach(o=>{i[o]=t[o]}):i[e.item]=t,e.index&&(i[e.index]=n),e.collection&&(i[e.collection]=r),i}function Gu(e){return!Array.isArray(e)&&!isNaN(e)}function Is(){}Is.inline=(e,{expression:t},{cleanup:n})=>{let r=mt(e);r._x_refs||(r._x_refs={}),r._x_refs[t]=e,n(()=>delete r._x_refs[t])};C("ref",Is);C("if",(e,{expression:t},{effect:n,cleanup:r})=>{e.tagName.toLowerCase()!=="template"&&M("x-if can only be used on a <template> tag",e);let i=D(e,t),s=()=>{if(e._x_currentIfEl)return e._x_currentIfEl;let a=e.content.cloneNode(!0).firstElementChild;return Ue(a,{},e),x(()=>{e.after(a),Q(()=>K(a))()}),e._x_currentIfEl=a,e._x_undoIf=()=>{x(()=>{Ae(a),a.remove()}),delete e._x_currentIfEl},a},o=()=>{e._x_undoIf&&(e._x_undoIf(),delete e._x_undoIf)};n(()=>i(a=>{a?s():o()})),r(()=>e._x_undoIf&&e._x_undoIf())});C("id",(e,{expression:t},{evaluate:n})=>{n(t).forEach(i=>Mu(e,i))});_t((e,t)=>{e._x_ids&&(t._x_ids=e._x_ids)});Pn(Li("@",$i(Se("on:"))));C("on",Q((e,{value:t,modifiers:n,expression:r},{cleanup:i})=>{let s=r?D(e,r):()=>{};e.tagName.toLowerCase()==="template"&&(e._x_forwardEvents||(e._x_forwardEvents=[]),e._x_forwardEvents.includes(t)||e._x_forwardEvents.push(t));let o=hn(e,t,n,a=>{s(()=>{},{scope:{$event:a},params:[a]})});i(()=>o())}));St("Collapse","collapse","collapse");St("Intersect","intersect","intersect");St("Focus","trap","focus");St("Mask","mask","mask");function St(e,t,n){C(t,r=>M(`You can't use [x-${t}] without first installing the "${e}" plugin here: https://alpinejs.dev/plugins/${n}`,r))}Ke.setEvaluator(Pi);Ke.setReactivityEngine({reactive:zn,effect:au,release:cu,raw:A});var Xu=Ke,Rs=Xu;const Yu=()=>{};var Rr={};/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Ds=function(e){const t=[];let n=0;for(let r=0;r<e.length;r++){let i=e.charCodeAt(r);i<128?t[n++]=i:i<2048?(t[n++]=i>>6|192,t[n++]=i&63|128):(i&64512)===55296&&r+1<e.length&&(e.charCodeAt(r+1)&64512)===56320?(i=65536+((i&1023)<<10)+(e.charCodeAt(++r)&1023),t[n++]=i>>18|240,t[n++]=i>>12&63|128,t[n++]=i>>6&63|128,t[n++]=i&63|128):(t[n++]=i>>12|224,t[n++]=i>>6&63|128,t[n++]=i&63|128)}return t},Qu=function(e){const t=[];let n=0,r=0;for(;n<e.length;){const i=e[n++];if(i<128)t[r++]=String.fromCharCode(i);else if(i>191&&i<224){const s=e[n++];t[r++]=String.fromCharCode((i&31)<<6|s&63)}else if(i>239&&i<365){const s=e[n++],o=e[n++],a=e[n++],c=((i&7)<<18|(s&63)<<12|(o&63)<<6|a&63)-65536;t[r++]=String.fromCharCode(55296+(c>>10)),t[r++]=String.fromCharCode(56320+(c&1023))}else{const s=e[n++],o=e[n++];t[r++]=String.fromCharCode((i&15)<<12|(s&63)<<6|o&63)}}return t.join("")},Ns={byteToCharMap_:null,charToByteMap_:null,byteToCharMapWebSafe_:null,charToByteMapWebSafe_:null,ENCODED_VALS_BASE:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",get ENCODED_VALS(){return this.ENCODED_VALS_BASE+"+/="},get ENCODED_VALS_WEBSAFE(){return this.ENCODED_VALS_BASE+"-_."},HAS_NATIVE_SUPPORT:typeof atob=="function",encodeByteArray(e,t){if(!Array.isArray(e))throw Error("encodeByteArray takes an array as a parameter");this.init_();const n=t?this.byteToCharMapWebSafe_:this.byteToCharMap_,r=[];for(let i=0;i<e.length;i+=3){const s=e[i],o=i+1<e.length,a=o?e[i+1]:0,c=i+2<e.length,u=c?e[i+2]:0,l=s>>2,p=(s&3)<<4|a>>4;let h=(a&15)<<2|u>>6,_=u&63;c||(_=64,o||(h=64)),r.push(n[l],n[p],n[h],n[_])}return r.join("")},encodeString(e,t){return this.HAS_NATIVE_SUPPORT&&!t?btoa(e):this.encodeByteArray(Ds(e),t)},decodeString(e,t){return this.HAS_NATIVE_SUPPORT&&!t?atob(e):Qu(this.decodeStringToByteArray(e,t))},decodeStringToByteArray(e,t){this.init_();const n=t?this.charToByteMapWebSafe_:this.charToByteMap_,r=[];for(let i=0;i<e.length;){const s=n[e.charAt(i++)],a=i<e.length?n[e.charAt(i)]:0;++i;const u=i<e.length?n[e.charAt(i)]:64;++i;const p=i<e.length?n[e.charAt(i)]:64;if(++i,s==null||a==null||u==null||p==null)throw new Zu;const h=s<<2|a>>4;if(r.push(h),u!==64){const _=a<<4&240|u>>2;if(r.push(_),p!==64){const g=u<<6&192|p;r.push(g)}}}return r},init_(){if(!this.byteToCharMap_){this.byteToCharMap_={},this.charToByteMap_={},this.byteToCharMapWebSafe_={},this.charToByteMapWebSafe_={};for(let e=0;e<this.ENCODED_VALS.length;e++)this.byteToCharMap_[e]=this.ENCODED_VALS.charAt(e),this.charToByteMap_[this.byteToCharMap_[e]]=e,this.byteToCharMapWebSafe_[e]=this.ENCODED_VALS_WEBSAFE.charAt(e),this.charToByteMapWebSafe_[this.byteToCharMapWebSafe_[e]]=e,e>=this.ENCODED_VALS_BASE.length&&(this.charToByteMap_[this.ENCODED_VALS_WEBSAFE.charAt(e)]=e,this.charToByteMapWebSafe_[this.ENCODED_VALS.charAt(e)]=e)}}};class Zu extends Error{constructor(){super(...arguments),this.name="DecodeBase64StringError"}}const el=function(e){const t=Ds(e);return Ns.encodeByteArray(t,!0)},ks=function(e){return el(e).replace(/\./g,"")},tl=function(e){try{return Ns.decodeString(e,!0)}catch(t){console.error("base64Decode failed: ",t)}return null};/**
 * @license
 * Copyright 2022 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function nl(){if(typeof self<"u")return self;if(typeof window<"u")return window;if(typeof global<"u")return global;throw new Error("Unable to locate global object.")}/**
 * @license
 * Copyright 2022 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const rl=()=>nl().__FIREBASE_DEFAULTS__,il=()=>{if(typeof process>"u"||typeof Rr>"u")return;const e=Rr.__FIREBASE_DEFAULTS__;if(e)return JSON.parse(e)},sl=()=>{if(typeof document>"u")return;let e;try{e=document.cookie.match(/__FIREBASE_DEFAULTS__=([^;]+)/)}catch{return}const t=e&&tl(e[1]);return t&&JSON.parse(t)},ol=()=>{try{return Yu()||rl()||il()||sl()}catch(e){console.info(`Unable to get __FIREBASE_DEFAULTS__ due to: ${e}`);return}},Ps=()=>{var e;return(e=ol())==null?void 0:e.config};/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class al{constructor(){this.reject=()=>{},this.resolve=()=>{},this.promise=new Promise((t,n)=>{this.resolve=t,this.reject=n})}wrapCallback(t){return(n,r)=>{n?this.reject(n):this.resolve(r),typeof t=="function"&&(this.promise.catch(()=>{}),t.length===1?t(n):t(n,r))}}}function Ms(){try{return typeof indexedDB=="object"}catch{return!1}}function Bs(){return new Promise((e,t)=>{try{let n=!0;const r="validate-browser-context-for-indexeddb-analytics-module",i=self.indexedDB.open(r);i.onsuccess=()=>{i.result.close(),n||self.indexedDB.deleteDatabase(r),e(!0)},i.onupgradeneeded=()=>{n=!1},i.onerror=()=>{var s;t(((s=i.error)==null?void 0:s.message)||"")}}catch(n){t(n)}})}function cl(){return!(typeof navigator>"u"||!navigator.cookieEnabled)}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const ul="FirebaseError";class xe extends Error{constructor(t,n,r){super(n),this.code=t,this.customData=r,this.name=ul,Object.setPrototypeOf(this,xe.prototype),Error.captureStackTrace&&Error.captureStackTrace(this,At.prototype.create)}}class At{constructor(t,n,r){this.service=t,this.serviceName=n,this.errors=r}create(t,...n){const r=n[0]||{},i=`${this.service}/${t}`,s=this.errors[t],o=s?ll(s,r):"Error",a=`${this.serviceName}: ${o} (${i}).`;return new xe(i,a,r)}}function ll(e,t){return e.replace(fl,(n,r)=>{const i=t[r];return i!=null?String(i):`<${r}?>`})}const fl=/\{\$([^}]+)}/g;function gn(e,t){if(e===t)return!0;const n=Object.keys(e),r=Object.keys(t);for(const i of n){if(!r.includes(i))return!1;const s=e[i],o=t[i];if(Dr(s)&&Dr(o)){if(!gn(s,o))return!1}else if(s!==o)return!1}for(const i of r)if(!n.includes(i))return!1;return!0}function Dr(e){return e!==null&&typeof e=="object"}/**
 * @license
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Wn(e){return e&&e._delegate?e._delegate:e}class Y{constructor(t,n,r){this.name=t,this.instanceFactory=n,this.type=r,this.multipleInstances=!1,this.serviceProps={},this.instantiationMode="LAZY",this.onInstanceCreated=null}setInstantiationMode(t){return this.instantiationMode=t,this}setMultipleInstances(t){return this.multipleInstances=t,this}setServiceProps(t){return this.serviceProps=t,this}setInstanceCreatedCallback(t){return this.onInstanceCreated=t,this}}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const ee="[DEFAULT]";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class dl{constructor(t,n){this.name=t,this.container=n,this.component=null,this.instances=new Map,this.instancesDeferred=new Map,this.instancesOptions=new Map,this.onInitCallbacks=new Map}get(t){const n=this.normalizeInstanceIdentifier(t);if(!this.instancesDeferred.has(n)){const r=new al;if(this.instancesDeferred.set(n,r),this.isInitialized(n)||this.shouldAutoInitialize())try{const i=this.getOrInitializeService({instanceIdentifier:n});i&&r.resolve(i)}catch{}}return this.instancesDeferred.get(n).promise}getImmediate(t){const n=this.normalizeInstanceIdentifier(t==null?void 0:t.identifier),r=(t==null?void 0:t.optional)??!1;if(this.isInitialized(n)||this.shouldAutoInitialize())try{return this.getOrInitializeService({instanceIdentifier:n})}catch(i){if(r)return null;throw i}else{if(r)return null;throw Error(`Service ${this.name} is not available`)}}getComponent(){return this.component}setComponent(t){if(t.name!==this.name)throw Error(`Mismatching Component ${t.name} for Provider ${this.name}.`);if(this.component)throw Error(`Component for ${this.name} has already been provided`);if(this.component=t,!!this.shouldAutoInitialize()){if(hl(t))try{this.getOrInitializeService({instanceIdentifier:ee})}catch{}for(const[n,r]of this.instancesDeferred.entries()){const i=this.normalizeInstanceIdentifier(n);try{const s=this.getOrInitializeService({instanceIdentifier:i});r.resolve(s)}catch{}}}}clearInstance(t=ee){this.instancesDeferred.delete(t),this.instancesOptions.delete(t),this.instances.delete(t)}async delete(){const t=Array.from(this.instances.values());await Promise.all([...t.filter(n=>"INTERNAL"in n).map(n=>n.INTERNAL.delete()),...t.filter(n=>"_delete"in n).map(n=>n._delete())])}isComponentSet(){return this.component!=null}isInitialized(t=ee){return this.instances.has(t)}getOptions(t=ee){return this.instancesOptions.get(t)||{}}initialize(t={}){const{options:n={}}=t,r=this.normalizeInstanceIdentifier(t.instanceIdentifier);if(this.isInitialized(r))throw Error(`${this.name}(${r}) has already been initialized`);if(!this.isComponentSet())throw Error(`Component ${this.name} has not been registered yet`);const i=this.getOrInitializeService({instanceIdentifier:r,options:n});for(const[s,o]of this.instancesDeferred.entries()){const a=this.normalizeInstanceIdentifier(s);r===a&&o.resolve(i)}return i}onInit(t,n){const r=this.normalizeInstanceIdentifier(n),i=this.onInitCallbacks.get(r)??new Set;i.add(t),this.onInitCallbacks.set(r,i);const s=this.instances.get(r);return s&&t(s,r),()=>{i.delete(t)}}invokeOnInitCallbacks(t,n){const r=this.onInitCallbacks.get(n);if(r)for(const i of r)try{i(t,n)}catch{}}getOrInitializeService({instanceIdentifier:t,options:n={}}){let r=this.instances.get(t);if(!r&&this.component&&(r=this.component.instanceFactory(this.container,{instanceIdentifier:pl(t),options:n}),this.instances.set(t,r),this.instancesOptions.set(t,n),this.invokeOnInitCallbacks(r,t),this.component.onInstanceCreated))try{this.component.onInstanceCreated(this.container,t,r)}catch{}return r||null}normalizeInstanceIdentifier(t=ee){return this.component?this.component.multipleInstances?t:ee:t}shouldAutoInitialize(){return!!this.component&&this.component.instantiationMode!=="EXPLICIT"}}function pl(e){return e===ee?void 0:e}function hl(e){return e.instantiationMode==="EAGER"}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class gl{constructor(t){this.name=t,this.providers=new Map}addComponent(t){const n=this.getProvider(t.name);if(n.isComponentSet())throw new Error(`Component ${t.name} has already been registered with ${this.name}`);n.setComponent(t)}addOrOverwriteComponent(t){this.getProvider(t.name).isComponentSet()&&this.providers.delete(t.name),this.addComponent(t)}getProvider(t){if(this.providers.has(t))return this.providers.get(t);const n=new dl(t,this);return this.providers.set(t,n),n}getProviders(){return Array.from(this.providers.values())}}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var S;(function(e){e[e.DEBUG=0]="DEBUG",e[e.VERBOSE=1]="VERBOSE",e[e.INFO=2]="INFO",e[e.WARN=3]="WARN",e[e.ERROR=4]="ERROR",e[e.SILENT=5]="SILENT"})(S||(S={}));const ml={debug:S.DEBUG,verbose:S.VERBOSE,info:S.INFO,warn:S.WARN,error:S.ERROR,silent:S.SILENT},bl=S.INFO,_l={[S.DEBUG]:"log",[S.VERBOSE]:"log",[S.INFO]:"info",[S.WARN]:"warn",[S.ERROR]:"error"},yl=(e,t,...n)=>{if(t<e.logLevel)return;const r=new Date().toISOString(),i=_l[t];if(i)console[i](`[${r}]  ${e.name}:`,...n);else throw new Error(`Attempted to log a message with an invalid logType (value: ${t})`)};class wl{constructor(t){this.name=t,this._logLevel=bl,this._logHandler=yl,this._userLogHandler=null}get logLevel(){return this._logLevel}set logLevel(t){if(!(t in S))throw new TypeError(`Invalid value "${t}" assigned to \`logLevel\``);this._logLevel=t}setLogLevel(t){this._logLevel=typeof t=="string"?ml[t]:t}get logHandler(){return this._logHandler}set logHandler(t){if(typeof t!="function")throw new TypeError("Value assigned to `logHandler` must be a function");this._logHandler=t}get userLogHandler(){return this._userLogHandler}set userLogHandler(t){this._userLogHandler=t}debug(...t){this._userLogHandler&&this._userLogHandler(this,S.DEBUG,...t),this._logHandler(this,S.DEBUG,...t)}log(...t){this._userLogHandler&&this._userLogHandler(this,S.VERBOSE,...t),this._logHandler(this,S.VERBOSE,...t)}info(...t){this._userLogHandler&&this._userLogHandler(this,S.INFO,...t),this._logHandler(this,S.INFO,...t)}warn(...t){this._userLogHandler&&this._userLogHandler(this,S.WARN,...t),this._logHandler(this,S.WARN,...t)}error(...t){this._userLogHandler&&this._userLogHandler(this,S.ERROR,...t),this._logHandler(this,S.ERROR,...t)}}const El=(e,t)=>t.some(n=>e instanceof n);let Nr,kr;function Sl(){return Nr||(Nr=[IDBDatabase,IDBObjectStore,IDBIndex,IDBCursor,IDBTransaction])}function Al(){return kr||(kr=[IDBCursor.prototype.advance,IDBCursor.prototype.continue,IDBCursor.prototype.continuePrimaryKey])}const Fs=new WeakMap,mn=new WeakMap,Ls=new WeakMap,Mt=new WeakMap,Jn=new WeakMap;function xl(e){const t=new Promise((n,r)=>{const i=()=>{e.removeEventListener("success",s),e.removeEventListener("error",o)},s=()=>{n(q(e.result)),i()},o=()=>{r(e.error),i()};e.addEventListener("success",s),e.addEventListener("error",o)});return t.then(n=>{n instanceof IDBCursor&&Fs.set(n,e)}).catch(()=>{}),Jn.set(t,e),t}function vl(e){if(mn.has(e))return;const t=new Promise((n,r)=>{const i=()=>{e.removeEventListener("complete",s),e.removeEventListener("error",o),e.removeEventListener("abort",o)},s=()=>{n(),i()},o=()=>{r(e.error||new DOMException("AbortError","AbortError")),i()};e.addEventListener("complete",s),e.addEventListener("error",o),e.addEventListener("abort",o)});mn.set(e,t)}let bn={get(e,t,n){if(e instanceof IDBTransaction){if(t==="done")return mn.get(e);if(t==="objectStoreNames")return e.objectStoreNames||Ls.get(e);if(t==="store")return n.objectStoreNames[1]?void 0:n.objectStore(n.objectStoreNames[0])}return q(e[t])},set(e,t,n){return e[t]=n,!0},has(e,t){return e instanceof IDBTransaction&&(t==="done"||t==="store")?!0:t in e}};function Tl(e){bn=e(bn)}function Ol(e){return e===IDBDatabase.prototype.transaction&&!("objectStoreNames"in IDBTransaction.prototype)?function(t,...n){const r=e.call(Bt(this),t,...n);return Ls.set(r,t.sort?t.sort():[t]),q(r)}:Al().includes(e)?function(...t){return e.apply(Bt(this),t),q(Fs.get(this))}:function(...t){return q(e.apply(Bt(this),t))}}function Cl(e){return typeof e=="function"?Ol(e):(e instanceof IDBTransaction&&vl(e),El(e,Sl())?new Proxy(e,bn):e)}function q(e){if(e instanceof IDBRequest)return xl(e);if(Mt.has(e))return Mt.get(e);const t=Cl(e);return t!==e&&(Mt.set(e,t),Jn.set(t,e)),t}const Bt=e=>Jn.get(e);function xt(e,t,{blocked:n,upgrade:r,blocking:i,terminated:s}={}){const o=indexedDB.open(e,t),a=q(o);return r&&o.addEventListener("upgradeneeded",c=>{r(q(o.result),c.oldVersion,c.newVersion,q(o.transaction),c)}),n&&o.addEventListener("blocked",c=>n(c.oldVersion,c.newVersion,c)),a.then(c=>{s&&c.addEventListener("close",()=>s()),i&&c.addEventListener("versionchange",u=>i(u.oldVersion,u.newVersion,u))}).catch(()=>{}),a}function Ft(e,{blocked:t}={}){const n=indexedDB.deleteDatabase(e);return t&&n.addEventListener("blocked",r=>t(r.oldVersion,r)),q(n).then(()=>{})}const Il=["get","getKey","getAll","getAllKeys","count"],Rl=["put","add","delete","clear"],Lt=new Map;function Pr(e,t){if(!(e instanceof IDBDatabase&&!(t in e)&&typeof t=="string"))return;if(Lt.get(t))return Lt.get(t);const n=t.replace(/FromIndex$/,""),r=t!==n,i=Rl.includes(n);if(!(n in(r?IDBIndex:IDBObjectStore).prototype)||!(i||Il.includes(n)))return;const s=async function(o,...a){const c=this.transaction(o,i?"readwrite":"readonly");let u=c.store;return r&&(u=u.index(a.shift())),(await Promise.all([u[n](...a),i&&c.done]))[0]};return Lt.set(t,s),s}Tl(e=>({...e,get:(t,n,r)=>Pr(t,n)||e.get(t,n,r),has:(t,n)=>!!Pr(t,n)||e.has(t,n)}));/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class Dl{constructor(t){this.container=t}getPlatformInfoString(){return this.container.getProviders().map(n=>{if(Nl(n)){const r=n.getImmediate();return`${r.library}/${r.version}`}else return null}).filter(n=>n).join(" ")}}function Nl(e){const t=e.getComponent();return(t==null?void 0:t.type)==="VERSION"}const _n="@firebase/app",Mr="0.14.1";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const V=new wl("@firebase/app"),kl="@firebase/app-compat",Pl="@firebase/analytics-compat",Ml="@firebase/analytics",Bl="@firebase/app-check-compat",Fl="@firebase/app-check",Ll="@firebase/auth",$l="@firebase/auth-compat",jl="@firebase/database",Ul="@firebase/data-connect",Hl="@firebase/database-compat",ql="@firebase/functions",Kl="@firebase/functions-compat",Vl="@firebase/installations",zl="@firebase/installations-compat",Wl="@firebase/messaging",Jl="@firebase/messaging-compat",Gl="@firebase/performance",Xl="@firebase/performance-compat",Yl="@firebase/remote-config",Ql="@firebase/remote-config-compat",Zl="@firebase/storage",ef="@firebase/storage-compat",tf="@firebase/firestore",nf="@firebase/ai",rf="@firebase/firestore-compat",sf="firebase";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const yn="[DEFAULT]",of={[_n]:"fire-core",[kl]:"fire-core-compat",[Ml]:"fire-analytics",[Pl]:"fire-analytics-compat",[Fl]:"fire-app-check",[Bl]:"fire-app-check-compat",[Ll]:"fire-auth",[$l]:"fire-auth-compat",[jl]:"fire-rtdb",[Ul]:"fire-data-connect",[Hl]:"fire-rtdb-compat",[ql]:"fire-fn",[Kl]:"fire-fn-compat",[Vl]:"fire-iid",[zl]:"fire-iid-compat",[Wl]:"fire-fcm",[Jl]:"fire-fcm-compat",[Gl]:"fire-perf",[Xl]:"fire-perf-compat",[Yl]:"fire-rc",[Ql]:"fire-rc-compat",[Zl]:"fire-gcs",[ef]:"fire-gcs-compat",[tf]:"fire-fst",[rf]:"fire-fst-compat",[nf]:"fire-vertex","fire-js":"fire-js",[sf]:"fire-js-all"};/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const ct=new Map,af=new Map,wn=new Map;function Br(e,t){try{e.container.addComponent(t)}catch(n){V.debug(`Component ${t.name} failed to register with FirebaseApp ${e.name}`,n)}}function fe(e){const t=e.name;if(wn.has(t))return V.debug(`There were multiple attempts to register component ${t}.`),!1;wn.set(t,e);for(const n of ct.values())Br(n,e);for(const n of af.values())Br(n,e);return!0}function Gn(e,t){const n=e.container.getProvider("heartbeat").getImmediate({optional:!0});return n&&n.triggerHeartbeat(),e.container.getProvider(t)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const cf={"no-app":"No Firebase App '{$appName}' has been created - call initializeApp() first","bad-app-name":"Illegal App name: '{$appName}'","duplicate-app":"Firebase App named '{$appName}' already exists with different options or config","app-deleted":"Firebase App named '{$appName}' already deleted","server-app-deleted":"Firebase Server App has been deleted","no-options":"Need to provide options, when not being deployed to hosting via source.","invalid-app-argument":"firebase.{$appName}() takes either no argument or a Firebase App instance.","invalid-log-argument":"First argument to `onLog` must be null or a function.","idb-open":"Error thrown when opening IndexedDB. Original error: {$originalErrorMessage}.","idb-get":"Error thrown when reading from IndexedDB. Original error: {$originalErrorMessage}.","idb-set":"Error thrown when writing to IndexedDB. Original error: {$originalErrorMessage}.","idb-delete":"Error thrown when deleting from IndexedDB. Original error: {$originalErrorMessage}.","finalization-registry-not-supported":"FirebaseServerApp deleteOnDeref field defined but the JS runtime does not support FinalizationRegistry.","invalid-server-app-environment":"FirebaseServerApp is not for use in browser environments."},W=new At("app","Firebase",cf);/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class uf{constructor(t,n,r){this._isDeleted=!1,this._options={...t},this._config={...n},this._name=n.name,this._automaticDataCollectionEnabled=n.automaticDataCollectionEnabled,this._container=r,this.container.addComponent(new Y("app",()=>this,"PUBLIC"))}get automaticDataCollectionEnabled(){return this.checkDestroyed(),this._automaticDataCollectionEnabled}set automaticDataCollectionEnabled(t){this.checkDestroyed(),this._automaticDataCollectionEnabled=t}get name(){return this.checkDestroyed(),this._name}get options(){return this.checkDestroyed(),this._options}get config(){return this.checkDestroyed(),this._config}get container(){return this._container}get isDeleted(){return this._isDeleted}set isDeleted(t){this._isDeleted=t}checkDestroyed(){if(this.isDeleted)throw W.create("app-deleted",{appName:this._name})}}function $s(e,t={}){let n=e;typeof t!="object"&&(t={name:t});const r={name:yn,automaticDataCollectionEnabled:!0,...t},i=r.name;if(typeof i!="string"||!i)throw W.create("bad-app-name",{appName:String(i)});if(n||(n=Ps()),!n)throw W.create("no-options");const s=ct.get(i);if(s){if(gn(n,s.options)&&gn(r,s.config))return s;throw W.create("duplicate-app",{appName:i})}const o=new gl(i);for(const c of wn.values())o.addComponent(c);const a=new uf(n,r,o);return ct.set(i,a),a}function lf(e=yn){const t=ct.get(e);if(!t&&e===yn&&Ps())return $s();if(!t)throw W.create("no-app",{appName:e});return t}function J(e,t,n){let r=of[e]??e;n&&(r+=`-${n}`);const i=r.match(/\s|\//),s=t.match(/\s|\//);if(i||s){const o=[`Unable to register library "${r}" with version "${t}":`];i&&o.push(`library name "${r}" contains illegal characters (whitespace or "/")`),i&&s&&o.push("and"),s&&o.push(`version name "${t}" contains illegal characters (whitespace or "/")`),V.warn(o.join(" "));return}fe(new Y(`${r}-version`,()=>({library:r,version:t}),"VERSION"))}/**
 * @license
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const ff="firebase-heartbeat-database",df=1,Pe="firebase-heartbeat-store";let $t=null;function js(){return $t||($t=xt(ff,df,{upgrade:(e,t)=>{switch(t){case 0:try{e.createObjectStore(Pe)}catch(n){console.warn(n)}}}}).catch(e=>{throw W.create("idb-open",{originalErrorMessage:e.message})})),$t}async function pf(e){try{const n=(await js()).transaction(Pe),r=await n.objectStore(Pe).get(Us(e));return await n.done,r}catch(t){if(t instanceof xe)V.warn(t.message);else{const n=W.create("idb-get",{originalErrorMessage:t==null?void 0:t.message});V.warn(n.message)}}}async function Fr(e,t){try{const r=(await js()).transaction(Pe,"readwrite");await r.objectStore(Pe).put(t,Us(e)),await r.done}catch(n){if(n instanceof xe)V.warn(n.message);else{const r=W.create("idb-set",{originalErrorMessage:n==null?void 0:n.message});V.warn(r.message)}}}function Us(e){return`${e.name}!${e.options.appId}`}/**
 * @license
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const hf=1024,gf=30;class mf{constructor(t){this.container=t,this._heartbeatsCache=null;const n=this.container.getProvider("app").getImmediate();this._storage=new _f(n),this._heartbeatsCachePromise=this._storage.read().then(r=>(this._heartbeatsCache=r,r))}async triggerHeartbeat(){var t,n;try{const i=this.container.getProvider("platform-logger").getImmediate().getPlatformInfoString(),s=Lr();if(((t=this._heartbeatsCache)==null?void 0:t.heartbeats)==null&&(this._heartbeatsCache=await this._heartbeatsCachePromise,((n=this._heartbeatsCache)==null?void 0:n.heartbeats)==null)||this._heartbeatsCache.lastSentHeartbeatDate===s||this._heartbeatsCache.heartbeats.some(o=>o.date===s))return;if(this._heartbeatsCache.heartbeats.push({date:s,agent:i}),this._heartbeatsCache.heartbeats.length>gf){const o=yf(this._heartbeatsCache.heartbeats);this._heartbeatsCache.heartbeats.splice(o,1)}return this._storage.overwrite(this._heartbeatsCache)}catch(r){V.warn(r)}}async getHeartbeatsHeader(){var t;try{if(this._heartbeatsCache===null&&await this._heartbeatsCachePromise,((t=this._heartbeatsCache)==null?void 0:t.heartbeats)==null||this._heartbeatsCache.heartbeats.length===0)return"";const n=Lr(),{heartbeatsToSend:r,unsentEntries:i}=bf(this._heartbeatsCache.heartbeats),s=ks(JSON.stringify({version:2,heartbeats:r}));return this._heartbeatsCache.lastSentHeartbeatDate=n,i.length>0?(this._heartbeatsCache.heartbeats=i,await this._storage.overwrite(this._heartbeatsCache)):(this._heartbeatsCache.heartbeats=[],this._storage.overwrite(this._heartbeatsCache)),s}catch(n){return V.warn(n),""}}}function Lr(){return new Date().toISOString().substring(0,10)}function bf(e,t=hf){const n=[];let r=e.slice();for(const i of e){const s=n.find(o=>o.agent===i.agent);if(s){if(s.dates.push(i.date),$r(n)>t){s.dates.pop();break}}else if(n.push({agent:i.agent,dates:[i.date]}),$r(n)>t){n.pop();break}r=r.slice(1)}return{heartbeatsToSend:n,unsentEntries:r}}class _f{constructor(t){this.app=t,this._canUseIndexedDBPromise=this.runIndexedDBEnvironmentCheck()}async runIndexedDBEnvironmentCheck(){return Ms()?Bs().then(()=>!0).catch(()=>!1):!1}async read(){if(await this._canUseIndexedDBPromise){const n=await pf(this.app);return n!=null&&n.heartbeats?n:{heartbeats:[]}}else return{heartbeats:[]}}async overwrite(t){if(await this._canUseIndexedDBPromise){const r=await this.read();return Fr(this.app,{lastSentHeartbeatDate:t.lastSentHeartbeatDate??r.lastSentHeartbeatDate,heartbeats:t.heartbeats})}else return}async add(t){if(await this._canUseIndexedDBPromise){const r=await this.read();return Fr(this.app,{lastSentHeartbeatDate:t.lastSentHeartbeatDate??r.lastSentHeartbeatDate,heartbeats:[...r.heartbeats,...t.heartbeats]})}else return}}function $r(e){return ks(JSON.stringify({version:2,heartbeats:e})).length}function yf(e){if(e.length===0)return-1;let t=0,n=e[0].date;for(let r=1;r<e.length;r++)e[r].date<n&&(n=e[r].date,t=r);return t}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function wf(e){fe(new Y("platform-logger",t=>new Dl(t),"PRIVATE")),fe(new Y("heartbeat",t=>new mf(t),"PRIVATE")),J(_n,Mr,e),J(_n,Mr,"esm2020"),J("fire-js","")}wf("");var Ef="firebase",Sf="12.1.0";/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */J(Ef,Sf,"app");const Hs="@firebase/installations",Xn="0.6.19";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const qs=1e4,Ks=`w:${Xn}`,Vs="FIS_v2",Af="https://firebaseinstallations.googleapis.com/v1",xf=60*60*1e3,vf="installations",Tf="Installations";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Of={"missing-app-config-values":'Missing App configuration value: "{$valueName}"',"not-registered":"Firebase Installation is not registered.","installation-not-found":"Firebase Installation not found.","request-failed":'{$requestName} request failed with error "{$serverCode} {$serverStatus}: {$serverMessage}"',"app-offline":"Could not process request. Application offline.","delete-pending-registration":"Can't delete installation while there is a pending registration request."},de=new At(vf,Tf,Of);function zs(e){return e instanceof xe&&e.code.includes("request-failed")}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Ws({projectId:e}){return`${Af}/projects/${e}/installations`}function Js(e){return{token:e.token,requestStatus:2,expiresIn:If(e.expiresIn),creationTime:Date.now()}}async function Gs(e,t){const r=(await t.json()).error;return de.create("request-failed",{requestName:e,serverCode:r.code,serverMessage:r.message,serverStatus:r.status})}function Xs({apiKey:e}){return new Headers({"Content-Type":"application/json",Accept:"application/json","x-goog-api-key":e})}function Cf(e,{refreshToken:t}){const n=Xs(e);return n.append("Authorization",Rf(t)),n}async function Ys(e){const t=await e();return t.status>=500&&t.status<600?e():t}function If(e){return Number(e.replace("s","000"))}function Rf(e){return`${Vs} ${e}`}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Df({appConfig:e,heartbeatServiceProvider:t},{fid:n}){const r=Ws(e),i=Xs(e),s=t.getImmediate({optional:!0});if(s){const u=await s.getHeartbeatsHeader();u&&i.append("x-firebase-client",u)}const o={fid:n,authVersion:Vs,appId:e.appId,sdkVersion:Ks},a={method:"POST",headers:i,body:JSON.stringify(o)},c=await Ys(()=>fetch(r,a));if(c.ok){const u=await c.json();return{fid:u.fid||n,registrationStatus:2,refreshToken:u.refreshToken,authToken:Js(u.authToken)}}else throw await Gs("Create Installation",c)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Qs(e){return new Promise(t=>{setTimeout(t,e)})}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Nf(e){return btoa(String.fromCharCode(...e)).replace(/\+/g,"-").replace(/\//g,"_")}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const kf=/^[cdef][\w-]{21}$/,En="";function Pf(){try{const e=new Uint8Array(17);(self.crypto||self.msCrypto).getRandomValues(e),e[0]=112+e[0]%16;const n=Mf(e);return kf.test(n)?n:En}catch{return En}}function Mf(e){return Nf(e).substr(0,22)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function vt(e){return`${e.appName}!${e.appId}`}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Zs=new Map;function eo(e,t){const n=vt(e);to(n,t),Bf(n,t)}function to(e,t){const n=Zs.get(e);if(n)for(const r of n)r(t)}function Bf(e,t){const n=Ff();n&&n.postMessage({key:e,fid:t}),Lf()}let re=null;function Ff(){return!re&&"BroadcastChannel"in self&&(re=new BroadcastChannel("[Firebase] FID Change"),re.onmessage=e=>{to(e.data.key,e.data.fid)}),re}function Lf(){Zs.size===0&&re&&(re.close(),re=null)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const $f="firebase-installations-database",jf=1,pe="firebase-installations-store";let jt=null;function Yn(){return jt||(jt=xt($f,jf,{upgrade:(e,t)=>{switch(t){case 0:e.createObjectStore(pe)}}})),jt}async function ut(e,t){const n=vt(e),i=(await Yn()).transaction(pe,"readwrite"),s=i.objectStore(pe),o=await s.get(n);return await s.put(t,n),await i.done,(!o||o.fid!==t.fid)&&eo(e,t.fid),t}async function no(e){const t=vt(e),r=(await Yn()).transaction(pe,"readwrite");await r.objectStore(pe).delete(t),await r.done}async function Tt(e,t){const n=vt(e),i=(await Yn()).transaction(pe,"readwrite"),s=i.objectStore(pe),o=await s.get(n),a=t(o);return a===void 0?await s.delete(n):await s.put(a,n),await i.done,a&&(!o||o.fid!==a.fid)&&eo(e,a.fid),a}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Qn(e){let t;const n=await Tt(e.appConfig,r=>{const i=Uf(r),s=Hf(e,i);return t=s.registrationPromise,s.installationEntry});return n.fid===En?{installationEntry:await t}:{installationEntry:n,registrationPromise:t}}function Uf(e){const t=e||{fid:Pf(),registrationStatus:0};return ro(t)}function Hf(e,t){if(t.registrationStatus===0){if(!navigator.onLine){const i=Promise.reject(de.create("app-offline"));return{installationEntry:t,registrationPromise:i}}const n={fid:t.fid,registrationStatus:1,registrationTime:Date.now()},r=qf(e,n);return{installationEntry:n,registrationPromise:r}}else return t.registrationStatus===1?{installationEntry:t,registrationPromise:Kf(e)}:{installationEntry:t}}async function qf(e,t){try{const n=await Df(e,t);return ut(e.appConfig,n)}catch(n){throw zs(n)&&n.customData.serverCode===409?await no(e.appConfig):await ut(e.appConfig,{fid:t.fid,registrationStatus:0}),n}}async function Kf(e){let t=await jr(e.appConfig);for(;t.registrationStatus===1;)await Qs(100),t=await jr(e.appConfig);if(t.registrationStatus===0){const{installationEntry:n,registrationPromise:r}=await Qn(e);return r||n}return t}function jr(e){return Tt(e,t=>{if(!t)throw de.create("installation-not-found");return ro(t)})}function ro(e){return Vf(e)?{fid:e.fid,registrationStatus:0}:e}function Vf(e){return e.registrationStatus===1&&e.registrationTime+qs<Date.now()}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function zf({appConfig:e,heartbeatServiceProvider:t},n){const r=Wf(e,n),i=Cf(e,n),s=t.getImmediate({optional:!0});if(s){const u=await s.getHeartbeatsHeader();u&&i.append("x-firebase-client",u)}const o={installation:{sdkVersion:Ks,appId:e.appId}},a={method:"POST",headers:i,body:JSON.stringify(o)},c=await Ys(()=>fetch(r,a));if(c.ok){const u=await c.json();return Js(u)}else throw await Gs("Generate Auth Token",c)}function Wf(e,{fid:t}){return`${Ws(e)}/${t}/authTokens:generate`}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Zn(e,t=!1){let n;const r=await Tt(e.appConfig,s=>{if(!io(s))throw de.create("not-registered");const o=s.authToken;if(!t&&Xf(o))return s;if(o.requestStatus===1)return n=Jf(e,t),s;{if(!navigator.onLine)throw de.create("app-offline");const a=Qf(s);return n=Gf(e,a),a}});return n?await n:r.authToken}async function Jf(e,t){let n=await Ur(e.appConfig);for(;n.authToken.requestStatus===1;)await Qs(100),n=await Ur(e.appConfig);const r=n.authToken;return r.requestStatus===0?Zn(e,t):r}function Ur(e){return Tt(e,t=>{if(!io(t))throw de.create("not-registered");const n=t.authToken;return Zf(n)?{...t,authToken:{requestStatus:0}}:t})}async function Gf(e,t){try{const n=await zf(e,t),r={...t,authToken:n};return await ut(e.appConfig,r),n}catch(n){if(zs(n)&&(n.customData.serverCode===401||n.customData.serverCode===404))await no(e.appConfig);else{const r={...t,authToken:{requestStatus:0}};await ut(e.appConfig,r)}throw n}}function io(e){return e!==void 0&&e.registrationStatus===2}function Xf(e){return e.requestStatus===2&&!Yf(e)}function Yf(e){const t=Date.now();return t<e.creationTime||e.creationTime+e.expiresIn<t+xf}function Qf(e){const t={requestStatus:1,requestTime:Date.now()};return{...e,authToken:t}}function Zf(e){return e.requestStatus===1&&e.requestTime+qs<Date.now()}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function ed(e){const t=e,{installationEntry:n,registrationPromise:r}=await Qn(t);return r?r.catch(console.error):Zn(t).catch(console.error),n.fid}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function td(e,t=!1){const n=e;return await nd(n),(await Zn(n,t)).token}async function nd(e){const{registrationPromise:t}=await Qn(e);t&&await t}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function rd(e){if(!e||!e.options)throw Ut("App Configuration");if(!e.name)throw Ut("App Name");const t=["projectId","apiKey","appId"];for(const n of t)if(!e.options[n])throw Ut(n);return{appName:e.name,projectId:e.options.projectId,apiKey:e.options.apiKey,appId:e.options.appId}}function Ut(e){return de.create("missing-app-config-values",{valueName:e})}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const so="installations",id="installations-internal",sd=e=>{const t=e.getProvider("app").getImmediate(),n=rd(t),r=Gn(t,"heartbeat");return{app:t,appConfig:n,heartbeatServiceProvider:r,_delete:()=>Promise.resolve()}},od=e=>{const t=e.getProvider("app").getImmediate(),n=Gn(t,so).getImmediate();return{getId:()=>ed(n),getToken:i=>td(n,i)}};function ad(){fe(new Y(so,sd,"PUBLIC")),fe(new Y(id,od,"PRIVATE"))}ad();J(Hs,Xn);J(Hs,Xn,"esm2020");/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const cd="/firebase-messaging-sw.js",ud="/firebase-cloud-messaging-push-scope",oo="BDOU99-h67HcA6JeFXHbSNMu7e2yNNu3RzoMj8TM4W88jITfq7ZmPvIM1Iv-4_l2LxQcYwhqby2xGpWwzjfAnG4",ld="https://fcmregistrations.googleapis.com/v1",ao="google.c.a.c_id",fd="google.c.a.c_l",dd="google.c.a.ts",pd="google.c.a.e",Hr=1e4;var qr;(function(e){e[e.DATA_MESSAGE=1]="DATA_MESSAGE",e[e.DISPLAY_NOTIFICATION=3]="DISPLAY_NOTIFICATION"})(qr||(qr={}));/**
 * @license
 * Copyright 2018 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except
 * in compliance with the License. You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software distributed under the License
 * is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express
 * or implied. See the License for the specific language governing permissions and limitations under
 * the License.
 */var Me;(function(e){e.PUSH_RECEIVED="push-received",e.NOTIFICATION_CLICKED="notification-clicked"})(Me||(Me={}));/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function H(e){const t=new Uint8Array(e);return btoa(String.fromCharCode(...t)).replace(/=/g,"").replace(/\+/g,"-").replace(/\//g,"_")}function hd(e){const t="=".repeat((4-e.length%4)%4),n=(e+t).replace(/\-/g,"+").replace(/_/g,"/"),r=atob(n),i=new Uint8Array(r.length);for(let s=0;s<r.length;++s)i[s]=r.charCodeAt(s);return i}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Ht="fcm_token_details_db",gd=5,Kr="fcm_token_object_Store";async function md(e){if("databases"in indexedDB&&!(await indexedDB.databases()).map(s=>s.name).includes(Ht))return null;let t=null;return(await xt(Ht,gd,{upgrade:async(r,i,s,o)=>{if(i<2||!r.objectStoreNames.contains(Kr))return;const a=o.objectStore(Kr),c=await a.index("fcmSenderId").get(e);if(await a.clear(),!!c){if(i===2){const u=c;if(!u.auth||!u.p256dh||!u.endpoint)return;t={token:u.fcmToken,createTime:u.createTime??Date.now(),subscriptionOptions:{auth:u.auth,p256dh:u.p256dh,endpoint:u.endpoint,swScope:u.swScope,vapidKey:typeof u.vapidKey=="string"?u.vapidKey:H(u.vapidKey)}}}else if(i===3){const u=c;t={token:u.fcmToken,createTime:u.createTime,subscriptionOptions:{auth:H(u.auth),p256dh:H(u.p256dh),endpoint:u.endpoint,swScope:u.swScope,vapidKey:H(u.vapidKey)}}}else if(i===4){const u=c;t={token:u.fcmToken,createTime:u.createTime,subscriptionOptions:{auth:H(u.auth),p256dh:H(u.p256dh),endpoint:u.endpoint,swScope:u.swScope,vapidKey:H(u.vapidKey)}}}}}})).close(),await Ft(Ht),await Ft("fcm_vapid_details_db"),await Ft("undefined"),bd(t)?t:null}function bd(e){if(!e||!e.subscriptionOptions)return!1;const{subscriptionOptions:t}=e;return typeof e.createTime=="number"&&e.createTime>0&&typeof e.token=="string"&&e.token.length>0&&typeof t.auth=="string"&&t.auth.length>0&&typeof t.p256dh=="string"&&t.p256dh.length>0&&typeof t.endpoint=="string"&&t.endpoint.length>0&&typeof t.swScope=="string"&&t.swScope.length>0&&typeof t.vapidKey=="string"&&t.vapidKey.length>0}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const _d="firebase-messaging-database",yd=1,Be="firebase-messaging-store";let qt=null;function co(){return qt||(qt=xt(_d,yd,{upgrade:(e,t)=>{switch(t){case 0:e.createObjectStore(Be)}}})),qt}async function wd(e){const t=uo(e),r=await(await co()).transaction(Be).objectStore(Be).get(t);if(r)return r;{const i=await md(e.appConfig.senderId);if(i)return await er(e,i),i}}async function er(e,t){const n=uo(e),i=(await co()).transaction(Be,"readwrite");return await i.objectStore(Be).put(t,n),await i.done,t}function uo({appConfig:e}){return e.appId}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Ed={"missing-app-config-values":'Missing App configuration value: "{$valueName}"',"only-available-in-window":"This method is available in a Window context.","only-available-in-sw":"This method is available in a service worker context.","permission-default":"The notification permission was not granted and dismissed instead.","permission-blocked":"The notification permission was not granted and blocked instead.","unsupported-browser":"This browser doesn't support the API's required to use the Firebase SDK.","indexed-db-unsupported":"This browser doesn't support indexedDb.open() (ex. Safari iFrame, Firefox Private Browsing, etc)","failed-service-worker-registration":"We are unable to register the default service worker. {$browserErrorMessage}","token-subscribe-failed":"A problem occurred while subscribing the user to FCM: {$errorInfo}","token-subscribe-no-token":"FCM returned no token when subscribing the user to push.","token-unsubscribe-failed":"A problem occurred while unsubscribing the user from FCM: {$errorInfo}","token-update-failed":"A problem occurred while updating the user from FCM: {$errorInfo}","token-update-no-token":"FCM returned no token when updating the user to push.","use-sw-after-get-token":"The useServiceWorker() method may only be called once and must be called before calling getToken() to ensure your service worker is used.","invalid-sw-registration":"The input to useServiceWorker() must be a ServiceWorkerRegistration.","invalid-bg-handler":"The input to setBackgroundMessageHandler() must be a function.","invalid-vapid-key":"The public VAPID key must be a string.","use-vapid-key-after-get-token":"The usePublicVapidKey() method may only be called once and must be called before calling getToken() to ensure your VAPID key is used."},R=new At("messaging","Messaging",Ed);/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Sd(e,t){const n=await nr(e),r=lo(t),i={method:"POST",headers:n,body:JSON.stringify(r)};let s;try{s=await(await fetch(tr(e.appConfig),i)).json()}catch(o){throw R.create("token-subscribe-failed",{errorInfo:o==null?void 0:o.toString()})}if(s.error){const o=s.error.message;throw R.create("token-subscribe-failed",{errorInfo:o})}if(!s.token)throw R.create("token-subscribe-no-token");return s.token}async function Ad(e,t){const n=await nr(e),r=lo(t.subscriptionOptions),i={method:"PATCH",headers:n,body:JSON.stringify(r)};let s;try{s=await(await fetch(`${tr(e.appConfig)}/${t.token}`,i)).json()}catch(o){throw R.create("token-update-failed",{errorInfo:o==null?void 0:o.toString()})}if(s.error){const o=s.error.message;throw R.create("token-update-failed",{errorInfo:o})}if(!s.token)throw R.create("token-update-no-token");return s.token}async function xd(e,t){const r={method:"DELETE",headers:await nr(e)};try{const s=await(await fetch(`${tr(e.appConfig)}/${t}`,r)).json();if(s.error){const o=s.error.message;throw R.create("token-unsubscribe-failed",{errorInfo:o})}}catch(i){throw R.create("token-unsubscribe-failed",{errorInfo:i==null?void 0:i.toString()})}}function tr({projectId:e}){return`${ld}/projects/${e}/registrations`}async function nr({appConfig:e,installations:t}){const n=await t.getToken();return new Headers({"Content-Type":"application/json",Accept:"application/json","x-goog-api-key":e.apiKey,"x-goog-firebase-installations-auth":`FIS ${n}`})}function lo({p256dh:e,auth:t,endpoint:n,vapidKey:r}){const i={web:{endpoint:n,auth:t,p256dh:e}};return r!==oo&&(i.web.applicationPubKey=r),i}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const vd=7*24*60*60*1e3;async function Td(e){const t=await Cd(e.swRegistration,e.vapidKey),n={vapidKey:e.vapidKey,swScope:e.swRegistration.scope,endpoint:t.endpoint,auth:H(t.getKey("auth")),p256dh:H(t.getKey("p256dh"))},r=await wd(e.firebaseDependencies);if(r){if(Id(r.subscriptionOptions,n))return Date.now()>=r.createTime+vd?Od(e,{token:r.token,createTime:Date.now(),subscriptionOptions:n}):r.token;try{await xd(e.firebaseDependencies,r.token)}catch(i){console.warn(i)}return Vr(e.firebaseDependencies,n)}else return Vr(e.firebaseDependencies,n)}async function Od(e,t){try{const n=await Ad(e.firebaseDependencies,t),r={...t,token:n,createTime:Date.now()};return await er(e.firebaseDependencies,r),n}catch(n){throw n}}async function Vr(e,t){const r={token:await Sd(e,t),createTime:Date.now(),subscriptionOptions:t};return await er(e,r),r.token}async function Cd(e,t){const n=await e.pushManager.getSubscription();return n||e.pushManager.subscribe({userVisibleOnly:!0,applicationServerKey:hd(t)})}function Id(e,t){const n=t.vapidKey===e.vapidKey,r=t.endpoint===e.endpoint,i=t.auth===e.auth,s=t.p256dh===e.p256dh;return n&&r&&i&&s}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function zr(e){const t={from:e.from,collapseKey:e.collapse_key,messageId:e.fcmMessageId};return Rd(t,e),Dd(t,e),Nd(t,e),t}function Rd(e,t){if(!t.notification)return;e.notification={};const n=t.notification.title;n&&(e.notification.title=n);const r=t.notification.body;r&&(e.notification.body=r);const i=t.notification.image;i&&(e.notification.image=i);const s=t.notification.icon;s&&(e.notification.icon=s)}function Dd(e,t){t.data&&(e.data=t.data)}function Nd(e,t){var i,s,o,a;if(!t.fcmOptions&&!((i=t.notification)!=null&&i.click_action))return;e.fcmOptions={};const n=((s=t.fcmOptions)==null?void 0:s.link)??((o=t.notification)==null?void 0:o.click_action);n&&(e.fcmOptions.link=n);const r=(a=t.fcmOptions)==null?void 0:a.analytics_label;r&&(e.fcmOptions.analyticsLabel=r)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function kd(e){return typeof e=="object"&&!!e&&ao in e}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Pd(e){if(!e||!e.options)throw Kt("App Configuration Object");if(!e.name)throw Kt("App Name");const t=["projectId","apiKey","appId","messagingSenderId"],{options:n}=e;for(const r of t)if(!n[r])throw Kt(r);return{appName:e.name,projectId:n.projectId,apiKey:n.apiKey,appId:n.appId,senderId:n.messagingSenderId}}function Kt(e){return R.create("missing-app-config-values",{valueName:e})}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class Md{constructor(t,n,r){this.deliveryMetricsExportedToBigQueryEnabled=!1,this.onBackgroundMessageHandler=null,this.onMessageHandler=null,this.logEvents=[],this.isLogServiceStarted=!1;const i=Pd(t);this.firebaseDependencies={app:t,appConfig:i,installations:n,analyticsProvider:r}}_delete(){return Promise.resolve()}}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Bd(e){try{e.swRegistration=await navigator.serviceWorker.register(cd,{scope:ud}),e.swRegistration.update().catch(()=>{}),await Fd(e.swRegistration)}catch(t){throw R.create("failed-service-worker-registration",{browserErrorMessage:t==null?void 0:t.message})}}async function Fd(e){return new Promise((t,n)=>{const r=setTimeout(()=>n(new Error(`Service worker not registered after ${Hr} ms`)),Hr),i=e.installing||e.waiting;e.active?(clearTimeout(r),t()):i?i.onstatechange=s=>{var o;((o=s.target)==null?void 0:o.state)==="activated"&&(i.onstatechange=null,clearTimeout(r),t())}:(clearTimeout(r),n(new Error("No incoming service worker found.")))})}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Ld(e,t){if(!t&&!e.swRegistration&&await Bd(e),!(!t&&e.swRegistration)){if(!(t instanceof ServiceWorkerRegistration))throw R.create("invalid-sw-registration");e.swRegistration=t}}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function $d(e,t){t?e.vapidKey=t:e.vapidKey||(e.vapidKey=oo)}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function fo(e,t){if(!navigator)throw R.create("only-available-in-window");if(Notification.permission==="default"&&await Notification.requestPermission(),Notification.permission!=="granted")throw R.create("permission-blocked");return await $d(e,t==null?void 0:t.vapidKey),await Ld(e,t==null?void 0:t.serviceWorkerRegistration),Td(e)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function jd(e,t,n){const r=Ud(t);(await e.firebaseDependencies.analyticsProvider.get()).logEvent(r,{message_id:n[ao],message_name:n[fd],message_time:n[dd],message_device_time:Math.floor(Date.now()/1e3)})}function Ud(e){switch(e){case Me.NOTIFICATION_CLICKED:return"notification_open";case Me.PUSH_RECEIVED:return"notification_foreground";default:throw new Error}}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Hd(e,t){const n=t.data;if(!n.isFirebaseMessaging)return;e.onMessageHandler&&n.messageType===Me.PUSH_RECEIVED&&(typeof e.onMessageHandler=="function"?e.onMessageHandler(zr(n)):e.onMessageHandler.next(zr(n)));const r=n.data;kd(r)&&r[pd]==="1"&&await jd(e,n.messageType,r)}const Wr="@firebase/messaging",Jr="0.12.23";/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const qd=e=>{const t=new Md(e.getProvider("app").getImmediate(),e.getProvider("installations-internal").getImmediate(),e.getProvider("analytics-internal"));return navigator.serviceWorker.addEventListener("message",n=>Hd(t,n)),t},Kd=e=>{const t=e.getProvider("messaging").getImmediate();return{getToken:r=>fo(t,r)}};function Vd(){fe(new Y("messaging",qd,"PUBLIC")),fe(new Y("messaging-internal",Kd,"PRIVATE")),J(Wr,Jr),J(Wr,Jr,"esm2020")}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function zd(){try{await Bs()}catch{return!1}return typeof window<"u"&&Ms()&&cl()&&"serviceWorker"in navigator&&"PushManager"in window&&"Notification"in window&&"fetch"in window&&ServiceWorkerRegistration.prototype.hasOwnProperty("showNotification")&&PushSubscription.prototype.hasOwnProperty("getKey")}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Wd(e,t){if(!navigator)throw R.create("only-available-in-window");return e.onMessageHandler=t,()=>{e.onMessageHandler=null}}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Jd(e=lf()){return zd().then(t=>{if(!t)throw R.create("unsupported-browser")},t=>{throw R.create("indexed-db-unsupported")}),Gn(Wn(e),"messaging").getImmediate()}async function Gd(e,t){return e=Wn(e),fo(e,t)}function Xd(e,t){return e=Wn(e),Wd(e,t)}Vd();window.Alpine=Rs;Rs.start();console.log("🔥 JS file loaded");const Yd={apiKey:"AIzaSyCGuYbCyYhOQtGQelQQhk_eR-EF-e0wEik",authDomain:"flat-925c4.firebaseapp.com",databaseURL:"https://flat-925c4-default-rtdb.firebaseio.com",projectId:"flat-925c4",storageBucket:"flat-925c4.firebasestorage.app",messagingSenderId:"812868767585",appId:"1:812868767585:web:9ce8153351517785643f20",measurementId:"G-DPDKL4WZHH"};console.log("✅ Firebase config loaded");try{const e=$s(Yd);console.log("✅ Firebase initialized");const t=Jd(e);console.log("✅ Messaging instance created"),console.log("🔍 Notification.permission =",Notification.permission),Notification.requestPermission().then(n=>{console.log("🔍 Permission result =",n),n==="granted"?(console.log("🔍 VAPID Key =",void 0),Gd(t,{vapidKey:void 0}).then(i=>{i?(console.log("✅ FCM Token generated:",i),axios.post("/fcm/store-token",{token:i}).then(()=>console.log("✅ Token sent to backend")).catch(s=>console.error("❌ Error sending token to backend:",s))):console.warn("⚠️ No FCM token retrieved")}).catch(i=>{console.error("❌ Error retrieving token:",i)})):console.warn("⚠️ Notifications not granted by user")}),Xd(t,n=>{console.log("📩 Foreground message received:",n)})}catch(e){console.error("❌ Firebase init error:",e)}
