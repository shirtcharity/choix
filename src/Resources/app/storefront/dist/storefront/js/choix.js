(window.webpackJsonp=window.webpackJsonp||[]).push([["choix"],{O6wl:function(t,e,n){"use strict";n.r(e);var r=n("k8s9");function o(t){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function i(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function c(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}function a(t,e){return!e||"object"!==o(e)&&"function"!=typeof e?function(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}(t):e}function u(t){return(u=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}function f(t,e){return(f=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}var s=function(t){function e(){return i(this,e),a(this,u(e).apply(this,arguments))}var n,o,s;return function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&f(t,e)}(e,t),n=e,(o=[{key:"init",value:function(){var t=new r.a(window.accessKey,window.contextToken);Array.prototype.forEach.call(document.getElementsByClassName("checkout-confirm-transfer-radio"),(function(e){e.checked=!0,e.checked=!1,e.addEventListener("change",(function(){t.post("/shirtcharity/checkout/data-transfer",JSON.stringify({_csrf_token:this.getAttribute("data-csrf-token"),dataTransferAccepted:"yes"===this.value}))}))}))}}])&&c(n.prototype,o),s&&c(n,s),e}(n("FGIj").a);window.PluginManager.register("SetDataTransferPlugin",s,"[data-set-data-transfer-plugin]")}},[["O6wl","runtime","vendor-node","vendor-shared"]]]);