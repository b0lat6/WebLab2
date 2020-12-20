let windowShow = function() {
    let k = document.getElementById("window");
    for (let i in window) {
        k.append(i+"\n");
    }
};

let documentShow  = function() {
    let k = document.getElementById("document");
    for (let i in document) {
        k.append(i+"\n");
    }
};

let locationShow  = function() {
    let k = document.getElementById("location");
    for (let i in location) {
        k.append(i+"\n");
    }
};

let navigatorShow  = function() {
    let k = document.getElementById("navigator");
    for (let i in navigator) {
        k.append(i+"\n");
    }
};