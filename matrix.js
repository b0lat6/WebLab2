let matrixGenerate;
let matrix = document.querySelector('.matrix');
let body = document.querySelector('body');


let rand = function(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
};

let generateMatrix = function(matrixGenerate) {
    matrixGenerate = new Array(10);
    for(let i = 0; i < 10; i++) {
        matrixGenerate[i] = new Array(10);
                for(let j = 0; j < 10; j++) {
            matrixGenerate[i][j] = rand(0, 100);
        }
    }
    return matrixGenerate;
};

let updateMatrix = function() {

    matrix.innerHTML = '';

    for(let i = 0; i < 10; i++) {
        
        let trTable = document.createElement('tr');

        for(let j = 0; j < 10; j++) {

            let tdTable = document.createElement('td');
            tdTable.classList.add('elem');
            let inputTable = document.createElement('input');

            inputTable.type = 'text';
            inputTable.value = matrixGenerate[i][j];

            trTable.appendChild(tdTable);
            tdTable.appendChild(inputTable);
            
        }
    
        matrix.appendChild(trTable);
    }
};

let sortMatrix = function(matrixGenerate) {
    for(let i = 0; i < 10; i++) {
        if (i % 2 === 0) {
            for(let j = 0; j < 10; j++) {
                for(let k = j; k < 10; k++) {
                    if(matrixGenerate[i][k] < matrixGenerate[i][j]) {
                        let temp = matrixGenerate[i][k];
                        matrixGenerate[i][k] = matrixGenerate[i][j];
                        matrixGenerate[i][j] = temp;
                    }
                }
            }
        } else {
            for(let j = 0; j < 10; j++) {
                for(let k = j; k < 10; k++) {
                    if(matrixGenerate[i][k] > matrixGenerate[i][j]) {
                        let temp = matrixGenerate[i][k];
                        matrixGenerate[i][k] = matrixGenerate[i][j];
                        matrixGenerate[i][j] = temp;
                    }
                }
            }
        }
    }
    return matrixGenerate;
};

let buttonSort = document.createElement('button');
buttonSort.textContent = 'Сортировка';
buttonSort.disabled = true;
buttonSort.classList.add('sort-button');
buttonSort.addEventListener('click', function() {
    matrixGenerate = sortMatrix(matrixGenerate);
    updateMatrix();
})
body.appendChild(buttonSort);

let buttonRand = document.createElement('button');
buttonRand.textContent = 'Random';
buttonRand.classList.add('sort-button');
buttonRand.addEventListener('click', function() {
    matrixGenerate = generateMatrix(matrixGenerate);
    updateMatrix();
    buttonSort.disabled = false;
})
body.appendChild(buttonRand);
