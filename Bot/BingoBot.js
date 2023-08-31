// ==UserScript==
// @name         Bot for Bing
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  Learning to Bot.
// @author       You
// @match        https://www.bing.com/*
// @icon         data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
// @grant        none
// ==/UserScript==

let searchInput = document.getElementById("sb_form_q");
let button = document.getElementById("search_icon");
let links = document.links
let keywords = ["10 самых популярных шрифтов от Google",
               // "Отключение редакций и ревизий в WordPress",
               // "Вывод произвольных типов записей и полей в WordPress"
               ];
let keyword = keywords[getRandom(0, keywords.length)];


if(button != undefined) {
  let i = 0;
  let timerId = setInterval(function() {
    searchInput.value += keyword[i];
    i++;
    if (i == keyword.length) {
      clearInterval(timerId);
      button.click();
    };
  }, 500);
} else {
  for (let i = 0; i < links.length; i++) {
    if(links[i].href.indexOf("napli.ru") != -1) {
      console.log("Got it " + links[i]);
      links[i].click();
      break;
    }
  }
}

function getRandom(min, max) {
  return Math.floor(Math.random() * (max - min) + min);
}
