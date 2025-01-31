'use strict'
const burgerMenuButton = document.querySelector('.burger-menu')//on recupère la class burger menu ou se trouve à l'intérieur l'icone burger
const icon = document.querySelector('.burger-menu i')//on recupère l'icone pour le moment ou on va cliquer dessus
const menu = document.querySelector('.burger')//on 

burgerMenuButton.onclick = function(){
    menu.classList.toggle('open')//a chaque clique sa vas ajouter open
    const isOpen = menu.classList.contains('open')
    icon.classList = isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars' //un ternaire afficher une croix si isOpen sinon on affiche l'icone de base
}


