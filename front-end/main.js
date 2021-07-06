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
    card = `        <div class="col-4 p-3 text-center">

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

  let formCard = `<hr> <h3>Add Plat:</h3>
  
  <form action="">

    <label for="formPlatName">Plat name:</label><br>
    <input type="text" id="formPlatName" name="formPlatName" required><br><br>

    <label for="formPlatPrice">Plat price:</label><br>
    <input type="number" id="formPlatPrice" name="formPlatPrice" required><br><br>
    
    <label for="formPlatDescription">Plat description:</label><br>
    <input type="text" id="formPlatDescription" name="formPlatDescription" required><br>

    <input type="hidden" id="formPlatRestaurantId" name="formPlatRestaurantId" value=${restaurant.id}><br><br>

    <input type="submit" id="addPlat" value="Submit">
</form> <br>`;

  divRestaurants.innerHTML += formCard;
  cardsPlats = "";

  plats.forEach((plat) => {
    cardPlat = `        <div class="row text-center" data-plat="${plat.id}">
<hr>
    <p><strong>${plat.name}</strong></p>
    <p><strong>${plat.price}  euros</strong></p>
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
  let btnAddPlat = document.querySelector("#addPlat");
  btnAddPlat.addEventListener("click", (event) => {
    let platName = btnAddPlat.form.formPlatName.value;
    let platDescription = btnAddPlat.form.formPlatDescription.value;
    let platPrice = btnAddPlat.form.formPlatPrice.value;
    let restaurantId = btnAddPlat.form.formPlatRestaurantId.value;
    addPlat(platName, platDescription, platPrice, restaurantId);
    event.preventDefault();
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

function addPlat(platName, platDescription, platPrice, restaurantId) {
  let maRequete = new XMLHttpRequest();

  maRequete.open(
    "POST",
    "http://localhost/humanBooster/framework-exam3-php/index.php?controller=plat&task=addPlatApi"
  );

  maRequete.onload = () => {
    // let data = JSON.parse(maRequete.responseText);
    showRestaurant(restaurantId);
  };

  maRequete.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  let params = `platName=${platName}&platDescription=${platDescription}&platPrice=${platPrice}&restaurantId=${restaurantId}`;
  maRequete.send(params);
}
