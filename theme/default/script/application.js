/**
 * Base scripting functionality for trivia game application
 *
 * @TODO DI-Container 4 cfg
 *
 * @package Ffhttg
 * @author Sven Schrodt <sven.flowfact.de>
 * @version 0.1
 * @since 2021-02-04
 */

document.addEventListener('DOMContentLoaded', function (event) {
    init();


});


function init() {
    // @todo register events

    // Generic global DOM query function
    window.$ = function(selector) {
        return document.getquerySelectorAll(selector);
    };

    // Getter for DOM element with given ID
    window.ID = function(id) {
        return document.getElementById(id);
    };

    // Global alias for setInterval
        window.__iv =function(callback, milliseconds) {
            return setInterval(callback, milliseconds);
        }
}

function activate(obj) {
    obj.children[0].checked = true;
}



function checkAmountOfAnswered() {

    let nonAnswered = new Array();
    const coll = document.querySelectorAll('fieldset');

    for(let i=0;i<coll.length;i++) {
        let what = isOneChecked(coll[i].querySelectorAll('input[type="radio"]'));

        if( !what) {
            nonAnswered.push(i);
        }
    }
    if(nonAnswered.length>0) {
        for(let x=0;x<nonAnswered.length;x++) {
            coll[x].style = 'background-color:red';
        }
    }


    return false;
}

function isOneChecked(nodeList)
{
    console.log(nodeList.length);

   let isOk = false;
    for(let i=0;i<nodeList.length;i++) {

        if(nodeList[i].checked === true) {
         return true;
        }
    }
    return isOk;

}