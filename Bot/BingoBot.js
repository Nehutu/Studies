// ==UserScript==
// @name         Bot for Bing
// @namespace    http://tampermonkey.net/
// @version      0.2
// @description  Learning to Bot.
// @author       You
// @match        https://www.bing.com/*
// @match        https://napli.ru/*
// @icon         data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
// @grant        none
// ==/UserScript==

let searchInput = document.getElementById("sb_form_q");
let button = document.getElementById("search_icon");
let links = document.links
let buttonNext = document.querySelector('[title="Следующая страница"]');
let keywords = ["10 популярных шрифтов Google",
                "Отключение редакций и ревизий",
                "Вывод произвольных типов записей и полей wp",
                "Конвертация Notion в Obsidian",
                "FFmpeg",
                "VSCode плагины"];
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
} else if (location.hostname == "napli.ru") {
  console.log("Target site reached.");
  setInterval(() => {
    let index = getRandom(0, links.length);
    if (getRandom(0, 101) >= 75) {
      location.href = "https://www.bing.com/";
    }
    if (links.length == 0) {
      location.href = "https://napli.ru/";
    }
    if(links[index].href.includes("napli.ru")) {
      links[index].click();
    }
  }, getRandom(3000, 5000))
} else {
  let nextBingPage = true;
  for (let i = 0; i < links.length; i++) {
    if(links[i].href.indexOf("napli.ru") != -1) {
      console.log("Got link " + links[i]);
      let link = links[i];
      nextBingPage = false;
      setTimeout(() => {link.click();}, getRandom(1000, 3000));
      break;
    }
  }
  let elementExist = setInterval(() => {
    let elm = document.querySelector(".sb_pagS");
    if (elm != null) {
      if (elm.innerText == "5") {
        nextBingPage = false;
        location.href = "https://www.bing.com/";
      }
      clearInterval(elementExist);
    }
  }, 100)
  if (nextBingPage) {
    setTimeout(() => {
      buttonNext.click();
    }, getRandom(3000, 5000))
  }
}

function getRandom(min, max) {
  return Math.floor(Math.random() * (max - min) + min);
}
