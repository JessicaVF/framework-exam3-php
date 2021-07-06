const divRestaurants = document.querySelector(".restaurants");

function displayAllRestaurants() {
  let maRequete = new XMLHttpRequest();

  maRequete.open(
    "GET",
    "http://localhost/humanBooster/framework-exam3-php/index.php?controller=restaurant&task=indexApi"
  );

  maRequete.onload = () => {
    let data = JSON.parse(maRequete.responseText);
    restaurantsCards(data);
  };

  maRequete.send();
}
displayAllRestaurants();

function restaurantsCards(restaurants) {
  let cards = "";

  restaurants.forEach((element) => {
    card = `        <div class="col-4 p-3">

        <div class="card" style="width: 18rem;">
            <div class="card-body">
            <h5 class="card-title">${element.name}</h5>
            <p class="card-text">${element.address}</p>
            <button value="${element.id}" class="btn btn-primary showRestaurant">voir la carte</button>
            </div>
        </div>

    </div>`;

    cards += card;
    divRestaurants.innerHTML = cards;
  });

  document.querySelectorAll(".showRestaurant").forEach((bouton) => {
    bouton.addEventListener("click", (event) => {
      showRestaurant(bouton.value);
    });
  });
}

function showRestaurant(id) {
  let maRequete = new XMLHttpRequest();

  maRequete.open(
    "GET",
    `http://localhost/humanBooster/framework-exam3-php/index.php?controller=restaurant&task=showApi&id=${id}`
  );

  maRequete.onload = () => {
    let data = JSON.parse(maRequete.responseText);

    let restaurant = data.restaurant;
    let plats = data.plats;

    cardRestaurantAndPlats(restaurant, plats);
  };

  maRequete.send();
}

function cardRestaurantAndPlats(restaurant, plats) {
  let cardRestaurant = `        <div class="col-4 p-3">

  <div class="card" style="width: 18rem;">
      <div class="card-body">
      <h5 class="card-title">${restaurant.name}</h5>
      <p class="card-text">${restaurant.address}</p>
      </div>
           <button class="btn btn-success retourRestaurants">Retour aux Restaurants</button>
   </div> 
 
</div>`;

  divRestaurants.innerHTML = cardRestaurant;

  cardsPlats = "";

  plats.forEach((plat) => {
    cardPlat = `        <div class="row" data-plat="${plat.id}">
<hr>
    <p><strong>${plat.name}</strong></p>
    <p><strong>${plat.price}</strong></p>
    <p>${plat.description}</p>
<button class="btn btn-danger supprPlat" value="${plat.id}">Supprimer</button>
   
<hr>
</div>`;

    cardsPlats += cardPlat;
  });

  divRestaurants.innerHTML += cardsPlats;

  document
    .querySelector(".retourRestaurants")
    .addEventListener("click", (event) => {
      displayAllRestaurants();
    });

  document.querySelectorAll(".supprPlat").forEach((bouton) => {
    bouton.addEventListener("click", (event) => {
      supprPlat(bouton.value);
    });
  });
}

function supprPlat(id) {
  let maRequete = new XMLHttpRequest();

  maRequete.open(
    "POST",
    "http://localhost/humanBooster/framework-exam3-php/index.php?controller=plat&task=supprPlatApi"
  );

  maRequete.onload = () => {
    let data = JSON.parse(maRequete.responseText);

    console.log(data);
  };

  maRequete.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );

  params = "id=" + id;
  maRequete.send(params);

  let divPlat = document.querySelector(`div[data-plat="${id}"]`);

  divPlat.remove();
}
