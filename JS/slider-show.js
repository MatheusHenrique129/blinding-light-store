"use strict";

const images = [
  { id: "1", url: "images/slider/desktop-discount-slider.png" },
  { id: "2", url: "images/slider/desktop-jeans-slider.gif" },
  { id: "3", url: "images/slider/desktop-polo-brand-slider.png" },
  {
    id: "4",
    url: "images/slider/desktop-promotion-shirt-polo-brand-slider.jpg",
  },
  { id: "5", url: "images/slider/desktop-tennis-slider.gif" },
  { id: "6", url: "images/slider/desktop-white-shirt-slider.jpg" },
  { id: "7", url: "images/slider/desktop-water-poof-slider.jpg" },
];

const containerItems = document.querySelector("#containerItems");

const loadImages = (images, container) => {
  images.forEach((image) => {
    container.innerHTML += `
            <div class='item'>
                <img src='${image.url}'
            </div>
        `;
  });
};

loadImages(images, containerItems);

let items = document.querySelectorAll(".item");

const next = () => {
  containerItems.appendChild(items[0]);
  items = document.querySelectorAll(".item");
};

setInterval(next, 5200);

const previous = () => {
  const lastItem = items[items.length - 1];
  containerItems.insertBefore(lastItem, items[0]);
  items = document.querySelectorAll(".item");
};

document.querySelector("#next").addEventListener("click", next);
document.querySelector("#previous").addEventListener("click", previous);
