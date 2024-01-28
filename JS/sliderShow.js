'use strict';

const images = [
    {'id': '1', 'url':'imagens/roupa-branca.jpg'},
    {'id': '2', 'url':'imagens/promocao.jpg'},
    {'id': '3', 'url':'imagens/logoTipo.png'},
    {'id': '4', 'url':'imagens/desconto.png'},
    {'id': '5', 'url':'imagens/polo.jpg'},
    {'id': '6', 'url':'imagens/paris.jpg'},
]

const containerItems = document.querySelector('#containerItems');

const loadImages = ( images, container ) => {
    images.forEach ( image => {
        container.innerHTML += `
            <div class='item'>
                <img src='${image.url}'
            </div>
        `
    })
}

loadImages( images, containerItems );

let items = document.querySelectorAll('.item');

const next = () => {
    containerItems.appendChild(items[0]);
    items = document.querySelectorAll('.item');
}

const previous = () => {
    const lastItem = items[items.length -1];
    containerItems.insertBefore(lastItem, items[0]);
    items = document.querySelectorAll('.item');
}

document.querySelector('#next').addEventListener('click', next);
document.querySelector('#previous').addEventListener('click', previous);