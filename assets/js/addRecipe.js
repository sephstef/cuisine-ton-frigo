// ici la seule différence avec l'ajout d'une étape c'est que je clone le select massUnit car je génère les options en php

function cloneIngredientInputs() {
    let div = document.createElement('div');
    div.setAttribute('class', 'mb-3');

    let secondDiv = document.createElement('div');
    secondDiv.setAttribute('class', 'input-group mb-3');

    let label = document.createElement('label');
    label.setAttribute('for', 'ingredient');
    label.setAttribute('class', 'form-label');
    label.innerHTML = 'Ingrédient';

    let input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('class', 'form-control');
    input.setAttribute('name', 'ingredient[]');
    input.setAttribute('id', 'ingredient' );

    let span = document.createElement('span');
    span.setAttribute('class', 'input-group-text');
    span.innerHTML = 'Quantité';

    let secondInput = document.createElement('input');
    secondInput.setAttribute('type', 'number');
    secondInput.setAttribute('class', 'form-control');
    secondInput.setAttribute('name', 'quantity[]');
    secondInput.setAttribute('id', 'quantity' );

    let secondSpan = document.createElement('span');
    secondSpan.setAttribute('class', 'input-group-text');
    secondSpan.innerHTML = 'Unité';

    let selectMassUnit = document.getElementById('massUnit');
    let clone = selectMassUnit.cloneNode(true);
    

    document.getElementById('ingredientTarget').append(div);
    div.append(label);
    div.append(input);

    document.getElementById('ingredientTarget').append(secondDiv);
    secondDiv.append(span);
    secondDiv.append(secondInput);
    secondDiv.append(secondSpan);
    secondDiv.append(clone);
}

document.getElementById('addIngredient').addEventListener('click', cloneIngredientInputs);

function cloneKitchenToolInput() {
    let div = document.createElement('div');
    div.setAttribute('class', 'mb-3');
    
    let label = document.createElement('label');
    label.setAttribute('for', 'cookingTool');
    label.setAttribute('class', 'form-label');
    label.innerHTML = 'Ustensile de Cuisine';

    let input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('class', 'form-control');
    input.setAttribute('name', 'kitchenTool[]')
    input.setAttribute('id', 'kitchenTool' );

    document.getElementById('kitchenToolGroup').append(div);
    div.append(label);
    div.append(input);
}

document.getElementById('addKitchenTool').addEventListener('click', cloneKitchenToolInput);


// Je crée une div avec createElement et je lui donne une classe bootstrap qui met 
// une marge en dessous de la div ensuite je crée le label en lui définissant des 
// attributs for et classe. Pour finir je crée le textarea qui lui a pour particularité d’avoir 
// un name sous forme de tableau c’est ce qui me permet d’ajouter mes étapes grâce 
// à une boucle foreach.

function cloneStepInput() {
    let div = document.createElement('div');
    div.setAttribute('class', 'mb-3');
    
    let label = document.createElement('label');
    label.setAttribute('for', 'step');
    label.setAttribute('class', 'form-label');
    label.innerHTML = `Nouvelle étape de la recette`;

    let textarea = document.createElement('textarea');
    textarea.setAttribute('class', 'form-control');
    textarea.setAttribute('name', 'step[]')
    textarea.setAttribute('id', 'step' );

    document.getElementById('stepTarget').append(div);
    div.append(label);
    div.append(textarea);
}
//La fonction est déclanchée par le bouton + qui a pour id addStep.

document.getElementById('addStep').addEventListener('click', cloneStepInput);

